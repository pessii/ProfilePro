@extends('layouts.app')

@section('content')
<h1>スキル編集画面</h1>

<!-- メッセージを表示 -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<br>
<h2>登録中のスキル</h2>
@foreach($userSkillList as $userSkill)
    <div>
        {{ $userSkill->skill_file_path }}
        {{ $userSkill->skill_name }}
    </div>
@endforeach
<br>

<h2>登録するスキル</h2>
<form method="POST" action="{{ route('skill.update') }}">
    @csrf
    @foreach($skillList as $skill)
        <label class="checkbox">
            <input type="checkbox" name="selected_skills[]" value="{{ $skill->id }}" {{ $skill->user_id ? 'checked' : '' }}>
            {{ $skill->skill_file_path }}
            {{ $skill->skill_name }}
        </label><br>
    @endforeach

    <br>
    <h2>新しいスキルを作成</h2>
    <label for="skill_file_path">スキル画像：</label>
    <input type="text" id="skill_file_path" name="skill_file_path"><br>

    <label for="skill">スキル作成：</label>
    <input type="text" id="skill" name="skill"><br>

    <button type="submit">更新する</button>
</form>

@endsection
