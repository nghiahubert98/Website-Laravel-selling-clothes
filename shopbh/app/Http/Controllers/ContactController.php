<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ContactController extends Controller
{
    public function getList() {
    	$contact = DB::table('contacts')->orderBy('id','DESC')->get();
		return view('admin.contact.list',compact('contact'));
		
	}
	public function getEdit($id){
		return view('admin.bill.detail',compact('customerInfo','billInfo'));
	}
	public function postEdit(Request $request, $id)
    {

        return redirect()->route('admin.bill.list')->with(['flash_level'=>'success','flash_message'=>'Update Order Complete Success!']);
    }
    public function getDelete($id)
    {
        $bill = Order::find($id);
        $bill->delete();
        return redirect()->route('admin.bill.list')->with(['flash_level'=>'success','flash_message'=>'Delete Order Complete Success!']);
    }
}
