@extends('layouts.app')

@inject('client', 'App\Models\Client')
@inject('donation', 'App\Models\DonationRequest')

@section('page-title')
  Dashboard
@endsection
@section('small-title')
  Statistics
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Clients</span>
        <span class="info-box-number">
          {{$client->count()}}
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-chart-line"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Donation Requests</span>
          <span class="info-box-number">
            {{$donation->count()}}
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
  </div>

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title float-right">Title</h3>

      <div class="card-tools float-left">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="card-body text-right">

      @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
      @endif
      You are logged in!

    </div>
    <!-- /.card-body -->
    <div class="card-footer text-right">
      Footer
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

@endsection

