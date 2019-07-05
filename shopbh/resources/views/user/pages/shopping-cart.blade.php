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
        <li class="active"> Giỏ hàng</li>
      </ul>       
      <h1 class="heading1"><span class="maintext"> Giỏ hàng</span><span class="subtext"> Tất cả các sản phẩm trong giỏ hàng</span></h1>
      <!-- Cart-->
      @if(Cart::count() != 0)
      <div class="cart-info">
        <table class="table table-striped table-bordered">
          <tr>
            <th class="image">Hình ảnh</th>
            <th class="name">Tên sản phẩm</th>
            <th class="name">Kích thước</th>
            <th class="quantity">Số lượng</th>
            <th class="total">Trạng thái</th>
            <th class="price">Giá mỗi sản phẩm</th>
            <th class="total">Tổng giá</th>
           
          </tr>
<!--           <form method="POST" acction="#">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}"> -->
          @foreach($content as $item)
          <tr>
            <td class="image"><a href="{!! url('product-detail',[$item->id,$item->options['alias']]) !!}"><img title="product" alt="product" src="{!! asset('resources/upload/'.$item->options['img']) !!}" height="50" width="50"></a></td>
            <td  class="name"><a href="{!! url('product-detail',[$item->id,$item->options['alias']]) !!}">{!! $item->name !!}</a></td>
            <td  class="name">{!! $item->options['size'] !!}</td>
            <td class="quantity"><input class="col-lg-1 qty" type="text" size="20" value="{!! $item->qty !!}" name="quantity" ></td>
            <td class="total">
              <a href="javascript:void(0)" class="updatecart" id="{!! $item->rowId !!}"><img class="tooltip-test" data-original-title="Update" src="{!! url('user/img/update.png') !!}"></a>
              <a href="{!! url('detete-cart',['id'=>$item->rowId]) !!}"><img class="tooltip-test" data-original-title="Remove"  src="{!! url('user/img/remove.png') !!}" alt=""></a>
            </td>
            <td class="price">{!! $item->price !!}đ</td>
            <td class="total">{!! $item->price*$item->qty !!}đ</td>    
          </tr> 
          @endforeach  
         <!--  </form>  -->
        </table>
      </div>

      <div class="container">
      <div>
          <div class="col-lg-4 pull-right">
            <table class="table table-striped table-bordered ">
              <tr>
                <td><span class="extra bold">Tổng phụ :</span></td>
                <td><span class="bold">{!! Cart::subtotal(); !!}đ</span></td>
              </tr>
              <tr>
                <td><span class="extra bold">VAT (5%) :</span></td>
                <td><span class="bold">{!! Cart::tax(); !!}đ</span></td>
              </tr>
              <tr>
                <td><span class="extra bold totalamout">Tổng :</span></td>
                <td><span class="bold totalamout">{!! Cart::total(); !!}đ</span></td>
              </tr>
            </table>
            <a href="{!! url('check-out') !!}"><input type="submit" value="Thanh toán" class="btn btn-orange pull-right"></a>
            <a href="{!! url('index') !!}"><input type="submit" value="Tiếp tục mua hàng" class="btn btn-orange pull-right mr10"></a>
          </div>
        </div>
        </div>
        @else
          <h2>Không có sản phẩm trong giỏ hàng....</h2>
          <a href="{!! url('index') !!}"><input type="submit" value="Tiếp tục mua hàng" class="btn btn-orange pull-right mr10"></a>
        @endif
    </div>
  </section>


@endsection