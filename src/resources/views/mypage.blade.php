@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('link')
<form class="search-form" action="/search" method="GET">
    @csrf
    <input class="search-form__keyword-input" type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ request('keyword') }}">
</form>
<div class="header__link">
    <form class="logout" action="/logout" method="POST">
            @csrf
            <input class="logout-link" type="submit" value="ログアウト">
    </form>
    <a class="link" href="/mypage">マイページ</a>
    <a class="link-sell" href="/sell">出品</a>
</div>
@endsection

@section('content')
<div class="contents">
    <dic class="header-content">
        <div class="user-profile">
            <img src="{{ asset($user->profile->image ?? 'images/default-avatar.png') }}" alt="ユーザー画像" class="user-image">
            <p class="user-name">{{ $user->name }}</p>
            <a class="profile" href="/mypage/profile">プロフィールを編集</a>
        </div>
    </dic>
    <div class="main-content">
        <div class="main-content__header">
            <a class="sell-item {{ request()->query('tab') === 'sell' ? 'active' : '' }}" href="/mypage?tab=sell">出品した商品</a>
            <a class="buy-item  {{ request()->query('tab') === 'buy' ? 'active' : '' }}" href="/mypage?tab=buy">購入した商品</a>
        </div>
        <div class="main-item">
            @foreach ($items as $item)
                <div class="item-content">
                    <img class="img-content" src="{{ asset($item->image) }}" alt="商品画像">
                    @if ($tab === 'buy')
                        <div class="sold-overlay">Sold</div>
                    @endif
                    <div class="detail-content">
                        <p class="item-name">{{ $item->name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection