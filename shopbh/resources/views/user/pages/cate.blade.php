@extends('user.master')
@section('content')
@section('description','Shop Fashion ST')



<section id="product">
  <div class="container">
   <!--  breadcrumb -->  
    <ul class="breadcrumb">
      <li>
        <a href="#">Trang chủ</a>
        <span class="divider">/</span>
      </li>
       <a href="#">Loại sản phẩm</a>
      <span class="divider">/</span>
      <a href="#">{!! $alias !!}</a>
    </ul>
    <div class="row">        
      <!-- Sidebar Start-->
      <aside class="col-lg-3">
       <!--  Best Seller -->  
        <div class="sidewidt">
          <h2 class="heading2"><span>Sản phẩm bán chạy nhất</span></h2>
          <ul class="bestseller">
            @foreach($product_bestseller as $item_product_bsl)
            <?php
                $bsl = DB::table('products')->join('categories', 'categories.id', '=', 'products.cate_id')
                            ->select('products.*', 'categories.id as cate_id', 'categories.name as cate_name')
                            ->where('products.id',$item_product_bsl->product_id)
                            ->first();
            ?>
            <li>
              <img width="50" height="50" src="{!! asset('resources/upload/'.$bsl->image) !!}" alt="product" title="product">
              <a class="productname" href="{!! url('product-detail',[$bsl->id,$bsl->alias]) !!}"> {!! $bsl->name !!}</a>
              <span class="procategory"> {!! $bsl->cate_name !!}</span>
              <span class="price">
                @if($bsl->price_new == 0)
                  {!! $bsl->price !!}đ
                @else
                  {!! $bsl->price_new !!}đ
                @endif
              </span>
            </li>
            @endforeach
          </ul>
        </div>
        <!-- Latest Product -->  
        <div class="sidewidt">
          <h2 class="heading2"><span>Sản phẩm mới nhất</span></h2>
          <ul class="bestseller">
            @foreach($product_related as $item_product_related)
            <li>
              <img width="50" height="50" src="{!! asset('resources/upload/'.$item_product_related->image) !!}" alt="product" title="product">
              <a class="productname" href="{!! url('product-detail',[$item_product_related->id,$item_product_related->alias]) !!}">{!! $item_product_related->name !!}</a>
              <span class="procategory">{!! $item_product_related->cate_name !!}</span>
              <span class="price">
                @if($item_product_related->price_new == 0)
                  {!! $item_product_related->price !!}đ
                @else
                  {!! $item_product_related->price_new !!}đ
                @endif
              </span>
            </li>
            @endforeach
          </ul>
        </div>

      </aside>
      <!-- Sidebar End-->
      <!-- Category-->
      <div class="col-lg-9">          
        <!-- Category Products-->
        <section id="category">
          <!-- Sorting-->
              <div class="sorting well">
                <div class="btn-group pull-right">
                  <button class="btn" id="list"><i class="icon-th-list"></i>
                  </button>
                  <button class="btn btn-orange" id="grid"><i class="icon-th icon-white"></i></button>
                </div>
              </div>
             <!-- Category-->
              <section id="categorygrid">
                <ul class="thumbnails grid">
                  @foreach($product_cate as $item_product_cate)
                  <li class="col-lg-4 col-sm-6">
                    <div style="height:50px">
                    <a class="prdocutname" href="{!! url('product-detail',[$item_product_cate->id,$item_product_cate->alias]) !!}">{!! $item_product_cate->name !!}</a>
                    </div>
                    <div class="thumbnail">
                      @if($item_product_cate->price_new != 0)
                      <span class="sale tooltip-test">Sale</span>
                      @endif
                      <a href="{!! url('product-detail',[$item_product_cate->id,$item_product_cate->alias]) !!}"><img width="260" height="355" alt="" src="{!! asset('resources/upload/'.$item_product_cate->image) !!}"></a>
