@extends('layouts.app')

@section('content')
<a href="{{ route('profile') }}">プロフィール編集</a>
<br>
<a href="{{ route('skill') }}">スキル編集</a>
<br>
<a href="{{ route('portfolio.create') }}" class="portfolio-button">ポートフォリオ作成画面<span style="font-size: 0.8rem; margin-left: 6px;">create</span></a>
<br>
<a href="{{ route('portfolio.admin') }}">ポートフォリオ一覧画面</a>
<br>
<a href="{{ route('socialmedia.admin') }}">ソーシャルメディア編集画面</a>
<br>
<a href="{{ route('productions.index', ['id' => Auth::user()->id]) }}">表示画面確認</a>
@endsection
