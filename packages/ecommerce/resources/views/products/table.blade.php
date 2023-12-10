@include('Table::components.image',['image' => $value->getImage()])
@include('Table::components.link',['text' => $value->name, 'url' => route('admin.products.edit', $value->id), 'width' => 'auto'])
<td style="width: 300px;">
	@php
		$product_category_maps = collect($product_category_maps);
		$product_categorie_map = $product_category_maps->where('product_id', $value->id);
	@endphp
	@if (isset($product_categorie_map) && !empty($product_categorie_map))
		@foreach ($product_categorie_map as $category)
			<a href="{{ route('admin.product_categories.edit', $category->product_category_id) }}" class="btn btn-xs btn-success float-left text-white mr-1 mb-1" target="_blank" style="padding: 2px 5px;margin-right: 2px;">{{ $product_categories[$category->product_category_id] ?? '' }}</a>
		@endforeach
	@endif
</td>