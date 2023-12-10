@extends('Core::layouts.app')

@section('title') @lang('Translate::form.create') @lang($module_name) @endsection
@section('content')

<form action="{!! route('admin.'.$table_name.'.store') !!}" class="form-horizontal" enctype="multipart/form-data" method="post">
<div class="row">
	@include('Form::generate')

	@if (isset($has_seo) && $has_seo == true)
		@include('Form::metaseo', ['hide_review'=>1])
	@endif
</div>
</form>

@endsection