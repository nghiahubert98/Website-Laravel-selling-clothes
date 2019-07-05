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
      <li class="active">Thanh toán</li>
    </ul>
    <div class="row">        
      <!-- Account Login-->
      <div class="col-lg-12">
        @if(!Auth::check())
        <h1 class="heading1"><span class="maintext">Thanh toán</span><span class="subtext"> Các bước thanh toán đơn hàng</span></h1>
        <div class="checkoutsteptitle">Khách hàng<a class="modify">Điều chỉnh</a>
        </div>
        <div class="checkoutstep ">

          <section class="returncustomer">
            <h2 class="heading2">Phản hồi khách hàng </h2>
            <div class="loginbox">
              <h4 class="heading4">Nếu bạn đã có tài khoản. Hãy đăng nhập:</h4>
              @if(Session::has('flash_message'))
                  <div class="alert alert-{!! Session::get('flash_level') !!}">
                      {!! Session::get('flash_message') !!}
                  </div>
              @endif
              @include('admin.blocks.error')
              <form class="form-vertical" role="form" action="{!! url('login-checkout') !!}" method="POST">
                 <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <fieldset>
                  <div class="control-group">
                    <label  class="control-label">Tên khách hàng:</label>
                    <div class="controls">
                      <input type="text" name="txtUsername" placeholder="Username" class="" value="{!! old('txtUsername') !!}">
                    </div>
                  </div>
                  <div class="control-group">
                    <label  class="control-label">Mật khẩu:</label>
                    <div class="controls">
                      <input type="password" name="txtPass" placeholder="Password" class="">
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="checkbox" name="remember" value="true">Nhớ mật khẩu  
                    <br>
                    <a class="" href="#">Quên mật khẩu?</a>
                  </div>
                  
                  <button type="submit" class="btn btn-orange">Đăng nhập</button>
                </fieldset>
              </form>
            </div>
          </section>
          <section class="newcustomer">
            <h2 class="heading2">Khách hàng mới: </h2>
            <div class="loginbox">
              <h4 class="heading4"> Đăng ký tài khoản</h4>
              <p>Đăng ký tại Shop Fashion HDT để dùng được thêm các chức năng của website và nhận được thông tin về sản phẩm một cách nhanh nhất.</p>
              <br>
              <br>
              <a href="{!! url('register') !!}" class="btn btn-orange">Đăng ký tài khoản</a>
            </div>
          </section>

        </div>
        @endif
        <form class="form-vertical" id="payment" role="form" action="{!! url('checkout') !!}" method="POST">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        @if(!Auth::check())
        <div class="checkoutsteptitle">Khách hàng:<a class="modify">Điều chỉnh</a>
        </div>
        <div class="checkoutstep">
          <div class="row">
              <fieldset>
                <div class="col-lg-6">
                  <div class="control-group">
                    <label class="control-label" >Tên<span class="red">*</span></label>
                    <div class="controls">
                      <input type="text" name="txtFname" class=""  value="{!! old('txtFname') !!}">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" >E-Mail<span class="red">*</span></label>
                    <div class="controls">
                      <input type="text" name="txtEmail" class=""  value="{!! old('txtEmail') !!}">
                    </div>
                  </div>
                  </div>
                  <div class="col-lg-6">
                  <div class="control-group">
                    <label class="control-label" >Điện thoại<span class="red">*</span></label>
                    <div class="controls">
                      <input type="text" name="txtPhone" class=""  value="{!! old('txtPhone') !!}">
                    </div>
                  </div>
    
                  <div class="control-group">
                    <label class="control-label" >Địa chỉ<span class="red">*</span></label>
                    <div class="controls">
                      <input type="text" name="txtAddress" class=""  value="{!! old('txtAddress') !!}">
                    </div>
                  </div>
              </fieldset>
          </div>
        </div>


        @endif

        <div class="checkoutsteptitle">Phương thức thanh toán<a class="modify">Điều chỉnh</a>
        </div>
            <div class="checkoutstep">
            <p>Bạn hãy chọn phước thức thanh toán: </p>
            <label class="inline">
              <input name="payment" type="radio" value="Cash On Delivery">Thanh toán bằng tiền mặt sau khi vận chuyển</label>
              <input name="payment" type="radio" checked="checked" value="Cash On Delivery">Thanh toán với PayPal</label>
            <textarea name="note" rows="2" placeholder="Add Comment here..."></textarea>
            <br>

            <input type="submit" class="btn btn-orange pull-right" value="Thanh toán sau khi vận chuyển">
            <a href="{{route('payment.paypal')}}"><input type="" value="Thanh toán với PayPal" class="btn btn-orange pull-right mr10"></a>
            <a href="{!! url('index') !!}"><input type="" value="Tiếp tục mua sản phẩm" class="btn btn-orange pull-right mr10"></a>
        </form>
      </div>        
    </div>
  </div>
</section>
@endsection