<div class="attributes__item attributes__item{!! $data_id !!}" data-id="{!! $data_id !!}">
	<div class="mb-3 row">
		<div class="col-md-5">
	        <label for="" class="col-md-12 col-form-label"> @lang('Tên thuộc tính')</label>
	        <div class="col-md-12">
	            <select class="form-control form-select" @if($data_id == 1) disabled @endif name="attributes[]" id="attributes">
	            	<option value="0">---@lang('Chọn thuộc tính')---</option>
	            	@foreach($attributes as $value)
                    <option value="{!! $value->id !!}">{!! $value->name??'' !!}</option>
                    @endforeach
                </select>
	        </div>
        </div>
        <div class="col-md-5">
	        <label for="" class="col-md-12 col-form-label"> @lang('Giá trị')</label>
	        <div class="col-md-12">
	            <select class="form-control form-select" @if($data_id == 1) disabled @endif name="attribute_details[]" id="attribute_details">
	            	<option value="0">---@lang('Giá trị thuộc tính')---</option>
                </select>
	        </div>
        </div>
        <div class="col-md-2">
        	<a href="javascript:;" class="btn-remove-attribute"><i class="fas fa-trash"></i></a>
        </div>
    </div>
</div>