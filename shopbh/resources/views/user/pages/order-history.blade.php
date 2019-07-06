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
            <h1 class="heading1"><span class="maintext">Lịch sử giao dịch</span><span class="subtext">Xem tất cả đơn hàng</span></h1>  
            <div class="container col-md-6"   style="">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <th>Mã đơn</th>
                  <th>Ngày đặt hàng</th>
                  <th>Trạng thái</th>
                  <th>Tổng</th>
                </thead>
                <tbody>
                  @foreach($orders as $item)
                  <tr>
                    <td>{!! $item->id !!} <a href="{!! url('billdetail', $item->id) !!}" style="color: Blue; float: right;">Chi tiết</a></td>
                    <td>{!! $item->date_order !!}</td>
                    <td>
                      @if($item->status == 0)
                        Mới đặt hàng
                      @elseif($item->status == 1)
                        Chưa vận chuyển
                      @elseif($item->status == 2)
                        Đang vẫn chuyển
                      @elseif($item->status == 3)
                        Đã vận chuyển
                      @endif
                    </td>
                    <td style="color: red;">{!! $item->total !!}đ</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

        </div>
        <!-- Sidebar Start-->
          <aside class="col-lg-3">
            <div class="sidewidt">
              <h2 class="heading2"><span>Account</span></h2>
              <ul class="nav nav-list categories">
                @if(Auth::user()->level == 1)
                <li>
                  <a href="{!! url('admin/bill/list') !!}">Trang Admin</a>
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
