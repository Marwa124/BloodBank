@extends('layouts.app')

@section('page-title')
  المقالات
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

      <h3 class="card-title float-right">قائمه المقالات</h3>
      <div class="clearfix"></div>

    </div>
    <div class="card-body">
    <a href="{{route('post.create')}}" class="btn btn-primary mb-4 float-right btn-sm"><i class="fas fa-plus"></i> &nbsp; أضافه مقال جديد</a>

    <button type="submit" id="delete-all" data-token="{{csrf_token()}}"
            data-route="{{route('delete.all.post')}}"
            class="btn btn-danger float-right mr-2 btn-sm">@method('delete')حذف الكل</button>

    <div class="clearfix"></div>

      @if (count($posts))
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr class="text-right">
                <th width="50px"><input type="checkbox" id="select-all"></th>
                <th width="80px">No</th>
                <th>Name</th>
                <th class="text-center">مشاهده</th>
                <th class="text-center">تعديل</th>
                <th class="text-center">حذف</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
                <tr class="text-right" id="tr_{{$post->id}}">
                <td><input type="checkbox" name="delete-id" value="{{$post->id}}" class="sub_chk" data-id="{{$post->id}}"></td>
                <td>{{$loop->iteration + $paginate}}</td>
                <td>{{$post->title}}</td>
                <td class="text-center">
                  <a href="{{route('post.show' , $post->id)}}" class="btn btn-info btn-xs"><i class="fas fa-eye" style="font-size: 16px;"></i></a>
                </td>
                <td class="text-center">
                  <a href="{{route('post.edit' , $post->id)}}" class="btn btn-success btn-xs"><i class="fas fa-edit"></i></a>
                </td>
                <td class="text-center">
                  {!! Form::open([
                    'action' => ['PostController@destroy', $post->id],
                    'method' => 'delete'
                  ]) !!}
                    <button type="submit" onclick="return confirm('هل انت متأكد?')" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button>
                  {!! Form::close() !!}
                </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{$posts->links()}}
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

@push('script')
<script>
$("#select-all").click(function(){
  $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
});
$('#delete-all').on('click', function(e) {
  var allVals = [];
  var token = $(this).data('token');
  $(".sub_chk:checked").each(function() {
    allVals.push($(this).attr('data-id'));
  });
  console.log(allVals);
  if(allVals.length <=0)
  {
      alert("Please select row.");
  } else {
    var check = confirm("Are you sure you want to delete this row?");
    if(check == true){
      var join_selected_values = allVals.join(",");

      $.ajax({
        url: $(this).data('route'),
        type: 'delete',
        // headers: $(this).data('token'),
        data: {
          _token: token,
          ids: 'ids='+join_selected_values
        },
        success: function (data) {
          console.log(data.status);
          // console.log($.parseJSON(data));
            if (data.status == 1) {
                $(".sub_chk:checked").each(function() {
                    $(this).parents("tr").remove();
                });
                alert(data['success']);
            } else if (data['error']) {
                alert(data['error']);
            } else {
                alert('Whoops Something went wrong!!');
            }
        },
        error: function (data) {
            alert(data.responseText);
        }
    });

    $.each(allVals, function( index, value ) {
        $('table tr').filter("[data-row-id='" + value + "']").remove();
    });

    }
  }
});
</script>
@endpush

@endsection
