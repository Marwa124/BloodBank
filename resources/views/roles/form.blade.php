@inject('permissions', 'Spatie\Permission\Models\Permission')

<div class="row">
    <div class="form-group text-right col-12">
    <label for="name">الاسم</label>
    {!! Form::text('name', $value = null, $attributes = [
      'class' => 'form-control'
    ]); !!}
  </div>
  <div class="form-group text-right col-12">
    <label for="display_name">الاسم الوظيفي</label>
    {!! Form::text('display_name', $value = null, $attributes = [
      'class' => 'form-control'
    ]); !!}
  </div>
  <div class="form-group text-right col-12">
    <label for="description">الوصف</label>
    {!! Form::textarea('description', $value = null, $attributes = [
      'class' => 'form-control'
    ]); !!}
  </div>
</div>
  <div class="form-group">
    <label for="permissions_list" class="float-right mb-3">الصلاحيات</label>
    <div class="clearfix"></div>

    <div class="text-right mb-1">
      <input id="select-all" type="checkbox">&nbsp;<label for='select-all'>أختيار الكل</label>
    </div>


    <div class="row text-right">
        @foreach ($permissions->all() as $mission)
        <div class="col-3">
            <label>
              <input type="checkbox" name="permissions_list[]" value="{{$mission->id}}"
                @if ($role->hasPermissionTo($mission->name))
                checked
                @endif
              >
              {{$mission->name}}
            </label>
        </div>
        @endforeach
      </div>
  </div>

  <div class="form-group float-right mt-2">
    <button class="btn btn-primary" type="submit">حفظ</button>
      <a href="{{url(route('role.index'))}}" class="btn btn-danger">الغاء</a>
  </div>
<div class="clearfix"></div>

@push('script')

<script>
  $("#select-all").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

});
</script>

@endpush
