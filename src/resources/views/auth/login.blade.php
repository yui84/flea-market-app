@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endsection

@section('content')
<div class="login-form">
    <h2 class="login-form__heading content__heading">
        ログイン
    </h2>
    <div class="login-form__inner">
        <form class="login-form__form" action="/login" method="POST">
            @csrf
            <div class="login-form__group">
                <label class="login-form__label" for="email">ユーザー名/メールアドレス</label>
                <input class="login-form__input" type="email" name="email" id="email" value="{{ old('email') }}">
                <p class="login-form__error-message">
                    @error('email')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="login-form__group">
                <label class="login-form__label" for="password">パスワード</label>
                <input class="login-form__input" type="password" name="password" id="password">
                <p class="login-form__error-message">
                    @error('password')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <input class="login-form__btn btn" type="submit" value="ログインする">
            <a class="login-form__link" href="/register">会員登録はこちら</a>
        </form>
    </div>
</div>
@endsection