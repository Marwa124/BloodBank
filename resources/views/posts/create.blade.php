@extends('layouts.app')

@inject('post', 'App\Models\Post')

@section('page-title')
  انشاء مقال
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

      <h3 class="card-title float-right">انشاء مقال</h3>
      <div class="clearfix"></div>

    </div>
    <div class="card-body">
      @include('includes.error')
      {!! Form::model($post, ['route' => 'post.store', 'files' => true]) !!}
        @include('includes.error-custom')
        @include('posts.form')
      {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

@endsection

