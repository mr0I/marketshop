@extends('admin.index')

@section('content')
<div class="container" style="width: 90%">
  <h3 class="text-center">ویرایش کد تخفیف</h3>
  <hr>

  <div class="row">
    <form class="form-horizontal" method="POST" action="{{ route('discounts.update', ['id'=>$discount->id]) }}">
      <fieldset>
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group row">
          <div>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="نام کد*"
            value="{{ $discount->name }}" autocomplete="name" autofocus>
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
            value="{{ $discount->percent }}" autocomplete="percent" autofocus>
            @error('percent')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
      </fieldset>
      <button type="submit" class="btn btn-success pull-left edit">ویرایش</button>
      <a href="{{ route('discounts.index') }}" class="btn btn-danger pull-left" style="margin-left: 8px;">لغو</a>
    </form>
  </div>
</div>
@endsection