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
<a type="submit" class="link" href="/register">
    register
</a>
@endsection

@section('main')
<div class="register">
    <div class="register-form__title">
        Login
    </div>
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
                    <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
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
                    <div class="form__error">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>

@endsection