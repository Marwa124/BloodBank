  <div class="form-group">
    <label for="name">Name</label>
    {!! Form::text('name', $value = null, $attributes = [
      'class' => 'form-control'
    ]); !!}
  </div>
  <div class="form-group">
    <button class="btn btn-primary" type="submit">Save</button>
    <a href="{{url(route('governorate.index'))}}" class="btn btn-danger">Cancel</a>
  </div>
