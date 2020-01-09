@extends('front.master')

@inject('blood_types', 'App\Models\BloodType')
@inject('governorates', 'App\Models\Governorate')

@section('content')
<div class="container">
  <!--Breadcrumb-->
  <nav class="my-5" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('master')}}">الرئيسيه</a></li>
      <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
    </ol>
  </nav>
</div>
<!--End container-->
<!--Donation-->
<section class="donation">
  <h2 class="text-center"><span class="py-1">طلبات التبرع</span> </h2>
  <hr />
  <div class="donation-request py-5">

    <!--End selection-->
    @foreach ($donationRequests as $donation)
    <div class="req-item my-3 container">
      <div class="row">
        <div class="col-md-9 col-sm-12 clearfix">
          <div class="blood-type m-1 float-right">
            <h3 class="blood-type">{{$donation->bloodType()->first()->name}}</h3>
          </div>
          <div class="mx-3 float-right pt-md-2">
            <p class="patient-name">
              اسم الحالة : {{$donation->patient_name}}
            </p>
            <p class="hospital-name">
              مستشفى : {{$donation->hospital_name}}
            </p>
            <p class="governorate">
              المدينة : {{$donation->city->governorate()->first()->name}}
            </p>
          </div>
        </div>
        <div class="col-md-3 col-sm-12 text-center p-sm-3 pt-md-5">
          <a href="{{route('donation.details', $donation->id)}}" class="btn btn-light px-5 py-3">التفاصيل</a>
        </div>
      </div>
    </div>
    @endforeach

    <div class="row d-flex justify-content-center">
      {{$donationRequests->links()}}
    </div>

  </div>
  <!--End container-->
  </div>
  <!--End Donation-request-->
  @endsection
