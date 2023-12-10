<td>
	<p>Họ Tên: <strong>{!! $value->name??'' !!}</strong></p>
	<p>SĐT: <strong>{!! $value->phone??'' !!}</strong></p>
</td>
<td>
	{!! $value->departure ?? '' !!} - {{ $value->destination ?? '' }}
</td>