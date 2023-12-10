@extends('Default::mobile.layouts.app')
@section('head')
	<style type="text/css">
		@php
			echo file_get_contents(asset("./assets/build/css/search_school_mb.min.css?v=".config('SudoAsset.vesion')));
		@endphp
	</style>
@endsection
@section('content')
<main class="search-school">
    <section class="filter">
        <div class="filter-banner" style="background-image:  url({{ getImage($setting_school['search_school_banner'] ?? '/assets/images/bg-thanh-tuu-1.png') }});background-repeat: no-repeat;background-size: cover;">
            <div class="container">
                <input type="hidden" name="current_url" value="{{ $url ?? '' }}" aria-label="current_url" class="current_url" id="current_url">
                @if ($filters && count($filters) > 0)
                    <div class="filter-list flex">
                        @foreach ($filters as $filter)
                            @if (count($filter->filterDetail) > 0)
                                <div class="filter-list__select">
                                    <label class="filter-label color_white fs-18 lh-36 f-w-b" for="filter_{{  $filter->id }}">{{ $filter->name ?? ''}}</label> <br>
                                    <select class="filter-select w-100" name="filter_{{  $filter->id }}" data-id="{{  $filter->id }}">
                                        <option value="">-- {{ $filter->name }} --</option>
                                        @foreach ($filter->filterDetail as $fil)
                                            <option value="{{ $fil->slug ?? '' }}">{{ $fil->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        @endforeach
                        <div class="filter-list__select filter-list__search">
                            <span class="filter-search color_white fs-18 lh-36 f-w-b text-up">Tìm kiếm</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="school">
        <div class="container">
            <div class="school-title w-100">
                <h1 class="fs-24 text-up f-w-b w-100 lh-36 mb-20"> Danh sách các trường</h1>
                <p class="fs-18 lh-22">{!! $setting_school['search_school_title']  ?? '' !!}</p>
            </div>
            <div class="school-list w-100" id="listdata">
                @include('Default::mobile.layouts.list_school', ['schools'=> $schools])
            </div>
            @if(count($schools) >= 12)
                <div class="category-button text-center button-action">
                    <span class="button button__more color_main view_school btn-more fs-18 f-w-b">{{ __('Xem thêm')}}</span>
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
@section('foot')
    <script defer src="{{ '/assets/build/js/search_school.min.js?v='.config('SudoAsset.vesion') }}"></script>
@endsection
