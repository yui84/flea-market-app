@extends('layouts.app')

@section('content')
<div class="container">
    <h1>メール確認</h1>
    <p>メールアドレスの確認が必要です。登録したメールアドレスに確認メールを送信しました。メールボックスをご確認ください。</p>

    <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link">確認メールを再送信</button>
    </form>
</div>
@endsection
