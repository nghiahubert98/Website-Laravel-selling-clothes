@extends('admin.master')
@section('content')
<style type="text/css">
    #insertSize {
        margin-top: 20px;
    }
</style>
<div class="col-lg-12">
    @include('admin.blocks.error')
    <h1 class="page-header">Product
        <small>Add</small>
    </h1>
</div>
<!-- /.col-lg-12 -->
<form action="{!! url('/admin/product/add') !!}" method="POST" enctype="multipart/form-data">
    <div class="col-lg-7" style="padding-bottom:120px">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="form-group">
            <label>Category Parent</label>
            <select class="form-control" name="sltParent">
                <option value="">Please Choose Category</option>
                <?php cate_parent($cate,0,"--",old('sltParent')); ?>
            </select>
        </div>
        <div class="form-group">
            <label>Name</label>
            <input class="form-control" name="txtName" placeholder="Please Enter Product Name" value="{!! old('txtName') !!}" />
        </div>
        <div class="form-group">
            <label>Price</label>
            <input class="form-control" name="txtPrice" placeholder="Please Enter Product Price" value="{!! old('txtPrice') !!}" />
        </div>
        <div class="form-group">
            <label>Intro</label>
            <textarea class="form-control" rows="3" name="txtIntro">{!! old('txtIntro') !!}</textarea>
            <script type="text/javascript">CKEDITOR.replace("txtIntro")</script>
        </div>
        <div class="form-group">
            <label>Content</label>
            <textarea class="form-control" rows="3" name="txtContent">{!! old('txtContent') !!}</textarea>
            <script type="text/javascript">CKEDITOR.replace("txtContent")</script>
        </div>
        <div class="form-group">
            <label>Images</label>
            <input type="file" name="fImages" value="{!! old('fImages') !!}">
        </div>
        <div class="form-group">
            <label>Product Description</label>
            <textarea class="form-control" rows="3" name="txtDescription" placeholder="Please Enter Product Description">{!! old('txtDescription') !!}</textarea>
            <script type="text/javascript">CKEDITOR.replace("txtDescription")</script>
        </div>
        <button type="submit" class="btn btn-default">Product Add</button>
        <button type="reset" class="btn btn-default">Reset</button>
    </div>
        <div class="col-md-1"></div>
        <div class="col-md-4">
            @for($i = 1; $i <= 5 ; $i++)
            <div class="form-group">
                <label>Product Image Detail {!! $i !!}</label>
                <input type="file" name="fProductDetail[]"/>
            </div>
            @endfor

            <button type="button" id="addSizes" class="btn btn-danger">Add Sizes</button>
            <div id="insertSize"></div>
        </div>
</form>

@endsection()