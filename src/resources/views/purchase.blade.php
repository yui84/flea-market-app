@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
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
<div class="form-contents">
    <form action="/item/purchase" method="POST">
        @csrf
        <input type="hidden" name="item_id" value="{{ $item->id }}">
        <input type="hidden" name="item_name" value="{{ $item->name }}">
        <input type="hidden" name="item_price" value="{{ $item->price }}">
        <div class="all-contents">
            <div class="left-contents">
                <div class="item left-group">
                    <img class="item-image" src="{{ asset($item->image) }}" alt="商品画像">
                    <div class="item-detail">
                        <h2 class="item-name">{{ $item->name }}</h2>
                        <p class="item-price"><span>¥ </span>{{ $item->price }}</p>
                    </div>
                </div>
                <div class="left-group">
                    <p class="title">支払い方法</p>
                    <div class="select-inner">
                        <select class="select" name="purchase_id" id="payment-method">
                            <option disabled selected>選択してください</option>
                            <option value="1">コンビニ支払い</option>
                            <option value="2">カード支払い</option>
                        </select>
                    </div>
                    @error('purchase_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="left-group">
                    <div class="delivery">
                        <p class="title">配送先</p>
                        <a class="address-link" href="/purchase/address/{{$item->id}}">変更する</a>
                    </div>
                    <div class="user-address">
                        <p class="postcode"><span>〒 </span>{{ $address['postcode'] }}</p>
                        <p class="address">{{ $address['address'] }}<span> </span>{{ $address['building'] }}</p>
                    </div>
                    <input type="hidden" name="user_address" value="{{ $address['postcode'] }} {{ $address['address'] }} {{ $address['building'] }}">
                    @error('user_address')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="right-contents">
                <div class="summary">
                    <table class="table">
                        <tr class="table-row">
                            <th class="table-title">商品代金</th>
                            <td class="table-inner"><span>¥ </span>{{ $item->price }}</td>
                        </tr>
                        <tr class="table-row">
                            <th class="table-title">支払い方法</th>
                            <td class="table-inner" id="selected-payment-method"></td>
                        </tr>
                    </table>
                </div>
                <button class="buy-button" type="submit">購入する</button>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById('payment-method').addEventListener('change', function() {

        const selectedMethod = this.options[this.selectedIndex].text;

        document.getElementById('selected-payment-method').textContent = selectedMethod;
    });
</script>
@endsection