@extends('layouts.app')

@section('content')
<h1 class="profile-heading">スキル編集<span class="edit-profile" style="margin-left: 10px;">edit skills</span></h1>

<h2 class="profile-heading-h2 slide-up-element-3">登録中スキル<span class="edit-profile-h2" style="margin-left: 10px;">registered skills</span></h2>
<div class="skill-container">
    @foreach($userSkillList as $userSkill)
        <div class="skill-item slide-up-element-2">
            <img src="{{ asset('storage/skills/' . $userSkill->skill_file_path) }}" alt="プロフィール画像" class="skill_image" style="width: 50px; height: 50px;">
            <span class="profile-title">{{ $userSkill->skill_name }}</span>
        </div>
    @endforeach
</div>

<h2 class="profile-heading-h2 slide-up-element-3" style="margin-top: 30px;">スキル一覧<span class="edit-profile-h2" style="margin-left: 10px;">skill list</span></h2>
<form method="POST" action="{{ route('skill.store') }}" enctype="multipart/form-data">
    @csrf
    <p class="moji-p slide-up-element">ロゴをクリックして自身が保持しているスキルを✓してから更新ボタンを押してください。</p>
    <div class="skill-container">
        @foreach($skillList as $skill)
            <div class="skill-item slide-up-element-2">
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

    <h2 class="profile-heading-h2 slide-up-element-3" style="margin-top: 30px;">スキル作成<span class="edit-profile-h2" style="margin-left: 10px;">create skill</span></h2>
    <p class="moji-p slide-up-element" style="margin-bottom: 30px;">スキルの作成は画像と言語名を入力してください。</p>

    <div class="form-group mb-4">
        <label for="skill_file_path" class="profile-title2 mb-1 slide-up-element-3">スキル画像<span style="margin-left: 6px;">skill image</span><span style="margin-left: 13px; background: #479aa5; color: transparent; -webkit-background-clip: text; background-clip: text;">(任意)</span></label>
        <input id="skill_file_path" type="file" name="skill_file_path" class="form-skill custom-input slide-up-element-2">
    </div>

    <div class="form-group">
        <label for="skill" class="profile-title2 mb-1 slide-up-element-3">スキル名<span style="margin-left: 6px;">skill name</span><span style="margin-left: 13px; background: #479aa5; color: transparent; -webkit-background-clip: text; background-clip: text;">(任意)</span></label>
        <input type="text" id="skill" class="form-control custom-input slide-up-element-2" name="skill" placeholder="PHP">
    </div>
    <div class="d-flex justify-content-end slide-up-element">
        <div class="form-group" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">更新<span style="font-size: 0.8rem; margin-left: 6px;">update</span></button>
        </div>
    </div>
</form>

@endsection
@section('scripts')
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }

        @if (Session::has('flashSuccess'))
            toastr.success("{{ session('flashSuccess') }}");
        @endif

        @if (Session::has('flashError'))
            toastr.error("{{ session('flashError') }}");
        @endif

        @if (Session::has('flashInfo'))
            toastr.info("{{ session('flashInfo') }}");
        @endif

        @if (Session::has('flashWarning'))
            toastr.warning("{{ session('flashWarning') }}");
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
	<script src="{{ asset('/js/profile.js') }}"></script>
@endsection