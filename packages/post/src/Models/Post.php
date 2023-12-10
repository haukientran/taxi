<?php

namespace Sudo\Post\Models;

use Sudo\Base\Models\BaseModel;

class Post extends BaseModel
{
	public function queryAdmin($show_data, $requests) {
		// Lọc theo danh mục
		if (isset($requests->category_id)) {
			$search_value = $requests->category_id;
			$show_data = $show_data->join('post_category_maps', 'post_category_maps.post_id', 'id')
									->where('post_category_maps.post_category_id', $search_value)
									->select('posts.*');
		}
        return $show_data;
    }
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
    public function getCateParent(){
        $category = $this->category();
        $list_cate = $category->getParentCase();
        $parents = $list_cate[0];
        return $parents;
    }
    public function scopeSearchByName($query, $key_word)
    {
        if (!empty($key_word)) {
            $key_word = str_replace(' ', '%', $key_word);
            $query->where('name', 'like', '%' . $key_word . '%');
        }
        return $query;
    }
    public function getTotalCommentByIdAttribute()
    {
        if(count($this->comments) <= 0)
        {
            return 0;
        }
        return count($this->comments->where('parent_id',0));
    }
    public function getAverageCommentAttribute()
    {
        $average = 0;
        if(count($this->comments) <= 0)
        {
            return 0;
        }
        if (!empty($this->comments->where('parent_id',0))) {
            foreach($this->comments->where('parent_id',0) as $comment) {
                $average += $comment->rank;
            }
        }
        return round($average/count($this->comments->where('parent_id',0)));
    }
    public function getListAverageCommentAttribute()
    {
        $average = 0;
        if(count($this->comments) <= 0)
        {
            return [];
        }
        $arr_star = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        ];
        if (!empty($this->comments->where('parent_id',0))) {
            foreach($this->comments->where('parent_id',0) as $comment) {
                if(isset($arr_star[$comment->rank])) {
                    $arr_star[$comment->rank] = $arr_star[$comment->rank] +1;
                }
            }
        }
        return $arr_star;
    }
}
