<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'alias', 'parent_id', 'description'];
    
    //mot cate co mot hoac nhieu product
    public function product () { 
    	return $this->hasMany('App\Product');
    }
}
