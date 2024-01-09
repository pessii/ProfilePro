@extends('layouts.app')

@section('content')
<h1 class="profile-heading">お問い合わせ<span class="edit-profile" style="margin-left: 10px;">inquiry</span></h1>

<!-- メッセージを表示 -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('contact.submit') }}">
    @csrf

    <div class="form-group mb-4">
        <label for="name" class="profile-title mb-1 slide-up-element-3">ユーザー名<span style="margin-left: 6px;">name</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label><br>
        <input type="text" name="name" id="name" class="form-control custom-input slide-up-element-2" required>
    </div>

    <div class="form-group mb-4">
        <label for="email" class="profile-title mb-1 slide-up-element-3">メールアドレス<span style="margin-left: 6px;">email</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label><br>
        <input type="email" name="email" id="email" class="form-control custom-input slide-up-element-2" required>
    </div>

    <div class="form-group mb-4">
        <label for="category" class="profile-title mb-1 slide-up-element-3">カテゴリ<span style="margin-left: 6px;">category</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label><br>
        <select name="category" id="category" class="select-form custom-input slide-up-element-2" required>
            <option value="1">サイトへの要望</option>
            <option value="2">エラー</option>
            <option value="3">操作方法</option>
            <option value="4">トラブル</option>
            <option value="99">その他</option>
        </select><br>
    </div>

    <div class="form-group mb-4">
        <label for="content" class="profile-title mb-1 slide-up-element-3">内容<span style="margin-left: 6px;">content</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label><br>
        <textarea name="content" id="content" rows="5" class="form-control custom-input slide-up-element-2" required></textarea><br>
    </div>

    <div class="d-flex justify-content-end slide-up-element">
        <div class="form-group" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="font-size: 1.2rem;">送信<span style="font-size: 0.8rem; margin-left: 6px;">send</span></button>
        </div>
    </div>
</form>

@endsection
@section('scripts')
	<script src="{{ asset('/js/profile.js') }}"></script>
@endsection