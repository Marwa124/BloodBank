 @extends('layouts.app')

@section('page-title')
الاعدادات
@endsection

<?php $setting = App\Models\Setting::first();?>

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

      <h3 class="card-title float-right">الاعدادات </h3>
      <div class="clearfix"></div>

      <div class="card-body text-right">
        <ul class="list-group" id="edit-list{{$setting->id}}">
          <li class="list-group-item active font-weight-bold">النص: &nbsp; <span
              class="text">{{$setting->notification_setting_text}}</span></li>
          <li class="list-group-item">عن التطبيق: &nbsp; <span class="about-app">{{$setting->about_app}}</span></li>
          <li class="list-group-item"> التليفون: &nbsp; <span class="phone">{{$setting->phone}}</span></li>
          <li class="list-group-item"> الايميل: &nbsp; <span class="email">{{$setting->email}}</span></li>
          <li class="list-group-item"> فيسبوك: &nbsp; <span class="fb-link">{{$setting->fb_link}}</span></li>
          <li class="list-group-item"> يوتيوب: &nbsp; <span class="yb-link">{{$setting->youtuble_link}}</span></li>
          <li class="list-group-item"> انستيجرام: &nbsp; <span class="insta-link">{{$setting->insta_link}}</span></li>
          <li class="list-group-item"> بلاي ستور: &nbsp; <span class="play-link">{{$setting->play_store_link}}</span>
          </li>
          <li class="list-group-item"> ابليكيشن ستور: &nbsp; <span class="app-link">{{$setting->app_store_link}}</span>
          </li>
          <li class="list-group-item d-flex justify-content-start"> ابليكيشن ستور: &nbsp; <img class=" img-thumbnail img-lg" src="{{asset($setting->app_logo)}}" alt="app logo"
              class="app=logo">

              <button class="btn text-primary" data-toggle="modal" data-target="#imageModal">تعديل</button>
              {!! Form::model($setting, [
                'action' => ['SettingController@update',
                  $setting->id
                ],
              'method' => 'patch',
              'files' => true
              ]) !!}
              <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="imageModalLabel">تعديل الصوره</h5>
                      <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="image">
                        <div class="form-group text-right">
                          <label for="image">الصوره</label>
                            {!! Form::file('image', $attributes = [
                              'placeholder' => '{{$setting->app_logo}}',
                              'class' => 'form-control w-25 image',
                              'style' => 'height:2.8rem !important;',
                            ]); !!}
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">حفظ</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    </div>
                  </div>
                </div>
              </div>
              {!! Form::close() !!}

          </li>

          {{-- <li class="list-group-item">الصوره:
              <br><img src="{{asset($setting->app_logo)}}" class=" img-thumbnail">
          </li> --}}

          <!-- Button trigger modal -->
          <button class="btn btn-info" type="button" data-toggle="modal" data-target="#editModalLong">تعديل</button>

      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModalLong" tabindex="-1" role="dialog" aria-labelledby="editModalLongTitle"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLongTitle">Modal title</h5>
            <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            {!! Form::model($setting, [
              'id' => 'frmEditTask',
              'files' => true
            ]) !!}

              {!! Form::text('notification_setting_text', null, [
                'class' => 'form-control',
                'placeholder' => '{{$setting->notification_setting_text}}'
              ]) !!}

              {!! Form::textarea('about-app', null, [
                'class' => 'form-control',
                'placeholder' => '{{$setting->about_app}}'
              ]) !!}

              {!! Form::text('phone', null, [
                'class' => 'form-control',
                'placeholder' => '{{$setting->phone}}'
              ]) !!}

              {!! Form::text('email', null, [
                'class' => 'form-control',
                'placeholder' => '{{$setting->email}}'
              ]) !!}

              {!! Form::text('fb_link', null, [
                'class' => 'form-control',
                'placeholder' => '{{$setting->fb_link}}'
              ]) !!}

              {!! Form::text('tw_link', null, [
                'class' => 'form-control',
                'placeholder' => '{{$setting->tw_link}}'
              ]) !!}

              {!! Form::text('youtuble_link', null, [
                'class' => 'form-control',
                'placeholder' => '{{$setting->youtuble_link}}'
              ]) !!}

              {!! Form::text('insta_link', null, [
                'class' => 'form-control',
                'placeholder' => '{{$setting->insta_link}}'
              ]) !!}

              {!! Form::text('play_store_link', null, [
                'class' => 'form-control',
                'placeholder' => '{{$setting->play_store_link}}'
              ]) !!}

              {!! Form::text('app_store_link', null, [
                'class' => 'form-control',
                'placeholder' => '{{$setting->app_store_link}}'
              ]) !!}

            {!! Form::close() !!}

            {{-- <form id="frmEditTask">
              <div class="form-group">
                <input type="text" class="form-control" name="notification_setting_text"
                  placeholder="{{$setting->notification_setting_text}}">
              </div>
              <div class="form-group">
                <textarea placeholder="{{$setting->about_app}}" class="form-control" name="about-app"></textarea>
              </div>
              <div class="form-group">
                <input class="form-control" name="phone" placeholder="{{$setting->phone}}">
              </div>
              <div class="form-group">
                <input class="form-control" name="email" placeholder="{{$setting->email}}">
              </div>
              <div class="form-group">
                <input class="form-control" name="fb_link" placeholder="{{$setting->fb_link}}">
              </div>
              <div class="form-group">
                <input class="form-control" name="tw_link" placeholder="تويتر">
              </div>
              <div class="form-group">
                <input class="form-control" name="youtuble_link" placeholder="يوتيوب">
              </div>
              <div class="form-group">
                <input class="form-control" name="insta_link" placeholder="انستيجرام">
              </div>
              <div class="form-group">
                <input class="form-control" name="play_store_link" placeholder="بلاي ستور">
              </div>
              <div class="form-group">
                <input class="form-control" name="app_store_link" placeholder="ابليكيشن ستور">
              </div>

            </form> --}}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary save-edit" id="{{$setting->id}}"
              data-route="{{route('setting.update', $setting->id)}}" data-token="{{csrf_token()}}" enctype="multipart/form-data">حفظ التعديل</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
          </div>
        </div>
      </div>
    </div>

    </ul>

  </div>
  <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->

