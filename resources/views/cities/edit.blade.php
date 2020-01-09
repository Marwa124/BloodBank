@extends('layouts.app')

@section('page-title')
تعديل المدينه
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header d-flex justify-content-end">
      <h3 class="card-title ml-auto">تعديل المدينه</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button>
      </div>
    </div>
    <div class="card-body">
      @include('includes.error')
      {!! Form::model($city, [
        'action' => ['CityController@update',
        $city->id
        ],
      'method' => 'put'
      ]) !!}
        @include('cities.form')
      {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

@endsection

