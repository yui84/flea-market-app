@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
<div class="content-header">
    <a class="best {{ request()->query('tab') === null ? 'active' : '' }}" href="{{ url('/') }}{{ request()->query('keyword') ? '?keyword=' . request()->query('keyword') : '' }}">おすすめ</a>
    @if (Auth::check())
    <a class="link-mylist {{ request()->query('tab') === 'mylist' ? 'active' : '' }}" href="{{ url('/?tab=mylist') }}{{ request()->query('keyword') ? '&keyword=' . request()->query('keyword') : '' }}">マイリスト</a>
    @else
    <a class="link-mylist {{ request()->query('tab') === 'mylist' ? 'active' : '' }}" href="/?tab=mylist">マイリスト</a>
    @endif
</div>
<div class="main-contents">
    @foreach ($items as $item)
        <div class="item-content">
            @if ($item->isSold())
                <div class="item-overlay">
                    <img class="img-content" src="{{ asset($item->image) }}" alt="商品画像">
                    <div class="sold-overlay">Sold</div>
                    <div class="detail-content">
                        <p class="item-name">{{ $item->name }}</p>
                    </div>
                </div>
            @else
                <a class="item-link" href="/item/{{$item->id}}">
                    <img class="img-content" src="{{ asset($item->image) }}" alt="商品画像">
                    <div class="detail-content">
                        <p class="item-name">{{ $item->name }}</p>
                    </div>
                </a>
            @endif
        </div>
    @endforeach
</div>
@endsection