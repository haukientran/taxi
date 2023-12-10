@include('Table::components.link',['text' => $value->title, 'url' => route('admin.taxes.edit', $value->id), 'width'=>'auto'])
<td class="center" style="width: 100px;">
	{!! $value->percentage??'' !!}
</td>
<td class="center" style="width: 100px;">
	{!! $value->priority??'' !!}
</td>