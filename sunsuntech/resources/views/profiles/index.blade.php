@extends('layouts.app')

@section('content')
<h1 class="profile-heading">プロフィール編集<span class="edit-profile" style="margin-left: 10px;">edit profile</span></h1>

<!-- メッセージを表示 -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
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

    <div class="d-flex justify-content-center">
        <label for="file-input">
            <img src="{{ asset('storage/images/' . $loginUser->avatar) }}" class="rounded-circle slide-up-element" alt="プロフィール画像" style="width: 150px; height: 150px; cursor: pointer;">
        </label>
        <input id="file-input" type="file" name="avatar" class="form-control" style="display: none;">
    </div>
    <div class="form-group mb-4">
        <label for="file-input" class="profile-title mb-1" style="cursor: pointer; display: none;">アイコン<span>（icon）</span></label>
    </div>

    <div class="form-group mb-4">
        <label for="name" class="profile-title2 mb-1 slide-up-element-3">ユーザー名<span style="margin-left: 6px;">name</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label>
        <input id="name" type="text" class="form-control custom-input slide-up-element-2" name="name" value="{{ old('name', $loginUser->name) }}" required>
    </div>

    <div class="form-group mb-4">
        <label for="self_introduction" class="profile-title2 mb-1 slide-up-element-3">自己紹介<span style="margin-left: 6px;">bio</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label>
        <textarea id="self_introduction" class="form-control custom-input slide-up-element-2" name="self_introduction">{{ old('self_introduction', $loginUser->self_introduction) }}</textarea>
    </div>

    <div class="form-group mb-4">
        <label for="email" class="profile-title2 mb-1 slide-up-element-3">メールアドレス<span style="margin-left: 6px;">email</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label>
        <input id="email" type="email" class="form-control custom-input slide-up-element-2" name="email" value="{{ old('email', $loginUser->email) }}" required>
    </div>

    <div class="form-group">
        <label for="password" class="profile-title2 mb-1 slide-up-element-3">パスワード<span style="margin-left: 6px;">password</span><span style="margin-left: 13px; background: #479aa5; color: transparent; -webkit-background-clip: text; background-clip: text;">(任意)</span></label>
        <input id="password" type="password" class="form-control custom-input slide-up-element-2" name="password">
    </div>

    <div class="d-flex justify-content-end slide-up-element">
        <div class="form-group form-send" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">保存<span style="font-size: 0.8rem; margin-left: 6px;">save</span></button>
        </div>
    </div>
</form>

@endsection
@section('scripts')
	<script src="{{ asset('/js/profile.js') }}"></script>
@endsection