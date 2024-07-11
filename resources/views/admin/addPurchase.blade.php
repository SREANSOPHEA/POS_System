<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Purchase</title>
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
  </head>
<style>
    .input-group button,.input-group input{
        text-align: center;
        border: 2px solid black;
    }
    .input-group button{
      width: 25%;
    }
</style>
  <body>
    @if (session("error"))
      <script>
        $(document).ready(function(){
          swal('Something Went Wrong!','Please Try Again','error');
          speech('Error Please try again');
        })
      </script>
    @endif
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="/admin/purchase" class="logo d-flex align-items-center">
          {{-- <img src="{{asset('images/'.$supplier->photo)}}" class="h-100 w-100" /> --}}
          <span class="d-none d-lg-block">{{$supplier->name}}</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div>
      <!-- End Logo -->

    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <h4>Current Order</h4>
        <form action="/admin/purchase-submit/{{$supplier->id}}" method="post">
          @csrf
        <div id="currentOrder" style="overflow-y: auto;height:45vh">
          
        </div>
        <div style="position: absolute;bottom:0;left:50%;transform:translateX(-50%);z-index: 1000" class="w-100 p-2">
            <div class="bg-dark w-100 rounded p-3">
                <div class="row text-light">
                  <input type="hidden" name="subtotal" value="0">
                  <input type="hidden" name="discount" value="0">
                  <input type="hidden" name="amount" value="0">
                    <div class="col-6">Subtotal</div>
                    <div class="col-6 text-end" id="subtotal"><b>0$</b></div>
                    <div class="col-6">Discount</div>
                    <div class="col-6 text-end"id="discount"><b>0%</b></div>
                    <div class="col-6">Tax </div>
                    <div class="col-6 text-end"><b>5%</b></div>
                    <hr>
                    <div class="col-6"><h3>Total</h3></div>
                    <div class="col-6 text-end"><h3 id="amount"><b>0$</b></h3></div>
                </div>
            </div>
            <button class="btn btn-primary w-100 mt-2 mb-2"><i class="bi bi-cart"></i>Buy</button>
        </div>
      </form>
    </aside>
    <!-- End Sidebar-->
    <p id="totalProduct"></p>
    <main id="main" class="main">
      {{-- <div class="w-50 m-3 float-end">
        <input type="text" placeholder="🔍Search" class="form-control border-2 border-dark">
      </div> --}}
        <div class="row w-100">
            @foreach ($product as $item)
              @php
                  if ($item->currency == 1){
                    if ($exchange->riel > $exchange->dollar)
                      $money = number_format($item->cost / $exchange->rate,2);
                    else
                      $money = number_format($exchange->rate/$item->cost,2);
                  }else{
                    $money = number_format($item->cost,2);
                  }
              @endphp
                <div class="col-md-3 col-sm-6 p-2" style="cursor: pointer" onclick="addPurchaseItem('{{$item->name}}',{{$item->id}},'{{$item->image}}',{{$money}},{{$item->qty}},'purchase')">
                    <div class="w-100 p-2 card text-center">
                        <div class="w-100 bg-secondary p-3 text-center rounded" style="margin: auto">
                            <img src="{{asset('images/'.$item->image)}}" class="w-75">
                        </div>
                        <h4>{{$item->name}}</h4>
                        @if ($item->currency == 1)
                          @if ($exchange->riel > $exchange->dollar)
                            <p>{{number_format($item->cost / $exchange->rate,2)}} <b>$</b></p>
                          @else
                            <p>{{number_format($exchange->rate/$item->cost,2)}} <b>$</b></p>
                          @endif
                        @else
                         <p>{{number_format($item->cost,2)}} <b>$</b></p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>
    <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    
  </body>
</html>

