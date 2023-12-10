@if(count($posts) > 0)
	@include('Default::web.layouts.post_item',['posts'=>$posts])
@else
	@include('Default::web.layouts.list_empty')
@endif
