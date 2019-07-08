@extends('admin.master')
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">Statistics
        <small>All Statistics</small>
    </h1>
</div>
<!-- /.col-lg-12 -->
<!-- Order Today -->
<div class="col-lg-12">
    <h3 class="page-header"><b>Order Today</b></h3>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Customer</th>
            <th>Address</th>
            <th>Date Order</th>
            <th>Total</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt = 0?>
        @foreach($ordersInDay as $item)
        <?php $stt = $stt + 1 ?>
        <tr class="" align="center">
            <td>{!! $stt !!}</td>
            <td>{!! $item->fullname !!}</td>
            <td>{!! $item->address !!}</td>
            <td>{!! $item->date_order !!}</td>
            <td>{!! $item->total !!}</td>
            <td>{!! $item->email !!}</td>
            <td>
                @if($item->status == 0)
                    New Order
                @elseif($item->status == 1)
                    Not Delivered Yet
                @elseif($item->status == 2)
                    Shipped
                @elseif($item->status == 3)
                    Delivered
                @endif
            </td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.statistics.getEdit', $item->id) !!}">Detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
    <div style="margin-left:50px" >
    <h5 class="page-header"><b>Total income for today: </b>{!! $total_income_day !!}</h5>
    <h5 class="page-header"><b>Best seller on today: </b></h5>
        <?php $max_count_seller = 0?>
        <?php $max_count_cate_seller = 0?>
        @foreach($product_bestseller_day as $item)
            @if($item->count_seller > $max_count_seller)
            <?php $max_count_seller = $item->count_seller ?>
            @endif
            @if($item->count_cate_seller > $max_count_cate_seller)
            <?php $max_count_cate_seller = $item->count_cate_seller ?>
            @endif
        @endforeach
        <div>
            @foreach($product_bestseller_day as $item)
                @if($item->count_seller == $max_count_seller)
                    {!! $item->name_product !!} : {!! $item->count_seller !!} lần mua.
                    <br>
                @endif
            @endforeach
        </div>
        <h5 class="page-header"><b>Most purchased catelogies in day: </b></h5>
            @foreach($product_bestseller_day as $item)
                @if($item->count_cate_seller == $max_count_cate_seller)
                    {!! $item->name_cate !!} : {!! $item->count_cate_seller !!} lần mua.
                    <br>
                @endif
            @endforeach
    </div>
</div>
<!-- Order In Month -->
<div class="col-lg-12">
    <h3 class="page-header"><b>Order In Month</b></h3>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Customer</th>
            <th>Address</th>
            <th>Date Order</th>
            <th>Total</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt = 0?>
        @foreach($ordersInMonth as $item)
        <?php $stt = $stt + 1 ?>
        <tr class="" align="center">
            <td>{!! $stt !!}</td>
            <td>{!! $item->fullname !!}</td>
            <td>{!! $item->address !!}</td>
            <td>{!! $item->date_order !!}</td>
            <td>{!! $item->total !!}</td>
            <td>{!! $item->email !!}</td>
            <td>
                @if($item->status == 0)
                    New Order
                @elseif($item->status == 1)
                    Not Delivered Yet
                @elseif($item->status == 2)
                    Shipped
                @elseif($item->status == 3)
                    Delivered
                @endif
            </td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.statistics.getEdit', $item->id) !!}">Detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
    <div style="margin-left:50px" >
        <h5 class="page-header"><b>Total income in month: </b>{!! $total_income_month !!}</h5>
        <h5 class="page-header"><b>Best seller in month: </b></h5>
        <?php $max_count_seller = 0?>
        <?php $max_count_cate_seller = 0?>
        @foreach($product_bestseller_month as $item)
            @if($item->count_seller > $max_count_seller)
            <?php $max_count_seller = $item->count_seller ?>
            @endif
            @if($item->count_cate_seller > $max_count_cate_seller)
            <?php $max_count_cate_seller = $item->count_cate_seller ?>
            @endif
        @endforeach
        <div>
            @foreach($product_bestseller_month as $item)
                @if($item->count_seller == $max_count_seller)
                    {!! $item->name_product !!} : {!! $item->count_seller !!} lần mua.
                    <br>
                @endif
            @endforeach
        </div>
        <h5 class="page-header"><b>Most purchased catelogies in month: </b></h5>
            @foreach($product_bestseller_month as $item)
                @if($item->count_cate_seller == $max_count_cate_seller)
                    {!! $item->name_cate !!} : {!! $item->count_cate_seller !!} lần mua.
                    <br>
                @endif
            @endforeach
    </div>
</div>
<!-- Order In Year -->
<div class="col-lg-12">
    <h3  class="page-header"><b>Order In Year</b></h3>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Customer</th>
            <th>Address</th>
            <th>Date Order</th>
            <th>Total</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt = 0?>
        @foreach($ordersInYear as $item)
        <?php $stt = $stt + 1 ?>
        <tr class="" align="center">
            <td>{!! $stt !!}</td>
            <td>{!! $item->fullname !!}</td>
            <td>{!! $item->address !!}</td>
            <td>{!! $item->date_order !!}</td>
            <td>{!! $item->total !!}</td>
            <td>{!! $item->email !!}</td>
            <td>
                @if($item->status == 0)
                    New Order
                @elseif($item->status == 1)
                    Not Delivered Yet
                @elseif($item->status == 2)
                    Shipped
                @elseif($item->status == 3)
                    Delivered
                @endif
            </td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.statistics.getEdit',$item->id) !!}">Detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
    <div style="margin-left:50px" >
        <h5 class="page-header"><b>Total income in year: </b>{!! $total_income_year !!}</h5>
        <h5 class="page-header"><b>Best seller in year: </b></h5>
        <?php $max_count_seller = 0?>
        <?php $max_count_cate_seller = 0?>
        @foreach($product_bestseller_year as $item)
            @if($item->count_seller > $max_count_seller)
            <?php $max_count_seller = $item->count_seller ?>
            @endif
            @if($item->count_cate_seller > $max_count_cate_seller)
            <?php $max_count_cate_seller = $item->count_cate_seller ?>
            @endif
        @endforeach
        <div>
            @foreach($product_bestseller_year as $item)
                @if($item->count_seller == $max_count_seller)
                    {!! $item->name_product !!} : {!! $item->count_seller !!} lần mua.
                    <br>
                @endif
            @endforeach
        </div>
        <h5 class="page-header"><b>Most purchased catelogies in year: </b></h5>
            @foreach($product_bestseller_year as $item)
                @if($item->count_cate_seller == $max_count_cate_seller)
                    {!! $item->name_cate !!} : {!! $item->count_cate_seller !!} lần mua.
                    <br>
                @endif
            @endforeach
    </div>
</div>
</div>
@endsection()