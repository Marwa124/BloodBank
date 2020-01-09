@extends('layouts.app')

@section('page-title')
  المستخدمين
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

      <h3 class="card-title float-right">قائمه المستخدمين</h3>
      <div class="clearfix"></div>

    </div>
    <div class="card-body">
    <a href="{{route('user.create')}}" class="btn btn-primary mb-4 float-right"><i class="fas fa-plus"></i> &nbsp;  مستخدم جديد</a>
      <div class="clearfix"></div>

      @if (count($users))
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr class="text-right">
                <th>#</th>
                <th>الاسم</th>
                <th>الرتبه</th>
                <th class="text-center">تعديل</th>
                <th class="text-center">حذف</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr class="text-right">
                <td>{{$loop->iteration}}</td>
                <td>{{$user->name}}</td>
                <td class=" font-weight-bold">
                  @foreach ($user->getRoleNames() as $user_roles)
                    {{$user_roles}}/
                  @endforeach
                </td>
                <td class="text-center">
                  <a href="{{route('user.edit', $user->id)}}" class="btn btn-success btn-xs"><i class="fas fa-edit"></i></a>
                </td>
                <td class="text-center">
                  {!! Form::open([
                    'action' => ['UserController@destroy', $user->id],
                    'method' => 'delete'
                  ]) !!}
                    <button type="submit" onclick="return confirm('هل انت متأكد?')" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
                  {!! Form::close() !!}
                </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{$users->links()}}
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
