<?php

namespace Sudo\Ecommerce\Models;

use Sudo\Base\Models\BaseModel;

class Product extends BaseModel
{
	public function queryAdmin($show_data, $requests) {
		// Lọc theo danh mục
		if (isset($requests->category_id)) {
			$search_value = $requests->category_id;
			$show_data = $show_data->join('product_category_maps', 'product_category_maps.product_id', 'id')
									->where('product_category_maps.product_category_id', $search_value)
									->select('products.*');
		}
        return $show_data;
    }
}
