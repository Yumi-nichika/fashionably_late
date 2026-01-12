@extends('layouts.adcom')

@section('title')
管理画面
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('button')
<form method="POST" action="/logout">
    @csrf
    <button type="submit" class="link">
        logout
    </button>
</form>
@endsection

@section('main')
<div class="admin">
    <div class="admin-form__title">
        Admin
    </div>

    <div class="admin-form">
        <div class="admin-search">
            <input type="text" name="free" placeholder="名前やメールアドレスを入力してください">
            <div class="form__input--select">
                <select name="gendar">
                    <option value="">性別</option>
                    <option value="1">男性</option>
                    <option value="2">女性</option>
                    <option value="3">その他</option>
                </select>
            </div>
            <div class="form__input--select">
                <select name="category_id">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}" {{ (old('category_id', request('category_id')) == $category->id) ? 'selected' : '' }}>
                        {{ $category['content'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            <input type="date" name="created_at">
            <button class="button-search">検索</button>
            <a class="button-reset" href="/admin">リセット</a>
        </div>

        <div class="admin-operation">
            <button class="button-export">エクスポート</button>
            {{ $contacts->links() }}
        </div>


        <div class="admin-table">
            <table class="admin-table__inner">
                <tr class="admin-table__row">
                    <th class="admin-table__header">お名前</th>
                    <th class="admin-table__header" style="width: 10%;">性別</th>
                    <th class="admin-table__header">メールアドレス</th>
                    <th class="admin-table__header">お問い合わせの種類</th>
                    <th class="admin-table__header"></th>
                </tr>
                @foreach($contacts as $contact)
                <tr class="admin-table__row">
                    <td class="admin-table__text">
                        {{ $contact['last_name'] }}　{{ $contact['first_name'] }}
                    </td>
                    <td class="admin-table__text">{{ config('gender')[$contact['gender']] }}</td>
                    <td class="admin-table__text">{{ $contact['email'] }}</td>
                    <td class="admin-table__text">{{ $contact['category']['content'] }}</td>
                    <td class="admin-table__text">
                        <button class="button-detail">詳細</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@endsection