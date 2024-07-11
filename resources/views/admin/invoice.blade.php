@extends('admin.masterPage')
@section('content_Title','Invoice')
@section('title',' - Invoice')
@section('content')
    <table class="w-100 table table-dark table-hover table-bordered text-center" style="table-layout: fixed">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Seller</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        @foreach ($sale as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->customer}}</td>
                <td>{{$item->seller}}</td>
                <td>{{$item->date}}</td>
                <td><a href="/admin/invoice-detail/{{$item->id}}" class="btn btn-primary">View</a></td>
            </tr>
        @endforeach
    </table>
@endsection

