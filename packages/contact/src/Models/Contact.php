<?php

namespace Sudo\Contact\Models;

use Sudo\Base\Models\BaseModel;

class Contact extends BaseModel {
	protected $fillable = ['name', 'phone', 'email', 'destination', 'departure', 'service_contact', 'type_contact', 'note', 'status'];
}