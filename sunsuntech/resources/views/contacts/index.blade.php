@extends('layouts.app')

@section('content')
<h1>お問い合わせ画面</h1>

<!-- メッセージを表示 -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('contact.submit') }}">
    @csrf
    <label for="name">名前</label><br>
    <input type="text" name="name" id="name" required><br>

    <label for="email">メールアドレス</label><br>
    <input type="email" name="email" id="email" required><br>

    <label for="category">カテゴリ</label><br>
    <select name="category" id="category" required>
        <option value="1">サイトへの要望</option>
        <option value="2">エラー</option>
        <option value="3">操作方法</option>
        <option value="4">トラブル</option>
        <option value="99">その他</option>
    </select><br>

    <label for="content">内容</label><br>
    <textarea name="content" id="content" rows="5" required></textarea><br>

    <button type="submit">送信</button>
</form>

@endsection
