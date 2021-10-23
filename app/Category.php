<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'oc_category';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function description()
    {
        return $this->hasOne(CategoryDescription::class, 'category_id', 'category_id')->where('language_id',session('lang_cat'));
    }

}
