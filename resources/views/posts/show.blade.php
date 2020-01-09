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
      <h3 class="card-title float-right">تفاصيل المقال</h3>
      <div class="clearfix"></div>
    </div>
    <div class="card-body text-right">
      <ul class="list-group">
          <li class="list-group-item active font-weight-bold">العنوان : &nbsp; {{$post->title}}</li>
          <li class="list-group-item">التصنيف:
            @foreach ($categories as $category)
              &nbsp;/ {{$category}}
            @endforeach
          </li>
          <li class="list-group-item">المحتوي: &nbsp; {{$post->content}}</li>
          <li class="list-group-item">الصوره:
            <br><img src="{{asset( $post->image)}}" alt="{{$post->title}}" class=" img-thumbnail">
          </li>

          <a href="{{route('post.index')}}" class="btn btn-secondary mt-2 ">الرجوع</a>
        </ul>
    </div>
  </div>
</section>
@endsection
