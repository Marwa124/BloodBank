@extends('front.master')
@section('content')
@inject('bloodTypes', 'App\Models\BloodType')
@inject('governorates', 'App\Models\Governorate')

@include('includes.error')
  {!! Form::model($client, [
    'route' => ['notification.save',
      $client->id
    ],
  'method' => 'put'
  ]) !!}

<div class="container">
  <div class="form-group">
    <div class="mb-3 mt-5 alert alert-info">
    <label for="blood_types" class="float-right">فصائل الدم</label>
    <div class="clearfix"></div>
  </div>

    <div class="row text-right">
        @foreach ($bloodTypes->all() as $bloodType)
        <div class="col-3">
          <label>
            {!! Form::checkbox('bloodTypes[]', $bloodType->id, null, [
              'class' => 'ml-1'
            ]) !!}

            {{$bloodType->name}}
          </label>
        </div>
        @endforeach
      </div>

  </div>

  <div class="form-group">
    <div class="mb-3 mt-5 alert alert-info">
      <label for="governorates" class="float-right"> المحافظات</label>
      <div class="clearfix"></div>
    </div>

    <div class="row text-right">
      @foreach ($governorates->all() as $governorate)
      <div class="col-3">
          <label>
            {!! Form::checkbox('governorates[]', $governorate->id, null, [
              'class' => 'ml-1'
            ]) !!}

            {{$governorate->name}}
          </label>
      </div>
      @endforeach
    </div>
  </div>

  <div class="form-group float-right mt-2">
    <button class="btn btn-primary" type="submit">حفظ</button>
  </div>
<div class="clearfix"></div>

</div>
{!! Form::close() !!}

@endsection
