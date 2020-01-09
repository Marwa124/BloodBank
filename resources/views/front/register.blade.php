@extends('front.master')
@section('content')
<div class="container">
  <!--Breadcrumb-->
  <nav class="my-4" aria-label="breadcrumb">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">الرئيسيه</a></li>
          <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
      </ol>
  </nav><!--End Breadcrumb-->
</div><!--End container-->
<section class="signup text-center">
  <div class="container">
      <div class="py-4 mb-4">
          <form action="{{route('client.save')}}" method="POST" class="w-75 m-auto">
            @csrf
              <div><input type="text" name="name" class="form-control my-3" placeholder="الاسم" value="{{ old('name') }}"></div>
              <div><input type="mail" name="email" class="form-control my-3" placeholder="البريد الاليكترونى" value="{{ old('email') }}"></div>
              <div class="input-group">
                  <input type="date"  id="datepicker" name="date_of_birth" class="form-control" placeholder="تاريخ الميلاد">
                  {{-- <i class="far fa-calendar-alt"></i> --}}
              </div>
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

              <input type="text" name="phone" class="form-control my-3" placeholder="رقم الهاتف" value="{{ old('phone') ?? '' }}">
              <div class="input-group mb-3">
                  <input type="date" id="datepicker" name="last_donation_date" class="form-control" placeholder="اخر تاريخ تبرع" aria-label="Username" aria-describedby="basic-addon1">
                  {{-- <i class="far fa-calendar-alt"></i> --}}
              </div>
              <input type="password" name="password" class="form-control my-3" placeholder="كلمة المرور">
              <input type="password" name="password_confirmation" class="form-control my-3" placeholder="تأكيد كلمة المرور">
              <button type="submit" class="btn btn-success py-2 w-50">ارسال</button>
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
    </script>
@endpush
@endsection
