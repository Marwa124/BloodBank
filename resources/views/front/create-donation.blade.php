@extends('front.master')
@section('content')
<div class="container">
  <!--Breadcrumb-->
  <nav class="my-4" aria-label="breadcrumb">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">الرئيسيه</a></li>
          <li class="breadcrumb-item active" aria-current="page">انشاء طلب تبرع</li>
      </ol>
  </nav><!--End Breadcrumb-->
</div><!--End container-->
<section class="signup text-center">
  <div class="container">
      <div class="py-4 mb-4">
        @include('includes.error')
          <form action="{{route('save.donation')}}" method="POST" class="w-75 m-auto">
            @csrf
            {!! Form::text('patient_name', null, [
              'class' => 'form-control my-3',
              'placeholder' => 'الاسم',
            ]) !!}
            {!! Form::text('patient_age', null, [
              'class' => 'form-control my-3',
              'placeholder' => 'العمر',
            ]) !!}
            {!! Form::text('bags_num', null, [
              'class' => 'form-control my-3',
              'placeholder' => 'عدد الاكياس',
            ]) !!}
            {!! Form::text('hospital_name', null, [
              'class' => 'form-control my-3',
              'placeholder' => 'اسم المستشفي',
            ]) !!}
            {!! Form::text('hospital_address', null, [
              'class' => 'form-control my-3',
              'placeholder' => 'عنوان المستشفي',
            ]) !!}
            {!! Form::text('phone', null, [
              'class' => 'form-control my-3',
              'placeholder' => 'التليفون',
            ]) !!}
            {!! Form::text('notes', null, [
              'class' => 'form-control my-3',
              'placeholder' => 'ملحوظه',
            ]) !!}

              @inject('blood_type', 'App\Models\BloodType')

              {!! Form::select('blood_type_id', $blood_type->pluck('name', 'id')->toArray(), null, [
                'class' => 'form-control my-3',
                'placeholder' => 'فصيلة الدم'
              ]) !!}

              <div class="input-group mb-3">
              @inject('governorate', 'App\Models\Governorate')
              {!! Form::select('governorate_id', $governorate->pluck('name', 'id')->toArray(), null, [
                'class' => 'form-control custom-select py-1',
                'id' => 'capital',
                'placeholder' => 'اختر محافظه'
              ]) !!}
                    <i class="fas fa-chevron-down"></i>
              </div>

              <div class="input-group">

                {!! Form::select('city_id', [], null, [
                  'class' => 'form-control custom-select py-1',
                  'id' => 'city',
                  'placeholder' => 'اختر مدينه'
                ]) !!}

                  <i class="fas fa-chevron-down"></i>
              </div>

              <div style="width: 500px; height: 500px;">
                {!! Mapper::render() !!}
              </div>

              <button type="submit" id="donation-sent" data-route="{{route('save.donation')}}"
                      data-token="{{csrf_token()}}"
                      class="btn btn-success py-2 w-50 mt-5">ارسال</button>
          </form>
      </div>
  </div>
</section>
@push('scripts')
    <script>
      $('#capital').change(function(e){
        e.preventDefault();
        //get governorate
        //send ajax
        //append cities
        var governorate_id = $('#capital').val();
        if(governorate_id)
        {
          $.ajax({
            url: '{{url('api/v1/cities?governorate_id=')}}' + governorate_id,
            type: 'get',
            success: function(data){
              if( data.status == 1 )
              {
                $('#city').empty();
                $('#city').append('<option value="">اختر مدينه</option>');
                $.each(data.data, function(index, city){
                  // data which contains status, message, data
                  $("#city").append('<option value="' + city.id + '">' + city.name + '</option>');
                })
              }
            },
            error: function(jqxhr, status, errorMessage){
              console.log(errorMessage);
            }
          });
        }else {
          $('#city').empty();
          $('#city').append('<option value="">اختر مدينه</option>');
        }
    });

    // $(document).on('click', '#donation-sent', function(e){
    //   e.preventDefault();
    //   console.log("kjdsglkj dnkj hkjshkjlehfdkljg nbk");
    //   var route = $(this).data('route');
    //   var token = $(this).data('token');
    //   $.ajax({
    //     url: route,
    //     type: 'post',
    //     dataType: 'json',
    //     data: {
    //       _token: token,
    //     },
    //     success: function(data){
    //       if(data.status == 1){
    //         console.log(data);
    //       }else{
    //         console.log("sorry");
    //       }
    //     },
    //     error: function(x, y, z){
    //       console.log("Sth wrong");
    //     }
    //   });
    // });
    </script>
@endpush
@endsection
