<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'oc_purpletree_vendor_stores';
    // public function storeProducts()
    // {
    //     return $this->hasMany(StoreProduct::class, 'store_id', 'seller_id');
    // }

    public function products()
    {
        return $this->belongsToMany(Product::class,  'id', 'seller_id');
    }
    public function storeP()
    {
        return $this->hasOne(StoreProduct::class, 'seller_id', 'seller_id');
    }
}
