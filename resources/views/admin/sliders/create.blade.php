@extends('admin.index')

@section('content')
<div class="container" style="width: 90%">
  <h3 class="text-center">افزودن اسلایدر</h3>
  <hr>

  <div class="row">
    <form class="form-horizontal" method="POST" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
      <fieldset>
        {{ csrf_field() }}
        <div class="form-group row">
          <div>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="نام اسلاید*"
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
            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" placeholder="لینک اسلاید*"
             value="{{ old('url') }}" autocomplete="url" autofocus>
            @error('url')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="form-group row">
          <div>
            <input type="file" accept=".png, .jpeg" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="تصویر اسلاید*"
             value="{{ old('image') }}" autocomplete="image" autofocus>
            @error('image')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
    </fieldset>

    <button type="submit" class="btn btn-success pull-left submit">ثبت<i class="fa fa-check"></i></button>
    <a class="btn btn-danger pull-left" href="{{ route('sliders.index') }}"
    style="margin-left: 4px;">لیست اسلایدرها</a>
  </form>

</div>


</div>
@endsection