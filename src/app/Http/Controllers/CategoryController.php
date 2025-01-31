<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\State;

class CategoryController extends Controller
{
    //商品出品画面表示
    public function getSell()
    {
        $categories = Category::all();
        $states = State::all();

        return view('sell', compact('categories', 'states'));
    }
}
