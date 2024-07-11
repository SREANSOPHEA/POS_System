@extends('admin.masterPage')
@section('content_Title','Currency')
@section('title',' - Currency')
@section('link')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-12"><h1><b>Exchange Rate</b></h1></div>
        <div class="col-6 d-flex justify-content-around">
            <div><input type="number" class="border-2 border-dark rielMoney" name="riel" value="{{$exchange->riel}}" style="text-align:end"> <b>Riel(៛)</b></div>
            <div><h3><b>=</b></h3></div>
            <div><input type="number" readonly class="border-2 border-dark dollarMoney" name="dollar" value="{{$exchange->dollar}}" style="text-align:end"> <b>Dollar($)</b></div>
        </div>
    </div>
    <table class="w-100 mt-3 table table-hover table-bordered text-center" style="table-layout: fixed">
        <tr>
            <th>N<sup>o</sup></th>
            <th>Name</th>
            <th>Icon</th>
            <th>Country</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Riel</td>
            <td>៛</td>
            <td>Cambodia</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Dollar</td>
            <td>$</td>
            <td>USA</td>
        </tr>
    </table>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.rielMoney').change(function(){
                var riel = $('.rielMoney').val();
                $.post('/admin/currency_update_riel',{money:riel},function(respone){
                    if(respone == "success") swal('Congratulation','Currency Updated','success');
                    else swal('Something went wrong','Please try again!!','error');
                });
            });
            $('.dollarMoney').change(function(){
                var dollar = $('.dollarMoney').val();
                $.post('/admin/currency_update_dollar',{money:dollar},function(respone){
                    if(respone == "success") swal('Congratulation','Currency Updated','success');
                    else swal('Something went wrong','Please try again!!','error');
                });
            });
        });

    </script>
@endsection