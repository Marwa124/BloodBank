<div class="row">
    <div class="form-group text-right col-12">
    <label for="name">الاسم</label>
    {!! Form::text('name', $value = null, $attributes = [
      'class' => 'form-control'
    ]); !!}
  </div>
  <div class="form-group text-right col-12">
    <label for="email">الايميل</label>
    {!! Form::text('email', $value = null, $attributes = [
      'class' => 'form-control'
    ]); !!}
  </div>
  <div class="form-group text-right col-12">
    <label for="password">كلمه المرور</label>
    {!! Form::password('password', ['class' => 'form-control']) !!}
  </div>
  <div class="form-group text-right col-12">
    <label for="phone">رقم الجوال</label>
    {!! Form::text('phone', $value = null, $attributes = [
      'class' => 'form-control'
    ]); !!}
  </div>
  <div class="form-group text-right col-12">
    <label for="date_of_birth">تاريخ الميلاد</label>
    {!! Form::date('date_of_birth', $value = null, $attributes = [
      'class' => 'form-control'
    ]) !!}
  </div>
  <div class="form-group text-right col-12">
    <label for="last_donation_date">تاريخ اخر تبرع</label>
    {!! Form::date('last_donation_date', $value = null, $attributes = [
      'class' => 'form-control'
    ]) !!}
  </div>
  <div class="form-group text-right col-12" hidden>
    {!! Form::date('created_at', \Carbon\Carbon::now()) !!}
  </div>
</div>
  <div class="row">
  <div class="form-group text-right col-12">
    <label for="blood_type">فصيله الدم</label>

    <div class="form-control" style=" font-size: 1.2rem; height: 3rem;">
      {!! Form::select('blood_type',  $blood_types); !!}
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group text-right col-12">
    <label for="city">المدينه</label>

    <div class="form-control" style=" font-size: 1.2rem; height: 3rem;">
      {!! Form::select('city',  $cities); !!}
    </div>
  </div>
</div>
  <div class="form-group">
    <button class="btn btn-primary" type="submit">حفظ</button>
    <a href="{{url(route('client.index'))}}" class="btn btn-danger">الغاء</a>
  </div>
