@extends('layouts.app')

@section('content')
<h1 class="profile-heading">スキル編集<span class="edit-profile" style="margin-left: 10px;">edit skills</span></h1>

<!-- メッセージを表示 -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h2 class="profile-heading-h2">登録中スキル<span class="edit-profile-h2" style="margin-left: 10px;">registered skills</span></h2>
<div class="skill-container">
    @foreach($userSkillList as $userSkill)
        <div class="skill-item">
            <img src="{{ asset('storage/skills/' . $userSkill->skill_file_path) }}" alt="プロフィール画像" class="skill_image" style="width: 50px; height: 50px;">
            <span class="profile-title">{{ $userSkill->skill_name }}</span>
        </div>
    @endforeach
</div>

<h2 class="profile-heading-h2" style="margin-top: 30px;">スキル一覧<span class="edit-profile-h2" style="margin-left: 10px;">skill list</span></h2>
<form method="POST" action="{{ route('skill.store') }}" enctype="multipart/form-data">
    @csrf
    <p class="moji-p">ロゴをクリックして自身が保持しているスキルを✓してから更新ボタンを押してください。</p>
    <div class="skill-container">
        @foreach($skillList as $skill)
            <div class="skill-item">
                <label class="skill-check">
                    <input type="checkbox" name="selected_skills[]" value="{{ $skill->id }}" class="hidden-checkbox" {{ $skill->user_id ? 'checked' : '' }}>
                    <div class="checkbox-icon">
                        <div class="checkmark" style="font-size: 1.5rem; font-weight: bold;">✓</div>
                    </div>
                    <img src="{{ asset('storage/skills/' . $skill->skill_file_path) }}" alt="プロフィール画像" class="skill_image" style="width: 50px; height: 50px;">
                    <span class="profile-title">{{ $skill->skill_name }}</span>
                </label><br>
            </div>
        @endforeach
    </div>

    <h2 class="profile-heading-h2" style="margin-top: 30px;">スキル作成<span class="edit-profile-h2" style="margin-left: 10px;">create skill</span></h2>
    <p class="moji-p" style="margin-bottom: 30px;">スキルの作成は画像と言語名を入力してください。</p>

    <div class="form-group mb-4">
        <label for="skill_file_path" class="profile-title mb-1">スキル画像<span style="margin-left: 6px;">skill image</span><span style="margin-left: 13px; background: #479aa5; color: transparent; -webkit-background-clip: text; background-clip: text;">(任意)</span></label>
        <input id="skill_file_path" type="file" name="skill_file_path" class="form-skill custom-input">
    </div>

    <div class="form-group mb-5">
        <label for="skill" class="profile-title mb-1">スキル名<span style="margin-left: 6px;">skill name</span><span style="margin-left: 13px; background: #479aa5; color: transparent; -webkit-background-clip: text; background-clip: text;">(任意)</span></label>
        <input type="text" id="skill" class="form-control custom-input" name="skill" placeholder="PHP">
    </div>
    <div class="d-flex justify-content-end">
        <div class="form-group" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="font-size: 1.2rem;">更新<span style="font-size: 0.8rem; margin-left: 6px;">update</span></button>
        </div>
    </div>
</form>

@endsection
