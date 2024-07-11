@extends('admin.masterPage')
@section('content_Title','Product')
@section('title',' - Product')
@section('content')
    <form action="/admin/product-detail" onsubmit="sub()" method="post">
        @csrf
        <input style="position: absolute;left:-100%" type="text" name="barcode" id="barcode" placeholder="Search...">
    </form>
    <table class="w-100 table table-bordered text-center" style="table-layout: fixed;">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Barcode</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        @foreach ($product as $item)
            <tr class="align-middle">
                <td>{{$item->id}}</td>
                <td style="overflow: hidden; text-overflow: ellipsis;">{{$item->name}}</td>
                <td>{{$item->category}}</td>
                <td><img src="https://www.barcode-generator.org/zint/api.php?bc_number=20&bc_data={{$item->barcode}}" class="w-100" alt="barcode"></td>
                <td><img src="{{asset('images/'.$item->image)}}" class="w-100" alt="image"></td>
                <td>
                    <div class="dropdown">
                        <div data-bs-toggle="dropdown" style="cursor: pointer" aria-expanded="false">...</div>
                        <ul class="dropdown-menu dropdown-menu-arrow">
                        <li><a class="dropdown-item text-warning" href="/admin/edit-product/{{$item->id}}"><i class="bi bi-pencil-square"></i>Edit</a></li>
                        <li><a class="dropdown-item text-danger deleteProduct"data-bs-toggle="modal" data-bs-target="#deleteProduct" style="cursor: pointer;"><i class="bi bi-trash-fill"></i>Delete</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    {{$product->links()}}
     <!-- Delete Modal -->
     <div class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure to delete this record?</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            <a id="deleteBTN" class="btn btn-danger">Delete</a>
            </div>
        </div>
        </div>
    </div>

    <script>
                
        document.addEventListener('mousemove', resetTimer);
        document.addEventListener('scroll', resetTimer);
        window.addEventListener('load', resetTimer);
        const timeoutDuration = 100;
        function resetTimer() {
            timeout = setTimeout(onMouseNotMove, timeoutDuration);
        }
        function onMouseNotMove() {
            if(document.getElementsByName('barcode')[0]){
                document.getElementsByName('barcode')[0].focus();
            }
        }
        setTimeout(function sub(){
            document.getElementById('barcode').value="";
        },500);
        
    </script>
@endsection