@extends('layouts.contact_common')

@section('title')
お問い合わせフォーム確認ページ
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
@endsection

@section('main')
<div class="content">
    <h2 class="content-title">
        Confirm
    </h2>

    <div class="content-form">
        <div class="confirm-table">
            <table class="confirm-table__inner">
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お名前</th>
                    <td class="confirm-table__text">
                        <input type="text" value="{{ $contact['last_name'] }}　{{ $contact['first_name'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">性別</th>
                    <td class="confirm-table__text">
                        <input type="text" value="{{ config('gender')[$contact['gender']] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">メールアドレス</th>
                    <td class="confirm-table__text">
                        <input type="email" value="{{ $contact['email'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">電話番号</th>
                    <td class="confirm-table__text">
                        <input type="tel" value="{{ $contact['telone'] }}{{ $contact['teltwo'] }}{{ $contact['telthree'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">住所</th>
                    <td class="confirm-table__text">
                        <input type="text" value="{{ $contact['address'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">建物名</th>
                    <td class="confirm-table__text">
                        <input type="text" value="{{ $contact['building'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせの種類</th>
                    <td class="confirm-table__text">
                        <input type="text" value="{{ $category['content'] }}" readonly />
                    </td>
                </tr>
                <tr class="confirm-table__row">
                    <th class="confirm-table__header">お問い合わせ内容</th>
                    <td class="confirm-table__textarea">
                        <p>{!! nl2br(e($contact['detail'])) !!}</p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="form-button">
            <form action="/thanks" method="post">
                @foreach($contact as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <button class="button button-submit" type="submit">送信</button>
            </form>
            <form action="/" method="get">
                @foreach($contact as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <button class="button button-back" type="submit">修正</button>
            </form>
        </div>
    </div>
</div>
@endsection