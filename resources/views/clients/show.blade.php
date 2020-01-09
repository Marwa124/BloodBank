@extends('layouts.app')

@section('page-title')
  العملاء
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">

      <div class="card-tools float-left">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button>
      </div>
      <h3 class="card-title float-right">قائمه العملاء</h3>
      <div class="clearfix"></div>
    </div>
    <div class="card-body text-right">
      <ul class="list-group">
          <li class="list-group-item active font-weight-bold">الأسم: &nbsp; {{$client->name}}</li>
          <li class="list-group-item">الايميل: &nbsp; {{$client->email}}</li>
          <li class="list-group-item">رقم المحمول: &nbsp; {{$client->phone}}</li>
          <li class="list-group-item">تاريخ الميلاد: &nbsp; {{$client->date_of_birth}}</li>
          <li class="list-group-item">تاريخ اخر تبرع: &nbsp; {{$client->last_donation_date}}</li>
          <li class="list-group-item">فصيله الدم: &nbsp; {{$client->bloodType->name}}</li>
          <li class="list-group-item">المدينه: &nbsp; {{$client->city->name}}</li>
          <a href="{{route('client.index')}}" class="btn btn-secondary mt-2 ">الرجوع</a>
        </ul>
    </div>
  </div>
</section>
@endsection
