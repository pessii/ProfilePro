@extends('layouts.app')

@section('content')
<h1 class="profile-heading">ポートフォリオ一覧<span class="edit-profile" style="margin-left: 10px;">portfolio list</span></h2>

<div class="portfolio-container slide-up-element">
    @foreach($portfolioList as $portfolio)
        <a href="{{ route('portfolio.edit', ['id'=>$portfolio->id]) }}" class="portfolio-card">
            <img src="{{ asset('storage/portfolios/' . $portfolio->site_file_path) }}" alt="ポートフォリオ画像">
            <h2>{{ $portfolio->serbice_name }}</h2>
        </a>
    @endforeach
</div>

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