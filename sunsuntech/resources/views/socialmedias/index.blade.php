@extends('layouts.app')

@section('content')
<h1>ソーシャルメディア編集画面</h1>

<!-- メッセージを表示 -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('socialmedia.update') }}">
    @csrf
    <h2>登録中のソーシャルメディア</h2>
    @foreach($userSocialMediaList as $userSocialMedia)
        <label class="checkbox">
            <input type="checkbox" name="selected_social_medias[]" value="{{ $userSocialMedia->id }}" {{ $userSocialMedia->user_id ? 'checked' : '' }}>
            {{ $userSocialMedia->social_media_name }}
            {{ $userSocialMedia->url }}
        </label><br>
    @endforeach
    <br>

    <h2>ソーシャルメディアを登録</h2>
    <div class="form-group">
        <label for="social_media_name">ソーシャルメディア名</label>
        <input id="social_media_name" type="text" class="form-control" name="social_media_name" value="{{ old('social_media_name', '') }}">
    </div>

    <div class="form-group">
        <label for="url">URL</label>
        <input id="url" type="text" class="form-control" name="url" value="{{ old('url', '') }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">更新する</button>
    </div>
</form>

@endsection
