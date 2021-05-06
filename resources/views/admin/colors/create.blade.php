@extends('admin.index')

@section('content')
<div class="container" style="width: 90%">
  <h3 class="text-center">افزودن رنگ محصولات</h3>
  <hr>

  <div class="row">
    <form class="form-horizontal" method="POST" action="{{ route('colors.store') }}">
      <fieldset>
        {{ csrf_field() }}
        <div class="form-group row">
          <div>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="نام رنگ*"
             value="{{ old('name') }}" autocomplete="name" autofocus
            >
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row" style="position: relative;">
          <label class="form-control color_label" for="colorcode">
            کد رنگ
          </label>
          <input type="color" class="form-control color_picker @error('colorcode') is-invalid @enderror" style="width: 10%"
          name="colorcode" id="colorcode" value="{{ old('colorcode') }}" autocomplete="colorcode"

          >
          @error('colorcode')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

      </fieldset>

      <button type="submit" class="btn btn-success pull-left submit">ثبت<i class="fa fa-check"></i></button>
      <a class="btn btn-danger pull-left" href="{{ route('colors.index') }}"
      style="margin-left: 4px;">لیست رنگ ها</a>

    </form>

  </div>


</div>
@endsection