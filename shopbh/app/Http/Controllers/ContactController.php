<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;
use App\Contact;
use DB;

class ContactController extends Controller
{
    public function getList() {
    	$contact = DB::table('contacts')->orderBy('id','DESC')->get();
		return view('admin.contact.list',compact('contact'));
		
	}
    public function getDelete($id)
    {
        $bill = Contact::find($id);
        $bill->delete($id);
        return redirect()->route('admin.contact.list')->with(['flash_level'=>'success','flash_message'=>'Delete Order Complete Success!']);
    }
}