<!--                       <div class="shortlinks">
                        <a class="details" href="#">DETAILS</a>
                        <a class="wishlist" href="#">WISHLIST</a>
                        <a class="compare" href="#">COMPARE</a>
                      </div> -->
                      <div class="pricetag">
                        @if($item_product_cate->status == 0)
                          <span class="spiral"></span><a href="{!! url('product-detail',[$item_product_cate->id,$item_product_cate->alias]) !!}" class="productcart">Thêm</a>
                        @else
                          <span class="spiral"></span><a href="{!! url('add-to-cart',[$item_product_cate->id,$item_product_cate->alias]) !!}" class="productcart">Thêm</a>
                        @endif
                        <div class="price">
                          @if($item_product_cate->price_new == 0)
                            <div class="pricenew">{!! $item_product_cate->price !!}đ</div>
                          @else
                            <div class="pricenew">{!! $item_product_cate->price_new !!}đ</div>
                            <div class="priceold">{!! $item_product_cate->price !!}đ</div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </li>
                  @endforeach
                </ul>
                <ul class="thumbnails list row">
                  @foreach($product_cate as $item_product_cate)
                  <li>
                    <div class="thumbnail">
                      <div class="row">
                        <div class="col-lg-4 col-sm-4">
                          @if($item_product_cate->price_new != 0)
                            <span class="sale tooltip-test"> Sale</span>
                          @endif
                          <a href="{!! url('product-detail',[$item_product_cate->id,$item_product_cate->alias]) !!}"><img alt="" src="{!! asset('resources/upload/'.$item_product_cate->image) !!}"></a>
                        </div>
                        <div class="col-lg-8 col-sm-8">
                          <a class="prdocutname" href="{!! url('product-detail',[$item_product_cate->id,$item_product_cate->alias]) !!}">{!! $item_product_cate->name !!}</a>
                          <div class="productdiscrption">{!! $item_product_cate->intro !!}</div>
                          <div class="pricetag">
                            @if($item_product_cate->status == 0)
                              <span class="spiral"></span><a href="{!! url('product-detail',[$item_product_cate->id,$item_product_cate->alias]) !!}" class="productcart">Thêm</a>
                            @else
                              <span class="spiral"></span><a href="{!! url('add-to-cart',[$item_product_cate->id,$item_product_cate->alias]) !!}" class="productcart">Thêm</a>
                            @endif
                            <div class="price">
                              @if($item_product_cate->price_new == 0)
                                <div class="pricenew">{!! $item_product_cate->price !!}đ</div>
                              @else
                                <div class="pricenew">{!! $item_product_cate->price_new !!}đ</div>
                                <div class="priceold">{!! $item_product_cate->price !!}đ</div>
                              @endif
                            </div>
                          </div>
<!--                           <div class="shortlinks">
                            <a class="details" href="#">DETAILS</a>
                            <a class="wishlist" href="#">WISHLIST</a>
                            <a class="compare" href="#">COMPARE</a>
                          </div> -->
                        </div>
                      </div>
                    </div>
                  </li>
                  @endforeach
                </ul>
                <div>
                  <ul class="pagination pull-right">
                    @if($product_cate->currentPage() != 1)
                    <li><a href="{!! str_replace('/?','?',$product_cate->url($product_cate->currentPage() - 1)) !!}">Prev</a></li>
                    @endif
                    @for($i = 1; $i <= $product_cate->lastPage(); $i = $i + 1)
                    <li class="{!! ($product_cate->currentPage() == $i) ? 'active' : '' !!}">
                      <a href="{!! str_replace('/?','?',$product_cate->url($i)) !!}">{!! $i !!}</a>
                    </li>
                    @endfor
                    @if($product_cate->currentPage() != $product_cate->lastPage())
                    <li><a href="{!! str_replace('/?','?',$product_cate->url($product_cate->currentPage() + 1)) !!}">Next</a></li>
                    @endif
                  </ul>
                </div>
              </section>
        </section>
      </div>
    </div>
  </div>
</section>

@endsection