@extends('layouts.app')

@section('content')
<a href="{{ route('profile') }}">プロフィール編集</a>
<br/>
<a href="{{ route('skill') }}">スキル編集</a>
@endsection
