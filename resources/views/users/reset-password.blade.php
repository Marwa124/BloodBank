@extends('layouts.app')

@inject('user', 'App\User')

@section('page-title')
  تغيير كلمه السر
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

      <h3 class="card-title float-right">تغيير كلمه السر</h3>
      <div class="clearfix"></div>

    </div>
    <div class="card-body text-right">

        {!! Form::model($user, ['route' => 'user.password.save']) !!}
        @csrf
          @include('includes.error-custom')
          <div class="form-group">
            <label for="old-password">كلمه السر الحاليه</label>
            {!! Form::password('old-password', ['class' => 'form-control']); !!}
          </div>
          @yield('old-password')

          <div class="form-group">
            <label for="new-password">كلمه السر الجديده</label>
            {!! Form::password('new-password', ['class' => 'form-control']); !!}
          </div>
          @yield('new-password')
          {!! Form::submit('حفظ', ['class' => 'btn btn-primary']); !!}

          <a href="{{url('home')}}" class="btn btn-danger">الغاء</a>

        {!! Form::close() !!}

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

@endsection




