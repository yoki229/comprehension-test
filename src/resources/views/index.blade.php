@extends('layouts.app')

<!-- お問い合わせフォーム入力画面 -->

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

<div class="contact-form__content">
    <div class="contact-form__heading">
        <h2>Contact</h2>
    </div>
    <form class="form" action="/confirm" method="post">
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__group-title--item">お名前</span>
                <span class="form__group-title--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__group-name">
                    <input type="text" name="first_name" placeholder="例：山田" value="{{ old('first_name', session('contact.first_name'))}}"/>
                    <input type="text" name="last_name" placeholder="例：太郎" value="{{ old('last_name', session('contact.last_name'))}}"/>
                </div>
                <div class="form__error">
                    @error('first_name')
                    {{$message}}
                    @enderror
                    @error('last_name')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__group-title--item">性別</span>
                <span class="form__group-title--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__group-gender">
                    <input type="radio" id="gender_male" name="gender" value="1" @checked(old('gender') == 1)>
                    <label for="gender_male">男性</label>
                    <input type="radio" id="gender_female" name="gender" value="2" @checked(old('gender') == 2)>
                    <label for="gender_female">女性</label>
                    <input type="radio" id="gender_other" name="gender" value="3" @checked(old('gender') == 3)>
                    <label for="gender_other">その他</label>
                </div>
                <div class="form__error">
                    @error('gender')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__group-title--item">メールアドレス</span>
                <span class="form__group-title--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__group-email">
                    <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email', session('contact.email'))}}"/>
                </div>
                <div class="form__error">
                    @error('email')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__group-title--item">電話番号</span>
                <span class="form__group-title--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__group-tel">
                    <input type="tel" name="tel1" placeholder="例:090" value="{{ old('tel1', session('contact.tel1')) }}"> -
                    <input type="tel" name="tel2" placeholder="例:1234" value="{{ old('tel2', session('contact.tel2')) }}"> -
                    <input type="tel" name="tel3" placeholder="例:5678" value="{{ old('tel3', session('contact.tel3')) }}">
                </div>
                <div class="form__error">
                    @error('tel')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__group-title--item">住所</span>
                <span class="form__group-title--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__group-address">
                    <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', session('contact.address'))}}"/>
                </div>
                <div class="form__error">
                    @error('address')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__group-title--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__group-building">
                    <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building', session('contact.building'))}}"/>
                </div>
                <div class="form__error">
                    @error('building')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__group-title--item">お問い合わせの種類</span>
                <span class="form__group-title--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__group-category">
                    <select class="search-form__item-select" name="category_id">
                        <option value="">選択してください</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', session('contact.category_id')) == $category->id)>
                            {{ $category->content }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    @error('category_id')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__group-title--item">お問い合わせの内容</span>
                <span class="form__group-title--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__group-detail">
                    <textarea name="detail" rows="5" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', session('contact.detail')) }}</textarea>
                </div>
                <div class="form__error">
                    @error('detail')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">送信</button>
        </div>
    </form>
</div>

@endsection