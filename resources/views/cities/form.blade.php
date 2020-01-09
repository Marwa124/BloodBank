@inject('governorate', 'App\Models\Governorate')

<div class="row">
    <div class="form-group text-right col-12">
    <label for="name">الاسم</label>
    {!! Form::text('name', $value = null, $attributes = [
      'class' => 'form-control'
    ]); !!}
  </div>
</div>
  <div class="row">
  <div class="form-group text-right col-12">
    <label for="governorate">المحافظه</label>

    <div style=" font-size: 1.2rem; height: 3rem;">
      {!! Form::select('governorate',  $governorate->pluck('name','id')->toArray() ,null,[
        'placeholder' => 'choose',
        'class' => 'form-control w-50'
      ]) !!}
    </div>
  </div>
</div>
  <div class="form-group">
    <button class="btn btn-primary" type="submit">حفظ</button>
    <a href="{{url(route('city.index'))}}" class="btn btn-danger">الغاء</a>
  </div>
