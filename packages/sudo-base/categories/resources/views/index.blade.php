@if (isset($data['table_simple']) && $data['table_simple'] == true)
	@include('Category::listdata_simple')
@elseif (isset(Request()->trash) && Request()->trash == true)
	@include('Category::listdata', ['module_name' => __('Thùng rác: ').__($module_name)])
@else
	@include('Category::listdata')
@endif