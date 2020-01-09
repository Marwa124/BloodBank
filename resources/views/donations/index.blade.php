@extends('layouts.app')

@section('page-title')
التبرعات
@endsection

@section('content')
<!-- Main content -->
<section class="content">
  @inject('donation', 'App\Models\DonationRequest')

  <!-- Default box -->
  <div class="card">
    <div class="card-header">

      <div class="card-tools float-left">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fas fa-times"></i></button>
      </div>
      <h3 class="card-title float-right">قائمه التبرعات</h3>
      <div class="clearfix"></div>

    </div>
    <div class="card-body text-right">

      {{-- real Time search --}}
      <div class="col-4 texy-right">
        {{-- {!! Form::open([
        'route' => 'donation.index',
        'method' => 'get'
      ]) !!}
        <div class="form-group input-group-prepend">
          <button type="submit" class="btn btn-info ">بحث</button>
          {!! Form::text('search', null, [
            'class' => 'form-control',
            'placeholder' => 'البحث',
          ]); !!}
        </div>
      {!! Form::close() !!} --}}
      </div>

      @if (count($donations))
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-right">#</th>
              <th class="text-right">الأسم</th>
              <th class="text-center">مشاهده</th>
              <th class="text-center">حذف</th>
            </tr>
          </thead>

          <tbody id="table">
            @foreach ($donations as $donation)
            <tr id="removable{{$donation->id}}">
              <td class="text-right">{{$loop->iteration + $paginate}}</td>
              <td class="text-right">{{$donation->patient_name}}</td>
              <td class="text-center">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-xs show" data-toggle="modal"
                  data-target="#showModalLong" data-route="{{route('donation.show' , $donation->id)}}">
                  <i class="far fa-eye" style="font-size: 16px;"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="showModalLong" tabindex="-1" role="dialog"
                  aria-labelledby="showModalLongTitle" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="showModalLongTitle">Modal title</h5>
                        <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" id="donation">

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                      </div>
                    </div>
                  </div>
                </div>

              </td>
              <td class="text-center">
                <button type="submit" data-token="{{csrf_token()}}"
                  data-route="{{route('donation.destroy', $donation->id)}}" class="btn btn-danger btn-xs destroy">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </td>
            </tr>
            @endforeach

            {{$donations->links()}}

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
