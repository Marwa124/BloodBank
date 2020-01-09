<div class="text-right">

  <div class="form-group">
    <label for="name"> الاسم</label>
    {!! Form::text('name', $value = null, $attributes = [
      'class' => 'form-control'
    ]); !!}
  </div>

  <div class="form-group">
    <button class="btn btn-primary" type="submit">حفظ</button>
    <a href="{{url(route('category.index'))}}" class="btn btn-danger">الغاء</a>
  </div>
</div>

