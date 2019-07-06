@extends('user.master')
@section('content')
@section('description','Shop Fashion ST')


  <section id="product">
    <div class="container">
      <!-- Product Details-->
      <div class="row">
       <!-- Left Image-->
        <div class="col-lg-5">
          <ul class="thumbnails mainimage">
            <li>
              <a  rel="position: 'inside' , showTitle: false, adjustX:-4, adjustY:-4" class="thumbnail cloud-zoom" href="{!! asset('resources/upload/'.$product_detail->image) !!}">
                <img src="{!! asset('resources/upload/'.$product_detail->image)  !!}" alt="" title="">
              </a>
            </li>
            @foreach($image as $item_image)
            <li>
              <a  rel="position: 'inside' , showTitle: false, adjustX:-4, adjustY:-4" class="thumbnail cloud-zoom" href="{!! asset('resources/upload/detail/'.$item_image->image) !!}">
                <img src="{!! asset('resources/upload/detail/'.$item_image->image)  !!}" alt="" title="">
              </a>
            </li>
            @endforeach
          </ul>
          <span>Di chuyển chuột tới để phóng to</span>

          <ul class="thumbnails mainimage">
            <li class="producthtumb">
              <a class="thumbnail" >
                <img  src="{!! asset('resources/upload/'.$product_detail->image) !!}" alt="" title="">
              </a>
            </li>
            @foreach($image as $item_image)
            <li class="producthtumb">
              <a class="thumbnail" >
                <img  src="{!! asset('resources/upload/detail/'.$item_image->image) !!}" alt="" title="">
              </a>
            </li>
            @endforeach
          </ul>
        </div>
         <!-- Right Details-->
        <div class="col-lg-7">
          <div class="row">
            <form class="form-vertical" role="form" action="{!! route('cart') !!}" method="POST">
              <input type="hidden" name="_token" value="{!! csrf_token() !!}">
              <input type="hidden" name="product_id" value="{!! $product_detail->id !!}">
            <div class="col-lg-12">
              <h1 class="productname"><span class="bgnone">{!! $product_detail->name !!}</span></h1>
              <div class="productprice">
                <div class="productpageprice">
                @if($product_detail->price_new == 0)
                  <span class="spiral"></span>{!! $product_detail->price !!}đ</div>
                @else
                  <span class="spiral"></span>{!! $product_detail->price_new !!}đ</div>
                <div class="productpageoldprice">Giá cũ : {!! $product_detail->price !!}đ</div>
                @endif
                <ul class="rate">
                  <li class="on"></li>
                  <li class="on"></li>
                  <li class="on"></li>
                  <li class="off"></li>
                  <li class="off"></li>
                </ul>
              </div>
              <div class="quantitybox">
                <div class="col-sm-6">
                  <legend>Kích thước</legend>
                    <select class="selectsize" name="size">
                      @foreach($size as $size)
                      <option value="{!! $size->size !!}">{!! $size->size !!}</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                  <legend>Số lượng</legend>
                    <div class="col-lg-5">
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" >
                    </div>

                </div>
                @include('admin.blocks.error')
                <div class="clear"></div>
