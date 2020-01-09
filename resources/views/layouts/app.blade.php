<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  {{-- <title>{{env('APP_NAME'), 'Laravel'}}</title> --}}
  <title>@yield('page-title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('adminlte/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .nav-link {
      right: -2rem;
    }

    select {
      padding-bottom: 10px !important;
    }
  </style>
  @stack('css')
  @yield('extra-css')
</head>

<body class="hold-transition sidebar-mini">

  <!-- Site wrapper -->
  <div class="wrapper" id="app">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-info ml-auto" style="margin-left:0% !important;">

      <!-- Left navbar links -->
      <ul class="navbar-nav" style="margin-right: 250px !important;">
        <li class="nav-item">
          <a class="nav-link text-white" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../../index3.html" class="nav-link text-white">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link text-white">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav text-white mr-auto">
        <!-- Authentication Links -->
        @guest
        <li class="nav-item">
          <a class="nav-link text-white float-right" href="{{ route('login') }}">{{ __('تسجيل الدخول') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link text-white float-right" href="{{ route('register') }}">{{ __('أنشاء حساب') }}</a>
        </li>
        @endif
        @else

        {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form> --}}

        <div class="image d-inline nav-link" style="padding: 0.2rem 1rem;">
          {{ Auth::user()->name }} <span class="caret"></span>
          <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle elevation-2 mr-2"
            style="height: auto; width: 2.1rem;" alt="User Image">
        </div>

        {{-- <a class="nav-link text-white" href="{{url('login')}}">
          <i class="fas fa-sign-out-alt"></i>
          logout
        </a> --}}

        <li>
          <script type="">
              function submitSignout() {
                  document.getElementById('signoutForm').submit();

              }
          </script>
          {!! Form::open(['method' => 'post', 'url' => url('logout'),'id'=>'signoutForm']) !!}

          {!! Form::close() !!}

        <a href="#" onclick="submitSignout()">
              <i class="fa fa-sign-out"></i> تسجيل الخروج
          </a>
      </li>
        @endguest
      </ul>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4"
      style="box-shadow: 0 1px 2px rgba(0,0,0,.25),0 30px 1px rgba(0,0,0,.22)!important">
      <!-- Brand Logo -->
      <a href="{{url('/home')}}" class="brand-link navbar-info">
        <img src="{{asset('adminlte/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light font-weight-bold text-white">تطبيق بنك
          <span class=" font-weight-light">الدم</span>
        </span>
      </a>

      @auth
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column text-right" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="{{route('governorate.index')}}" class="nav-link">
                <p>
                  <i class="nav-icon fas fa-map-marker-alt"></i>
                  المحافظات
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('city.index')}}" class="nav-link">
                <p>
                  <i class="nav-icon fas fa-flag"></i>
                  المدن
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('category.index')}}" class="nav-link">
                <p>
                  <i class="nav-icon fas fa-list"></i>
                  الأقسام
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('post.index')}}" class="nav-link">
                <p>
                  <i class="nav-icon fas fa-comment"></i>
                  المقالات
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('client.index')}}" class="nav-link">
                <p>
                  <i class="nav-icon fas fa-users"></i>
                  العملاء
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('donation.index')}}" class="nav-link">
                <p>
                  <i class="nav-icon fas fa-heart"></i>
                  التبرعات
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('city.index')}}" class="nav-link">
                <p>
                  <i class="nav-icon fas fa-phone"></i>
                  تواصل معنا
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('user.password')}}" class="nav-link">
                <p>
                  <i class="nav-icon fas fa-key"></i>
                  تغيير كلمه المرور
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('setting.index')}}" class="nav-link">
                <p>
                  <i class="nav-icon fas fa-cogs"></i>
                  الاعدادات
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('user.index')}}" class="nav-link">
                <p>
                  <i class="nav-icon fas fa-cogs"></i>
                  المستخدمين
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('role.index')}}" class="nav-link">
                <p>
                  <i class="nav-icon fas fa-cogs"></i>
                  رتب المستخدمين
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
      @endauth
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-left:0% !important; padding-right:15.6rem!important;">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="float-right">
                @yield('page-title')
                <small>
                  @yield('small-title')
                </small>
              </h1>
            </div>
            <div class="col-sm-6 d-flex justify-content-end ">
              <ol class="breadcrumb float-sm-right ">
                <li class="breadcrumb-item"><a href="url{{'/home'}}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.0.1
      </div>
      <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('adminlte/js/adminlte.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{asset('adminlte/js/demo.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  @include('sweetalert::alert')

  <script>
    $(document).on('click', '.destroy', function() {
      var route = $(this).data('route');
      var token = $(this).data('token');
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: route,
            type: 'post',
            data: {
              _method: 'delete',
              _token: token
            },
            dataType: 'json',
            success: function(data) {
              console.log(data);
              if (data.status === 0) {
                console.log("error");
                swalWithBootstrapButtons.fire(
                  'Error',
                  data.message,
                  'error'
                );
              } else {
                console.log("success");
                $("#removable" + data.id).remove();
                swalWithBootstrapButtons.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                );
              }
            }
          });
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your imaginary file is safe :)',
            'error'
          )
        }
      });
    });
    $(document).on('click', '.show', function() {
      var route = $(this).data('route');
      $.ajax({
        url: route,
        type: 'get',
        success: function(data) {
          $('#donation').html(data);
        },
        error: function(x, y, z) {
          console.log(y + " " + z);
        }
      });
    });

  </script>

  @stack('script')

</body>

</html>
