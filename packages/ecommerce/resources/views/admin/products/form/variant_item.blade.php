@php
	$product_attribute_maps = DB::table("attribute_variant_maps")->where('product_id', $product_id)->pluck('attribute_id')->toArray();
	$product_attribute_maps = array_unique($product_attribute_maps);
@endphp
@if(count($variants) > 0)
<table>
	<thead>
		<tr>
			@foreach($product_attribute_maps as $value)
				@php
					$attribute = DB::table('attributes')->where('id', $value)->first();
				@endphp
				<th>{!! $attribute->name??'' !!}</th>
			@endforeach
			<th class="price">Giá</th>
			<th class="image">Hình ảnh</th>
			<th class="action">Hành động</th>
		</tr>
	</thead>
	<tbody>
		@foreach($variants as $key => $value)
		<tr>
			@foreach($product_attribute_maps as $val)
				@php
					$attribute_detail = DB::table('attribute_details')->leftJoin('attribute_variant_maps', 'attribute_details.id', 'attribute_variant_maps.attribute_detail_id')->where('attribute_variant_maps.attribute_id', $val)->where('attribute_variant_maps.variant_id', $value->id)->first();
				@endphp
			<td>{!! $attribute_detail->name??'--' !!}</td>
			@endforeach
			<td>
				{!! number_format($value->price??'0') !!}
			</td>
			<td class="center">
				<img src="{!! getImage($value->image) !!}" alt="">
			</td>
			<td>
				<a href="javascript:;" class="btn-edit-variant" data-id="{!! $value->id !!}">Sửa</a>
				<a href="javascript:;" class="btn-remove-variant" data-id="{!! $value->id !!}">Xóa</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else
	<p style="text-align: center;">Việc thêm các thuộc tính giúp sản phẩm có nhiều lựa chọn, chẳng hạn như kích thước, màu sắc,...</p>
@endif