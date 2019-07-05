@extends('admin.master')
@section('content')
<style type="text/css">
    .img_current {
        width: 150px;
    }
    .img_detail{
        width: 200px;
        padding-bottom: 20px;
    }
    .icon_del{
        position: relative;
        top: -155px;
        left: -20px;
    }
    #insert {
        margin-top: 20px;
    }
    #insertSize {
        margin-top: 20px;
    }
</style>
<div class="col-lg-12">
    @include('admin.blocks.error')
    <h1 class="page-header">Product
        <small>Edit</small>
    </h1>
</div>
<!-- /.col-lg-12 -->
<form action="" method="POST" name="frmEditProduct" enctype="multipart/form-data">
<div class="col-lg-7" style="padding-bottom:120px">
    
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Category Parent</label>
            <select class="form-control" name="sltParent">
                <option value="">Please Choose Category</option>
                <?php cate_parent($cate,0,"--",$product["cate_id"]); ?>
            </select>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="txtName" placeholder="Please Enter Username" value="{!! old('txtName',isset($product) ? $product['name'] : null) !!}" />
        </div>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" name="txtPrice" placeholder="Please Enter Price" value="{!! old('txtPrice',isset($product) ? $product['price'] : null) !!}" />
        </div>
        <div class="form-group">
            <label>Price New</label>
            <input class="form-control" name="txtPriceNew" placeholder="Please Enter Price" value="{!! old('txtPriceNew',isset($product) ? $product['price_new'] : null) !!}" />
        </div>
        <div class="form-group">
            <label>Status</label>
            <label class="radio-inline">
            <input name="status" value="1" type="radio" {!! old('status',$product['status']=='1' ? 'checked' : '' )!!}>OverStock</label>
            <label class="radio-inline">
            <input name="status" value="0" type="radio" {!! old('status',$product['status']=='0' ? 'checked' : '' )!!}>Out of Stock</label>
        </div>
        <div class="form-group">
            <label>Intro</label>
            <textarea class="form-control" rows="3" name="txtIntro">{!! old('txtIntro',isset($product) ? $product['intro'] : null) !!}</textarea>
            <script type="text/javascript">CKEDITOR.replace("txtIntro")</script>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent',isset($product) ? $product['content'] : null) !!}</textarea>
            <script type="text/javascript">CKEDITOR.replace("txtContent")</script>
        </div>
        <div class="form-group">
            <label>Images Current</label>
            <img src="{!! asset('resources/upload/'.$product['image']) !!}" class="img_current" >
            <input type="hidden" name="img_current" value="{!! $product['image'] !!}">
        </div>
        <div class="form-group">
            <label>Images</label>
            <input type="file" name="fImages">
        </div>
        <div class="form-group">
            <label>Product Description</label>
            <textarea class="form-control" rows="3" name="txtDescription" >{!! old('txtDescription',isset($product) ? $product['description'] : null) !!}</textarea>
            <script type="text/javascript">CKEDITOR.replace("txtDescription")</script>
        </div>
        <button type="submit" class="btn btn-default">Product Edit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    
</div>
<div class="col-md-1"></div>
<div class="col-md-4">
    @foreach($product_image as $key => $item)
    <div class="form-group" id="{!! $key !!}">
        <img src="{!! asset('resources/upload/detail/'.$item['image']) !!}" class="img_detail" idImg="{!! $item['id'] !!}" id="{!! $key !!}">
        <a href="javascript:void(0)" id="del_image" type="button" class="btn btn-danger btn-circle icon_del"><i class="fa fa-times"></i></a>
    </div>
    
    @endforeach
    <button type="button" id="addImages" class="btn btn-danger">Add Images</button>
    <div id="insert"></div>
    
    <h3>Edit Size</h3>
    @foreach($product_size as $key => $item_size)
    <div class="form-group">Input Size
        <input type="text" name="SizeEditDetail[]" value="{!! old('SizeEditDetail',isset($item_size) ? $item_size['size'] : null) !!}">
        <input type="hidden" name="idSize[]" value="{!! $item_size['id'] !!}">
    </div>
    @endforeach
    <button type="button" id="addSizes" class="btn btn-danger">Add Sizes</button>
    <div id="insertSize"></div>
</div>

</form>
@endsection()