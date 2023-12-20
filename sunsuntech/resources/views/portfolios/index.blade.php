@extends('layouts.app')

@section('content')
<h1>ポートフォリオ管理画面</h1>

<a href="{{ route('portfolio.create') }}">作成する</a>

<h2>ポートフォリオ一覧</h2>

@foreach($portfolioList as $portfolio)
    <a href="{{ route('portfolio.edit', ['id'=>$portfolio->id]) }}">
        {{ $portfolio->site_file_path }}
    </a>
    <a href="{{ route('portfolio.edit', ['id'=>$portfolio->id]) }}">
        {{ $portfolio->serbice_name }}
    </a>
    <br><br>
@endforeach

@endsection
