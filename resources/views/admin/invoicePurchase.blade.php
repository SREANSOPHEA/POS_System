@extends('admin.masterPage')
@section('content_Title','Purchase Invoice')
@section('title',' - Purchase Invoice')
@section('content')
    <table class="w-100 table table-dark table-hover table-bordered text-center" style="table-layout: fixed">
        <tr>
            <th>ID</th>
            <th>Buyer</th>
            <th>Supplier</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        @foreach ($purchase as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->buyer}}</td>
                <td>{{$item->supplier}}</td>
                <td>{{$item->date}}</td>
                <td><a href="/admin/invoice-purchase-detail/{{$item->id}}" class="btn btn-primary">View</a></td>
            </tr>
        @endforeach
    </table>
@endsection

