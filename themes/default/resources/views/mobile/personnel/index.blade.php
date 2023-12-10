@extends('Default::mobile.layouts.app')
@section('head')
	<style type="text/css">
		@php
			echo file_get_contents(asset("./assets/build/css/personnel_mb.min.css?v=".config('SudoAsset.vesion')));
		@endphp
	</style>
@endsection
@section('content')
<main class="personnel">
    <section class="personnel-banner w-100" style="background-image:url({{ isset($config_personnel['background']) ? $config_personnel['background'] : ''}});background-repeat: no-repeat;background-size: cover;">
        <h1 class="fs-30 lh-35 f-w-b text-center color_white ">
            {{ isset($config_personnel['description']) ? $config_personnel['description'] : 'Nhân sự của DU HỌC LÊ ÁNH' }}
        </h1>
    </section>
    <section class="personnel-top mt-30">
        <div class="container">
            <div class="personnel-title mb-20">
                <h3 class="fs-28 lh-36 f-w-b text-up">{{ $config_personnel['title_1'] ?? 'Ban lãnh đạo'}}</h3>
            </div>
            <div class="personnel-list w-100">
                @if(isset($personnels) && count($personnels) > 0)
                    @foreach($personnels as $personnel)
                        @if(!$personnel->type_position)
                            @include('Default::mobile.layouts.member_item')
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
	</section>
    <section class="personnel-bottom">
        <div class="container">
            <div class="personnel-title mb-20">
                <h3 class="fs-28 lh-36 f-w-b text-up">{{ $config_personnel['title_2'] ?? 'Đội ngũ nhân sự'}}</h3>
            </div>
            <div class="personnel-list w-100">
                @if(isset($personnels) && count($personnels) > 0)
                    @foreach($personnels as $personnel)
                        @if($personnel->type_position)
                            @include('Default::mobile.layouts.member_item')
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </section>
</main>
@endsection

