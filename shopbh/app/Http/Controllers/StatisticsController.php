<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Order;
use App\Order_detail;
use App\Product;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function getList() {
        $Current = Carbon::now();
        $yearCurrent =  $Current->year;
        $monthCurrent =  $Current->month;
        $dayCurrent =  $Current->day;

        $total_income_day = DB::table('orders')->where(DB::raw('Day(date_order)'), '=', $dayCurrent)->sum('total');
        $total_income_month = DB::table('orders')->where(DB::raw('Month(date_order)'), '=', $monthCurrent)->sum('total');
        $total_income_year = DB::table('orders')->where(DB::raw('Year(date_order)'), '=', $yearCurrent)->sum('total');
        $ordersInDay = DB::table('orders')
                        ->join('users', 'users.id', '=', 'orders.user_id')
                        ->select('orders.*', 'users.fullname as fullname', 'users.email as email', 'users.address as address', 'users.phone as phone')
                        ->where(DB::raw('Day(date_order)'), '=', $dayCurrent)->get();  
        $ordersInMonth = DB::table('orders')
                        ->join('users', 'users.id', '=', 'orders.user_id')
                        ->select('orders.*', 'users.fullname as fullname', 'users.email as email', 'users.address as address', 'users.phone as phone', DB::raw('month(date_order)'))
                        ->where(DB::raw('month(date_order)'), '=', $monthCurrent)->get();  
        $ordersInYear = DB::table('orders')
                        ->join('users', 'users.id', '=', 'orders.user_id')
                        ->select('orders.*', 'users.fullname as fullname', 'users.email as email', 'users.address as address', 'users.phone as phone', DB::raw('year(date_order)'))
                        ->where(DB::raw('year(date_order)'), '=', $yearCurrent)->get();      

        $product_bestseller_day = DB::table('order_details')
                                ->join('products', 'products.id', '=', 'order_details.product_id')
                                ->join('orders', 'orders.id', '=', 'order_details.order_id')
                                ->join('categories', 'categories.id', '=', 'products.cate_id')
                                ->select('product_id', 'products.name as name_product', 'categories.name as name_cate', DB::raw('count(product_id) as count_seller'), DB::raw('count(categories.id) as count_cate_seller'))
                                ->where(DB::raw('day(date_order)'), '=', $dayCurrent)
                                ->groupBy('product_id','products.name','categories.name')
                                ->orderBy('count_seller', 'DESC')
                                ->get();  
        $product_bestseller_month = DB::table('order_details')
                                ->join('products', 'products.id', '=', 'order_details.product_id')
                                ->join('orders', 'orders.id', '=', 'order_details.order_id')
                                ->join('categories', 'categories.id', '=', 'products.cate_id')
                                ->select('product_id', 'products.name as name_product', 'categories.name as name_cate', DB::raw('count(product_id) as count_seller'), DB::raw('count(categories.id) as count_cate_seller'))
                                ->where(DB::raw('month(date_order)'), '=', $monthCurrent)
                                ->groupBy('product_id','products.name','categories.name')
                                ->orderBy('count_seller', 'DESC')
                                ->get();  
        $product_bestseller_year = DB::table('order_details')
                                ->join('products', 'products.id', '=', 'order_details.product_id')
                                ->join('orders', 'orders.id', '=', 'order_details.order_id')
                                ->join('categories', 'categories.id', '=', 'products.cate_id')
                                ->select('product_id', 'products.name as name_product', 'categories.name as name_cate', DB::raw('count(product_id) as count_seller'), DB::raw('count(categories.id) as count_cate_seller'))
                                ->where(DB::raw('year(date_order)'), '=', $yearCurrent)
                                ->groupBy('product_id','products.name','categories.name')
                                ->orderBy('count_seller', 'DESC')
                                ->get();  

		return view('admin.statistics.list',compact('ordersInDay','ordersInMonth','ordersInYear','total_income_day','total_income_month','total_income_year','product_bestseller_day','product_bestseller_month','product_bestseller_year'));
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
}
