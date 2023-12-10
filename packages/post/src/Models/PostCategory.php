<?php

namespace Sudo\Post\Models;

use Sudo\Base\Models\BaseModel;

class PostCategory extends BaseModel
{
    public function parents() {
        $table_name = self::getTable();
        return $this->hasMany(self::class, 'parent_id');
    }

    public function childrenParents() {
        $table_name = self::getTable();
        return $this->hasMany(self::class, 'parent_id')
                    ->with('childrenParents')
                    ->join('language_metas', 'language_metas.lang_table_id', $table_name.'.id')
                    ->where('lang_table', self::getTable());
    }
    public function childId($id)
    {
        $child = \Cache::remember('postCat_childId_'.$id, 1800, function() use ($id){
            $categories = self::where('id', $id)->where('status',1)->first();
            $child = array();
            array_push($child, $id);
            $child = $this->getAllChildId($categories, $child);
            return $child;
        });
        return $child;
    }
    public function childrenCates()
    {
        return $this->hasMany('Sudo\Post\Models\PostCategory', 'parent_id', 'id');
    }
    public function allChildrenCates()
    {
        return $this->childrenCates()->with('allChildrenCates');
    }
    public function getAllChildId($cate, $child = [])
    {
        $categories = $cate->allChildrenCates->where('status', 1);
        if(count($categories)>0){
            $child = array_merge($child, $categories->pluck('id', 'id')->toArray());
            foreach ($categories as $key => $value) {
                $child = $this->getAllChildId($value, $child);
            }
            return $child;
        }else{
            return $child;
        }
    }
    public function getParent() {
        if ($this->parent_id == 0) return null;
        if(\Cache::has('post_parent_cate_'.$this->parent_id)) {
            return \Cache::get('post_parent_cate_'.$this->parent_id);
        }
        $dt = self::where('id',$this->parent_id)->first();
        \Cache::forever('post_parent_cate_'.$this->parent_id, $dt);
        return $dt;
    }
    public function getParentCase() {
        $case = [];
        array_unshift($case,$this);
        $parent_category = $this->getParent();
        while($parent_category) {
            array_unshift($case,$parent_category);
            $parent_category = $parent_category->getParent();
        }
        return $case;
    }
    public function categoryMap() {
        return $this->hasMany('Sudo\Post\Models\PostCategoryMap','post_category_id', 'id');
    }
    public function getUrl($device='app')
    {
        return route($device.'.post_categories.index', $this->slug);
    }
}
