<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_size extends Model
{
    protected $table = 'product_sizes';
    protected $fillable = ['size', 'product_id'];
    //public $timestamps = false;

    public function product () {
    	return $this->belongTo('App\Product');
    }
}
