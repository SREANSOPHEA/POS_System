<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Admin @yield('title')</title>
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet"/>
    @yield('link')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  </head>

  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
      <div class="d-flex align-items-center justify-content-between">
        <a href="/admin" class="logo d-flex align-items-center">
          {{-- <img src="assets/img/logo.png" alt="" /> --}}
          <span class="d-none d-lg-block">Stock Management</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
      </div>
      <!-- End Logo -->

      <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
          {{-- <li class="nav-item dropdown">
            <a class="nav-link nav-icon" style="cursor: pointer" data-bs-toggle="dropdown">
              <i class="bi bi-bell"></i>
              <span class="badge bg-primary badge-number">4</span> 
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
              <li class="dropdown-header">
                You have 4 new notifications
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>

              <li class="notification-item">
                <i class="bi bi-exclamation-circle text-warning"></i>
                <div>
                  <h4>Lorem Ipsum</h4>
                  <p>Quae dolorem earum veritatis oditseno</p>
                  <p>30 min. ago</p>
                </div>
              </li>

              <li>
                <hr class="dropdown-divider" />
              </li>

              <li class="notification-item">
                <i class="bi bi-x-circle text-danger"></i>
                <div>
                  <h4>Atque rerum nesciunt</h4>
                  <p>Quae dolorem earum veritatis oditseno</p>
                  <p>1 hr. ago</p>
                </div>
              </li>
            </ul>
          </li> --}}
          <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="{{asset('images/'.Auth::user()->profile)}}" alt="Profile" class="rounded-circle"/>
              <span class="d-none d-md-block dropdown-toggle ps-2">{{Auth::user()->name}}</span> 
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6>{{Auth::user()->name}}</h6>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="/admin/accountSetting">
                  <i class="bi bi-gear"></i>
                  <span>Account Settings</span>
                </a>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a class="dropdown-item d-flex align-items-center" href="/admin/logout">
                  <i class="bi bi-box-arrow-right"></i>
                  <span>Sign Out</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>
    <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item ">
          <a class="nav-link collapsed" href="/admin">
            <i class="bi bi-bar-chart-fill"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <li class="nav-heading">Properties</li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="/admin/categories">
            <i class="bi bi-tag"></i>
            <span>Categories</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="/admin/units">
            <i class="bi bi-archive-fill"></i>
            <span>Units</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="/admin/currency">
            <i class="bi bi-coin"></i>
            <span>Currency</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="/admin/customer">
            <i class="bi bi-person-fill"></i>
            <span>Customer</span>
          </a>
        </li>

        <li class="nav-heading">Shop</li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="/admin/sale">
            <i class="bi bi-shop"></i>
            <span>Sale</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="/admin/purchase">
            <i class="bi bi-shop"></i>
            <span>Purchase</span>
          </a>
        </li>

        <li class="nav-item" >
          <a class="nav-link collapsed" data-bs-target="#supplier_nav" data-bs-toggle="collapse" style="cursor: pointer">
            <i class="bi bi-box-seam-fill"></i><span>Supplier</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="supplier_nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
              <a href="/admin/supplier">
                <i class="bi bi-circle"></i><span>View Suppliers</span>
              </a>
            </li>
            <li>
              <a href="/admin/add-supplier">
                <i class="bi bi-circle"></i><span>Add Supplier</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item" >
          <a class="nav-link collapsed" data-bs-target="#product_nav" data-bs-toggle="collapse" style="cursor: pointer">
            <i class="bi bi-box-seam-fill"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="product_nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
              <a href="/admin/products">
                <i class="bi bi-circle"></i><span>View Products</span>
              </a>
            </li>
            <li>
              <a href="/admin/add-product">
                <i class="bi bi-circle"></i><span>Add Product</span>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="/admin/stock">
            <i class="bi bi-boxes"></i>
            <span>Stock</span>
          </a>
        </li>

        <li class="nav-item" >
          <a class="nav-link collapsed" data-bs-target="#invoice_nav" data-bs-toggle="collapse" style="cursor: pointer">
            <i class="bi bi-box-seam-fill"></i><span>Invoice</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="invoice_nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li>
              <a href="/admin/invoice-purchase">
                <i class="bi bi-circle"></i><span>Purchase Invoice</span>
              </a>
            </li>
            <li>
              <a href="/admin/invoice-sale">
                <i class="bi bi-circle"></i><span>Sale Invoice</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">
      <div class="pagetitle">
        <h1>@yield('content_Title')</h1>
      </div>
      <!-- End Page Title -->

      <section class="section dashboard">
        @yield('content')
      </section>
    </main>

    <!-- Message Error -->
    @if (session("error"))
      <script>
        $(document).ready(function(){
          swal('Something Went Wrong!','Please Try Again','error');
          speech('Error Please try again');
        })
      </script>
    @endif
    @if (session("exist"))
      <script>
        $(document).ready(function(){
          swal('Please Try Again!','Data already exist','error');
          speech('data already exist');
        })
      </script>
    @endif

    @if (session("insert"))
      <script>
        $(document).ready(function(){
          swal('Congratulation','Data Inserted','success');
          speech('data inserted');
        })
      </script>
    @endif

    @if (session("edit"))
      <script>
        $(document).ready(function(){
          swal('Congratulation','Data Updated','success');
          speech('data edited');
        })
      </script>
    @endif

    @if (session("delete"))
      <script>
        $(document).ready(function(){
          swal('Congratulation','Data Deleted','success');
          speech('data deleted');
        })
      </script>
    @endif

    <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
  </body>
</html>
