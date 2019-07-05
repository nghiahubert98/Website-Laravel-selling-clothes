<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Order;
use App\Order_detail;
use App\Product;
class BillController extends Controller
{
    public function getList() {
    	$customer = DB::table('orders')
                        ->join('users', 'users.id', '=', 'orders.user_id')
                        ->select('orders.*', 'users.fullname as fullname', 'users.email as email', 'users.address as address', 'users.phone as phone')
                        ->orderBy('orders.id','desc')
                        ->get();
                      
		return view('admin.bill.list',compact('customer'));
		
	}
	public function getEdit($id){
		$customerInfo = DB::table('orders')
                        ->join('users', 'users.id', '=', 'orders.user_id')
                        ->select('orders.*', 'users.fullname as fullname', 'users.email as email', 'users.address as address', 'users.phone as phone')
                        ->orderBy('orders.id','desc')
                        ->where('orders.id', '=', $id)
                        ->first();
        $billInfo = DB::table('orders')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->leftjoin('products', 'order_details.product_id', '=', 'products.id')
                    ->where('orders.id', '=', $id)
                    ->select('orders.*', 'order_details.*', 'products.name as product_name')
                    ->get();
		return view('admin.bill.detail',compact('customerInfo','billInfo'));
	}
	public function postEdit(Request $request, $id)
    {
        $bill = Order::find($id);
        $bill->status = $request->input('status');
        $bill->save();
        return redirect()->route('admin.bill.list')->with(['flash_level'=>'success','flash_message'=>'Update Order Complete Success!']);
    }
    public function getDelete($id)
    {
        $bill = Order::find($id);
        $bill->delete();
        return redirect()->route('admin.bill.list')->with(['flash_level'=>'success','flash_message'=>'Delete Order Complete Success!']);
    }
}
