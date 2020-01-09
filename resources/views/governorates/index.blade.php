@extends('layouts.app')

@section('page-title')
  Governorates
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

      <h3 class="card-title float-right">قائمه المحافظات</h3>
      <div class="clearfix"></div>

    </div>
    <div class="card-body">
    <a href="{{route('governorate.create')}}" class="btn btn-primary mb-4 float-right">
      <i class="fas fa-plus"></i> أنشاء محافظه</a>
      <div class="clearfix"></div>
      @if (count($governorates))
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr class="text-right">
                <th>#</th>
                <th>Name</th>
                <th class="text-center">Edit</th>
                <th class="text-center">Delete</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($governorates as $governorate)
                <tr class=" text-right">
                <td>{{$loop->index+1}}</td>
                <td>{{$governorate->name}}</td>
                  <td class="text-center">
                  <a href="{{url('governorate/' . $governorate->id . '/edit')}}"   class="btn btn-success btn-xs"><i class="fas fa-edit"></i></a>
                  </td>
                  <td class="text-center">
                    {!! Form::open([
                      'action' => ['GovernorateController@destroy', $governorate->id],
                      'method' => 'delete'
                    ]) !!}
                      <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
      <div class="alert alert-danger" role="alert">
        No Data
      </div>
      @endif
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

@endsection
