@extends('admin.masterPage')
@section('content_Title','Stock')
@section('title',' - Stock')
@section('content')
    <table class="w-100 table table-hover table-bordered text-center" style="table-layout: fixed">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th>Image</th>
        </tr>
        @foreach ($stock as $item)
            <tr class="align-middle">
                <td>{{$item->ID}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->category}}</td>
                <td>{{$item->price}}</td>
                <td style="overflow: hidden;text-overflow: ellipsis">
                    @if ($item->qty == 0) <b class="text-danger">Out of Stock</b>@endif
                    @if ($item->qty  <= 5 && $item->qty>0) <b class="text-warning">{{$item->qty}}</b>@endif
                    @if ($item->qty  > 5) <b class="text-success">{{$item->qty}}</b>@endif
                </td>
                <td>{{$item->unit}}</td>
                <td><img src="{{asset('images/'.$item->img)}}" class="w-75"></td>
                {{-- <td style="overflow: hidden; text-overflow: ellipsis;">{{$item->note}}</td> --}}
            </tr>
        @endforeach
    </table>
    {{$stock->links()}}
@endsection

