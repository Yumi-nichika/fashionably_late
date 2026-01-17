@extends('layouts.admin_common')

@section('title')
管理画面
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('button')
<form method="POST" action="/logout">
    @csrf
    <button type="submit" class="button">
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
            <form action="/search" method="GET">
                @csrf
                <input type="text" name="free" placeholder="名前やメールアドレスを入力してください" value="{{ request('free') }}">
                <div class="form__input--select">
                    <select name="gender">
                        <option value="">性別</option>
                        <option value="0" {{ request('gender') == '0' ? 'selected' : '' }}>全て</option>
                        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                        <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                    </select>
                </div>
                <div class="form__input--select">
                    <select name="category_id">
                        <option value="">お問い合わせの種類</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form__input--date">
                    <input type="date" name="created_at" value="{{ request('created_at') }}">
                    <span class="date-select__arrow">▼</span>
                </div>
                <button type="submit" class="button button-search">検索</button>
            </form>
            <a class="button button-reset" href="/reset">リセット</a>
        </div>

        <div class="admin-operation">
            <a href="{{ route('export', request()->query()) }}" class="button button-export">
                エクスポート
            </a>
            {{ $contacts->links() }}
        </div>


        <div class="admin-table">
            <table class="admin-table__inner">
                <thead>
                    <tr class="admin-table__row">
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問い合わせの種類</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $contact)
                    <tr class="admin-table__row">
                        <td class="admin-table__text">
                            {{ $contact['last_name'] }}　{{ $contact['first_name'] }}
                        </td>
                        <td class="admin-table__text">{{ config('gender')[$contact['gender']] }}</td>
                        <td class="admin-table__text">{{ $contact['email'] }}</td>
                        <td class="admin-table__text">{{ $contact['category']['content'] }}</td>
                        <td class="admin-table__text">
                            <button type="button" class="button button-detail" data-contact='@json($contact)'>
                                詳細
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<div id="detailModal" class="modal">
    <div class="modal-content">
        <button id="closeModal">×</button>
        <div class="modal-content__inner">
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                </div>
                <span id="modalName"></span>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">性別</span>
                </div>
                <span id="modalGender"></span>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                </div>
                <span id="modalEmail"></span>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">電話番号</span>
                </div>
                <span id="modalTel"></span>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                </div>
                <span id="modalAddress"></span>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <span id="modalBuilding"></span>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせの種類</span>
                </div>
                <span id="modalCategory"></span>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容</span>
                </div>
                <p id="modalContent" style="white-space: pre-wrap;"></p>
            </div>
        </div>
        <div class="form__button">
            <form action="/delete" method="POST">
                @csrf
                <input type="hidden" id="id" name="id" value="">
                <button type="submit" class="button form__button-delete">削除</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('detailModal');
        const closeBtn = document.getElementById('closeModal');

        const Id = document.getElementById('id');
        const modalName = document.getElementById('modalName');
        const modalGender = document.getElementById('modalGender');
        const modalEmail = document.getElementById('modalEmail');
        const modalTel = document.getElementById('modalTel');
        const modalAddress = document.getElementById('modalAddress');
        const modalBuilding = document.getElementById('modalBuilding');
        const modalCategory = document.getElementById('modalCategory');
        const modalContent = document.getElementById('modalContent');

        // 「詳細」ボタンをすべて取得
        document.querySelectorAll('.button-detail').forEach(button => {
            button.addEventListener('click', function() {
                const contact = JSON.parse(this.dataset.contact);

                Id.value = contact.id;
                modalName.textContent = `${contact.last_name} ${contact.first_name}`;
                modalGender.textContent = @json(config('gender'))[contact.gender];
                modalEmail.textContent = contact.email;
                modalTel.textContent = contact.tel;
                modalAddress.textContent = contact.address;
                modalBuilding.textContent = contact.building ?? '';
                modalCategory.textContent = contact.category.content;
                modalContent.textContent = contact.detail ?? '';

                //モーダル表示
                modal.style.display = 'flex';
            });
        });

        // ×ボタンで閉じる
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    });
</script>
@endsection