@extends('admin.index')

@section('content')
<div class="container" style="width: 90%">
  <h3 class="text-center">افزودن برند</h3>
  <hr>

  <div class="row">
    <form class="form-horizontal" method="POST" action="{{ route('brands.store') }}" enctype="multipart/form-data">
      <fieldset>
        {{ csrf_field() }}
        <div class="form-group row">
          <div>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="نام برند*"
            value="{{ old('name') }}" autocomplete="name" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="form-group row">
          <div>
            <label for="image" class="form-text text-muted">تصویر</label>
            <input type="file" class="form-control" name="image" id="image">
            @error('image')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
      </fieldset>

      <button type="submit" class="btn btn-success pull-left submit">ثبت<i class="fa fa-check"></i></button>
      <a class="btn btn-danger pull-left" href="{{ route('brands.index') }}"
      style="margin-left: 4px;">بازگشت به لیست برند ها </a>

    </form>

  </div>


</div>
@endsection