@extends('layouts.admin_common')

@section('title')
ログイン
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('path')
/register
@endsection

@section('button')
<a type="submit" class="button" href="/register">
    register
</a>
@endsection

@section('main')
<div class="content">
    <h2 class="content-title">
        Login
    </h2>
    <div class="register-form">
        <form class="form" action="/login" method="post" novalidate>
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" value="{{ old('email') }}" />
                    </div>
                    @error('email')
                    <ul class="form-error">
                        <li>{{ $message }}</li>
                    </ul>
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">パスワード</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" name="password" />
                    </div>
                    @error('password')
                    <ul class="form-error">
                        <li>{{ $message }}</li>
                    </ul>
                    @enderror
                </div>
            </div>
            <div class="form-button">
                <button class="button button-submit" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>

@endsection