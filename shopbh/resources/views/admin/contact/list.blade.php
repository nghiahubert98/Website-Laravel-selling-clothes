@extends('admin.master')
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">Mailbox
        <small>List Mail</small>
    </h1>
</div>
<!-- /.col-lg-12 -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Date Contact</th>
            <th>Note</th>
            <th>Status</th>
            <th>Action</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contact as $key => $item)
        <tr class="" align="center">
            <td>{!! $key + 1 !!}</td>
            <td>{!! $item->name !!}</td>
            <td>{!! $item->email !!}</td>
            <td>{!! $item->phone !!}</td>
            <td>{!! $item->created_at !!}</td>
            <td>{!! $item->note !!}</td>
            <td>
                @if($item->status == 0)
                    New Mail
                @elseif($item->status == 1)
                    <span class="glyphicon glyphicon-ok"></span>
                @endif
            </td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="">Detail</a></td>
            <td class="center"><i class="fa fa-trash-o fa-fw"></i><a onclick=" return xacnhanxoa('Are you sure you want to delete?')" href="{!! URL::route('admin.contact.getDelete', $item->id) !!}">Delete</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()