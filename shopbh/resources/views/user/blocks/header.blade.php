<div class="headerstrip">
    <div class="container">
        <div class="row">
            <div class="col-lg-12"> <a href="{{ url('/index')}}" class="logo pull-left"><img align="center" width="170" height="60" src="{!! url('user/img/logo.png') !!}" alt="SimpleOne" title="SimpleOne"></a> 
                <!-- Top Nav Start -->
                <div class="pull-left">
                    <div class="navbar" id="topnav">
                        <div class="navbar-inner">
                            <ul class="nav" >
                                <li><a class="home active" href="{!! url('index') !!}">TRANG CHỦ</a> </li>
                                <li><a class="shoppingcart" href="{!! url('cart-info') !!}">GIỎ HÀNG</a> </li>
                                <li><a class="checkout" href="{!! url('check-out') !!}">THANH TOÁN</a> </li>
                                <li><a class="myaccount" href="{!! url('myaccount') !!}">TÀI KHOẢN</a> </li>
                                <li><a class="contact" href="{!! url('contact') !!}">LIÊN HỆ</a> </li>
                                @if(Auth::check())
                                    <li><a class="log-out" href="{!! url('logout') !!}">ĐĂNG XUẤT</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Top Nav End -->
                <!---search--->
                    <form action="{!! route('search') !!}" method="get" class="form-search">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="min_price" value= {!!$min_price??0!!} >
                        <input type="hidden" name="max_price" value= {!!$max_price??1000000!!}>
                        <input type="text" id="key_search" name="key_search" class="input-medium search-query" placeholder="Search Here…"> 
                        <input type="submit" name="search" value="Tìm kiếm">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>