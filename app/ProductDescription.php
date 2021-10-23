<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{



    protected $table = 'oc_product_description';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
