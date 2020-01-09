@extends('front.master')

<?php $posts = App\Models\Post::paginate(5); ?>

@section('content')
<div class="col-4 texy-right">
    <div class="form-group input-group-prepend">
      <button id="search-btn"><i id="search-icon" class="fas fa-search"></i></button>
      {!! Form::text('search', null, [
        'class' => 'form-control',
        'placeholder' => 'البحث',
      ]); !!}
    </div>
</div>


</div>
<!--End selection-->
@foreach ($posts as $post)
<div class="req-item my-3 container">
<div class="row">
  <div class="col-md-9 col-sm-12 clearfix">
    <img src="{{asset($post->image)}}" class="blood-type m-1 float-right" alt="{{$post->image}}">
    <div class="mx-3 float-right pt-md-2">
      <p class="patient-name">
        اسم المقال : {{$post->title}}
      </p>
      <p class="hospital-name">
        محتوي المقال : <span class="post-content" id="content">{{$post->content}}</span>
      </p>

    </div>
  </div>
  <div class="col-md-3 col-sm-12 text-center p-sm-3 pt-md-5">
    <a href="{{route('post.details', $post->id)}}" class="btn btn-light px-5 py-3">التفاصيل</a>
  </div>
</div>
</div>
@endforeach

<div class="row d-flex justify-content-center mt-3 mb-5">
  {{$posts->links()}}
</div>

@endsection

@push('scripts')
  <script>
    $(document).on('click', '#search-btn', function(){
      var inputSearch = $('input[name="search"]').val();
      $.ajax({
        url: '{{url('client/artical-search?keyword=')}}' + inputSearch,
        type: 'get',
        success: function(data){
          // console.log(data);
            $.each(data.data, function(i, val){
                console.log(JSON.stringify(val, null, 4));
                var a =JSON.stringify(val);
                for (var i in a){
                  console.log(i.title);
              }
              // console.log(val);
              // console.log(JSON.parse(val));
            });
            // $('img').attr('src', '');
            // $('.patient-name').html('data.title');
            // $('.hospital-name').html('');
            $('img').attr('src', data.image);
            $('.patient-name').html(data.title);
            $('.hospital-name').html(data.content);
        },
        error: function(x, y, z){
          console.log(x + ' ' + y + ' ' + z);
        }
      });
    });


    const postDetails = document.querySelector('span');
    // const url = 'client/post-details';
    const config = {
      char: '...readMore'
    }
    shave($('#content'), 3, config);
    // $('#content').shave(3, { classname: 'post-content', character: '... <a href=" {{route('post.details', $post->id)}} ">Read More</a>'  });
  </script>
@endpush
