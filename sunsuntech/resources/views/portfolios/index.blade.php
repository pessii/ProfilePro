@extends('layouts.app')

@section('content')
<h1 class="profile-heading">ポートフォリオ一覧<span class="edit-profile" style="margin-left: 10px;">portfolio list</span></h2>

<div class="portfolio-container">
    @foreach($portfolioList as $portfolio)
        <a href="{{ route('portfolio.edit', ['id'=>$portfolio->id]) }}" class="portfolio-card">
            <img src="{{ asset('storage/portfolios/' . $portfolio->site_file_path) }}" alt="ポートフォリオ画像">
            <h2>{{ $portfolio->serbice_name }}</h2>
        </a>
    @endforeach
</div>

@endsection
