@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endsection

@section('content')
<div class="register-form">
    <h2 class="register-form__heading content__heading">
        会員登録
    </h2>
    <div class="register-form__inner">
        <form class="register-form__form" action="/register" method="POST">
            @csrf
            <div class="register-form__group">
                <label class="register-form__label" for="name">ユーザー名</label>
                <input class="register-form__input" type="text" name="name" id="name" value="{{ old('name') }}">
                <p class="register-form__error-message">
                    @error('name')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="email">メールアドレス</label>
                <input class="register-form__input" type="text" name="email" id="email" value="{{ old('email') }}">
                <p class="register-form__error-message">
                    @error('email')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="password">パスワード</label>
                <input class="register-form__input" type="password" name="password" id="password">
                <p class="register-form__error-message">
                    @error('password')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="register-form__group">
                <label class="register-form__label" for="password">確認用パスワード</label>
                <input class="register-form__input" type="password" name="password_confirmation">
                <p class="register-form__error-message">
                    @error('password')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <input class="register-form__btn btn" type="submit" value="登録する">
            <a class="register-form__link" href="/login">ログインはこちら</a>
        </form>
    </div>
</div>
@endsection