@extends('admin.index')


@section('content')
<div class="container" style="width: 90%">
  <div class="row">
    <h3 class="text-center">ویژگی های محصول</h3>
    <hr>
    @if (sizeof($specifications) != 0)
    <section class="mb-4">
      <p>ویژگی های تعریف شده برای این محصول</p>
      <ul class="specifications list-inline">
        @foreach ($specifications as $spec)
        <li class="list-inline-item">{{ $spec->title }}
          <span class="specOp d-none">
            <a href="#" id="{{ $spec->id }}" class="editSpec"><i class="fa fa-edit"></i></a>
            <a href="#" id="{{ $spec->id }}" class="deleteSpec"><i class="fa fa-remove"></i></a>
          </span>
        </li>
        @endforeach
      </ul>
    </section>
    @endif


    <form class="form-horizontal" method="POST" action="{{ route('specs.store') }}" enctype="multipart/form-data" id="addSpec">
      <fieldset>
        {{ csrf_field() }}
        <div class="form-group row">
          <label for="title" class="form-text text-muted">عنوان اصلی</label>
          <input type="text" class="form-control" name="title" id="title">
          @error('title')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group row">
          <label for="spec1" class="form-text text-muted">نام ویژگی 1</label>
          <input type="text" class="form-control" name="spec1" id="spec1">
          @error('spec1')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group row">
          <label for="desc1" class="form-text text-muted">توضیحات ویژگی 1</label>
          <textarea class="form-control" name="desc1" id="desc1" cols="20" rows="5"></textarea>
          @error('desc1')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group row">
          <label for="spec2" class="form-text text-muted">نام ویژگی 2</label>
          <input type="text" class="form-control" name="spec2" id="spec2">
          @error('spec2')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group row">
          <label for="desc2" class="form-text text-muted">توضیحات ویژگی 2</label>
          <textarea class="form-control" name="desc2" id="desc2" cols="20" rows="5" ></textarea>
          @error('desc2')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group row">
          <label for="spec3" class="form-text text-muted">نام ویژگی 3</label>
          <input type="text" class="form-control" name="spec3" id="spec3">
          @error('spec3')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group row">
          <label for="desc3" class="form-text text-muted">توضیحات ویژگی 3</label>
          <textarea class="form-control" name="desc3" id="desc3" cols="20" rows="5"></textarea>
          @error('desc3')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <input type="hidden" name="product_id" value="{{ $product->id }}">
      </fieldset>
      <button type="submit" class="btn btn-success pull-left submit">ثبت<i class="fa fa-check"></i></button>
      <a class="btn btn-danger pull-left" href="{{ route('products.index') }}" style="margin-left: 4px;">بازگشت به لیست محصولات</a>
    </form>


    <form class="form-horizontal" method="POST" id="editSpec">
      <fieldset>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group row">
          <label for="title" class="form-text text-muted">عنوان اصلی</label>
          <input type="text" class="form-control" name="title" id="title" value="">
          @error('title')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group row">
          <label for="spec1" class="form-text text-muted">نام ویژگی 1</label>
          <input type="text" class="form-control" name="spec1" id="spec1">
          @error('spec1')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group row">
          <label for="desc1" class="form-text text-muted">توضیحات ویژگی 1</label>
          <textarea class="form-control" name="desc1" id="desc1" cols="20" rows="5"></textarea>
          @error('desc1')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <div class="form-group row">
          <label for="spec2" class="form-text text-muted">نام ویژگی 2</label>
          <input type="text" class="form-control" name="spec2" id="spec2">
          @error('spec2')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group row">
          <label for="desc2" class="form-text text-muted">توضیحات ویژگی 2</label>
          <textarea class="form-control" name="desc2" id="desc2" rows="5" cols="5"></textarea>
          @error('desc2')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group row">
          <label for="spec3" class="form-text text-muted">نام ویژگی 3</label>
          <input type="text" class="form-control" name="spec3" id="spec3">
          @error('spec3')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group row">
          <label for="desc3" class="form-text text-muted">توضیحات ویژگی 3</label>
          <textarea class="form-control" name="desc3" id="desc3" cols="20" rows="5"></textarea>
          @error('desc3')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>

        <input type="hidden" id="spec_id" name="id" value="">
        <input type="hidden" id="product_id" name="product_id" value="">
      </fieldset>
      <button type="submit" class="btn btn-success pull-left edit">ویرایش</button>
      <a class="btn btn-danger pull-left" href="#" style="margin-left: 4px;" id="cancel_editfrm">لغو</a>
    </form>

  </div>
  </div>
    @endsection