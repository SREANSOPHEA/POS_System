@extends('admin.masterPage')
@section('content_Title','Suppliers')
@section('title',' - Supplier')
@section('content')
    <style>
        .card{
            animation: pages linear;
            animation-timeline: view();
            animation-range: entry 0% cover 40%;
        }
        @keyframes pages{
            from{
                opacity: 0;
                scale: 0.5;
            }
            to{
                opacity: 1;
                scale: 1;
            }
        }
    </style>
    <div class="row w-100">
        @foreach ($supplier as $item)
            <div class="col-12 p-3 ">
                <div class="w-50 card rounded h-100" style="margin: auto">
                    <div class="h-100">
                        <div class="dropdown">
                            <div data-bs-toggle="dropdown" style="cursor: pointer" aria-expanded="false"><b>...</b></div>
                            <ul class="dropdown-menu dropdown-menu-arrow">
                            <li><a class="dropdown-item text-warning" href="/admin/edit-product/{{$item->id}}"><i class="bi bi-pencil-square"></i>Edit</a></li>
                            <li><a class="dropdown-item text-danger deleteSupplier" data-value="{{$item->id}}" data-bs-toggle="modal" data-bs-target="#deleteSupplier" style="cursor: pointer;"><i class="bi bi-trash-fill"></i>Delete</a></li>
                            </ul>
                        </div>
                        <a class="align-items-center" href="/admin/supplier-detail/{{$item->id}}"><img src="{{asset('images/'.$item->photo)}}" class="w-100 h-100"></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

     <!-- Delete Modal -->
     <div class="modal fade" id="deleteSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
@endsection