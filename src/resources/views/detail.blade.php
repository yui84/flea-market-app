@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('link')
<form class="search-form" action="/search" method="GET">
    @csrf
    <input class="search-form__keyword-input" type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ request('keyword') }}">
</form>
<div class="header__link">
    @if (Auth::check())
        <form class="logout" action="/logout" method="POST">
            @csrf
            <input class="logout-link" type="submit" value="ログアウト">
        </form>
        <a class="link" href="/mypage">マイページ</a>
        <a class="link-sell" href="/sell">出品</a>
    @else
        <a class="link" href="/login">ログイン</a>
        <a class="link" href="/login">マイページ</あ>
        <a class="link-sell" href="/login">出品</a>
    @endif
</div>
@endsection

@section('content')
<div class="all-contents">
    <div class="detail-contents">
        <div class="left-content">
            <img class="img-content" src="{{ asset($item->image) }}" alt="商品画像">
        </div>
        <div class="right-content">
            <h2 class="item-name">{{ $item->name }}</h2>
            <p class="brand">ブランド名</p>
            <p class="item-price"><span>¥</span>{{ $item->price }}</p>
            <div class="good-comment">
                <form action="/item/{{$item->id}}/like" method="POST">
                    @csrf
                    <button class="good {{ $liked ? 'checked' : '' }}" type="submit">⭐︎</button>
                    <p class="good-count">{{ $item->likes->count() }}</p>
                </form>
                <div class="comment-icon">
                    <img class="icon" src="{{ asset('/images/comment.png') }}" alt="">
                    <p class="comment-count">{{ $item->comments->count() }}</p>
                </div>
            </div>
            <div class="button-content">
                <a class="purchase-link" href="/purchase/{{$item->id}}">購入手続きへ</a>
            </div>
            <h3 class="title">商品説明</h3>
            <p class="item-detail">{{ $item->detail }}</p>
            <h3 class="title">商品の情報</h3>
            <div class="item-category">
                <label class="label">カテゴリー</label>
                @foreach ($item->categories as $category)
                    <p class="category-type">{{ $category->type }}</p>
                @endforeach
            </div>
            <p class="item-state"><label class="label">商品の状態</label>{{ $item->state->content }}</p>
            <form action="/item/{{$item->id}}/comment" method="POST">
                @csrf
                <p class="comment-title">コメント(<span>{{ $item->comments->count() }}</span>)</p>
                <div class="comment-send">
                    @foreach ($item->comments as $comment)
                        <div class="user-send">
                            <div class="user-image">
                                <img class="profile-image" src="{{ asset($comment->user->profile->image) }}" alt="ユーザー画像">
                            </div>
                            <div class="user-name">
                                {{ $comment->user->name }}
                            </div>
                        </div>
                        <div class="user-comment">
                            {{ $comment->comment }}
                        </div>
                    @endforeach
                </div>
                <div class="item-comment">
                    <p class="item-comment-title">商品へのコメント</p>
                    <textarea class="textarea" name="comment" id="comment" cols="30" rows="10"></textarea>
                    @error('comment')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <button class="comment-button" type="submit">コメントを送信する</button>
            </form>
        </div>
    </div>
</div>
@endsection