@extends('layouts.app')

<!-- 管理画面 -->

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection


@section('content')

<div class="admin__content">

    <!-- タイトル -->
    <div class="admin-heading">
        <h2 class="admin-heading__title">Admin</h2>
    </div>

    <!-- 検索 -->
    <form class="search-form" action='/admin/search' method='get'>
        @csrf
        <div class="search-form__item">
            <!-- 名前やメールアドレスで検索 -->
            <input Class="search-form__item-input" type="text" name='keyword' placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">
            <!-- 性別で検索 -->
            <select class="search-form__item-gender" name="gender">
                <option value="">性別</option>
                @foreach($genders as $gender => $label)
                    <option value="{{ $gender }}"@selected(old('gender') == $gender)>{{ $label }}</option>
                @endforeach
            </select>
            <!-- 問い合わせ種類で検索 -->
            <select class="search-form__item-select" name="category_id">
                <option value="">問い合わせの種類</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->content }}</option>
                @endforeach
            </select>
            <!-- 日付で検索 -->
            <div class="search-form__item-date">
                <input type="date" class="search-form__date" name="created_at" value=" {{old('created_at')}} ">
            </div>
        </div>
        <div class="search-form__button">
            <button class="search-form__button-search" type="submit">検索</button>
            <button class="search-form__button-reset" type="reset">リセット</button>
        </div>
    </form>

    <!-- エクスポート -->

    <!-- ページネーション -->
    {{ $contacts->links() }}

    <!-- テーブル -->
    <div class="contact-table">
        <table class="contact-table__inner">
            <tr class="contact-table__row">
                <th class="contact-table__header-name">お名前</th>
                <th class="contact-table__header-gender">性別</th>
                <th class="contact-table__header-email">メールアドレス</th>
                <th class="contact-table__header-category">お問い合わせの種類</th>
                <th class="contact-table__header-blank"></th>
            </tr>

            @foreach ($contacts as $contact)
            <tr class="contact-table__row">
                <td class="contact-table__item">
                    <div class="contact-table__name">
                        <p class=" ">{{ "{$contact->first_name}  {$contact->last_name}" }}</p>
                    </div>
                    <div class="contact-table__gender">
                        <p class=" ">{{ $contact->gender_name }}</p>
                    </div>
                    <div class="contact-table__email">
                        <p class=" ">{{ $contact->email }}</p>
                    </div>
                    <div class="contact-table__category">
                        <p class=" ">{{ $contact->category->content }}</p>
                    </div>
                    <!-- モーダルを開く -->
                    <div class="contact-table__button">
                        <input type="checkbox" id="modal-{{ $contact->id }}" class="modal-button" hidden>
                            <!-- モーダル本体 -->
                            <div class="modal" id="modal{{ $contact->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="modal-table">
                                                <tr class="modal-table__row">
                                                    <th class="modal-table_td">お名前</th>
                                                    <td class="modal-table_td">{{ "{$contact->first_name}  {$contact->last_name}" }}</td>
                                                </tr>
                                                <tr class="modal-table__row">
                                                    <th class="modal-table_td">性別</th>
                                                    <td class="modal-table_td">{{ $contact->gender_name }}</td>
                                                </tr>
                                                <tr class="modal-table__row">
                                                    <th class="modal-table_td">メールアドレス</th>
                                                    <td class="modal-table_td">{{ $contact->email }}</td>
                                                </tr>
                                                <tr class="modal-table__row">
                                                    <th class="modal-table_td">電話番号</th>
                                                    <td class="modal-table_td">{{ $contact->tel }}</td>
                                                </tr>
                                                <tr class="modal-table__row">
                                                    <th class="modal-table_td">住所</th>
                                                    <td class="modal-table_td">{{ $contact->address }}</td>
                                                </tr>
                                                    <tr class="modal-table__row">
                                                    <th class="modal-table_td">建物名</th>
                                                    <td class="modal-table_td">{{ $contact->building }}</td>
                                                </tr>
                                                <tr class="modal-table__row">
                                                    <th class="modal-table_td">お問い合わせの種類</th>
                                                    <td class="modal-table_td">{{ $contact->category->content }}</td>
                                                </tr>
                                                <tr class="modal-table__row">
                                                    <th class="modal-table_td">お問い合わせ内容</th>
                                                    <td class="modal-table_td">{{ $contact->detail }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <form class="delete-form" action="/contacts/delete" method="post">
                                            @method('DELETE')
                                            @csrf
                                                <div class="delete-form__button">
                                                    <input type="hidden" name="id" value="{{ $contact->id }}">
                                                    <button class="delete-form__button-submit" type="submit">削除</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <label for="modal-{{ $contact->id }}" class="modal-button">詳細</label>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
        

    </div>
</div>

@endsection
