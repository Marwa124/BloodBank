@extends('layouts.app')

@section('page-title')
  المدن
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
      <h3 class="card-title float-right">قائمه المدن</h3>
      <div class="clearfix"></div>

    </div>
    <div class="card-body text-right">
    <a href="{{route('city.create')}}" class="btn btn-primary mb-4"><i class="fas fa-plus"></i> أضافه مدينه</a>
      @if (count($cities))
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-right">#</th>
                <th class="text-right">الأسم</th>
                <th class="text-center">تعديل</th>
                <th class="text-center">حذف</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($cities as $city)
                <tr>
                  <td class="text-right">{{$loop->index+1}}</td>
                  <td class="text-right">{{$city->name}}</td>
                  <td class="text-center">
                    <a href="{{url('city/' . $city->id . '/edit')}}" class="btn btn-success btn-xs"><i class="fas fa-edit"></i></a>
                  </td>
                  <td class="text-center">
                    {!! Form::open([
                      'action' => ['CityController@destroy', $city->id],
                      'method' => 'delete'
                    ]) !!}
                      <button type="submit" onclick="return confirm('هل انت متأكد؟')" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
      <div class="alert alert-danger" role="alert">
        لا يوجد بيانات
      </div>
      @endif
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

@endsection
