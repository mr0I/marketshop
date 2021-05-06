@extends('admin.index')

@section('content')
<div class="container" style="width: 90%">
  <h3 class="text-center">افزودن دسته بندی</h3>
  <hr>

  <div class="row">
    <form class="form-horizontal" method="POST" action="{{ route('category.store') }}">
      <fieldset>
        {{ csrf_field() }}
        <div class="form-group row">
          <div>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="نام دسته*"
             value="{{ old('name') }}" autocomplete="name" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <div class="form-group row">
            <label for="parent_id" class="form-text text-muted">نام دسته مادر</label>
            <select class="form-control @error('parent_id') is-invalid @enderror" name="parent_id" id="parent_id">
            <option value="0"> --- </option>
            @foreach ($category as $key=>$value)
            <option value="{{$key}}">{{$value}}</option>
            @endforeach
          </select>
          @error('parent_id')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
      </div>
    </fieldset>

    <button type="submit" class="btn btn-success pull-left submit">ثبت<i class="fa fa-check"></i></button>
    <a class="btn btn-danger pull-left" href="{{ route('category.index') }}"
    style="margin-left: 4px;">لیست دسته ها</a>

  </form>

</div>


</div>
@endsection