@extends('layouts.app')

@section('content')

<div class="productions-img slide-up-element">
    <img src="{{ asset('storage/images/' . $user->avatar) }}" class="rounded-circle" alt="プロフィール画像" style="width: 150px; height: 150px; cursor: pointer;">
</div>

<div class="productions-name slide-up-element-3">
    {{ $user->name }}
</div>

<div class="productions-self_introduction slide-up-element-2">
    {{ $user->self_introduction }}
</div>

<div class="skill-container slide-up-element">
    @foreach($userSocialMediaList as $userSocialMedia)
    <div style="margin: 0.8rem;">
        <a href="{{ $userSocialMedia->url }}" class="skill-item">
            <img src="{{ asset('storage/socialmedias/' . $userSocialMedia->social_media_file_path) }}" alt="ソーシャルメディア画像" class="skill_image" style="width: 50px; height: 50px; border-radius: 8px;">
        </a>
    </div>
    @endforeach
</div>

<div class="links slide-up-element-3">
    <a href="{{ route('productions.index', ['id' => $id]) }}" style="display: block; text-align: center; text-decoration: none;">
        <h2 class="links-skills">ポートフォリオ<span class="edit-profile-h2" style="margin-left: 10px;">portfolio</span></h2>
    </a>
    <a href="{{ route('portfolio.index', ['id' => $id]) }}" style="display: block; text-align: center; text-decoration: none;">
        <h2 class="links-portfolio">スキル<span class="edit-profile-h2" style="margin-left: 10px;">skills</span></h2>
    </a>
</div>

<div class="slide-up-element-2">
    @foreach($SkillList as $skill)
        <div class="skill-item">
            <img src="{{ asset('storage/skills/' . $skill->skill_file_path) }}" alt="プロフィール画像" class="skill_image" style="width: 50px; height: 50px;">
            <span class="profile-title">{{ $skill->skill_name }}</span>
        </div>
    @endforeach
</div>

@endsection
@section('scripts')
	<script src="{{ asset('/js/profile.js') }}"></script>
@endsection