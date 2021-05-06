@extends('admin.index')

@section('content')
<div class="container" style="width: 90%">
  <h3 class="text-center">ویرایش رنگ</h3>
  <hr>

  <div class="row">
    <form class="form-horizontal" method="POST" action="{{ route('colors.update' , ['id' => $color->id ])  }}">
      <fieldset>
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group row">
          <div>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="نام رنگ*"
            value="{{ $color->name }}" autocomplete="name" autofocus
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
          name="colorcode" id="colorcode" value="{{ $color->colorcode }}" autocomplete="colorcode"

          >
          @error('colorcode')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

      </fieldset>

      <button type="submit" class="btn btn-success pull-left edit">ویرایش<i></i></button>
      <a href="{{ route('colors.index') }}" class="btn btn-danger pull-left"
      style="margin-left: 8px;">لغو</a>
    </form>

  </div>


</div>
@endsection