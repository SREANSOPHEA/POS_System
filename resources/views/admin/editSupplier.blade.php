@extends('admin.masterPage')
@section('content_Title','Edit Supplier')
@section('title',' - Edit Supplier')
@section('content')
    <div class="card p-3">
        <form action="/admin/edit-supplier-submit/{{$supplier->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <table class="w-100">
                <input type="hidden" name="old_image" value="{{$supplier->photo}}">
                <tr class="align-top">
                    <th>Name</th>
                    <td><input type="text" name="name" class="form-control border-2 border-dark" value="{{$supplier->name}}"></td>
                    <td class="w-25 align-middle text-center" rowspan="7"><img src="{{asset('images/'.$supplier->photo)}}" style="margin: auto" id="imagePreview" class="w-75"><h5>Image</h5></td>
                </tr>
                <tr class="align-top">
                    <th>Image</th>
                    <td><input type="file" name="image" onchange="changeImage()" class="form-control border-2 border-dark"></td>
                </tr>
                <tr class="align-top">
                    <th>Email</th>
                    <td><input type="text" name="email" class="form-control border-2 border-dark" value="{{$supplier->email}}"></td>
                </tr>
                <tr class="align-top">
                    <th>Phone</th>
                    <td><input type="text" name="phone" class="form-control border-2 border-dark" value="{{$supplier->phone}}"></td>
                </tr>
                <tr class="align-top">
                    <th>Address</th>
                    <td><input type="text" name="address" class="form-control border-2 border-dark" value="{{$supplier->address}}"></td>
                </tr>
                <tr class="align-top">
                    <th>Note</th>
                    <td><textarea name="note" class="form-control border-2 border-dark" cols="30" rows="3">{{$supplier->note}}</textarea></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center"><button class="btn btn-primary">Save</button></td>
                </tr>
            </table>
        </form>
    </div>
   
@endsection