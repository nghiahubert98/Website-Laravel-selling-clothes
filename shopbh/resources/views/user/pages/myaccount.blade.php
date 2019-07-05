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
        <li class="active">Tài khoản của tôi</li>
      </ul>
      <div class="row">
        
        <!-- My Account-->
        <div class="col-lg-9">
            <h1 class="heading1"><span class="maintext">Tài khoản của tôi</span><span class="subtext">Xem tất cả thông tin về tài khoản</span></h1>  
            <div class="container col-md-6"   style="">
                <h4></h4>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="col-md-3">Thông tin tài khoản</th>
                        <th class="col-md-6"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Tên người dùng</td>
                        <td>{!! $user_detail->username !!}</td>
                    </tr>
                    <tr>
                        <td>Tên đầy đủ:</td>
                        <td>{!! $user_detail->fullname !!}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{!! $user_detail->email !!}</td>
                    </tr>
                    <tr>
                        <td>Giới tính</td>
                        <td>@if($user_detail->gender == 0)
                              Nam
                            @else
                              Nữ
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Địa chỉ</td>
                        <td>{!! $user_detail->address !!}</td>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td>{!! $user_detail->phone !!}</td>
                    </tr>
                    </tbody>
                </table>
              </div>
     
        </div>
        <!-- Sidebar Start-->
          <aside class="col-lg-3">
            <div class="sidewidt">
              <h2 class="heading2"><span>Tài khoản</span></h2>
              <ul class="nav nav-list categories">
                @if(Auth::user()->level == 1)
                <li>
                  <a href="{!! url('admin/bill/list') !!}">Trang admin</a>
                </li>
                @endif
                <li>
                  <a href="{!! url('edit-account') !!}">Chỉnh sửa tài khoản</a>
                </li>
                <li><a href="{!! url('order-history') !!}">Lịch sử giao dịch</a>
                </li>
                <li>
                  <a href=" {!! url('logout') !!}">Đăng xuất</a>
                </li>
              </ul>
            </div>
          </aside>
        <!-- Sidebar End-->
      </div>
    </div>
  </section>
@endsection