<!--                 <div class="control-group">
                  <div class="controls">
                    <label class="checkbox">
                      <input type="checkbox" name="optionsCheckboxList2" value="option2">
                      Option two can also be checked and included in form results </label>
                    <label class="checkbox">
                      <input type="checkbox" name="optionsCheckboxList3" value="option3">
                      Option three can&mdash;yes, you guessed it&mdash;also be checked and included in form results </label>
                    <label class="radio">
                      <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                      Option one is this and that—be sure to include why it's great </label>
                    <label class="radio">
                      <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                      Option two can be something else and selecting it will deselect option one </label>
                  </div>
                </div> -->
              </div>

              @if($product_detail->status == 0)
                <button disabled type="submit" class="btn btn-orange" style="font-size: 20px"><span class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ hàng</button>
              @else
              <button type="submit" class="btn btn-orange" style="font-size: 20px"><span class="glyphicon glyphicon-shopping-cart"></span> Thêm vào giỏ hàng</button>
              @endif

            </form>

         <!-- Product Description tab & comments-->
         <div class="productdesc">
                <ul class="nav nav-tabs" id="myTab">
                  <li class="active"><a href="#detail">Chi tiết sản phẩm</a>
                  <li><a href="#description">Miêu tả sản phẩm</a>
                  </li>
                  <!-- <li><a href="#specification">Specification</a>
                  </li> -->
                  <li><a href="#producttag">Tags</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="detail">
                    {!! $product_detail->content !!}
                  </div>
                  <div class="tab-pane" id="description">

                    {!! $product_detail->description !!}

                  </div>

                  <!-- <div class="tab-pane " id="specification">
                  </div> -->

                  <div class="tab-pane" id="producttag">
                    <ul class="tags">
                      <li><a href="#"><i class="icon-tag"></i> Thời trang nữ</a>
                      </li>
                      <li><a href="#"><i class="icon-tag"></i> Đầm</a>
                      </li>
                      <li><a href="#"><i class="icon-tag"></i> Đầm ren</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--  Related Products-->
  <section id="related" class="row">
    <div class="container">
      <h1 class="heading1"><span class="maintext">Sản phẩm liên quan</span><span class="subtext"> Xem các sản phẩm liên quan</span></h1>
      <ul class="thumbnails">
        @foreach($product_related as $item_related)
        <li class="col-lg-3 col-sm-3">
          <a class="prdocutname" href="{!! url('product-detail',[$item_related->id,$item_related->alias]) !!}">{!! $item_related->name !!}</a>
          <div class="thumbnail">
            <span class="sale tooltip-test">Sale</span>
            <a href="{!! url('product-detail',[$item_related->id,$item_related->alias]) !!}"><img alt="" src="{!! asset('resources/upload/'.$item_related->image) !!}"></a>
<!--             <div class="shortlinks">
              <a class="details" href="#">DETAILS</a>
              <a class="wishlist" href="#">WISHLIST</a>
              <a class="compare" href="#">COMPARE</a>
            </div> -->
            <div class="pricetag">
              @if($item_related->status == 0)
                          <span class="spiral"></span><a href="{!! url('product-detail',[$item_related->id,$item_related->alias]) !!}" class="productcart">Thêm</a>
                        @else
                          <span class="spiral"></span><a href="{!! url('add-to-cart',[$item_related->id,$item_related->alias]) !!}" class="productcart">Thêm</a>
              @endif
              <div class="price">
                          @if($item_related->price_new == 0)
                            <div class="pricenew">{!! $item_related->price !!}đ</div>
                          @else
                            <div class="pricenew">{!! $item_related->price_new !!}đ</div>
                            <div class="priceold">{!! $item_related->price !!}đ</div>
                          @endif
              </div>
            </div>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
  </section>
  <!-- Popular Brands-->
  <section id="popularbrands" class="container">
    <h1 class="heading1"><span class="maintext">Nhãn hiệu phổ biến</span><span class="subtext"> Xem các nhãn hiệu phổ biến</span></h1>
    <div class="brandcarousalrelative">
      <ul id="brandcarousal">
        <li><img src="{!! url('user/img/brand1.jpg') !!}" alt="" title=""/></li>
        <li><img src="{!! url('user/img/brand2.jpg') !!}" alt="" title=""/></li>
        <li><img src="{!! url('user/img/brand3.jpg') !!}" alt="" title=""/></li>
        <li><img src="{!! url('user/img/brand4.jpg') !!}" alt="" title=""/></li>
        <li><img src="{!! url('user/img/brand1.jpg') !!}" alt="" title=""/></li>
        <li><img src="{!! url('user/img/brand2.jpg') !!}" alt="" title=""/></li>
        <li><img src="{!! url('user/img/brand3.jpg') !!}" alt="" title=""/></li>
        <li><img src="{!! url('user/img/brand4.jpg') !!}" alt="" title=""/></li>
        <li><img src="{!! url('user/img/brand1.jpg') !!}" alt="" title=""/></li>
        <li><img src="{!! url('user/img/brand2.jpg') !!}" alt="" title=""/></li>
        <li><img src="{!! url('user/img/brand3.jpg') !!}" alt="" title=""/></li>
        <li><img src="{!! url('user/img/brand4.jpg') !!}" alt="" title=""/></li>
      </ul>
      <div class="clearfix"></div>
      <a id="prev" class="prev" href="#">&lt;</a>
      <a id="next" class="next" href="#">&gt;</a>
    </div>
  </section>

@endsection
