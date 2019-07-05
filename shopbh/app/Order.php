<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['date_order', 'total', 'payment', 'status', 'note', 'customer_id'];

    //mot bill chi thuoc ve 1 customer
    public function customer () {
    	return $this->belongTo('App\User');
    }
    //mot bill co 1 hoac nhieu bill_detail
    public function order_detail () { 
    	return $this->hasMany('App\Order_detail');
    }
}
