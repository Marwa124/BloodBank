@extends('layouts.app')

@section('page-title')
  الاقسام
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

      <h3 class="card-title float-right">قائمه الاقسام</h3>
      <div class="clearfix"></div>

    </div>
    <div class="card-body">
    <a href="{{route('category.create')}}" class="btn btn-primary mb-4 float-right"><i class="fas fa-plus"></i> &nbsp; أضافه قسم جديد</a>
      <div class="clearfix"></div>

      @if (count($categories))
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr class="text-right">
                <th>#</th>
                <th>الاسم</th>
                <th class="text-center">حذف</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
            <tr class="text-right" id="removable{{$category->id}}">
                <td>{{$loop->iteration}}</td>
                <td>{{$category->name}}</td>
                <td class="text-center">
                  <button id="{{$category->id}}" data-token="{{csrf_token()}}"
                    data-route="{{route('category.destroy', $category->id)}}"
                    class="btn btn-danger destroy btn-xs">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                  {{-- {!! Form::open([
                    'action' => ['CategoryController@destroy', $category->id],
                    'method' => 'delete'
                  ]) !!}
                    <button type="submit" onclick="return confirm('هل انت متأكد?')" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
                  {!! Form::close() !!} --}}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
      <div class="alert alert-danger" role="alert">
        لا توجد بيانات
      </div>
      @endif
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

@endsection
