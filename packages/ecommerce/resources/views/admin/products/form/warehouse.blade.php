<div class="mb-3 row">
    <div style="width: 40px;float: left;">
        <input type="checkbox" class="warehouse" name="warehouse" @if(isset($data) && $data->quantity != 0) checked @endif style="width: 20px;height: 18px;">
    </div> 
    <label class="col-md-4 col-form-label" style="padding: 0;">@lang('Quản lý kho hàng')</label>
</div>
@php
	if(isset($data) && $data->quantity != 0){
		$disable = false;
	}else{
		$disable = true;
	}
@endphp
@include('Form::base.number', [
	'name'				=> 'quantity',
	'value' 			=> number_format($data->quantity??0),
	'required' 			=> 0,
	'label' 			=> 'Số lượng',
	'placeholder' 		=> '',
	'has_row' 			=> false,
	'class_col' 		=> 'col-lg-3',
	'disable' 			=> $disable,
	'convert_number'	=> true,
])
<script>
	$(document).ready(function(){
		@if($disable == true)
		$('input[name="quantity"]').parents('.mb-3 ').hide();
		@endif
		$('input[name="warehouse"]').on('change', function(){
	        if($(this).prop("checked") == true){
	            $('input[name="quantity"]').parents('.mb-3 ').slideDown();
	            $('input[name="quantity"]').removeAttr('disabled');
	        }else{
	        	$('input[name="quantity"]').parents('.mb-3 ').slideUp();
	        	$('input[name="quantity"]').attr('disabled', 'disabled');
	        }
		});
	});
</script>