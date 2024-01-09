@extends('layouts.app')

@section('content')
<div class="admin-mb-div">
    <a href="{{ route('profile') }}" class="admin-m-button slide-up-element-3">
        <h2 class="admin-m-h2">プロフィール編集</h2>
        <span style="font-size: 0.8rem; margin-left: 6px;">edit profile</span>
        <div class="admin-m-div-img">
            <img src="{{ asset('storage/images/' . $loginUser->avatar) }}" class="rounded-circle admin-m-img" alt="プロフィール画像">
        </div>
    </a>
    <a href="{{ route('contact.index') }}" class="admin-b-button slide-up-element-3">
        <h2 class="admin-m-h2">お問い合わせ</h2>
        <span style="font-size: 0.8rem; margin-left: 6px;">inquiry</span>
        <div class="admin-m-div-img">
            <img src="{{ asset('storage/images/letter_mono.png') }}" class="admin-m-img" alt="プロフィール画像">
        </div>
    </a>
</div>

<a href="{{ route('productions.index', ['id' => Auth::user()->id]) }}" class="admin-mb-a slide-up-element-2">
    <h2 class="admin-m-h2-a">表示確認<span style="font-size: 0.8rem; margin-left: 6px;">display confirmation</span></h2>
    <div class="admin-m-div-img">
        <img src="{{ asset('storage/images/ifn0859.png') }}" class="rounded-circle admin-m-img-a" alt="プロフィール画像">
    </div>
</a>

<div class="admin-mb">
    <a href="{{ route('skill') }}" class="admin-m-button-4 slide-up-element">
        <h2 class="admin-m-h2-4">スキル編集</h2>
        <span style="font-size: 0.6rem; margin-left: 6px;">edit skills</span>
        <div class="admin-m-div-img">
            <img src="{{ asset('storage/images/icon_data01_01.png') }}" class="rounded-circle admin-m-img-4" alt="プロフィール画像">
        </div>
    </a>
    <a href="{{ route('portfolio.create') }}" class="admin-m-button-4 slide-up-element">
        <h2 class="admin-m-h2-4">ポートフォリオ作成</h2>
        <span style="font-size: 0.6rem; margin-left: 6px;">portfolio creation</span>
        <div class="admin-m-div-img">
            <img src="{{ asset('storage/images/pc_program_tag_icon_4126.png') }}" class="rounded-circle admin-m-img-4" alt="プロフィール画像">
        </div>
    </a>
    <a href="{{ route('portfolio.admin') }}" class="admin-b-button-4 slide-up-element">
        <h2 class="admin-m-h2-4">ポートフォリオ一覧</h2>
        <span style="font-size: 0.6rem; margin-left: 6px;">portfolio list</span>
        <div class="admin-m-div-img">
            <img src="{{ asset('storage/images/pc_program_tag_icon_4127-300x300.png') }}" class="rounded-circle admin-m-img-4" alt="プロフィール画像">
        </div>
    </a>
    <a href="{{ route('socialmedia.admin') }}" class="admin-b-button-4 slide-up-element">
        <h2 class="admin-m-h2-4">ソーシャルメディア編集</h2>
        <span style="font-size: 0.6rem; margin-left: 6px;">social media editing</span>
        <div class="admin-m-div-img">
            <img src="{{ asset('storage/images/08-06-200303-sns.png') }}" class="admin-m-img-4" alt="プロフィール画像">
        </div>
    </a>
</div>
@endsection
@section('scripts')
	<script src="{{ asset('/js/admin.js') }}"></script>
@endsection
