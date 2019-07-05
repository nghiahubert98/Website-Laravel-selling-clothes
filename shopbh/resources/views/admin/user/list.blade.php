@extends('admin.master')
@section('content')
<div class="col-lg-12">
    <h1 class="page-header">User
        <small>List</small>
    </h1>
</div>
<!-- /.col-lg-12 -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr align="center">
            <th>ID</th>
            <th>Username</th>
            <th>Level</th>
            <th>Status</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        <?php $stt = 0 ?>
        @foreach($user as $item)
        <?php $stt = $stt + 1 ?>
        <tr class="odd gradeX" align="center">
            <td>{!! $stt !!}</td>
            <td>{!! $item["username"] !!}</td>
            <td>
                @if($item["id"] == 0)
                    SupperAdmin
                @elseif($item["level"] == 1)
                    Admin
                @else
                    Member
                @endif
            </td>
            <td>
                @if($item->isOnline())
                    <img src="{!! url('user/img/online.png') !!}" width="10" height="10"> Online
                @else
                    <img src="{!! url('user/img/offline.png') !!}" width="10" height="10"> Offline
                @endif
            </td>
            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick=" return xacnhanxoa('Are you sure you want to delete?')" href="{!! URL::route('admin.user.getDelete', $item['id']) !!}"> Delete</a></td>
            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{!! URL::route('admin.user.getEdit', $item['id']) !!}">Edit</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection()