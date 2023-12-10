<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | {{env('APP_NAME')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Laravel csrf_token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="admin_dir" content="{{ config('app.admin_dir') }}">
    <meta name="language" content="{{ \App::getLocale() }}">
    {{-- Asset đầu trang --}}
    {{-- {!! \Asset::renderHeader() !!} --}}
    {{-- Code nhúng đầu trang --}}
    <!-- Bootstrap Css -->
    <link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin_assets/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('admin_assets/plugins/toastr/toastr.min.css')}}">
    <!-- Icons Css -->
    <link href="{{ asset('admin_assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin_assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/plugins/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('core/libs/nestable/nestable.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin_assets/css/style.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @yield('head')
    <script src="{{ asset('admin_assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <style>
    	.table-rep-plugin .fixed-solution .sticky-table-header {
            top: 0px!important;
            background-color: #556ee6;
        }
        body{
        	background: #fff;
        }
    </style>
</head>
<body data-sidebar="dark">
    <div class="sudo-wrap">
        <div id="layout-wrapper">
            <div class="main-content" style="margin-left: 0;">
                <div class="page-content" style="padding: 0;">
                    <div class="container-fluid">
                        {{-- menu --}}
                        @include('Core::layouts.base.alert')
                        <div class="row" style="background: #fff;">
							<div class="col-lg-12" style="padding: 0;">
								<div class="card listdata" id="listdata">
									<div class="card-header" style="background: #fff;">
										@if (isset($data['search']) && !empty($data['search']))
											<div class="float-left search-container" style="width: 100%;">
													@if(isset($data['action']) && is_array($data['action']))
														<div class="box-action">
															<select class="btn btn-default btn-sm" data-action data-field="{!! $data['action']['field_name'] !!}" style="float: left;height: 30px;margin-right: 5px;">
																@foreach($data['action']['value'] as $key => $value)
																	<option value="{!! $value !!}">{!! __($data['action']['label'][$key]) !!}</option>
																@endforeach
															</select>
															<button style="float: left;padding: 5px 10px;margin-top: 1px;margin-right: 5px;"
																type="button"
																class="btn btn-sm btn-primary"
																data-table="{{$table_name??''}}"
																data-action_all
															> {!! __('Translate::table.apply') !!}</button>
														</div>
													@endif
												<form action="{{ route('admin.'.$table_name.'.index') }}" class="form-inline" method="GET" accept-charset="utf-8">
													<input type="hidden" name="search" value="1">
													@foreach ($data['search'] as $search)
														@switch($search['field_type']??'')
														    @case('string')
														    	@php
														    		$fields = $search['fields']??'';
														    		$label = $search['label']??'';
														    	@endphp
														        <div class="form-group">
																	<input type="text" class="form-control input-sm" name="{{ $fields }}" placeholder="@lang($label)" value="{{ Request()->$fields }}">
																</div>
													        @break

													        @case('array')
																@php
														    		$fields = $search['fields']??'';
														    		$label = $search['label']??'';
														    		$options = $search['option']??'';
														    	@endphp
														    	<div class="form-group">
														    		<select name="{{ $fields }}" class="form-control input-sm">
														    			<option value="" @if(empty(Request()->$fields)) selected @endif >@lang('Translate::table.all') @lang($label)</option>
														    			@foreach ($options as $key => $option)
														    				<option value="{{ $key??'' }}" 
														    					@if (Request()->$fields != null && Request()->$fields == $key)
															    					selected
															    				@endif
														    				>@lang($option??'')</option>
														    			@endforeach
														    		</select>
														    	</div>
													        @break

													        @case('hidden')
																@php
														    		$fields = $search['fields']??'';
														    		$label = $search['label']??'';
														    	@endphp
																<input type="hidden" class="form-control input-sm" name="{{ $fields }}" value="{{ Request()->$fields }}">
													        @break

													        @case('range')
																@php
														    		$fields = $search['fields']??'';
														    		$field_start = $search['fields'].'_start'??'';
														    		$field_end = $search['fields'].'_end'??'';
														    		$label = $search['label']??'';
														    	@endphp
																<div class="form-group">
																	<div id="{!! $fields !!}" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%" class="form-control input-sm">
								                                        <i class="fa fa-calendar mr-1"></i>
								                                        <span></span>
								                                        <i class="fa fa-caret-down ml-1"></i>
								                                    </div>
								                                    <input id="{!! $fields !!}_start" type="hidden" name="{!! $fields !!}_start" value="">
								                                    <input id="{!! $fields !!}_end" type="hidden" name="{!! $fields !!}_end" value="">
																</div>
																<script>
																	$(function() {
								                                        var start = moment('{{Request()->$field_start??'01/01/1970'}}');
								                                        var end = moment('{{Request()->$field_end??''}}');
								                                        function cb(start, end) {
								                                            if(start.format('DD/MM/YYYY') == '01/01/1970') {
								                                                $('#{!! $fields !!} span').html('@lang('Translate::table.all') @lang($label)');
								                                                $('#{!! $fields !!}_start').val('');
								                                                $('#{!! $fields !!}_end').val('');
								                                            }else {
								                                                $('#{!! $fields !!} span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
								                                                $('#{!! $fields !!}_start').val(start.format('YYYY-MM-DD HH:mm:ss'));
								                                                $('#{!! $fields !!}_end').val(end.format('YYYY-MM-DD HH:mm:ss'));
								                                            }
								                                        }
								                                        $('#{!! $fields !!}').daterangepicker({
								                                            startDate: start,
								                                            endDate: end,
								                                            timePicker: true,
								                                            timePicker24Hour: true,
								                                            timePickerSeconds: true,
								                                            ranges: {
								                                               '@lang('Tất cả')': [moment('1970-01-01'), moment().endOf('day')],
								                                               '@lang('Hôm nay')': [moment().startOf('day'), moment().endOf('day')],
								                                               '@lang('Hôm qua')': [moment().startOf('day').subtract(1, 'days'), moment().endOf('day').subtract(1, 'days')],
								                                               '@lang('7 ngày qua')': [moment().startOf('day').subtract(6, 'days'), moment()],
								                                               '@lang('30 ngày qua')': [moment().startOf('day').subtract(29, 'days'), moment()],
								                                               '@lang('Tháng này')': [moment().startOf('month'), moment().endOf('month')],
								                                               '@lang('Tháng trước')': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
								                                            },
								                                            locale: {
								                                                applyLabel: "@lang('Chọn')",
								                                                cancelLabel: "@lang('Xóa')",
								                                                fromLabel: "@lang('Từ')",
								                                                toLabel: "@lang('Đến')",
								                                                customRangeLabel: "@lang('Tùy chọn')",
								                                                daysOfWeek: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
								                                                monthNames: ["@lang('Tháng') 1", "@lang('Tháng') 2", "@lang('Tháng') 3", "@lang('Tháng') 4", "@lang('Tháng') 5", "@lang('Tháng') 6", "@lang('Tháng') 7", "@lang('Tháng') 8", "@lang('Tháng') 9", "@lang('Tháng') 10", "@lang('Tháng') 11", "@lang('Tháng') 12"],
								                                                firstDay: 1
								                                            }
								                                        }, cb);
								                                        cb(start, end);
								                                    });
																</script>
													        @break
														@endswitch
														
													@endforeach

													<div class="form-group">
								                    	<div class="btn-group">
								                    		@csrf
								                    		<button type="submit" class="btn btn-flat btn-success btn-sm search-btn"><i class="fas fa-search mr-1"></i>@lang('Translate::table.search')</button>
								                    		@if (isset($data['search_btn']) && !empty($data['search_btn']))
								                    			@foreach ($data['search_btn'] as $search_btn)
								                    				<button type="submit" formaction="{!! $search_btn['url']??'' !!}" formmethod="POST" class="btn btn-{!! $search_btn['btn_type']??'' !!} btn-sm">{!! (isset($search_btn['btn_icon']) && !empty($search_btn['btn_icon']))?'<i class="'.$search_btn['btn_icon'].' mr-1"></i>' : ''!!}@lang($search_btn['label']??'')</button>
								                    			@endforeach
								                    		@endif
								                    	</div>
								                    </div>

												</form>
											</div>
										@endif
										<div class="float-right action-container">
						                    @if (Request()->trash == true) 
												<a href="{{ route('admin.'.$table_name.'.index') }}" class="btn btn-sm btn-default"><i class="fas fa-bars mr-1"></i>@lang('Translate::table.list_url')</a>
						                    @endif
										</div>
									</div>
									<!-- /.card-header -->
									<div class="table-rep-plugin">
										<div class="table-wrapper">
											<div class="table-responsive mb-0 fixed-solution" data-pattern="priority-columns" style="margin-bottom: 0;">
												<table class="table table-striped" style="width: 100%;float: left;min-width: unset;">
													<thead>
														<tr>
															<th class="text-center pl-3" style="width: 50px;">STT</th>
															@if (isset($data['action']) && !empty($data['action']))
																<th class="table-checkbox center">
																	<input type="checkbox" class="btn-checkbox checkall">
																</th>
															@endif
															@foreach ($data['table_generate'] as $generate)
																{{-- Nếu là route sửa và có đa ngôn ngữ thì hiển thị tự động cột đa ngôn ngữ --}}
																@if ($generate['type'] == 'lang')
																	@if (isset($has_locale) && $has_locale == true && !empty(config('app.language') ?? []))
																		<th class="lang" style="width: calc(26px * {{count(config('app.language') ?? [])}} + 5px)">
																			@foreach (config('app.language') as $key => $lang)
																				<span><img src="{{getImage($lang['flag'] ?? '')}}"></span>
																			@endforeach
																		</th>
																	@endif
																@else
																	<th 
																		class="text-center"
																		@if (isset($generate['has_order']) && $generate['has_order'] == 1)
																			style="cursor: pointer;" 
																			data-order_fields="{{$generate['field']??''}}"
																			data-order_by="asc"
																		@endif
																	>
																		@lang($generate['label']??'')
																		@if (isset($generate['has_order']) && $generate['has_order'] == 1)
																			<div class="float-right"><i class="fas fa-sort"></i></div>
																		@endif
																	</th>
																@endif
															@endforeach
														</tr>
													</thead>
													<tbody>
														@include('Category::item')
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- /.card-body -->

									<div class="card-footer clearfix">
										<div class="float-left footer-action">
											@if(isset($data['action']) && is_array($data['action']))
												<div class="box-action">
													<select class="btn btn-default btn-sm" data-action data-field="{!! $data['action']['field_name'] !!}" style="float: left;height: 30px;margin-right: 5px;">
														@foreach($data['action']['value'] as $key => $value)
															<option value="{!! $value !!}">{!! __($data['action']['label'][$key]) !!}</option>
														@endforeach
													</select>
													<button style="float: left;padding: 5px 10px;margin-top: 1px;margin-right: 5px;"
														type="button"
														class="btn btn-sm btn-primary"
														data-table="{{$table_name??''}}"
														data-action_all
													> {!! __('Translate::table.apply') !!}</button>
												</div>
											@endif
											@if (isset($has_locale) && $has_locale == true && !empty(config('app.language') ?? []))
												<select class="btn btn-default btn-sm" data-language_table>
													@php
														$cookie_locale = (isset($_COOKIE['table_locale']))? $_COOKIE['table_locale'] : \App::getLocale();
													@endphp
													@foreach (config('app.language') as $key => $lang)
														<option value="{!! $key !!}" @if ($key == $cookie_locale) selected @endif >{!! $lang['name'] ?? '' !!}</option>
													@endforeach
												</select>
											@endif
											@if (isset($data['no_trash']) && $data['no_trash'] == true)
						                    	<a href="{{ route('admin.'.$table_name.'.index', ['trash' => 'true']) }}" class="btn btn-sm btn-default" style="color: #fff;background: #f1b44c;border: none;padding: 5px 20px;">@lang('Translate::table.trash_url')</a>
						                    @endif
										</div>
										@if (isset($data['paginate']) && $data['paginate'] == true)
											<div class="float-right pagination-sm m-0">
												{{$data['show_data']->appends(Request()->all())->links()}}
											</div>
											<div class="float-right mr-2">
							                    <button type="button" class="btn btn-sm btn-default">@lang('Translate::table.total'): <span class="total">{{$data['show_data']->total()}}</span></button>
											</div>
										@else
											<div class="float-right">
									            <button type="button" class="btn btn-sm btn-default">@lang('Translate::table.total'): <span class="total">{{ count($data['show_data']) }}</span></button>
											</div>
										@endif
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Asset cuối trang --}}
    {{-- {!! \Asset::renderFooter() !!} --}}
    <!-- Code nhúng cuối trang -->
    <script>
    	$(document).ready(function(){
            $('table td a').on('click', function(e){
                e.preventDefault();
                var link = $(this).attr('href');
                if(link != 'undefined'){
                	window.parent.window.location.href = link;
                }
            });
    	});
    </script>
    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin_assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('admin_assets/libs/admin-resources/rwd-table/rwd-table.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/pages/table-responsive.init.js') }}"></script>
    <!-- Toastr -->
    <script src="{{asset('admin_assets/plugins/toastr/toastr.min.js')}}"></script>
    <!-- apexcharts -->
    <script src="{{ asset('admin_assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- dashboard init -->
    {{-- <script src="{{ asset('admin_assets/js/pages/dashboard.init.js') }}"></script> --}}
    <script src="{{ asset('admin_assets/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('admin_assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('core/libs/nestable/jquery.nestable.js') }}"></script>
    
    <script src="{{ asset('admin_assets/libs/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/pages/form-mask.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('admin_assets/js/app.js') }}"></script>
    <script src="{{ asset('core/js/core.js') }}"></script>
    <script src="{{ asset('core/js/functions.js') }}"></script>
    <script src="{{ asset('core/libs/nestable/nestable.js') }}"></script>
    @yield('foot')
</body>
</html>