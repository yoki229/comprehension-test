@extends('layouts.app')

<!-- サンクスページ -->

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')

<div class="thanks__content">
    <div class="thanks__message">
        <h2>お問い合わせありがとうございました</h2>
    </div>
    <div class="thanks__button">
        <a class="home-button" href="/">HOME</a>
    </div>
    <div class="background">
    Thank you
    </div>
</div>

@endsection