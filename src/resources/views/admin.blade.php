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
            <a class="button-reset" href="/reset">リセット</a>
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
                        <button type="button" class="button-detail"
                            data-name="{{ $contact['last_name'] }} {{ $contact['first_name'] }}"
                            data-gender="{{ config('gender')[$contact['gender']] }}"
                            data-email="{{ $contact['email'] }}"
                            data-tel="{{ $contact['tel'] }}"
                            data-address="{{ $contact['address'] }}"
                            data-building="{{ $contact['building'] }}"
                            data-category="{{ $contact['category']['content'] }}"
                            data-content="{{ $contact['detail'] ?? '' }}">
                            詳細
                        </button>
                    </td>
                </tr>
                @endforeach
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
        <div class="button-delete">
            <form>
                <button type="submit">削除</button>
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
                // データをモーダルにセット
                modalName.textContent = this.dataset.name;
                modalGender.textContent = this.dataset.gender;
                modalEmail.textContent = this.dataset.email;
                modalTel.textContent = this.dataset.tel;
                modalAddress.textContent = this.dataset.address;
                modalBuilding.textContent = this.dataset.building;
                modalCategory.textContent = this.dataset.category;
                modalContent.textContent = this.dataset.content;

                // モーダルを表示
                modal.style.display = 'flex';
            });
        });

        // ×ボタンで閉じる
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        // モーダル外クリックで閉じる
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>
@endsection