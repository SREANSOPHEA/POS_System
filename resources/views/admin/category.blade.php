@extends('admin.masterPage')
@section('content_Title','Categories')
@section('title',' /Category')
@section('content')
    <button type="button" class="btn btn-primary mb-2 float-end" data-bs-toggle="modal" data-bs-target="#categoryModal">+ Add Category</button>
    <table class="w-100 table table-hover table-bordered text-center" style="table-layout: fixed">
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
        @foreach ($category as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->code}}</td>
                <td>{{$item->name}}</td>
                <td style="overflow: hidden; text-overflow: ellipsis;">{{$item->note}}</td>
                <td>
                    <div class="dropdown">
                        <div data-bs-toggle="dropdown" style="cursor: pointer" aria-expanded="false">...</div>
                        <ul class="dropdown-menu dropdown-menu-arrow">
                          <li><a class="dropdown-item text-warning editBTN" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#categoryEdit"><i class="bi bi-pencil-square"></i>Edit</a></li>
                          <li><a class="dropdown-item text-danger deleteCategory" style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#categoryDelete"><i class="bi bi-trash-fill"></i>Delete</a></li>
                        </ul>
                      </div>
                </td>
            </tr>
        @endforeach
    </table>
    {{$category->links()}}


    <!-- Add Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="/admin/add-category" method="post">
            @csrf
            <table class="w-100">
                <tr class="align-top">
                    <th>Code</th>
                    <td><input type="text" name="code" class="form-control border-2 border-dark"></td>
                </tr>
                <tr class="align-top">
                    <th>Name</th>
                    <td><input type="text" name="name" class="form-control border-2 border-dark"></td>
                </tr>
                <tr class="align-top">
                    <th>Note</th>
                    <td><textarea name="note" class="form-control border-2 border-dark" cols="30" rows="3"></textarea></td>
                </tr>
            </table>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
            </div>
        </div>
        </div>
    </div>

     <!-- Edit Modal -->
     <div class="modal fade" id="categoryEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="/admin/edit-category" method="post">
            @csrf
            <table class="w-100">
                <tr class="align-top">
                    <th>ID</th>
                    <td><input type="text" name="id" class="form-control border-2 border-dark" id="text_id" readonly></td>
                </tr>
                <tr class="align-top">
                    <th>Code</th>
                    <td><input type="text" name="code" class="form-control border-2 border-dark" id="text_code"></td>
                </tr>
                <tr class="align-top">
                    <th>Name</th>
                    <td><input type="text" name="name" class="form-control border-2 border-dark" id="text_name"></td>
                </tr>
                <tr class="align-top">
                    <th>Note</th>
                    <td><textarea name="note" class="form-control border-2 border-dark" cols="30" rows="3" id="text_note"></textarea></td>
                </tr>
            </table>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </form>
            </div>
        </div>
        </div>
    </div>

     <!-- Delete Modal -->
     <div class="modal fade" id="categoryDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

