@extends('admin.master')
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">Bill
        <small>Bill Detail</small>
    </h1>
</div>
<!-- /.col-lg-12 -->
<div class="col-lg-6">
    <div class=""   style="">
        <h4></h4>
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="col-md-3">Customer information</th>
                <th class="col-md-3"></th>
            </tr>
            </thead>
            <tbody>
            <tr class="info">
                <td>Name</td>
                <td>{!! $customerInfo->fullname !!}</td>
            </tr>
            <tr class="info">
                <td>Date Order</td>
                <td>{!! $customerInfo->date_order !!}</td>
            </tr>
            <tr class="info">
                <td>Phone Number</td>
                <td>{!! $customerInfo->phone !!}</td>
            </tr>
            <tr class="info">
                <td>Address</td>
                <td>{!! $customerInfo->address !!}</td>
            </tr>
            <tr class="info">
                <td>Email</td>
                <td>{!! $customerInfo->email !!}</td>
            </tr>
            <tr class="info">
                <td>Payment</td>
                <td>{!! $customerInfo->payment !!}</td>
            </tr>
            <tr class="info">
                <td>Note</td>
                <td>{!! $customerInfo->note !!}</td>
            </tr>
            </tbody>
        </table>
      </div>
</div>


<table class="table table-bordered table-hover" role="grid" aria-describedby="example2_info">
    <thead>  
        <th class="sorting col-md-1" >ID</th>
        <th class="sorting_asc col-md-4">Product Name</th>
        <th class="sorting col-md-2">Size</th>
        <th class="sorting col-md-2">Quantity</th>
        <th class="sorting col-md-2">Price</th>
    </thead>
    <tbody>
        @foreach($billInfo as $key => $bill)
        <tr>
            <td>{!! $key+1 !!}</td>
            <td>{!! $bill->product_name !!}</td>
            <td>{!! $bill->size !!}</td>
            <td>{!! $bill->quantity !!}</td>
            <td>${!! $bill->unit_price*$bill->quantity !!}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4"><b>Total Pay</b></td>
            <td colspan="1"><b style="color: red;">${!! $customerInfo->total !!}</b></td>
        </tr>
    </tbody>
</table>
<div class="col-lg-12">
<form action="" method="POST">
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <div class="col-md-8"></div>
    <div class="col-md-4">
        <div class="form-inline">
            <label>Status Shipping: </label>
            <select name="status" class="form-control input-inline" style="width: 200px">
                <option value="1">Not Delivered Yet</option>
                <option value="2">Shipped</option>
                <option value="3">Delivered</option>
            </select>
            <button onClick="window.print()">Print this page</button>`
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>
    </div>
</form>
</div>
@endsection()