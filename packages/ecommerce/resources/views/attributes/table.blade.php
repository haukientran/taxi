@include('Table::components.link',['text' => $value->name, 'url' => route('admin.attributes.edit', $value->id), 'width'=>'auto'])
<td class="center" style="width: 200px;">
	{!! $value->slug ?? '' !!}
</td>
<td class="form-switch form-switch-lg text-center" style="width: 120px;">
    <input type="checkbox" class="form-check-input" name="is_searchable" value="{!! $value->is_searchable?? '' !!}" @if($value->is_searchable == 1) checked @endif style="padding: 0;margin: 0;left: 0;">
</td>