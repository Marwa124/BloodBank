@section('title')
  @if ($errors->any())
  <div class="alert alert-danger" style="padding:0px 2rem 5px; margin-right:0%;">
    {{ $errors->first('title') }}
  </div>
  <div class="clearfix"></div>
  @endif
@endsection

@section('old-password')
  @error('old-password')
  <div class="alert alert-danger" style="padding:0px 2rem 5px; margin-right:0%;">
    {{ $errors->first('old-password') }}
  </div>
  <div class="clearfix"></div>
  @enderror
@endsection

@section('new-password')
  @error('new-password')
  <div class="alert alert-danger" style="padding:0px 2rem 5px; margin-right:0%;">
    {{ $errors->first('new-password') }}
  </div>
  <div class="clearfix"></div>
  @enderror
@endsection
