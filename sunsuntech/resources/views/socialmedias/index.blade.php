@extends('layouts.app')

@section('content')
<h1 class="profile-heading">ソーシャルメディア編集<span class="edit-profile" style="margin-left: 10px;">social media editing</span></h1>

<!-- メッセージを表示 -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('socialmedia.update') }}" enctype="multipart/form-data">
    @csrf
    <h2 class="profile-heading-h2 slide-up-element-3">登録中ソーシャルメディア<span class="edit-profile-h2" style="margin-left: 10px;">registered social media</span></h2>

    <div class="skill-container slide-up-element-2">
        @foreach($userSocialMediaList as $userSocialMedia)
            <div class="skill-item">
                <label class="skill-check">
                    <input type="checkbox" name="selected_social_medias[]" value="{{ $userSocialMedia->id }}" class="hidden-checkbox" {{ $userSocialMedia->user_id ? 'checked' : '' }}>
                    <div class="checkbox-icon">
                        <div class="checkmark" style="font-size: 1.5rem; font-weight: bold;">✓</div>
                    </div>
                    <img src="{{ asset('storage/socialmedias/' . $userSocialMedia->social_media_file_path) }}" alt="ソーシャルメディア画像" class="skill_image" style="width: 50px; height: 50px;">
                    <span class="profile-title">{{ $userSocialMedia->social_media_name }}</span>
                </label><br>
            </div>
        @endforeach
    </div>
    <br>

    <h2 class="profile-heading-h2 slide-up-element-3">ソーシャルメディア登録<span class="edit-profile-h2" style="margin-left: 10px;">social media name</span></h2>
    <p class="moji-p slide-up-element">※登録する場合は全て必須入力</p>
    
    <div class="form-group mb-4">
        <label for="social_media_file_path" class="profile-title mb-1 slide-up-element-3">ソーシャルメディア画像<span style="margin-left: 6px;">social media image</span><span style="margin-left: 13px; background: #479aa5; color: transparent; -webkit-background-clip: text; background-clip: text;">(任意)</span></label>
        <input id="social_media_file_path" type="file" name="social_media_file_path" class="form-skill custom-input slide-up-element-2">
    </div>

    <div class="form-group mb-4">
        <label for="social_media_name" class="profile-title mb-1 slide-up-element-3">ソーシャルメディア名<span style="margin-left: 6px;">social media image</span><span style="margin-left: 13px; background: #479aa5; color: transparent; -webkit-background-clip: text; background-clip: text;">(任意)</span></label>
        <input id="social_media_name" type="text" class="form-control custom-input slide-up-element-2" name="social_media_name" value="{{ old('social_media_name', '') }}">
    </div>

    <div class="form-group mb-5">
        <label for="url" class="profile-title mb-1 slide-up-element-3">URL<span style="margin-left: 6px;">url</span><span style="margin-left: 13px; background: #479aa5; color: transparent; -webkit-background-clip: text; background-clip: text;">(任意)</span></label>
        <input id="url" type="text" class="form-control custom-input slide-up-element-2" name="url" value="{{ old('url', '') }}">
    </div>

    <div class="d-flex justify-content-end slide-up-element">
        <div  class="form-group" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="font-size: 1.2rem;">更新<span style="font-size: 0.8rem; margin-left: 6px;">update</span></button>
        </div>
    </div>
</form>

@endsection
@section('scripts')
	<script src="{{ asset('/js/profile.js') }}"></script>
@endsection