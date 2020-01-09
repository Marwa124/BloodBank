@extends('layouts.app')

@section('page-title')
  العملاء
@endsection

@section('content')
<!-- Main content -->
<section class="content">
@inject('client', 'App\Models\Client')

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

      {{-- Wanting search to be real Time --}}
    <div class="col-4 texy-right">
      {!! Form::open([
        'route' => 'client.index',
        'method' => 'get'
      ]) !!}
        <div class="form-group input-group-prepend">
          <button type="submit" class="btn btn-info ">بحث</button>
          {!! Form::text('search', null, [
            'class' => 'form-control',
            'placeholder' => 'البحث',
          ]); !!}
        </div>
      {!! Form::close() !!}
    </div>

      @if (count($clients))
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-right">#</th>
                <th class="text-right">الأسم</th>
                <th class="text-right">مفعل/غير مفعل</th>
                <th class="text-center">مشاهده</th>
                <th class="text-center">حذف</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($clients as $client)
                <tr>
                  <td class="text-right">{{$loop->iteration + $paginate}}</td>
                  <td class="text-right">{{$client->name}}
                  <span>
                    @if ($client['is_active'] == 1)
                        <button disabled class="btn-xs float-left btn-success">مفعل</button>
                    @else
                      <button disabled class="btn-xs float-left btn-warning">غير مفعل</button>
                    @endif
                  </span>
                  </td>
                  <td class="text-right">
                    <form action="{{route('client.update', $client->id)}}" method="post">
                      @csrf
                      @method('put')
                        <button type="submit" class="btn btn-secondary btn-xs" name="is-active" value="{{$client->id}}">
                            تفعيل/ألغاء التفعيل
                          </button>
                    </form>
                  </td>
                      {{-- {!! Form::model($client, [
                        'route' => ['client.index'],
                        'method' => 'get'
                      ]) !!}
                          {!! Form::select('is-active', ['1' => 'مفعل', '0' => 'غير مفعل'],
                            '1')!!}
                      {!! Form::close() !!} --}}

                  <td class="text-center">
                    <a href="{{url('client/' . $client->id)}}" class="btn btn-info btn-xs"><i class="far fa-eye" style="font-size: 16px;"></i></a>
                  </td>
                  <td class="text-center">
                    {!! Form::open([
                      'action' => ['ClientController@destroy', $client->id],
                      'method' => 'delete'
                    ]) !!}
                      <button type="submit" onclick="return confirm('هل انت متأكد؟')" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
                    {!! Form::close() !!}
                  </td>
                </tr>
              @endforeach

              {{$clients->links()}}

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
