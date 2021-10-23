<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryDescription extends Model
{
    protected $table = 'oc_category_description';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->where('language_id',1);
    }
}
