@extends('admin.master')
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">Product
        <small>List</small>
    </h1>
</div>
<!-- /.col-lg-12 -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Price New</th>
            <th>Status</th>
            <th>Date</th>
            <th>Category</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt = 0 ?>
        @foreach($data as $item)
        <tr class="odd gradeX" align="center">
            <td>{!! $stt = $stt + 1 !!}</td>
            <td>{!! $item["name"] !!}</td>
            <td>{!! number_format($item["price"],0,",",".") !!} đ</td>
            <td>{!! number_format($item["price_new"],0,",",".") !!} đ</td>
            <td>{!! $item['status']=='1' ? 'OverStock' : 'Out of Stock'!!}</td>
            <td>{!! \Carbon\Carbon::createFromTimestamp(strtotime($item["created_at"]))->diffForHumans(); !!}</td>
            <td>
                <?php $cate = DB::table('categories')->where('id',$item["cate_id"])->first(); ?>
                @if(!empty($cate->name))
                    {!! $cate->name !!}
                @endif
            </td>
            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick=" return xacnhanxoa('Are you sure you want to delete?')" href="{!! URL::route('admin.product.getDelete', $item['id']) !!}"> Delete</a></td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.product.getEdit', $item['id']) !!}">Edit</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()