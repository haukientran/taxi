<style>
	.card-title-desc{
		display: none;
	}
</style>
<div class="row" id="shipping">
	<div class="col-lg-4">
		<div class="title-page">Quy tắc tính phí vận chuyển</div>
		<div class="choose-nation" data-bs-toggle="modal" data-bs-target="#chooseNation">
			Chọn khu vực
		</div>
	</div>
	<div class="col-lg-8">
		<div class="shipping-content">
			@foreach($shippings as $value)
			@php
				$shipping_rule = DB::table('shipping_rules')->where('shipping_id', $value->id)->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
			@endphp
				<div class="shipping-content__item shipping-content__item{!! $value->id !!}" data-id="{!! $value->id !!}">
					<div class="head">
						<p class="title">Khu vực: <strong>{!! $provinces[$value->province_id]??'Mặc định' !!}</strong></p>
						@if($value->province_id != -1)
						<p class="action">
							<a href="javascript:;" class="remove-shipping" data-id="{!! $value->id !!}">Xóa</a>
							<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#shippingRule{!! $value->id !!}">Thêm quy tắc vận chuyển</a>
						</p>
						@endif
					</div>
					@foreach($shipping_rule as $val)
						<div class="shipping-rule-group shipping-rule-group-{!! $val->id !!}">
							<div class="shipping-name" data-id="{!! $val->id !!}">{!! $val->name??'' !!}</div>
							<div class="foot">
								@if($value->province_id != -1)
								<p>{!! number_format($val->from) !!} @if($val->type == 'price') đ @else gram @endif - {!! number_format($val->to) !!} @if($val->type == 'price') đ @else gram @endif</p>
								@endif
								<p>{!! number_format($val->price) !!} đ</p>
							</div>
							<div class="shipping-rule shipping-rule-{!! $val->id !!}">
								<div class="shipping-rule-content">
									<div class="form-group">
										<label>Tên quy tắc vận chuyển</label>
										<input type="text" name="name" value="{!! $val->name??'' !!}" @if($value->province_id == -1) disabled @endif>
									</div>
									@if($value->province_id != -1)
									<div class="form-group col-6">
										<label>Type</label>
										<select name="type">
											<option value="price" @if($val->type == 'price') selected @endif>Dựa theo giá sản phẩm</option>
											<option value="weight" @if($val->type == 'weight') selected @endif>Dựa theo trọng lượng sản phẩm (gram)</option>
										</select>
									</div>
									<div class="form-group col-6 price">
										<label>@if($val->type == 'price') Dựa theo giá của sản phẩm @else Dựa theo trọng lượng sản phẩm (gram) @endif</label>
										<input type="text" class="number" name="from" value="{!! $val->from??'' !!}">
										<span class="inline">—</span>
										<input type="text" class="number" name="to" value="{!! $val->to??'' !!}">
									</div>
									@endif
									<div class="form-group col-6">
										<label>Phí ship</label>
										<input type="text" class="number" name="price" value="{!! $val->price??'' !!}">
									</div>
									@if($value->province_id != -1)
									<div class="form-group col-6 order">
										<label>{!! __('Thứ tự ưu tiên') !!}</label>
										<input type="text" class="number" class="order" name="order" value="{!! $val->order??'' !!}">
									</div>
									@endif
								</div>
								<div class="shipping-rule-action">
									@if($value->province_id != -1)
									<button type="button" class="btn btn-danger click-remove" data-id="{!! $val->id !!}">Xóa</button>
									@endif
									<button type="button" class="btn btn-secondary click-cancel">Hủy bỏ</button>
									<button type="button" class="btn btn-primary btn-save-rule" data-id="{!! $val->id !!}">Lưu lại</button>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			@endforeach
		</div>
	</div>
</div>
<div class="modal fade" tabindex="-1" id="chooseNation">
	<div class="modal-dialog">
	    <div class="modal-content">
		    <div class="modal-header">
			    <h5 class="modal-title">Thêm khu vực giao hàng</h5>
			    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		    </div>
	      	<div class="modal-body">
	        	<label>Tỉnh thành</label>
	        	<select name="region">
	        		@foreach($provinces as $key => $value)
	        			@if(!in_array($key, $disable_province))
	        				<option value="{!! $key !!}">{!! $value !!}</option>
	        			@endif
	        		@endforeach
	        	</select>
	      	</div>
	      	<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
		        <button type="submit" class="btn btn-primary">Lưu lại</button>
	      	</div>
	    </div>
	</div>
