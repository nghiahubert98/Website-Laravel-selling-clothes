<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Hash;
use Auth;

class UserController extends Controller
{
    public function getList(){
    	$user = User::all();
    	return view('admin.user.list',compact('user'));
    }
    public function getAdd(){
    	return view('admin.user.add');
    }
    public function postAdd(UserRequest $request){
    	$user = new User();
    	$user->username = $request->txtUser;
    	$user->fullname = $request->txtFName;
    	$user->email = $request->txtEmail;
    	$user->password = Hash::make($request->txtPass);
    	$user->gender = $request->rdoGender;
    	$user->address = $request->txtAddress;
    	$user->phone = $request->txtPhone;
    	$user->level = $request->rdoLevel;
    	$user->status = "Offline";
    	$user->remember_token = $request->_token;
    	$user->save();
    	return redirect()->route('admin.user.list')->with(['flash_level'=>'success','flash_message'=>'Add User Complete Success!']);
    }
    public function getDelete($id){
    	$user_current_login = Auth::user()->id;
    	$user = User::find($id);
    	if (($id == 1) || ($user_current_login != 1 && $user["level"] == 1)) {
    		return redirect()->route('admin.user.list')->with(['flash_level'=>'danger','flash_message'=>'Access Denied!']);
    	}else{
    		$user->delete($id);
    		return redirect()->route('admin.user.list')->with(['flash_level'=>'success','flash_message'=>'Delete User Complete Success!']);
    	}
    }
    public function getEdit($id){
    	$user_edit = User::find($id);
    	if ((Auth::user()->id != 0) && ($id == 0 || ($user_edit['level'] == 1 && (Auth::user()->id != $id)))) {
    		return redirect()->route('admin.user.list')->with(['flash_level'=>'danger','flash_message'=>'Access Denied!']);
    	}
    	return view('admin.user.edit',compact('user_edit','id'));
    }
    public function postEdit($id,Request $request){
    	$user = User::find($id);
    	if($request->input('txtPass')){
    		$this->validate($request,
    			[
    				'txtRePass' => 'required|same:txtPass'
    			],
    			[
    				'txtRePass.required' => 'Please Enter RePassword',
            		'txtRePass.same'    => 'Two Password Don\'t Match'
    			]
    		);
    		$pass = $request->input('txtPass');
    		$user->password = Hash::make($pass);
    	}
    	$user->fullname = $request->txtFName;
    	$user->email = $request->txtEmail;
    	$user->gender = $request->rdoGender;
    	$user->address = $request->txtAddress;
    	$user->phone = $request->txtPhone;
    	if($request->input('rdoLevel')){
    		$user->level = $request->rdoLevel;
  		}
    	$user->save();
    	return redirect()->route('admin.user.list')->with(['flash_level'=>'success','flash_message'=>'Edit User Complete Success!']);
    }
}
