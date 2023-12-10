<div class="modal-dialog">
    <div class="modal-content">
	    <div class="modal-header">
		    <h5 class="modal-title">Thêm biến thể</h5>
		    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	    </div>
      	<div class="modal-body">
      		<div class="row">
      			@foreach($product_attribute_maps as $value)
      				@php
      					$attribute = DB::table('attributes')->where('id', $value)->first();
      					$attribute_details = DB::table('attribute_details')->where('attribute_id', $value)->pluck('name', 'id');
      				@endphp
      				@include('Form::base.select', [
			        	'name'				=> 'attribute_detail[]',
						'value' 			=> '',
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
					'value' 			=> '',
					'required' 			=> 0,
					'label' 			=> 'Mã sản phẩm',
					'placeholder' 		=> '',
					'has_row' 			=> false,
					'class_col' 		=> 'col-lg-4',
					'disable' 			=> ''
		        ])
		        @include('Ecommerce::admin.products.form.price', [
                    'name'          => 'variant_price',
                    'value'         => '',
                    'required'      => 0,
                    'label'         => 'Giá bán',
                    'placeholder'   => '',
                    'has_row'       => false,
                    'class_col'     => 'col-lg-4',
                ])
                @include('Ecommerce::admin.products.form.price', [
                    'name'          => 'variant_price_old',
                    'value'         => '',
                    'required'      => 0,
                    'label'         => 'Giá thị trường',
                    'placeholder'   => '',
                    'has_row'       => false,
                    'class_col'     => 'col-lg-4',
                ])
            </div>
            <div class="form-title" style="width: 100%;margin-left: 0;"> Thông tin tính phí vận chuyển </div>
            <div class="row">
                @include('Ecommerce::admin.products.form.price', [
                    'name'          => 'variant_weight',
                    'value'         => '',
                    'required'      => 0,
                    'label'         => 'Trọng lượng (gram)',
                    'placeholder'   => '',
                    'has_row'       => false,
                    'class_col'     => 'col-lg-6',
                ])
                @include('Ecommerce::admin.products.form.price', [
                    'name' => 'variant_length',
                    'value' => '',
                    'required' => 0,
                    'label' => 'Chiều dài (cm)',
                    'placeholder' => '',
                    'has_row'       => false,
                    'class_col'     => 'col-lg-6',
                ])
      		</div>
      		<div class="row">
      			@include('Ecommerce::admin.products.form.price', [
                    'name'          => 'variant_wide',
                    'value'         => '',
                    'required'      => 0,
                    'label'         => 'Chiều rộng (cm)',
                    'placeholder'   => '',
                    'has_row'       => false,
                    'class_col'     => 'col-lg-6',
                ])
                @include('Ecommerce::admin.products.form.price', [
                    'name' => 'variant_height',
                    'value' => '',
                    'required' => 0,
                    'label' => 'Chiều cao (cm)',
                    'placeholder' => '',
                    'has_row'       => false,
                    'class_col'     => 'col-lg-6',
                ])
                @include('Form::base.image', [
		        	'name'				=> 'variant_image0',
					'value' 			=> '',
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
	        <button type="button" class="btn btn-primary btn-save" data-variant="0">Lưu lại</button>
      	</div>
    </div>
</div>