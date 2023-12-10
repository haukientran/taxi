@extends('Core::layouts.app')

@section('content')
<div class="top_html">
    @if (isset($include_view_top) && !empty($include_view_top))
    	@foreach ($include_view_top as $include_view => $include_data)
    		@include($include_view, $include_data)
    	@endforeach
    @endif
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="card listdata" id="listdata">
			<div class="card-header">
				@if (isset($data['search']) && !empty($data['search']))
					<div class="float-left search-container">
						@if (Request()->trash == true)
							<div class="box-action">
								<select class="btn btn-default btn-sm" data-action data-field="{!! $data['action']['field_name'] !!}" style="float: left;height: 30px;margin-right: 5px;">
										<option value="0">{!! __('Hành động') !!}</option>
										<option value="1">{!! __('Lấy lại') !!}</option>
								</select>
								<button style="float: left;padding: 5px 10px;margin-top: 1px;margin-right: 5px;"
									type="button"
									class="btn btn-sm btn-primary"
									data-table="{{$table_name??''}}"
									data-action_all
								> {!! __('Translate::table.apply') !!}</button>
							</div>
	                    @else
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
	                    @endif
						<form action="{{ route('admin.'.$table_name.'.index') }}" class="form-inline" method="GET" accept-charset="utf-8">
							<input type="hidden" name="search" value="1">
                            <input type="hidden" class="newUpdateUrl">
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
								    		<select name="{{ $fields }}" class="form-control input-sm form-select">
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
		                                        <span>{{ $label??'' }}</span>
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
	                        				<button type="submit" formaction="{!! $search_btn['url']??'' !!}" formmethod="POST" class="btn btn-{!! $search_btn['btn_type']??'' !!} btn-flat btn-sm">{!! (isset($search_btn['btn_icon']) && !empty($search_btn['btn_icon']))?'<i class="'.$search_btn['btn_icon'].' mr-1"></i>' : ''!!}@lang($search_btn['label']??'')</button>
	                        			@endforeach
	                        		@endif
	                        	</div>
	                        </div>

						</form>
					</div>
				@endif
				<div class="float-right action-container">
					@if (isset($data['no_add']) && $data['no_add'] == true)
						<a href="{{ route('admin.'.$table_name.'.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus mr-2"></i>@lang('Translate::table.add')</a>
					@endif
                    @if (Request()->trash == true)
						<a href="{{ route('admin.'.$table_name.'.index') }}" class="btn btn-sm btn-default"><i class="fas fa-bars mr-1"></i>@lang('Translate::table.list_url')</a>
                    @endif
				</div>
			</div>
			<!-- /.card-header -->

			<div class="table-rep-plugin">
				<div class="table-wrapper">
					<div class="table-responsive mb-0 fixed-solution" data-pattern="priority-columns">
						<table class="table table-striped">
							<thead>
								<tr>
									<th class="text-center pl-3" style="width: 50px;">@lang('STT')</th>
									@if (isset($data['action']) && !empty($data['action']))
										<th class="table-checkbox center" style="width: 50px;">
											<input type="checkbox" class="form-check-input btn-checkbox checkall">
										</th>
									@endif
									@foreach ($data['table_generate'] as $generate)
										{{-- Nếu là route sửa và có đa ngôn ngữ thì hiển thị tự động cột đa ngôn ngữ --}}
										@if ($generate['type'] == 'lang')
											@if (isset($has_locale) && $has_locale == true && !empty(config('app.language') ?? []))
												<th class="lang center" style="width: calc(26px * {{count(config('app.language') ?? [])}} + 50px)">
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
													data-order_fields="{{$generate['type'] == 'pin' ? 'pin_' : ''}}{{$generate['field']??''}}"
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
								@include('Table::item')
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- /.card-body -->

			<div class="card-footer clearfix">
				<div class="float-left footer-action">
					@if (!empty( config('app.page_size') ?? [] ))
						<select class="btn btn-default btn-sm" data-pagesize>
							@php
								$cookie_locale = (isset($_COOKIE['sudo_page_size']))? $_COOKIE['sudo_page_size'] : $data['page_size'];
							@endphp
							@foreach (config('app.page_size') as $page_size)
								<option value="{!! $page_size !!}" @if ($page_size == $cookie_locale) selected @endif >{!! $page_size !!}</option>
							@endforeach
						</select>
					@endif
					@if (Request()->trash == true)
						<div class="box-action">
							<select class="btn btn-default btn-sm" data-action data-field="{!! $data['action']['field_name'] !!}" style="float: left;height: 30px;margin-right: 5px;">
									<option value="0">{!! __('Hành động') !!}</option>
									<option value="1">{!! __('Lấy lại') !!}</option>
							</select>
							<button style="float: left;padding: 5px 10px;margin-top: 1px;margin-right: 5px;"
								type="button"
								class="btn btn-sm btn-primary"
								data-table="{{$table_name??''}}"
								data-action_all
							> {!! __('Translate::table.apply') !!}</button>
						</div>
                    @else
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
				<div class="float-right pagination-sm m-0">
					{{$data['show_data']->appends(Request()->all())->links()}}
				</div>
				<div class="float-right mr-2">
                    <button type="button" class="btn btn-sm btn-default">@lang('Translate::table.total'): <span class="total">{{$data['show_data']->total()}}</span></button>
				</div>
			</div>

		</div>
	</div>
</div>
@if (isset($include_view_bottom) && !empty($include_view_bottom))
	@foreach ($include_view_bottom as $include_view => $include_data)
		@include($include_view, $include_data)
	@endforeach
@endif

@endsection
