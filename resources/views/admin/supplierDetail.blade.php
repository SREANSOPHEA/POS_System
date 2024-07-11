@extends('admin.masterPage')
@section('content_Title','Supplier Detail')
@section('title',' - Supplier Detail')
@section('content')
    <style>
        .logo_company{
            box-shadow: 0 0 1.5rem black;
        }
    </style>
    <div class="row w-100">
        {{-- <div class="col-12 text-center"><h1>Supplier Detail</h1></div> --}}
        <div class="col-12 text-center">
            <img src="{{asset('images/'.$detail->photo)}}" class="w-75 logo_company" style="background-color:white">
            {{-- <h5>Image</h5> --}}
        </div>
        <div class="col-md-6" >
            {{-- <h1 class="text-center"><b>{{$product->name}}</b></h1> --}}
            <h5>Name: <b>{{$detail->name}}</b></h5>
            <p>
                Email   : <b>{{$detail->email}}</b><br>
                Phone   : <b>{{$detail->phone}}</b><br>
                Address : <b>{{$detail->address}}</b><br>
                Note    :{{$detail->note}}
            </p>
        </div>
        
    </div>
@endsection