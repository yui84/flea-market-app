<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Item;
use App\Models\Profile;
use App\Models\State;
use App\Models\Purchase;
use App\Models\Like;
use App\Models\Comment;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ExhibitionRequest;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\CommentRequest;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class ItemController extends Controller
{
    //プロフィール編集画面表示
    public function getProfile()
    {
        $user = Auth::user();

        $profile = $user->profile;

        return view('profile', compact('user', 'profile'));
    }

    //プロフィールデータ送信
    public function upload(ProfileRequest $request1, AddressRequest $request2)
    {
        $user = Auth::user();

        if ($request1->hasFile('image')) {
            $dir = 'ProfileImages';
            $file_name = $request1->file('image')->getClientOriginalName();
            $request1->file('image')->storeAs('public/' . $dir, $file_name);
            $imagePath = 'storage/' . $dir . '/' . $file_name;
    } else {
        $imagePath = $user->profile ? $user->profile->image : 'storage/ProfileImages/default-avatar.png';
    }

        $user->name = $request2->input('name');
        $user->save();

        if ($user->profile) {
            $profile_data = $user->profile;
        } else {
            $profile_data = new Profile();
            $profile_data->user_id = $user->id;
        }

        $profile_data->image = $imagePath;
        $profile_data->postcode = $request2->input('postcode');
        $profile_data->address = $request2->input('address');
        $profile_data->building = $request2->input('building');
        $profile_data->save();

        return redirect('/?tab=mylist');
    }

    //商品出品データ送信
    public function create(ExhibitionRequest $request)
    {
        $dir = 'ItemImages';
        $file_name = $request->file('item_image')->getClientOriginalName();
        $request->file('item_image')->storeAs('public/' . $dir , $file_name);

        $item_data = new Item();
        $item_data->user_id = Auth::id();
        $item_data->image = 'storage/' . $dir . '/' . $file_name;
        $item_data->state_id = $request->input('state_id');
        $item_data->name = $request->input('item_name');
        $item_data->detail = $request->input('item_detail');
        $item_data->price = $request->input('item_price');
        $item_data->save();

        $categories = $request->input('item_category');

        if ($categories) {
            foreach ($categories as $category_id) {
                DB::table('category_item')->insert([
                    'item_id' => $item_data->id,
                    'category_id' => $category_id
                ]);
            }
        }

        return redirect('/');
    }

    //商品一覧画面
    public function index(Request $request)
    {
        $userId = Auth::id();
        $tab = $request->query('tab');
        $keyword = $request->query('keyword');

        $query = Item::query();

        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        if ($tab === 'mylist') {
            $items = Item::whereHas('likes', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })->get();
        } else {
            $items = Item::where('user_id', '!=', $userId)
                    ->with('purchases')
                    ->get();
        }

        return view('index', compact('items'));
    }

    //商品検索機能
    public function search(Request $request)
    {
        $query = Item::query();
        $keyword = $request->input('keyword');

        if ($keyword) {
            $query->where('name','like','%' . $keyword . '%');
        }

        $items = $query->get();

        return view('index', compact('items'));
    }

    //商品詳細画面
    public function show($item_id)
    {
        $item = Item::with('categories', 'likes')->findOrFail($item_id);
        $liked = $item->likes->contains('user_id', Auth::id());

        return view('detail', compact('item', 'liked'));
    }

    //商品詳細画面いいね機能
    public function like(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $item_id = $request->item_id;

        $already_liked = Like::where('user_id', $user_id)->where('item_id', $item_id)->first();

        if (!$already_liked) {
            $like = new Like;
            $like->item_id = $item_id;
            $like->user_id = Auth::id();
            $like->save();
        } else {
            Like::where('item_id', $item_id)->where('user_id', $user_id)->delete();
        }

        return back();
    }

    //商品詳細画面コメント機能
    public function comment(CommentRequest $request)
    {
        $user = Auth::user();

        $user_id = Auth::user()->id;
        $item_id = $request->item_id;

        $comment_data = New Comment;
        $comment_data->user_id = Auth::id();
        $comment_data->item_id = $item_id;
        $comment_data->comment = $request->input('comment');
        $comment_data->save();

        return back();
    }

    //商品購入画面
    public function purchase($item_id)
    {
        $item = Item::findOrFail($item_id);

        $user = Auth::user();

        $address = session('temporary_address', $user->profile);

        return view('purchase', compact('item', 'user', 'address'));
    }

    //住所変更画面
    public function address($item_id)
    {
        return view('address', compact('item_id'));
    }

    //住所変更したデータ送信
    public function uploadTemporaryAddress(Request $request, $item_id)
    {
        $request->validate([
            'postcode' => 'required | string | regex:/^\d{3}-\d{4}$/',
            'address' => 'required',
            'building' => 'required'
        ]);

        session([
            'temporary_address' => [
                'postcode' => $request->input('postcode'),
                'address' => $request->input('address'),
                'building' => $request->input('building')
            ],
        ]);

        return redirect("/purchase/$item_id");
    }

    //商品購入データ送信
    public function uploadPurchase(PurchaseRequest $request)
    {
        $purchase_data = new Purchase();
        $purchase_data->item_id = $request->input('item_id');
        $purchase_data->user_id = Auth::id();
        $purchase_data->option = $request->input('purchase_id');
        $purchase_data->address = $request->input('user_address');
        $purchase_data->save();

        Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $request->input('item_name'),
                        ],
                        'unit_amount' => $request->input('item_price'),
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => url('/'),
            'cancel_url' => url('/')
        ]);

        return redirect($session->url);
    } catch (ApiErrorException $e) {
        return back()->withErrors(['error' => $e->getMessage()]);
    }
    }

    public function success(Request $request)
    {
        return redirect('/');
    }

    public function cancel()
    {
        return redirect('/');
    }

    //プロフィール画面表示
    public function mypage(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::user()->id;

        $tab = $request->query('tab');

        if ($tab === 'buy') {
            $items = $user->purchases;
        } else {
            $items = Item::where('user_id', $user_id)->get();
        }

        return view('mypage', compact('user' ,'items', 'tab'));
    }
}