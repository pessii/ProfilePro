@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center mb-4 slide-up-element">
    <img src="{{ asset('storage/portfolios/' . $portfolioData->site_file_path) }}" alt="ポートフォリオ画像" style="width: 100%; height: auto;">
</div>

<div class="portfolios-serbice-name mb-2 slide-up-element-3">
    {{ $portfolioData->serbice_name }}
</div>

<div class="portfolios-site-url mb-4 slide-up-element-2">
    <a href="{{ $portfolioData->site_url }}">{{ $portfolioData->site_url }}</a>
</div>

<div class="portfolios-border mb-5"></div>

<div class="portfolios-project-overview mb-4">
    <h3 class="slide-up-element-3">概要</h3>
    <p class="slide-up-element-2">{{ $portfolioData->project_overview }}</p>
</div>

<h3 class="portfolios-skill-file-path slide-up-element-3">使用したスキル</h3>
<div class="skill-container">
    @foreach($userSkillList as $userSkill)
    <div class="skill-item slide-up-element-2">
            <img src="{{ asset('storage/skills/' . $userSkill->skill_file_path) }}" alt="プロフィール画像" class="skill_image" style="width: 50px; height: 50px;">
            <span class="profile-title">{{ $userSkill->skill_name }}</span>
        </div>
    @endforeach
</div>

<div class="portfolios-project-overview portfolios-site-url mb-4">
    <h3 class="slide-up-element-3">コーディングURL</h3>
    <a href="{{ $portfolioData->coding }}" class="slide-up-element-2">{{ $portfolioData->coding }}</a>
</div>

<div class="portfolios-project-overview portfolios-site-url mb-4">
    <h3 class="slide-up-element-3">デザインURL</h3>
    <a href="{{ $portfolioData->design }}" class="slide-up-element-2">{{ $portfolioData->design }}</a>
</div>

<div class="portfolios-project-overview mb-4">
    <h3 class="slide-up-element-3">担当内容</h3>
    <p class="slide-up-element-2">{{ $portfolioData->responsibilities }}</p>
</div>

<div class="portfolios-project-overview mb-4">
    <h3 class="slide-up-element-3">その他</h3>
    <p class="slide-up-element-2">{{ $portfolioData->explanation }}</p>
</div>

@endsection
@section('scripts')
	<script src="{{ asset('/js/profile.js') }}"></script>
@endsection