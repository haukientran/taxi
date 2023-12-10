@php
	$prefix = '';
	for ($i=0; $i < $value->level; $i++) { 
		$prefix .= '|— ';
	}
@endphp
@include('Table::components.link', ['text' => $prefix.$value->name, 'url' => route('admin.product_categories.edit', $value->id), 'width'=>'auto'])