@push('script')
    <script>

    $(document).on('click', '.save-edit', function(){
      var route = $(this).data('route');
      var token = $(this).data('token');
      $.ajax({
        url: route,
        type: 'post',
        data: {
          _method: 'patch',
          _token: token,
          // Save the input value in the database
          notification_setting_text: $("#frmEditTask input[name=notification_setting_text]").val(),
          about_app: $("#frmEditTask textarea[name=about-app]").val(),
          /* app_logo: $("#image input[name=image]").val(), */
          phone: $("#frmEditTask input[name=phone]").val(),
          email: $("#frmEditTask input[name=email]").val(),
          fb_link: $("#frmEditTask input[name=fb_link]").val(),
          insta_link: $("#frmEditTask input[name=insta_link]").val(),
          youtuble_link: $("#frmEditTask input[name=youtuble_link]").val(),
          play_store_link: $("#frmEditTask input[name=play_store_link]").val(),
          app_store_link: $("#frmEditTask input[name=app_store_link]").val(),
        },
        dataType: 'json',
        success: function(data){
          console.log(data);
          if(data.status == 1){
            // Update the values in the form with New data
            $('.text').html(data.setting.notification_setting_text);
            $('.about-app').html(data.setting.about_app);
            /* $('.image').html(data.setting.app_logo); */
            $('.phone').html(data.setting.phone);
            $('.email').html(data.setting.email);
            $('.fb-link').html(data.setting.fb_link);
            $('.insta-link').html(data.setting.insta_link);
            $('.yb-link').html(data.setting.youtuble_link);
            $('.play-link').html(data.setting.play_store_link);
            $('.app-link').html(data.setting.app_store_link);
            $('#editModalLong').modal('toggle');
          }else {
            console.log("error");
            swalWithBootstrapButtons.fire(
              'Error',
              data.message,
              'error'
            );
          }
        },
        error: function(x, y, z){
          console.log(y + " " + z);
        }
      });
    });

    // $('input').keypress(function (e) {
    //   if (e.which == 13) {
    // $('#frmEditTask').submit();
    // return false;    //<---- Add this line
    //   }
    // });

    </script>
@endpush

@endsection
 --}}
