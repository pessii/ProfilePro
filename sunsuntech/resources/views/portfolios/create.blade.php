@extends('layouts.app')

@section('content')
<h1>ポートフォリオ作成画面</h1>

<!-- メッセージを表示 -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('portfolio.store') }}">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="site_file_path">サイト画像</label>
        <input id="site_file_path" type="text" name="site_file_path" value="{{ old('site_file_path', '') }}">
    </div>

    <div class="form-group">
        <label for="serbice_name">サービス名</label>
        <input id="serbice_name" type="text" name="serbice_name" value="{{ old('serbice_name', '') }}" required>
    </div>

    <div class="form-group">
        <label for="site_url">サイトURL</label>
        <input id="site_url" name="site_url" value="{{ old('site_url', '') }}"></input>
    </div>

    <div class="form-group">
        <label for="explanation">説明文</label>
        <textarea id="explanation" name="explanation">{{ old('explanation', '') }}</textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">作成する</button>
    </div>
</form>

@endsection
