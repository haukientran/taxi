<div class="modal-dialog">
    <div class="modal-content">
	    <div class="modal-header">
		    <h5 class="modal-title">Sửa biến thể</h5>
		    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	    </div>
      	<div class="modal-body">
			<input type="hidden" name="{!! $product_id??0 !!}">
      		<div class="row">
      			@foreach($product_attribute_maps as $value)
      				@php
      					$attribute = DB::table('attributes')->where('id', $value)->first();
      					$attribute_details = DB::table('attribute_details')->where('attribute_id', $value)->pluck('name', 'id');
      					$attribute_detail_id = DB::table('attribute_variant_maps')->where('product_id', $product_id)->where('variant_id', $variant->id)->where('attribute_id', $attribute->id)->first();
      				@endphp
      				@include('Form::base.select', [
			        	'name'				=> 'attribute_detail[]',
						'value' 			=> $attribute_detail_id->attribute_detail_id,
						'required' 			=> 1,
						'label' 			=> $attribute->name??'',
						'options' 			=> $attribute_details,
						'select2' 			=> 0,
						'disabled' 			=> [],
						'has_row' 			=> false,
						'class_col' 		=> 'col-lg-4'
			        ])
      			@endforeach
      		</div>
      		<div class="row">
      			@include('Form::base.text', [
		        	'name'				=> 'variant_sku',
					'value' 			=> $variant->sku,
					'required' 			=> 0,
					'label' 			=> 'Mã sản phẩm',
					'placeholder' 		=> '',
					'has_row' 			=> false,
					'class_col' 		=> 'col-lg-4',
					'disable' 			=> ''
		        ])
		        @include('Form::base.number', [
                    'name'          => 'variant_price',
                    'value'         => number_format($variant->price),
                    'required'      => 0,
                    'label'         => 'Giá bán',
                    'placeholder'   => '',
                    'has_row'       => false,
                    'class_col'     => 'col-lg-4',
                    'disable'       => false,
                    'convert_number'=> true,
                ])
                @include('Form::base.number', [
                    'name'          => 'variant_price_old',
                    'value'         => number_format($variant->price_old),
                    'required'      => 0,
                    'label'         => 'Giá thị trường',
                    'placeholder'   => '',
                    'has_row'       => false,
                    'class_col'     => 'col-lg-4',
                    'disable'       => false,
                    'convert_number'=> true,
                ])
            </div>
            <div class="form-title" style="width: 100%;margin-left: 0;"> @lang('Thông tin tính phí vận chuyển') </div>
            <div class="row">
                @include('Form::base.number', [
                    'name'          => 'variant_weight',
                    'value'         => number_format($variant->weight),
                    'required'      => 0,
                    'label'         => 'Trọng lượng (gram)',
                    'placeholder'   => '',
                    'has_row'       => false,
                    'class_col'     => 'col-lg-6',
                    'disable'       => false,
                    'convert_number'=> true,
                ])
                @include('Form::base.number', [
                    'name' => 'variant_length',
                    'value' => number_format($variant->length),
                    'required' => 0,
                    'label' => 'Chiều dài (cm)',
                    'placeholder' => '',
                    'has_row'       => false,
                    'class_col'     => 'col-lg-6',
                    'disable'       => false,
                    'convert_number'=> true,
                ])
      		</div>
      		<div class="row">
      			@include('Form::base.number', [
                    'name'          => 'variant_wide',
                    'value'         => number_format($variant->wide),
                    'required'      => 0,
                    'label'         => 'Chiều rộng (cm)',
                    'placeholder'   => '',
                    'has_row'       => false,
                    'class_col'     => 'col-lg-6',
                    'disable'       => false,
                    'convert_number'=> true,
                ])
                @include('Form::base.number', [
                    'name' => 'variant_height',
                    'value' => number_format($variant->height),
                    'required' => 0,
                    'label' => 'Chiều cao (cm)',
                    'placeholder' => '',
                    'has_row'       => false,
                    'class_col'     => 'col-lg-6',
                    'disable'       => false,
                    'convert_number'=> true,
                ])
                @include('Form::base.image', [
		        	'name'				=> 'variant_image'.$variant->id,
					'value' 			=> $variant->image,
					'required' 			=> 0,
					'label' 			=> 'Hình ảnh',
					'title_btn' 		=> 'Chọn ảnh',
					'helper_text' 		=> '',
					'has_row' 			=> false,
					'class_col' 		=> 'col-lg-12',
		        ])
      		</div>
      	</div>
      	<div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-cancel" data-bs-dismiss="modal">Hủy bỏ</button>
	        <button type="button" class="btn btn-primary btn-save" data-variant="{!! $variant->id !!}">Lưu lại</button>
      	</div>
    </div>
</div>