@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
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
<div class="sell-form">
    <h2 class="form__heading content__heading">
        商品の出品
    </h2>
    <div class="sell-form__inner">
        <form class="sell-form__form" action="/item/create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form__group">
                <label class="label">商品画像</label>
                <label class="image-label"><span class="image-title">画像を選択する</span>
                    <input class="image-input" type="file" id="item_image" name="item_image">
                    <output class="image-output" id="list"></output>
                </label>
                @error('item_image')
                    <span class="input__error">
                        <p class="input_error_message">{{$errors->first('item_image')}}</p>
                    </span>
                @enderror
            </div>
            <h3 class="form__title">
                商品の詳細
            </h3>
            <div class="form__group">
                <label class="label">カテゴリー</label>
                <div class="check-inner">
                    @foreach ($categories as $category)
                        <input class="input-check" type="checkbox" id="category_{{ $category->id }}" value="{{ $category->id }}" name="item_category[]">
                        <label class="label-check" for="category_{{ $category->id }}">{{ $category->type }}</label>
                    @endforeach
                </div>
                @error('item_category')
                    <span class="input__error">
                        <p class="input_error_message">{{$errors->first('item_category')}}</p>
                    </span>
                @enderror
            </div>
            <div class="form__group">
                <label class="label">商品の状態</label>
                <div class="select-inner">
                    <select class="select" name="state_id" id="">
                        <option disabled selected>選択してください</option>
                        @foreach ($states as $state)
                            <option value="{{$state->id}}"{{old('state_id')==$state->id?'selected':''}}>{{ $state->content }}</option>
                        @endforeach
                    </select>
                </div>
                @error('state_id')
                    <span class="input__error">
                        <p class="input_error_message">{{$errors->first('state_id')}}</p>
                    </span>
                @enderror
            </div>
            <h3 class="form__title">
                商品名と説明
            </h3>
            <div class="form__group">
                <label class="label">商品名</label>
                <input class="input" type="text" name="item_name">
                @error('item_name')
                    <span class="input__error">
                        <p class="input_error_message">{{$errors->first('item_name')}}</p>
                    </span>
                @enderror
            </div>
            <div class="form__group">
                <label class="label">商品の説明</label>
                <textarea class="textarea" name="item_detail" id="" cols="30" rows="10"></textarea>
                @error('item_detail')
                    <span class="input__error">
                        <p class="input_error_message">{{$errors->first('item_detail')}}</p>
                    </span>
                @enderror
            </div>
            <div class="form__group">
                <label class="label">販売価格</label>
                <input class="input" type="text" name="item_price" placeholder="¥">
                @error('item_price')
                    <span class="input__error">
                        <p class="input_error_message">{{$errors->first('item_price')}}</p>
                    </span>
                @enderror
            </div>
            <input class="sell-form__btn btn" type="submit" value="出品する">
        </form>
    </div>
</div>
<script>
    document.getElementById('item_image').onchange = function(event){

        initializeFiles();

        var files = event.target.files;

        for (var i = 0, f; f = files[i]; i++) {
            var reader = new FileReader;
            reader.readAsDataURL(f);

            reader.onload = (function(theFile) {
                return function (e) {
                    var div = document.createElement('div');
                    div.className = 'reader_file';
                    div.innerHTML += '<img class="reader_image" src="' + e.target.result + '" />';
                    document.getElementById('list').insertBefore(div, null);
                }
            })(f);
        }
    };

    function initializeFiles() {
        document.getElementById('list').innerHTML = '';
    }
</script>
@endsection