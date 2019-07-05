<?php

namespace App\Http\Controllers;

use App\Http\Requests\CateRequest;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;

class CateController extends Controller
{
	public function getList() {
		$data = Category::select('id','name','parent_id')->orderBy('id')->get()->toArray();
		return view('admin.cate.list',compact('data'));
	}

    public function getAdd() {
    	$parent = Category::select('id','name','parent_id')->get()->toArray();
    	return view('admin.cate.add',compact('parent'));
    }

    public function postAdd(CateRequest $request) {
    	$cate = new Category();
    	$cate->name = $request->txtCateName;
    	$cate->alias = changeTitle($request->txtCateName);
    	//$cate->order = $request->txtOrder;
    	$cate->parent_id = $request->sltParent;
    	$cate->description = $request->txtDescription;
    	$cate->save();
    	return redirect()->route('admin.cate.list')->with(['flash_level'=>'success','flash_message'=>'Add Category Complete Success!']);
    }

    public function getDelete($id) {
    	$parent = Category::where('parent_id',$id)->count();
    	if ($parent == 0) {
    		$cate = Category::find($id);
	    	$cate->delete($id);
	    	return redirect()->route('admin.cate.list')->with(['flash_level'=>'success','flash_message'=>'Delete Category Complete Success!']);
    	} else {
    		echo "<script type='text/javascript'>
    			alert('This Category Can Not Delete!');
    			window.location = '";
    				echo route('admin.cate.list');
    		echo "';
    		</script>";
    	}

    }

    public function getEdit($id) {
    	$data = Category::findOrFail($id)->toArray();
    	$parent = Category::select('id','name','parent_id')->get()->toArray();
    	return view('admin.cate.edit',compact('parent','data','id'));
    }  
    
    public function postEdit(Request $request,$id) {
    	$this->validate($request,
    		["txtCateName"=>"required"],
    		["txtCateName.required"=>"Please Enter Category Name!"]
    	);
    	$cate = Category::find($id);
    	$cate->name = $request->txtCateName;
    	$cate->alias = changeTitle($request->txtCateName);
    	//$cate->order = $request->txtOrder;
    	$cate->parent_id = $request->sltParent;
    	$cate->description = $request->txtDescription;
    	$cate->save();
    	return redirect()->route('admin.cate.list')->with(['flash_level'=>'success','flash_message'=>'Edit Category Complete Success!']);
    }
}