</div>
@foreach($shippings as $value)
<div class="modal fade" tabindex="-1" id="shippingRule{!! $value->id !!}" data-id="{!! $value->id !!}">
	<div class="modal-dialog">
	    <div class="modal-content" style="width: 650px;">
	    	<input type="hidden" name="create_region" value="0">
		    <div class="modal-header">
			    <h5 class="modal-title">Thêm phí vận chuyển cho khu vực</h5>
			    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		    </div>
	      	<div class="modal-body">
	      		<div class="shipping-rule">
		        	<div class="shipping-rule-content">
						<div class="form-group">
							<label>Tên quy tắc vận chuyển</label>
							<input type="text" name="name" value="">
						</div>
						<div class="form-group col-6">
							<label>Type</label>
							<select name="type">
								<option value="price">Dựa theo giá sản phẩm</option>
								<option value="weight">Dựa theo trọng lượng sản phẩm (gram)</option>
							</select>
						</div>
						<div class="form-group col-6 price">
							<label>Dựa theo giá của sản phẩm</label>
							<input type="text" class="number" name="from" value="0">
							<span class="inline">—</span>
							<input type="text" class="number" name="to" value="0">
						</div>
						<div class="form-group col-6">
							<label>Phí ship</label>
							<input type="text" class="number" name="price" value="0">
						</div>
						<div class="form-group col-6 order">
							<label>{!! __('Thứ tự ưu tiên') !!}</label>
							<input type="text" class="number" class="order" name="order" value="999">
						</div>
					</div>
				</div>
	      	</div>
	      	<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
		        <button type="button" class="btn btn-primary add-shipping-rule" data-id="{!! $value->id !!}">Lưu lại</button>
	      	</div>
	    </div>
	</div>
</div>
@endforeach
<script>
	$(document).ready(function(){
		$('.shipping-rule-action .btn-save-rule').on('click', function(){
			var shipping_rule_id = $(this).data('id');
			element = $('.shipping-rule-'+shipping_rule_id);
			var name 	= element.find('input[name="name"]').val();
			var type 	= element.find('select[name="type"]').val();
			var from 	= element.find('input[name="from"]').val();
			var to 		= element.find('input[name="to"]').val();
			var price 	= element.find('input[name="price"]').val();
			var order 	= element.find('input[name="order"]').val();
			url = '/admin/shippings/shipping-rule/update';
        	data = {
				shipping_rule_id	: 	shipping_rule_id,
				name 				: 	name,
				type				:	type,
				from 				: 	from,
				to 					: 	to,
				price 				: 	price,
				order 				: 	order,
			};
			loadAjaxPost(url, data, {
				beforeSend: function(){},
		        success:function(result){
		        	window.location.reload();
		        },
		        error: function (error) {}
			}, 'loading');
		});
		$('.shipping-rule-action .click-remove').on('click', function(){
			var shipping_rule_id = $(this).data('id');
			url = '/admin/shippings/shipping-rule/remove';
        	data = {
				shipping_rule_id:shipping_rule_id
			};
			if(confirm("Bạn có chắc chắn muốn xóa quy tắc vận chuyển này không?")){
				loadAjaxPost(url, data, {
					beforeSend: function(){},
			        success:function(result){
			        	$('.shipping-rule-group-'+shipping_rule_id).remove();
			        },
			        error: function (error) {}
				}, 'loading');
			}
		});
		$('.add-shipping-rule').on('click', function(){
			var shipping_id = $(this).data('id');
			element = $('#shippingRule'+shipping_id);
			var name 	= element.find('input[name="name"]').val();
			var type 	= element.find('select[name="type"]').val();
			var from 	= element.find('input[name="from"]').val();
			var to 		= element.find('input[name="to"]').val();
			var price 	= element.find('input[name="price"]').val();
			var order 	= element.find('input[name="order"]').val();
			url = '/admin/shippings/shipping-rule/create';
        	data = {
				shipping_id	: 	shipping_id,
				name 		: 	name,
				type		:	type,
				from 		: 	from,
				to 			: 	to,
				price 		: 	price,
				order 		: 	order,
			};
			loadAjaxPost(url, data, {
				beforeSend: function(){},
		        success:function(result){
		        	window.location.reload();
		        },
		        error: function (error) {}
			}, 'loading');
		});
		$('input[class="number"]').on('keyup', function(){
			var number = $(this).val();
			number = format_price(number, 0, ',', ',');
			$(this).val(number);
		});
		$('.shipping-rule-content select').on('change', function(){
			var html = $(this).find(":selected").text();
			$(this).parents('.shipping-rule-content').find('.price label').html(html);
		});
        
        $('.shipping-name').on('click', function(){
        	var id = $(this).data('id');
        	$(this).parents('.shipping-content__item').find('.shipping-rule-'+id).slideToggle();
        });
        $('.click-cancel').on('click', function(){
        	$(this).parents('.shipping-rule').slideUp();
        });
        $('.remove-shipping').on('click', function(){
        	var shipping_id = $(this).data('id');
        	url = '/admin/shippings/region/remove';
        	data = {
				shipping_id:shipping_id
			};
			if(confirm("Bạn có chắc chắn muốn xóa khu vực giao hàng này không?")){
				loadAjaxPost(url, data, {
					beforeSend: function(){},
			        success:function(result){
			        	$('.shipping-content__item'+shipping_id).remove();
			        },
			        error: function (error) {}
				}, 'loading');
			}
        });
	});
</script>