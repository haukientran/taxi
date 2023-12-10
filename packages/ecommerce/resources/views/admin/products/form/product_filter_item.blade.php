@if (!isset($category_id) || $category_id == 0)
	<h5 class="p-2" style="font-weight: normal;">@lang('Vui lòng chọn <strong>Danh mục</strong> để hiển thị')</h5>
@else
	@php
		$filter_product_category_maps = getFilterCategoryMap($category_id);
		$filter_array_id = $filter_product_category_maps->pluck('filter_id')->toArray();
		$filters = \Sudo\Ecommerce\Models\Filter::whereIn('id', $filter_array_id)->orderBy('order', 'asc')->where('status',1)->orderBy('id', 'desc')->get();
		$filter_details = collect(\Sudo\Ecommerce\Models\FilterDetail::whereIn('filter_id', $filter_array_id)->where('status',1)->orderBy('order', 'asc')->get());
		$product_filters = \Sudo\Ecommerce\Models\ProductFilter::where('product_id', $product_id ?? 0)->pluck('product_id', 'filter_detail_id')->toArray();
	@endphp
	@if (isset($filters) && count($filters) > 0)
		@foreach ($filters as $filter)
			<div class="card card-pink mb-2">
				<div class="card-header text-sm" data-card-widget="collapse" style="padding: 5px 13px;">
					<div class="card-title">@lang($filter->name)</div>
				</div>
				<div class="card-body" style="padding: 10px 13px;">
					@foreach ($filter_details->where('filter_id', $filter->id) as $details)
						<div class="float-left mr-3 mb-1">
							<input type="checkbox" class="btn-checkbox mr-1" name="filters[]" id="filters-{{$details->id}}" value="{{ $details->id }}"
								@if (isset($product_filters[$details->id]) && $product_filters[$details->id] == $product_id)
									checked
								@endif
							>
							<label class="m-0" style="cursor: pointer;" for="filters-{{$details->id}}">{{ $details->name }}</label>
						</div>
					@endforeach
				</div>
			</div>
		@endforeach
	@else
		<h5 class="p-2" style="font-weight: normal;">@lang('Bộ lọc tạm thời không khả dụng!') @lang('Vui lòng') <a href="{{ route('admin.filters.index') }}" target="_blank">@lang('Thêm bộ lọc')</a> @lang('hoặc chọn bộ lọc tại') <a href="{{ route('admin.product_categories.edit', $category_id) }}" target="_blank">@lang('Danh mục')</a></h5>
	@endif
@endif