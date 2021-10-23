<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = 'oc_manufacturer';
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
