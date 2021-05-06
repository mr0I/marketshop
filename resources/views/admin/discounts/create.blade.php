@extends('admin.index')

@section('content')
<div class="container" style="width: 90%">
  <h3 class="text-center">افزودن کد تخفیف</h3>
  <hr>

  <div class="row">
    <form class="form-horizontal" method="POST" action="{{ route('discounts.store') }}">
      <fieldset>
        {{ csrf_field() }}
        <div class="form-group row">
          <div>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="نام کد*"
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
            <input type="number" class="form-control @error('percent') is-invalid @enderror" name="percent" placeholder="درصد*"
             value="{{ old('percent') }}" autocomplete="percent" autofocus>
            @error('percent')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
      </fieldset>

      <button type="submit" class="btn btn-success pull-left submit">ثبت<i class="fa fa-check"></i></button>
      <a class="btn btn-danger pull-left" href="{{ route('discounts.index') }}"
      style="margin-left: 4px;">بازگشت به لیست </a>
    </form>
  </div>
</div>
@endsection