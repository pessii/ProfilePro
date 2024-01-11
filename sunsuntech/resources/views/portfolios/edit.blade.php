@extends('layouts.app')

@section('content')
<h1 class="profile-heading">ポートフォリオ編集<span class="edit-profile" style="margin-left: 10px;">portfolio edit</span></h1>

<form method="POST" action="{{ route('portfolio.update', ['id'=>$portfolioData->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    @if ($errors->has('site_file_path'))
        <br>
        <span class="errors" role="alert">
            <strong>{{ $errors->first('site_file_path') }}</strong>
        </span>
    @endif
    <div class="d-flex justify-content-center mb-4 slide-up-element-2">
        <label for="site_file_path">
            <img src="{{ asset('storage/portfolios/' . $portfolioData->site_file_path) }}" alt="ポートフォリオ画像" style="width: 100%; height: auto; cursor: pointer;">
        </label>
        <input id="site_file_path" type="file" name="site_file_path" style="display: none;">
    </div>

    <div class="form-group mb-4">
        <label for="serbice_name" class="profile-title2 mb-1 slide-up-element-3">サービス名<span style="margin-left: 6px;">serbice name</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label>
        @if ($errors->has('serbice_name'))
            <br>
            <span class="errors" role="alert">
                <strong>{{ $errors->first('serbice_name') }}</strong>
            </span>
        @endif
        <input type="text" id="serbice_name" class="form-control custom-input slide-up-element-2" name="serbice_name" value="{{ old('serbice_name', $portfolioData->serbice_name) }}" required>
    </div>

    <div class="form-group mb-4">
        <label for="site_url" class="profile-title2 mb-1 slide-up-element-3">サービスURL<span style="margin-left: 6px;">serbice url</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label>
        @if ($errors->has('site_url'))
            <br>
            <span class="errors" role="alert">
                <strong>{{ $errors->first('site_url') }}</strong>
            </span>
        @endif
        <input type="text" id="site_url" class="form-control custom-input slide-up-element-2" name="site_url" value="{{ old('site_url', $portfolioData->site_url) }}">
    </div>

    <div class="form-group mb-4">
        <label for="project_overview" class="profile-title2 mb-1 slide-up-element-3">プロジェクト概要<span style="margin-left: 6px;">project overview</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label>
        @if ($errors->has('project_overview'))
            <br>
            <span class="errors" role="alert">
                <strong>{{ $errors->first('project_overview') }}</strong>
            </span>
        @endif
        <textarea id="project_overview" class="form-control custom-input slide-up-element-2" name="project_overview">{{ old('project_overview', $portfolioData->project_overview) }}</textarea>
    </div>

    <label for="coding" class="profile-title2 mb-1 slide-up-element-3">使用した技術<span style="margin-left: 6px;">use skills</span><span style="margin-left: 13px; background: #479aa5; color: transparent; -webkit-background-clip: text; background-clip: text;">(任意)</span></label>
    <div class="skill-container slide-up-element-2">
        @foreach($userSkillList as $userSkill)
            <div class="skill-item">
                <label class="skill-check">
                    <input type="checkbox" name="selected_skills[]" value="{{ $userSkill->skill_id }}" class="hidden-checkbox" 
                    @foreach($checkSkillList as $checkSkill)
                        {{ $userSkill->skill_id == $checkSkill->skill_id ? 'checked' : '' }}
                    @endforeach
                    >
                    <div class="checkbox-icon">
                        <div class="checkmark" style="font-size: 1.5rem; font-weight: bold;">✓</div>
                    </div>
                    <img src="{{ asset('storage/skills/' . $userSkill->skill_file_path) }}" alt="スキル画像" class="skill_image" style="width: 50px; height: 50px;">
                    <span class="profile-title2">{{ $userSkill->skill_name }}</span>
                </label><br>
            </div>
        @endforeach
    </div>

    <div class="form-group mb-4">
        <label for="coding" class="profile-title2 mb-1 slide-up-element-3">コーディングURL<span style="margin-left: 6px;">coding url</span><span style="margin-left: 13px; background: #479aa5; color: transparent; -webkit-background-clip: text; background-clip: text;">(任意)</span></label>
        <br><small class="profile-small">※GitHubなどのプラットフォームを使ってコードを公開することで、実際の成果物を見せることができます。</small>
        @if ($errors->has('coding'))
            <br>
            <span class="errors" role="alert">
                <strong>{{ $errors->first('coding') }}</strong>
            </span>
        @endif
        <input type="text" id="coding" class="form-control custom-input slide-up-element-2" name="coding" value="{{ old('coding', $portfolioData->coding) }}">
    </div>

    <div class="form-group mb-4">
        <label for="design" class="profile-title2 mb-1 slide-up-element-3">デザインURL<span style="margin-left: 6px;">design url</span><span style="margin-left: 13px; background: #479aa5; color: transparent; -webkit-background-clip: text; background-clip: text;">(任意)</span></label>
        <br><small class="profile-small">※Figmaなどのプラットフォームを使ってデザインを公開することで、実際のデザインを見せることができます。</small>
        @if ($errors->has('design'))
            <br>
            <span class="errors" role="alert">
                <strong>{{ $errors->first('design') }}</strong>
            </span>
        @endif
        <input type="text" id="design" class="form-control custom-input slide-up-element-2" name="design" value="{{ old('design', $portfolioData->design) }}">
    </div>

    <div class="form-group mb-4">
        <label for="responsibilities" class="profile-title2 mb-1 slide-up-element-3">担当内容<span style="margin-left: 6px;">responsibilities</span><span style="margin-left: 13px; background: #479aa5; color: transparent; -webkit-background-clip: text; background-clip: text;">(任意)</span></label>
        @if ($errors->has('responsibilities'))
            <br>
            <span class="errors" role="alert">
                <strong>{{ $errors->first('responsibilities') }}</strong>
            </span>
        @endif
        <input type="text" id="responsibilities" class="form-control custom-input slide-up-element-2" name="responsibilities" value="{{ old('responsibilities', $portfolioData->responsibilities) }}">
    </div>

    <div class="form-group mb-4">
        <label for="explanation" class="profile-title2 mb-1 slide-up-element-3">その他<span style="margin-left: 6px;">others</span><span style="margin-left: 13px; background: #479aa5; color: transparent; -webkit-background-clip: text; background-clip: text;">(任意)</span></label>
        @if ($errors->has('explanation'))
            <br>
            <span class="errors" role="alert">
                <strong>{{ $errors->first('explanation') }}</strong>
            </span>
        @endif
        <textarea id="explanation" class="form-control custom-input slide-up-element-2" name="explanation">{{ old('explanation', $portfolioData->explanation) }}</textarea>
    </div>

    <div class="d-flex justify-content-end slide-up-element">
        <div class="form-group">
            <button type="submit" class="btn btn-primary">更新<span style="font-size: 0.8rem; margin-left: 6px;">edit</span></button>
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