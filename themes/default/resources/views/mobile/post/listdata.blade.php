@if(count($posts) > 0)
	@include('Default::mobile.layouts.post_item',['posts'=>$posts])
@else
	@include('Default::mobile.layouts.list_empty')
@endif
