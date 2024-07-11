<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<style>
    table,tr,th,td{
        border-bottom: 2px solid black;
        padding-bottom: 10px;
    }
    .hide{
        border-left: 2px solid transparent;
        border-bottom: 2px solid transparent;
    }
    .text-start{
      text-align: start;
    }
    .text-end{
      text-align: start;
    }
    @media print{
        .btn,.back{
            display: none;
        }
        .table {
        color: rgb(0, 0, 0) !important;
        background-color: yellow !important;
    }
    }
</style>
<body class="m-0 p-0">
    <div class="p-3 d-flex w-100 align-items-center">
        <div><a class="back"href="/admin/invoice">Back</a></div>
        <div class="text-end w-100">
            <button class="btn btn-primary" onclick="print()">Print</button>
        </div>
    </div>
    {{-- <marquee behavior="alternate">Beltei International University</marquee> --}}
    <hr style="height: 3px; background-color:black;margin: auto;" width="90%" >
    <h1 class="text-center"><b><i><u>Invoice</u></i></b></h1>
    <div class="container">
        <div style="line-height: 0">
            <h3>Invoice: <b>#{{$detail[0]->ID}}</b></h3>
            <p>Buyer: <b>{{$detail[0]->customer}}</b></p>
            <p>Seller: <b>{{$detail[0]->seller}}</b></p>
            <p>Date: <b>{{$detail[0]->date}}</b></p>
        </div>
        <table class="w-100 text-center align-middle" style="table-layout: fixed">
          <tr>
            <th class="text-start">N<sup>o</sup></th>
            <th>Name</th>
            <th>Category</th>
            <th>Unit</th>
            <th>Qty</th>
            <th>Price</th>
            <th class="text-end">Total</th>
          </tr>
          @php
              $i=1;
          @endphp
          @foreach ($detail as $item)
              <tr>
                <td class="text-start">{{$i++}}</td>
                <td>{{$item->product}}</td>
                <td>{{$item->category}}</td>
                <td>{{$item->unit}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{number_format($item->price)}} {{$item->currency}}</td>
                <td class="text-end"><b>{{number_format($item->price * $item->quantity)}} {{$item->currency}}</b></td>
              </tr>
          @endforeach
          {{-- <tr > 
            <th colspan="5" class="text-start">Subtotal:<br>Discount: <br>Tax:</th>
            <td class="text-end"><b>{{number_format($detail[0]->subtotal)}}$ <br>{{$detail[0]->discount}}% <br>5%</b></td>
          </tr>
          <tr>
            <th colspan="5" class="text-start"><h3>Total:</h3></th>
            <td class="text-end"><h3><b>{{number_format($detail[0]->amount)}}$</b></h3></td>
          </tr> --}}
        </table>
    </div>
    
</body>
</html>