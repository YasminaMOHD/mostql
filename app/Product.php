<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $language=0;
    public function __construct($language_id = 1)
    {
        $this->language=$language_id;
    }

    protected $table = 'oc_product';

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id', 'manufacturer_id');
    }


    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'oc_product_to_category',
            'product_id',
            'category_id',
            'product_id',
            'category_id',
        )->with('description');
    }

    // public function stores()
    // {
    //     return $this->belongsToMany(
    //         Store::class,
    //         'oc_product_to_store',
    //         'store_id',
    //         'product_id',
    //         'id',
    //         'product_id',
    //     );
    // }

    public function stores()
    {
        return $this->belongsToMany(
            Store::class,
            'oc_product_to_store',
            'product_id',
            'store_id',
            'product_id',
            'id'
        );
    }

    public function description()
    {
        // dd($this->language);
        return $this->hasOne(ProductDescription::class, 'product_id', 'product_id')->where('language_id',session('language'));
    }

    public function storeProduct()
    {
        return $this->hasOneThrough(Store::class,StoreProduct::class,'product_id','seller_id','product_id','seller_id','id');
    }
}
