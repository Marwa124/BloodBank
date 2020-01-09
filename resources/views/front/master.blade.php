<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--bootstrap file css-->
  <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
  <!--Plugins file css-->
  <link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
  <link rel="stylesheet" href="{{asset('front/css/slick-theme.css')}}">
{{--   <link rel="stylesheet" href="{{asset('front/css/jquery-nao-calendar.css')}}"> --}}
  <!--google-font-->
  <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&display=swap" rel="stylesheet">
  <!--main file css-->
  <link rel="stylesheet" href="{{asset('front/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
  <style>
    .fa-heart-alt{
      color: red;
      background-color: red;
    }
    select.form-control:not([size]):not([multiple]){
      height: 0% !important;
    }
  </style>
  <title>بنك الدم</title>
</head>

<body>
  <!--Loading Page-->
  <div class="loading-page">
    <div class="spinner">
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
  </div>
  <!--header section-->
  <section class="header">
    <!--top-bar-->
    <div class="top-bar py-2">
      <div class="container">
        <!--row of top-bar-->
        <div class="d-flex justify-content-between">
          <div>
            <a href="index.html" class="ar px-1">عربى</a>
            <a href="" class="en px-1">EN</a>
          </div>
          <div>
            <ul class="list-unstyled">
            <li class="d-inline-block mx-2"><a class="facebook" href="{{$setting->fb_link}}" target=" _blank"><i class="fab fa-facebook-f"></i></a></li>
              <li class="d-inline-block mx-2"><a class="insta" href="{{$setting->insta_link}}" target=" _blank"><i class="fab fa-instagram"></i></a></li>
              <li class="d-inline-block mx-2"><a class="twitter" href="{{$setting->tw_link}}" target=" _blank"><i class="fab fa-twitter"></i></a></li>
              <li class="d-inline-block mx-2"><a class="whatsapp" href="{{$setting->phone}}" target=" _blank"><i class="fab fa-whatsapp"></i></a></li>
            </ul>
          </div>
          @if (auth('client')->user())
          <div class="connect">
            <div class="dropdown">
              <a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span> مرحبا بك </span> &nbsp; &nbsp;{{auth()->guard('client')->user()->name}}
              </a>
              <div class="dropdown-menu text-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('master')}}"> <i class="fas fa-home ml-2"></i>الرئيسيه</a>
                <a class="dropdown-item" href="#"> <i class="fas fa-user-alt ml-2"></i>معلوماتى</a>
                <a class="dropdown-item" href="{{route('client.donation', auth('client')->user()->id)}}">
                  <i class="fas fa-bell ml-2"></i> الاشعارات
                  <span class="badge badge-pill badge-danger rounded-circle">{{$notificationCount}}</span>
                </a>
                <a class="dropdown-item" href="{{route('notification.setting', auth('client')->user()->id)}}">
                  <i class="fas fa-bell ml-2"></i>اعدادات الاشعارات
                </a>
                <a class="dropdown-item" href="{{route('favorate.post')}}"> <i class="far fa-heart ml-2"></i>المفضلة</a>
                <a class="dropdown-item" href="{{route('create.donation')}}"> <i class="far fa-comments ml-2"></i>أنشاءطلب تبرع</a>
                <a class="dropdown-item" href="contact.html"> <i class="fas fa-phone ml-2"></i>تواصل
                  معنا</a>
                <a class="dropdown-item" href="{{url('client/client-logout')}}" method="get">@csrf <i class="fas fa-sign-out-alt ml-2"></i>خروج</a>
              </div>
            </div>
          </div>
          @endif
        </div>
        <!--End row-->
      </div>
      <!--End container-->
    </div>
    <!--End top-bar-->
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="{{asset('front/imgs/logo.png')}}" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="{{route('master')}}">الرئيسيه <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">عن بنك الدم</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('posts')}}">المقالات</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('donation')}}">طلبات التبرع</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('about')}}">من نحن</a>
            </li>
            <li class="nav-item cont">
              <a class="nav-link" href="contact.html">اتصل بنا</a>
            </li>
            @if (!auth()->guard('client')->check())
            <li class="mr-lg-auto"><a class="signin" href="{{route('client.register')}}">انشاء حساب جديد</a></li>
            <li class="pr-3"><a class="btn bg" href="{{route('client.login')}}">الدخول</a></li>
            @endif
          </ul>
        </div>
      </div>
      <!--End container-->
    </nav>
    <!--End Nav-->
    @yield('header')
  </section>
  <!--End Header-->

  @yield('content')

    <!--Footer-->
    <footer>
      <div class="main-footer py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-4  offset-1">
              <img src="{{asset('front/imgs/logo.png')}}" alt="">
              <h5 class="my-3">بنك الدم</h5>
              <p class="pl-4"> هذا النص هو مثال لنص ممكن أن يستبدل فى نفس المساحه, لقد تم توليد
                هذا النص من مولد النص العرب حيث يمكنك ان تولد هذا النص أو
                العديد من النصوص الأخرى وإضافة الى زيادة عدد الحروف التى يولدها التطبيق يطلع على صورة حقيقة
                لتطبيق
                الموقع
              </p>
            </div>
            <div class="col-md-3">
              <h6 class="">الرئيسية</h6>
              <ul class="list-unstyled">
                <li class="py-2"><a href="">عن بنك الدم</a></li>
                <li class="py-2"><a href="article-details.html">المقالات</a></li>
                <li class="py-2"><a href="donation.html">عن التبرع</a></li>
                <li class="py-2"><a href="about-us.html">من نحن</a></li>
                <li class="py-2"><a href="contact.html">اتصل بنا</a></li>
              </ul>
            </div>
            <div class="col-md-4 available">
              <h6 class="mb-5">متوفر على</h6>
              <div class="my-3"><img src="{{asset('front/imgs/google1.png')}}" alt=""></div>
              <div class="my-3"><img src="{{asset('front/imgs/ios1.png')}}" alt=""></div>
            </div>
          </div>
        </div>
        <!--End container-->
      </div>
      <!--End main-footer-->
      <div class="copyright">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <ul class="list-unstyled">
                <li class="d-inline-block mx-2"><a class="facebook" href=""><i class="fab fa-facebook-f"></i></a></li>
                <li class="d-inline-block mx-2"><a class="insta" href=""><i class="fab fa-instagram"></i></a></li>
                <li class="d-inline-block mx-2"><a class="twitter" href=""><i class="fab fa-twitter"></i></a></li>
                <li class="d-inline-block mx-2"><a class="whatsapp" href=""><i class="fab fa-whatsapp"></i></a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <p class="text-center">جميع الحقوق محفوظه لـ <span>بنك الدم</span> &copy; 2019</p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!--End Footer-->
    <!--scrollUp-->
    <div class="scrollUp">
      <i class="fas fa-chevron-up"></i>
    </div>
    <!--jquery/bootstrap/main file js-->
    <script src="{{asset('front/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('front/js/slick.min.js')}}"></script>
    <script src="{{asset('front/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('front/js/popper.min.js')}}"></script>
    <script src="{{asset('front/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('front/js/main.js')}}"></script>
    <script src="{{asset('front/js/shave.js')}}"></script>
    <script src="{{asset('front/js/jquery.shave.js')}}"></script>
    <script async defer
    src="https://www.google.com/maps/embed/v1/MODE?key=AIzaSyB7nQsHdCPEljJh6MYKIfcQwQHze2bMu-E"></script>

    <script>
      var request = new XMLHttpRequest();
      var url = "https://cors-anywhere.herokuapp.com/" +
        "http://ipda3-tech.com/blood-bank/api/v1/donation-requests?api_token=W4mx3VMIWetLcvEcyF554CfxjZHwdtQldbdlCl2XAaBTDIpNjKO1f7CHuwKl&page=1";
      request.open('GET', url);
      request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var dataHolder = JSON.parse(this.responseText);
          var div = document.getElementById('donations');
          var temp = "";
          for (var i = 0; i < dataHolder['data'].data.length; i++) {
            temp +=
              '<div class="req-item my-3"><div class="row"><div class="col-md-9 col-sm-12 clearfix"><div class="blood-type m-1 float-right"><h3>' +
              dataHolder['data'].data[i].blood_type.name +
              '</h3></div><div class="mx-3 float-right pt-md-2"><p>اسم الحالة : ' + dataHolder['data'].data[i]
              .patient_name + '</p><p>مستشفى : ' + dataHolder['data'].data[i].hospital_name + '</p><p>المدينة : ' +
              dataHolder['data'].data[i].city.name +
              '</p></div></div><div class="col-md-3 col-sm-12 text-center p-sm-3 pt-md-5"><a href="Status-detailes.html" class="btn btn-light px-5 py-3">التفاصيل</a></div></div></div>';
          }
          div.innerHTML = temp;
          // console.log(dataHolder);
        }
      };
      request.send();
    </script>
    @include('sweetalert::alert')

    @stack('scripts')
  </body>

  </html>
