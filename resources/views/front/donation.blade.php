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
    <div class="container">
      <div class="container">
        <div class="selection w-75 d-flex mx-auto my-4">

          {!! Form::open([
          'route' => 'donation.search',
          'method' => 'get'
          ]) !!}

          <div class="row d-flex justify-content-center">
            <div class="col-md-5 col-sm-5">

              {!! Form::select('blood_type', $blood_types->pluck('name', 'id')->toArray(), null, [
              'class' => 'custom-select blood-type',
              'id' => 'blood_type_id',
              'placeholder' => 'اختر فصيلة الدم'
              ]) !!}
            </div>
            <div class="col-md-5 col-sm-5">

              {!! Form::select('governorate', $governorates->pluck('name', 'id')->toArray(), null, [
              'class' => 'custom-select mx-md-3 mx-sm-1 governorate',
              'id' => 'governorate_id',
              'placeholder' => 'اختر المدينة'
              ]) !!}

            </div>

            <div class="col-md-2 col-sm-2">

              {{-- <a href="{{route('donation.search')}}"> --}}
              {{-- </a> --}}
              <button type="submit" class=" btn btn-xs ">
                <i id="search-icon" class="fas fa-search">
                </i>
              </button>
            </div>
          </div>

          {!! Form::close() !!}
        </div>

      </div>
      <!--End selection-->
      @foreach ($donations as $donation)
      <div class="req-item my-3">
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
        {{$donations->links()}}
      </div>

    </div>
    <!--End container-->
  </div>
  <!--End Donation-request-->
</section>
<!--End Donation-->

{{-- @push('scripts')
  <script>
    $(document).on('click', '#search-icon', function(){
      //get governorate
      //send ajax
      //append cities
      var governorate = $('#governorate_id').val();
      var bloodType = $('#blood_type_id').val();
      console.log(bloodType);
      console.log(governorate);
      if(bloodType){
        $.ajax({
          url: '{{url('client/donation-search?blood_type=')}}' + bloodType + 1,
          type: 'get',
          data: {
            blood_type: $(".blood-type").val(),
          },
          success: function(data){
            if(data.status == 1)
            {
              console.log(data.lenght);

              for (var i = 0; i < data.data.length; i++) {
                const element = data.data[i];
                console.log("kjsh " + element);
              }

              // $('.blood-type').html(data.bloodType.name);
              // $('.patient-name').html(data.donation.data.patient_name);
              // $('.hospital-name').html(data.donation);
              // $('.governorate').html(data.governorate.name);
            }
          },
          error: function(x, y, z){
            console.log(x + ' ' + y + ' ' + z);
          }
        });
      }
      if(governorate) {
        $.ajax({
          url: '{{url('client/donation-search?city_id=')}}' + governorate,
          type: 'get',
          data: {
            governorate: $(".governorate").val(),
          },
          success: function(data) {
            if(data.status == 1)
            {
              console.log('done    ' + data);
            }
          },
            error: function(x, y, z){
              console.log(x + ' ' + y + ' ' + z);
            }
        });
      }
    })
  </script>
@endpush --}}

@endsection
