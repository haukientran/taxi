<?php

namespace Sudo\Ecommerce\Models;

use Sudo\Base\Models\BaseModel;

class FilterDetail extends BaseModel {

    public function productFilter() {
    	return $this->hasMany('Sudo\Ecommerce\Models\ProductFilter', 'filter_id', 'id');
    }	
}