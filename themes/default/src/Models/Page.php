<?php

namespace Sudo\Theme\Models;

class Page extends BaseModel
{

    public function getUrl($device ='app') {
        return route($device.'.pages.show', $this->slug);
    }

}
