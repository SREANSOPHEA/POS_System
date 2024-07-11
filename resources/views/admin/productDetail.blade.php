@extends('admin.masterPage')
@section('content_Title','Product Detail')
@section('title',' - Product Detail')
@section('content')
    <div class="row w-100">
        <div class="col-12 text-center"><h1>Product Detail</h1></div>
        <div class="col-md-6 text-center">
            <img src="{{asset('images/'.$product->image)}}" class="w-75">
            {{-- <h5>Image</h5> --}}
        </div>
        <div class="col-md-6" >
            {{-- <h1 class="text-center"><b>{{$product->name}}</b></h1> --}}
            <h5>Name: <b>{{$product->name}}</b></h5>
            <p>
                Category: <b>{{$product->category}}</b><br>
                Quantity: <b>{{$product->qty}}</b><br>
                Unit    : <b>{{$product->unit}}</b><br>
                Cost    : <b>{{number_format($product->cost)}} {{$product->currency}}</b><br>
                Price   : <b>{{number_format($product->price)}} {{$product->currency}}</b> <br>
                {{$product->detail}}

            </p>
        </div>
        
    </div>
@endsection