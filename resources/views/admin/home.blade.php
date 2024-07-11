@extends('admin.masterPage')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Products</h5>
                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-box"></i>
                </div>
                <div class="ps-3">
                    <h6>{{$product}} Products</h6>
                    {{-- <span class="text-success small pt-1 fw-bold">8%</span>
                    <span class="text-muted small pt-2 ps-1">increase</span> --}}
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card info-card revenue-card">
            <div class="card-body">
                <h5 class="card-title">Customers</h5>
                <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="ps-3">
                    <h6>{{$customer}} Customers</h6>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-12">
          <input type="hidden" id="warning" value="{{$warning}}">
          <input type="hidden" id="bad" value="{{$bad}}">
          <input type="hidden" id="good" value="{{$good}}">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Product in Stock</h5>
              <div id="barChart"></div>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  var bad = $('#bad').val();
                  var warning = $('#warning').val();
                  var good = $('#good').val();

                  new ApexCharts(document.querySelector("#barChart"), {
                    series: [{
                      data: [bad, warning, good]
                    }],
                    chart: {
                      type: 'bar',
                      height: 350
                    },
                    plotOptions: {
                      bar: {
                        borderRadius: 4,
                        horizontal: true,
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    xaxis: {
                      categories: ['Bad', 'Warning', 'Good'],
                    }
                  }).render();
                });
              </script>
            </div>
          </div>
    </div>
@endsection