<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    protected $table = 'oc_purpletree_vendor_products';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id','seller_id');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'seller_id', 'seller_id');
    }
}
