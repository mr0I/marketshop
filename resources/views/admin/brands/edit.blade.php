@extends('admin.index')

@section('content')
<div class="container" style="width: 90%">
  <h3 class="text-center">ویرایش برند</h3>
  <hr>

  <div class="row">
    <form class="form-horizontal" method="POST" action="{{ route('brands.update' , ['id' => $brand->id ]) }}" enctype="multipart/form-data">
      <fieldset>
        {{ csrf_field() }}
        @method('PATCH')
        <div class="form-group row">
          <div>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="نام برند*"
             value="{{ $brand->name }}" autocomplete="name" autofocus >
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
            @if ($brand->image != null)
            <img class="img_preview" src="{{ url('uploads/images') . '/' . $brand->image}}" alt="تصویر برند">
            @endif
            @error('image')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
      </fieldset>

      <button type="submit" class="btn btn-success pull-left edit">ویرایش</button>
      <a href="{{ route('brands.index') }}" class="btn btn-danger pull-left"
      style="margin-left: 8px;">لغو</a>

    </form>

  </div>


</div>
@endsection