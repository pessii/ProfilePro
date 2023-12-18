@extends('layouts.app')

@section('content')
<h1>スキル編集画面</h1>

<!-- メッセージを表示 -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('skill.update') }}">
    @csrf
    @foreach($skillList as $skill)
        <label class="checkbox">
            <input type="checkbox" name="selected_skills[]" value="{{ $skill->id }}" {{ $skill->user_id ? 'checked' : '' }}>
            {{ $skill->skill_file_path }}
            {{ $skill->skill_name }}
        </label><br>
    @endforeach


    <button type="submit">更新する</button>
</form>

@endsection
