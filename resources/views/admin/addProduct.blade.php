@extends('admin.masterPage')
@section('content_Title','Product')
@section('title',' - Product')
@section('content')
    <div class="card p-3">
        <form action="/admin/add-product-submit" method="post" enctype="multipart/form-data">
            @csrf
            <table class="w-100">
                <tr class="align-top">
                    <th>Name</th>
                    <td><input type="text" name="name" class="form-control border-2 border-dark"></td>
                    <td class="w-25 align-middle text-center" rowspan="7"><img style="margin: auto" id="imagePreview" class="w-75"><h5>Image</h5></td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>
                        <select name="category" class="form-select border-2 border-dark">
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Unit</th>
                    <td>
                        <select name="unit" class="form-select border-2 border-dark">
                            @foreach ($unit as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Currency</th>
                    <td>
                        <select name="currency" class="form-select border-2 border-dark">
                            @foreach ($currency as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr class="align-top">
                    <th>Image</th>
                    <td><input type="file" name="image" onchange="changeImage()" class="form-control border-2 border-dark"></td>
                </tr>
                <tr class="align-top">
                    <th>Cost</th>
                    <td><input type="text" name="cost" class="form-control border-2 border-dark"></td>
                </tr>
                <tr class="align-top">
                    <th>Price</th>
                    <td><input type="text" name="price" class="form-control border-2 border-dark"></td>
                </tr>
                <tr class="align-top">
                    <th>Detail</th>
                    <td><textarea name="detail" class="form-control border-2 border-dark" cols="30" rows="3"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center"><button class="btn btn-primary">Save</button></td>
                </tr>
            </table>
        </form>
    </div>
   
@endsection