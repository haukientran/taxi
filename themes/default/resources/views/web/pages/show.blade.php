@extends('Default::web.layouts.app')
@section('head')
	<style type="text/css">
		@php
			echo file_get_contents(asset("./assets/build/css/page.min.css?v=".config('SudoAsset.vesion')));
		@endphp
	</style>
@endsection
@section('content')
<main class="pages">
	<div class="container">
		<div class="page w-100 mb-30 mt-30">
            <div class="page-left__title w-100">
                <h1 class="fs-22 f-w-b lh-26">{{ $page->name ?? '' }}</h1>
            </div>
            <div class="page-left__detail">
                <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr">
                    <div class="ck-content">
                        {!! replaceCkeditor($page->detail ?? '') !!}
                    </div>
                </div>
            </div>
		</div>
	</div>
</main>
@endsection
