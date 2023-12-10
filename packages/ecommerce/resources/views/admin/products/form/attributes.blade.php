@php
	$attributes_all = \DB::table('attributes')->where('status', 1)->get();
	if(isset($id)){
		$variants = DB::table('variants')->where('product_id', $id)->get();
	}
@endphp
@if(isset($id) && count($variants) > 0) {{-- Hiển thị của trang sửa --}}
	@php
		$variants = DB::table('variants')->where('product_id', $id)->get();
	@endphp
	<div class="edit-attribute" style="width: 100%;float: left;text-align: right;position: relative;bottom: 45px;height: 0">
		<a href="javascript:;" data-bs-toggle="modal" data-bs-target="#editAttributes">@lang('Sửa thuộc tính')</a>
		<a href="javascript:;" style="margin-left: 15px;" class="add-variant">@lang('Thêm biến thể')</a>
	</div>
	<div class="variants">
		<div class="variants-content">
			@include('Ecommerce::admin.products.form.variant_item', ['variants'=>$variants, 'product_id'=>$id])
		</div>
	</div>
@else {{-- Hiển thị của trang thêm --}}
	<div class="add-attribute" style="width: 100%;float: left;text-align: right;position: relative;bottom: 45px;height: 0">
		<a href="javascript:;">@lang('Thêm thuộc tính')</a>
	</div>
	<p style="text-align: center;">Việc thêm các thuộc tính giúp sản phẩm có nhiều lựa chọn, chẳng hạn như kích thước, màu sắc,...</p>
	<div class="attributes">
		<div class="attributes-content">
			@include('Ecommerce::admin.products.form.attributes_item', ['attributes'=>$attributes_all, 'data_id'=>1])
		</div>
		<button type="button" class="add-more-attribute" data-id="2">@lang('Thêm thuộc tính khác')</button>
	</div>
@endif
@if(isset($id)) {{-- Chỉ hiển thị popup khi ở trang sửa --}}
	@php
		$product_attribute_maps = DB::table("attribute_variant_maps")->where('product_id', $id)->pluck('attribute_id')->toArray();
		$product_attribute_maps = array_unique($product_attribute_maps);
	@endphp
	<div class="modal fade" tabindex="-1" id="editAttributes">
		<div class="modal-dialog">
		    <div class="modal-content">
			    <div class="modal-header">
				    <h5 class="modal-title">@lang('Chọn thuộc tính')</h5>
				    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			    </div>
		      	<div class="modal-body">
		      		@foreach($attributes_all as $value)
			        	<div class="edit-attribute-item">
			        		<input type="checkbox" class="form-check-input" @if(in_array($value->id, $product_attribute_maps)) checked @endif name="edit_attribute[]" value="{!! $value->id !!}">
			        		<label>{!! $value->name !!}</label>
			        	</div>
		        	@endforeach
		      	</div>
		      	<div class="modal-footer">
			        <button type="button" class="btn btn-secondary btn-cancel" data-bs-dismiss="modal">Hủy bỏ</button>
			        <button type="button" class="btn btn-primary btn-save">Lưu lại</button>
		      	</div>
		    </div>
		</div>
	</div>
	<div class="modal fade action-variant" tabindex="-1" id="addVariants">
	</div>
	<div class="modal fade action-variant" tabindex="-1" id="editVariants">
	</div>
