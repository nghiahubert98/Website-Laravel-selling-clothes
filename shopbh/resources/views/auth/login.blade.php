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
        <li class="active">Đăng nhập</li>
      </ul>
       <!-- Account Login-->
      <div class="row">  
        <div class="col-lg-12">
          <h1 class="heading1"><span class="maintext">Đăng nhập</span></h1>
          <section class="returncustomer">
            <h2 class="heading2">Khách hàng đăng nhập </h2>
            <div class="loginbox">
              <h4 class="heading4">Nếu bạn đã có tài khoản. Hãy đăng nhập:</h4>
              @if(Session::has('flash_message'))
                  <div class="alert alert-{!! Session::get('flash_level') !!}">
                      {!! Session::get('flash_message') !!}
                  </div>
              @endif
              @include('admin.blocks.error')
              <form class="form-vertical" role="form" action="" method="POST">
                 <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <fieldset>
                  <div class="control-group">
                    <label  class="control-label">Tên người dùng:</label>
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
                    <input type="checkbox" name="remember" value="true">Nhớ tài khoản   
                    <br>
                    <a class="" href="#">Quên mật khẩu?</a>
                  </div>
                  <button type="submit" class="btn btn-orange">Đăng nhập</button>
                </fieldset>
              </form>
            </div>
          </section>
          <section class="newcustomer">
            <h2 class="heading2">Khách hàng mới</h2>
            <div class="loginbox">
              <h4 class="heading4"> Đăng ký tài khoản</h4>
              <p>Đăng ký tại Shop Fashion HDT để dùng được thêm các chức năng của website và nhận được thông tin về sản phẩm một cách nhanh nhất.</p>
              <br>
              <br>
              <a href="{!! url('register') !!}" class="btn btn-orange">Đăng ký tài khoản</a>
            </div>
          </section>
        </div>
        

      </div>
    </div>
  </section>


@endsection