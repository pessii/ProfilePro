@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center mb-4">
    <img src="{{ asset('storage/portfolios/' . $portfolioData->site_file_path) }}" alt="ポートフォリオ画像" style="width: 100%; height: auto;">
</div>

<div class="portfolios-serbice-name mb-2">
    {{ $portfolioData->serbice_name }}
</div>

<div class="portfolios-site-url mb-4">
    <a href="{{ $portfolioData->site_url }}">{{ $portfolioData->site_url }}</a>
</div>

<div class="portfolios-border mb-5"></div>

<div class="portfolios-project-overview mb-4">
    <h3>概要</h3>
    <p>{{ $portfolioData->project_overview }}</p>
</div>

<h3 class="portfolios-skill-file-path">使用したスキル</h3>
<div class="skill-container">
    @foreach($userSkillList as $userSkill)
        <div class="skill-item">
            <img src="{{ asset('storage/skills/' . $userSkill->skill_file_path) }}" alt="スキル画像" class="skill_image" style="width: 50px; height: 50px;">
            <span class="portfolios-skill-file-path-profile-title">{{ $userSkill->skill_name }}</span>
        </div>
    @endforeach
</div>

<div class="portfolios-project-overview portfolios-site-url mb-4">
    <h3>コーディングURL</h3>
    <a href="{{ $portfolioData->coding }}">{{ $portfolioData->coding }}</a>
</div>

<div class="portfolios-project-overview portfolios-site-url mb-4">
    <h3>デザインURL</h3>
    <a href="{{ $portfolioData->design }}">{{ $portfolioData->design }}</a>
</div>

<div class="portfolios-project-overview mb-4">
    <h3>担当内容</h3>
    {{ $portfolioData->responsibilities }}
</div>

<div class="portfolios-project-overview mb-4">
    <h3>その他</h3>
    {{ $portfolioData->explanation }}
</div>

@endsection
