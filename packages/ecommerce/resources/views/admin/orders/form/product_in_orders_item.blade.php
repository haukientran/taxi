@if(isset($data))
    @foreach($data as $value)
        @php
            $variants = DB::table('variants')->where('product_id', $value->id)->get();
            $price = $value->price;
            $image = $value->image;

            $attributes = DB::table('attributes')->where('status', 1)->leftJoin('attribute_variant_maps', 'attribute_variant_maps.attribute_id', 'attributes.id')->where('attribute_variant_maps.product_id', $value->id)->pluck('name', 'id')->toArray();

            $attribute_details = DB::table('attribute_details')->leftJoin('attribute_variant_maps', 'attribute_variant_maps.attribute_detail_id', 'attribute_details.id')->where('attribute_variant_maps.product_id', $value->id)->pluck('name', 'id')->toArray();
        @endphp
        @if(count($variants) > 0)
            @foreach($variants as $val)
                @php
                    if($val->price > 0){$price = $val->price;}
                    if($val->image != ''){$image = $val->image;}

                    $attribute_variant_maps = DB::table('attribute_variant_maps')->where('product_id', $value->id)->where('variant_id', $val->id)->get();
                @endphp
                <li data-suggest_products="" data-id_products="{!! $value->id !!}" data-variant_id_products="{!! $val->id !!}" data-image_products="{!! $image !!}" data-price_products="{!! $price !!}" data-name_products="{!! $value->name !!}">
                    <div class="image">
                        <img src="{!! $image !!}" alt="">
                    </div>
                    <div class="info">
                        <p class="name">{!! $value->name??'' !!}</p>
                        @foreach($attribute_variant_maps as $v)
                        <p class="attribute">{!! $attributes[$v->attribute_id] ?? '' !!}: <strong>{!! $attribute_details[$v->attribute_detail_id] ?? '' !!}</strong></p>
                        @endforeach
                        <p class="attribute">Giá: <strong>{!! number_format($price??0) !!}</strong></p>
                    </div>
                </li>
            @endforeach
        @else
            <li data-suggest_products="" data-id_products="{!! $value->id !!}" data-variant_id_products="0" data-image_products="{!! $image !!}" data-price_products="{!! $price !!}" data-name_products="{!! $value->name !!}">
                <div class="image">
                    <img src="{!! $image !!}" alt="">
                </div>
                <div class="info">
                    <p class="name">{!! $value->name??'' !!}</p>
                    <p class="attribute">Giá: <strong>{!! number_format($price??0) !!}</strong></p>
                </div>
            </li>
        @endif
    @endforeach
@endif