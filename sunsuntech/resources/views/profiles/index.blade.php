@extends('layouts.app')

@section('content')
<h1>プロフィール編集画面</h1>

<!-- メッセージを表示 -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('profile.store') }}">
    @csrf
    @method('PUT')

    <div>  
        @if ($errors->any())  
            <ul>  
                @foreach ($errors->all() as $error)  
                    <li>{{ $error }}</li>  
                @endforeach  
            </ul>  
        @endif  
    </div>

    <div class="form-group">
        <label for="name">名前</label>
        <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $loginUser->name) }}" required>
    </div>

    <div class="form-group">
        <label for="self_introduction">自己紹介</label>
        <textarea id="self_introduction" class="form-control" name="self_introduction">{{ old('self_introduction', $loginUser->self_introduction) }}</textarea>
    </div>

    <div class="form-group">
        <label for="email">メールアドレス</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $loginUser->email) }}" required>
    </div>

    <div class="form-group">
        <label for="password">パスワード</label>
        <input id="password" type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
        <label for="profile_path">プロフィールファイルパス</label>
        <input id="profile_path" type="text" class="form-control" name="profile_path" value="{{ old('profile_path', $loginUser->profile_path) }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">更新する</button>
    </div>
</form>

@endsection
