<?php

namespace Sudo\Ecommerce\Models;

use Sudo\Base\Models\BaseModel;

class OrderDetail extends BaseModel {
	public static function add($data) {
		$data = json_decode(json_encode(removeScriptArray($data)));
		OrderDetail::insert([
			'order_id' 		=> $data->order_id,
			'product_id' 	=> $data->product_id,
			'price' 		=> $data->price,
			'quantity' 		=> $data->quantity,
			'variant_id' 	=> $data->variant_id,
			'variant_text' 	=> $data->variant_text,
		]);
	}
}