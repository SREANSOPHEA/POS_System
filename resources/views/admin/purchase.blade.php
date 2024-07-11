@extends('admin.masterPage')
@section('content_Title','Purchase')
@section('title',' - Purchase')
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
            <div class="col-6 p-3 ">
                <div class="w-100 card rounded h-100">    
                    <div class="h-100">
                        <a class="align-items-center" href="/admin/purchase/{{$item->id}}"><img src="{{asset('images/'.$item->photo)}}" class="w-100 h-100"></a>
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