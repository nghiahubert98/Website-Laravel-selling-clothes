@extends('user.master')
@section('content')
@section('description','Shop Fashion ST')

  <!-- Slider Start-->
  @include('user.blocks.slider')
  <!-- Slider End-->
  
  <!-- Section Start-->
  @include('user.blocks.otherdetail')
  <!-- Section End-->

<!--  Best Seller -->  
<section id="featured" class="row mt40">
  <div class="container">
    <h1 class="heading1"><span class="maintext">Sản phẩm bán chạy nhất</span><span class="subtext"> Xem những sản phẩm bán chạy nhất của chúng tôi</span></h1>
    <ul class="thumbnails">
      @foreach($product_bestseller as $item_product_bsl)
      <?php
                $bsl = DB::table('products')->join('categories', 'categories.id', '=', 'products.cate_id')
                            ->select('products.*', 'categories.id as cate_id', 'categories.name as cate_name')
                            ->where('products.id',$item_product_bsl->product_id)
                            ->first();
      ?>
      <li class="col-lg-3  col-sm-6">
        <div style="height:50px">
          <a class="productname" href="{!! url('product-detail',[ $bsl->id,$bsl->alias]) !!}">{!!  $bsl->name !!}</a>
        </div>
        <div class="thumbnail">
          @if($bsl->price_new != 0)
          <span class="sale tooltip-test">Sale</span>
          @endif
          
          <a href="{!! url('product-detail',[ $bsl->id, $bsl->alias]) !!}"><img width="260" height="355" alt="" src="{!! asset('resources/upload/'. $bsl->image) !!}"></a>
          
<!--           <div class="shortlinks">
            <a class="details" href="#">DETAILS</a>
            <a class="wishlist" href="#">WISHLIST</a>
            <a class="compare" href="#">COMPARE</a>
          </div> -->
          <div class="pricetag">
            @if($bsl->status == 0)
              <span class="spiral"></span><a href="{!! url('product-detail',[ $bsl->id, $bsl->alias]) !!}" class="productcart">ADD TO CART</a>
            @else
              <span class="spiral"></span><a href="{!! url('add-to-cart',[ $bsl->id, $bsl->alias]) !!}" class="productcart">ADD TO CART</a>
            @endif
            <div class="price">
              @if($bsl->price_new == 0)
                <div class="pricenew">{!!  $bsl->price !!}đ</div>
              @else
                <div class="pricenew">{!!  $bsl->price_new !!}đ</div>
                <div class="priceold">{!!  $bsl->price !!}đ</div>
              @endif
            </div>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
  </div>
</section>

<!-- Latest Product-->
<section id="latest" class="row">
  <div class="container">
    <h1 class="heading1"><span class="maintext">Sản phẩm mới nhất</span><span class="subtext"> Xem những sản phẩm mới nhất của chúng tôi</span></h1>
    <ul class="thumbnails">
      @foreach($product_related as $item)
      <li class="col-lg-3 col-sm-6">
      <div style="height:50px">
        <a class="productname" href="{!! url('product-detail',[$item->id,$item->alias]) !!}">{!! $item->name !!}</a>
      </div>
        <div class="thumbnail">
          @if($item->price_new != 0)
          <span class="sale tooltip-test">Sale</span>
          @endif
          <a href="{!! url('product-detail',[$item->id,$item->alias]) !!}"><img width="260" height="355" alt="" src="{!! asset('resources/upload/'.$item->image) !!}"></a>
<!--           <div class="shortlinks">
            <a class="details" href="#">DETAILS</a>
            <a class="wishlist" href="#">WISHLIST</a>
            <a class="compare" href="#">COMPARE</a>
          </div> -->
          <div class="pricetag">
            @if($item->status == 0)
              <span class="spiral"></span><a href="{!! url('product-detail',[$item->id,$item->alias]) !!}" class="productcart">ADD TO CART</a>
            @else
              <span class="spiral"></span><a href="{!! url('add-to-cart',[$item->id,$item->alias]) !!}" class="productcart">ADD TO CART</a>
            @endif
            <div class="price">
              @if($item->price_new == 0)
                <div class="pricenew">{!! $item->price !!}đ</div>
              @else
                <div class="pricenew">{!! $item->price_new !!}đ</div>
                <div class="priceold">{!! $item->price !!}đ</div>
              @endif
            </div>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
  </div>
</section>
@endsection