@extends('admin.masterPage')
@section('content_Title','Sale')
@section('title',' - Sale')
@section('link')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <style>
        table{
            width: 100%;
            text-align: center;
            table-layout: fixed;
            border-collapse: collapse;
        }
        table th,table td{
            border: 3px solid black;
            padding: 5px 10px;
        }
        table tr td img{
            width: 100%;
        }
        /* table tr:nth-child(odd){
            background-color: rgb(153, 153, 153);
        } */
        table tr:nth-child(1){
            background-color: black;
            color: white;
        }
        .deleteBTN{
            background: red;
            color: white;
            border: 2px solid black;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
  
   <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#barcode').keydown(function(){
                var length = $('#barcode').val().length;
                if(length == 6){
                    var barcode = $('#barcode').val();
                    var code = getBarcode(barcode);
                    if(code != 0){
                        $.post('/admin/sale-submit',{barcode:code},function(respone){
                            $('table').append(respone);
                        });
                    }
                    $('#barcode').val('');
                }
            });
            $('body').on('click','.deleteBTN',function(){
                deleteArr($(this).closest('tr').index()-1);
                $(this).closest('tr').remove();
            });
        });
   </script>
     <input type="text" id="barcode" class="border-2 border-dark m-2 form-control " name="barcode" autocomplete="off" placeholder="barcode...">
    <form action="/admin/sale-sendsubmit" method="post" class="w-100">
        @csrf
        <div class="d-flex m-2  justify-content-between">
            <div class="w-25 d-flex align-items-center">
                <label for="cus"><b>Customer</b></label>
                <select name="customer" class="form-select border-dark border-2">
                    @foreach ($customer as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary d-flex align-items-center"><i class="bi bi-cart4"></i>Sale</button>
        </div>
   <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th>price</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
   </table>
    </form>
@endsection