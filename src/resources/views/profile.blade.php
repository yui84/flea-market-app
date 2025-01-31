@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
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
<div class="mypage-form">
    <h2 class="mypage-form__heading content__heading">
        プロフィール設定
    </h2>
    <div class="mypage-form__inner">
        <form class="mypage-form__form" action="/profile/upload" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="user-image mypage-form__group">
                @if($profile && $profile->image)
                    <img src="{{ asset($profile->image) }}" alt="プロフィール画像"  class="current-image">
                @else
                    <img src="{{ asset('images/default-avatar.png') }}" alt="デフォルト画像" class="current-image">
                @endif
                <output id="list" class="image_output"></output>
                <label class="image-label">
                    <span class="image-title">画像を選択する</span>
                    <input type="file" id="image" class="image" name="image">
                </label>
                @error('image')
                    <span class="input_error">
                        <p class="input_error_message">{{ $message }}</p>
                    </span>
                @enderror
            </div>
            <div class="mypage-form__group">
                <label class="mypage-form__label">ユーザー名</label>
                <input class="mypage-form__input" type="text" name="name" value="{{ old('name', $profile->name ?? $user->name) }}">
                @error('name')
                    <span class="input_error">
                        <p class="input_error_message">{{ $message }}</p>
                    </span>
                @enderror
            </div>
            <div class="mypage-form__group">
                <label class="mypage-form__label">郵便番号</label>
                <input class="mypage-form__input" type="text" name="postcode" value="{{old('postcode', $profile->postcode ?? '')}}">
                @error('postcode')
                    <span class="input_error">
                        <p class="input_error_message">{{ $message }}</p>
                    </span>
                @enderror
            </div>
            <div class="mypage-form__group">
                <label class="mypage-form__label">住所</label>
                <input class="mypage-form__input" type="text" name="address" value="{{old('address', $profile->address ?? '')}}">
                @error('address')
                    <span class="input_error">
                        <p class="input_error_message">{{ $message }}</p>
                    </span>
                @enderror
            </div>
            <div class="mypage-form__group">
                <label class="mypage-form__label">建物名</label>
                <input class="mypage-form__input" type="text" name="building"value="{{old('building', $profile->building ?? '')}}">
                @error('building')
                    <span class="input_error">
                        <p class="input_error_message">{{ $message }}</p>
                    </span>
                @enderror
            </div>
            <input class="mypage-form__btn btn" type="submit" value="更新する">
        </form>
    </div>
</div>
<script>
    document.getElementById('image').onchange = function(event) {
        var files = event.target.files;

        if (files && files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                // 現在の画像（プロフィール画像）を新しい画像に更新
                var currentImage = document.querySelector('.current-image');
                currentImage.src = e.target.result;  // 新しい画像を表示

            };

            reader.readAsDataURL(files[0]);
        }
    };
</script>
@endsection