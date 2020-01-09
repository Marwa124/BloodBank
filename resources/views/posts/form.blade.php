@inject('categories', 'App\Models\Category')

<div class="text-right">

  <div class="form-group">
    <label for="title">العنوان الرئيسي:</label>
    {!! Form::text('title', $value = null, $attributes = [
      'class' => 'form-control'
    ]); !!}
{{-- @yield('title') --}}
    {{--  @if ($errors->any())
      <div class="alert alert-danger" style="padding:0px 2rem 5px; margin-right:0%;">
        {{ $errors->first('title') }}
      </div>
      <div class="clearfix"></div>
    @endif --}}

  </div>

    <div class="row text-right my-2 pt-2">
      <label for="category">التصنيف </label>
        @foreach ($categories->all() as $category)
        <div class="col-2 text-center">
              <input type="checkbox" name="categories_list[]" value="{{$category->id}}"
                @if ($post->categories->contains($category->id))
                checked
                @endif
              >
              {{$category->name}}
        </div>
        @endforeach
      </div>

  <div class="form-group">
    <label for="content">المحتوي</label>
      {!! Form::textarea('content', $value = null, $attributes = [
        'class' => 'form-control'
      ]); !!}
  </div>
  <div class="form-group">
    <label for="image">الصوره</label>
      {!! Form::file('image', $attributes = [
        'placeholder' => 'اختر صوره',
        'class' => 'form-control w-25',
        'style' => 'height:2.8rem !important;',
  ]); !!}
  </div>
  <div class="form-group">
    <button class="btn btn-primary" type="submit">Save</button>
    <a href="{{url(route('post.index'))}}" class="btn btn-danger">Cancel</a>
  </div>
</div>

