@extends('admin.master')
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">Bill
        <small>List Bill</small>
    </h1>
</div>
<!-- /.col-lg-12 -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Customer</th>
            <th>Address</th>
            <th>Date Order</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt = 0 ?>
        @foreach($customer as $item)
        <?php $stt = $stt + 1 ?>
        <tr class="" align="center">
            <td>{!! $stt !!}</td>
            <td>{!! $item->fullname !!}</td>
            <td>{!! $item->address !!}</td>
            <td>{!! $item->date_order !!}</td>
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
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.bill.getEdit', $item->id) !!}">Detail</a></td>
            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick=" return xacnhanxoa('Are you sure you want to delete?')" href="{!! URL::route('admin.bill.getDelete', $item->id) !!}">Delete</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()