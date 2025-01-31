@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
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
<div class="address-form">
    <h2 class="address-form__heading content__heading">
        住所の変更
    </h2>
    <div class="address-form__inner">
        <form class="address-form__form" action="/address/upload/{{ $item_id }}" method="POST">
            @csrf
            <div class="address-form__group">
                <label class="address-form__label">郵便番号</label>
                <input class="address-form__input" type="text" name="postcode" value="{{ old('postcode') }}">
                @error('postcode')
                    <span class="input_error">
                        <p class="input_error_message">{{$errors->first('postcode')}}</p>
                    </span>
                @enderror
            </div>
            <div class="address-form__group">
                <label class="address-form__label">住所</label>
                <input class="address-form__input" type="text" name="address" value="{{ old('address') }}">
                @error('address')
                    <span class="input_error">
                        <p class="input_error_message">{{$errors->first('address')}}</p>
                    </span>
                @enderror
            </div>
            <div class="address-form__group">
                <label class="address-form__label">建物名</label>
                <input class="address-form__input" type="text" name="building" value="{{ old('building') }}">
                @error('building')
                    <span class="input_error">
                        <p class="input_error_message">{{$errors->first('building')}}</p>
                    </span>
                @enderror
            </div>
            <input class="address-form__btn btn" type="submit" value="更新する">
        </form>
    </div>
</div>
@endsection