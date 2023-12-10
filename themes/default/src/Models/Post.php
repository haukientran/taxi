<?php

namespace Sudo\Theme\Models;

class Post extends BaseModel
{

    public function getUrl($device='app')
    {
        return route($device.'.posts.show', $this->slug);
    }
    public function adminUser() {
        return $this->belongsTo('Sudo\AdminUser\Models\AdminUser','admin_user_id','id');
    }
    public function postCategoryMap()
    {

        return $this->hasOne('Sudo\Post\Models\PostCategoryMap', 'post_id', 'id');
    }
    public function category(){
        $cate = PostCategory::query()
            ->join('post_category_maps', 'post_category_maps.post_category_id', 'post_categories.id')
            ->where('post_categories.status', 1)
            ->where('post_id', $this->id)->first();
        return $cate;
    }
}
