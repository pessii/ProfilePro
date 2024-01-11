@extends('layouts.app')

@section('content')
<h1 class="profile-heading">お問い合わせ<span class="edit-profile" style="margin-left: 10px;">inquiry</span></h1>

<form method="POST" action="{{ route('contact.submit') }}">
    @csrf

    <div class="form-group mb-4">
        <label for="name" class="profile-title2 slide-up-element-3">ユーザー名<span style="margin-left: 6px;">name</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label><br>
        @if ($errors->has('name'))
            <br>
            <span class="errors" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
        <input type="text" name="name" id="name" class="form-control custom-input slide-up-element-2" required>
    </div>

    <div class="form-group mb-4">
        <label for="email" class="profile-title2 slide-up-element-3">メールアドレス<span style="margin-left: 6px;">email</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label><br>
        @if ($errors->has('email'))
            <br>
            <span class="errors" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <input type="email" name="email" id="email" class="form-control custom-input slide-up-element-2" required>
    </div>

    <div class="form-group mb-4">
        <label for="category" class="profile-title2 slide-up-element-3">カテゴリ<span style="margin-left: 6px;">category</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label><br>
        @if ($errors->has('category'))
            <br>
            <span class="errors" role="alert">
                <strong>{{ $errors->first('category') }}</strong>
            </span>
        @endif
        <select name="category" id="category" class="select-form custom-input slide-up-element-2" required>
            <option value="1">サイトへの要望</option>
            <option value="2">エラー</option>
            <option value="3">操作方法</option>
            <option value="4">トラブル</option>
            <option value="99">その他</option>
        </select><br>
    </div>

    <div class="form-group">
        <label for="content" class="profile-title2 slide-up-element-3">内容<span style="margin-left: 6px;">content</span><span style="margin-left: 13px; background: #dc3545; color: transparent; -webkit-background-clip: text; background-clip: text;">(必須)</span></label><br>
        @if ($errors->has('content'))
            <br>
            <span class="errors" role="alert">
                <strong>{{ $errors->first('content') }}</strong>
            </span>
        @endif
        <textarea name="content" id="content" rows="5" class="form-control custom-input slide-up-element-2" required></textarea><br>
    </div>

    <div class="d-flex justify-content-end slide-up-element">
        <div class="form-group form-send">
            <button type="submit" class="btn btn-primary">送信<span style="font-size: 0.8rem; margin-left: 6px;">send</span></button>
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