@endif
@if(isset($id))
<script>
	$(document).ready(function(){
		$('body').on('click', '.add-variant', function(){
			var product_id = {!! $id !!}
			url = '/admin/products/show-popup-add-variant';
        	data = {
				product_id	: 	product_id,
			};
			loadAjaxPost(url, data, {
				beforeSend: function(){},
		        success:function(result){
		        	$('#addVariants').html(result.html);
		        	$('#addVariants').modal('toggle');
		        },
		        error: function (error) {}
			}, 'loading');
		});
		$('body').on('click', '.btn-edit-variant', function(){
			var variant_id = $(this).data('id');
			var product_id = {!! $id !!}
			url = '/admin/products/show-popup-edit-variant';
        	data = {
				variant_id	: 	variant_id,
				product_id	: 	product_id,
			};
			loadAjaxPost(url, data, {
				beforeSend: function(){},
		        success:function(result){
		        	$('#editVariants').html(result.html);
		        	$('#editVariants').modal('toggle');
		        },
		        error: function (error) {}
			}, 'loading');
		});
		$('body').on('click', '.btn-remove-variant', function(){
			var variant_id = $(this).data('id');
			var product_id = {!! $id !!}
			url = '/admin/products/remove-variant';
        	data = {
				variant_id	: 	variant_id,
				product_id	: 	product_id,
			};
			if(confirm("Bạn có chắc muốn xóa biến thể này ?")){
				loadAjaxPost(url, data, {
					beforeSend: function(){},
			        success:function(result){
			        	$('.variants-content').html(result.html);
			        },
			        error: function (error) {}
				});
			}
		});
		$('body').on('click','.action-variant .btn-save', function(){
			var attr_id = $(this).parents('.action-variant').attr('id');
			var element = $('#'+attr_id);
        	var attribute_detail = [];
        	var product_id = {!! $id !!};
        	var variant_id = $(this).data('variant');
        	$('#'+attr_id+' select[name="attribute_detail[]"]').each(function(){
	            attribute_detail.push($(this).find(":selected").val());
			});
			var variant_sku 		= element.find('input[name="variant_sku"]').val();
			var variant_price 		= element.find('input[name="variant_price"]').val();
			var variant_price_old 	= element.find('input[name="variant_price_old"]').val();
			var variant_weight 		= element.find('input[name="variant_weight"]').val();
			var variant_length 		= element.find('input[name="variant_length"]').val();
			var variant_wide 		= element.find('input[name="variant_wide"]').val();
			var variant_height 		= element.find('input[name="variant_height"]').val();
			var variant_image 		= element.find('input[name="variant_image'+variant_id+'"]').val();

			url = '/admin/products/add-variant';
        	data = {
				attribute_detail	: 	attribute_detail,
				product_id			: 	product_id,
				variant_sku			: 	variant_sku,
				variant_price		: 	variant_price,
				variant_price_old	: 	variant_price_old,
				variant_weight		: 	variant_weight,
				variant_length		: 	variant_length,
				variant_wide		: 	variant_wide,
				variant_height		: 	variant_height,
				variant_image		: 	variant_image,
				variant_id			: 	variant_id,
			};
			loadAjaxPost(url, data, {
				beforeSend: function(){},
		        success:function(result){
		        	$('.variants-content').html(result.html);
		        	$('.action-variant .btn-cancel').trigger('click');
		        },
		        error: function (error) {}
			});

        });
        $('#editAttributes .btn-save').on('click', function(){
        	var attribute_checked = [];
        	var product_id = {!! $id !!}
        	$("#editAttributes input").each(function(){
			    if($(this).is(":checked")){
	                attribute_checked.push($(this).val());
	            }
			});
			url = '/admin/products/edit-attributes';
        	data = {
				attribute_checked	: 	attribute_checked,
				product_id			: 	product_id,
			};
			loadAjaxPost(url, data, {
				beforeSend: function(){},
		        success:function(result){
		        	$('.variants-content').html(result.html);
		        	$('#editAttributes .btn-cancel').trigger('click');
		        },
		        error: function (error) {}
			});
        });
	});
</script>
@endif
<script>
	$(document).ready(function(){
		$('body').on('click', '.add-attribute', function(){
			$('.attributes').show();
			$('.attributes .attributes__item select').removeAttr('disabled');
			$(this).find('a').html('Hủy bỏ');
			$(this).addClass('remove-all-attribute');
			$(this).removeClass('add-attribute');
		});

		$('body').on('click', '.remove-all-attribute', function(){
			$('.attributes').hide();
			$('body .attributes .attributes__item select').attr('disabled', 'disabled');
			$(this).find('a').html('Thêm thuộc tính');
			$(this).addClass('add-attribute');
			$(this).removeClass('remove-all-attribute');
		});
		$('body').on('click', '.btn-remove-attribute', function(){
			$(this).parents('.attributes__item').remove();
		});
		$('body').on('click', '.add-more-attribute', function(){
			var data_id = $(this).attr('data-id');
			url = '/admin/products/add-more-attributes';
        	data = {
				data_id:data_id,
			};
			loadAjaxPost(url, data, {
				beforeSend: function(){},
		        success:function(result){
		        	$('.attributes-content').append(result.html);
		        	$('.add-more-attribute').attr('data-id', result.data_id);
		        },
		        error: function (error) {}
			}, 'loading');
		});
        $('body').on('change', '.attributes__item select[name="attributes[]"]',function(){
        	var data_id = $(this).parents('.attributes__item').data('id');
        	var attribute_id = $(this).val();
        	url = '/admin/products/get-attribute-details';
        	data = {
				attribute_id:attribute_id,
			};
			loadAjaxPost(url, data, {
				beforeSend: function(){},
		        success:function(result){
		        	$('.attributes__item'+data_id).find('select[name="attribute_details[]"]').html(result.html);
		        },
		        error: function (error) {}
			});
        });
	});
</script>