@extends('admin.masterPage')
@section('content_Title','Customer')
@section('title',' - Customer')
@section('content')
    <div class="text-end mb-2"><a class="btn btn-primary" href="/admin/add-customer">+ Create new customer</a></div>
    <table class="w-100 table table-bordered text-center" style="table-layout: fixed;">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach ($customer as $item)
            <tr class="align-middle">
                <td>{{$item->id}}</td>
                <td style="overflow: hidden; text-overflow: ellipsis;">{{$item->name}}</td>
                <td style="overflow: hidden; text-overflow: ellipsis;">{{$item->gender}}</td>
                <td style="overflow: hidden; text-overflow: ellipsis;">{{$item->phone}}</td>
                <td style="overflow: hidden; text-overflow: ellipsis;">{{$item->email}}</td>
                <td style="overflow: hidden; text-overflow: ellipsis;">{{$item->address}}</td>
                <td style="overflow: hidden; text-overflow: ellipsis;">
                    @if ($item->status == "Active")
                        <b class="text-success">Active</b>
                    @else
                        <b class="text-danger">Inactive</b>
                    @endif
                </td>
                <td>
                    <div class="dropdown">
                        <div data-bs-toggle="dropdown" style="cursor: pointer" aria-expanded="false">...</div>
                        <ul class="dropdown-menu dropdown-menu-arrow">
                        <li><a class="dropdown-item text-warning" href="/admin/edit-customer/{{$item->id}}"><i class="bi bi-pencil-square"></i>Edit</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    {{$customer->links()}}
@endsection