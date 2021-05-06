@extends('admin.index')

@section('content')
<div class="container" style="width: 90%">
  <h3 class="text-center">ویرایش محصول</h3>
  <hr>

  <div class="row">
    <form class="form-horizontal" method="POST" action="{{route('products.update' , ['id' => $product->id])}}" enctype="multipart/form-data">
      <fieldset>
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="form-group row">
          <div class="col-8 required">
            <label for="title" class="form-text text-muted">عنوان</label>
            <input type="text" id="title" class="form-control @error('title')
                    is-invalid @enderror" name="title" placeholder="عنوان"  title="عنوان" value="{{ $product->title }}"
            autocomplete="title" autofocus>
            @error('title')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row ">
          <div class="col-8 required">
            <label for="code" class="form-text text-muted">کد محصول</label>
            <input type="text" id="code" class="form-control @error('code')
                    is-invalid @enderror" name="code" placeholder="کد محصول"  title="کد محصول" value="{{ $product->code }}" autocomplete="code"
            >
            @error('code')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
            @enderror
          </div>
        </div>
        <div class="form-group row ">
          <div class="col-8 required">
            <label for="price" class="form-text text-muted">قیمت</label>
            <input type="number" id="price" class="form-control @error('price')
                    is-invalid @enderror" name="price" placeholder="قیمت" title="قیمت" value="{{ $product->price }}" autocomplete="price">
            @error('price')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
            @enderror
          </div>
        </div>
        <div class="form-group row">
          <div class="col-8 required">
            <label for="offprice" class="form-text text-muted">قیمت با تخفیف</label>
            <input type="number" id="offprice" class="form-control @error('offprice') is-invalid @enderror" name="offprice" placeholder="قيمت با تخفیف"
             title="قيمت با تخفیف" value="{{ $product->offprice }}"
            autocomplete="offprice">
            @error('offprice')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
            @enderror
          </div>
        </div>
        <div class="form-group row">
          <div class="col-8">
            <label for="editor" class="form-text text-muted">توضیحات</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="editor" cols="30" rows="10"
            placeholder="توضیحات" title="توضیحات" >{{$product->description}}
          </textarea>
          @error('description')
          <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
      <div class="form-group row required">
        <label for="indexImage" class="form-text text-muted">تصویر شاخص</label>
        <input type="file" class="form-control" name="indexImage" id="indexImage">
        @if ($product->indexImage != null)
        <img src="{{ url('uploads/images/indexes/' . $product->indexImage) }}"
        alt="تصویر شاخص" width="75">
        @endif
        @error('indexImage')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

        <div class="form-group row">
          <div class="col-8 required">
            <label class="form-text text-muted" for="brand">برند</label>
            <select id="brand" class="@error('brand') is-invalid @enderror" name="brand">
              @foreach($brands as $key=>$value)
                <option {{ $key }} @if($product->brand==$value) selected @endif>{{ $value }}</option>
              @endforeach
            </select>

            @error('brand')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
            @enderror
          </div>
        </div>
      <div class="form-group row">
        <div class="col-8">
          <label class="form-text text-muted" for="color_id">رنگ را انتخاب کنید</label>
          <select class="@error('color_id') is-invalid
          @enderror" data-placeholder="رنگ های محصول" id="color_id" name="color_id[]" multiple>
          @foreach ($colors as $color)
          <option
          @foreach ($product->colors as $item)
          @if ($item->id == $color->id)
          {{ "selected" }}
          @endif
          @endforeach
          value="{{$color->id}}">{{$color->name}}
        </option>
        @endforeach
      </select>
      @error('color_id')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <div class="col-8">
      <label for="category_id" class="form-text text-muted">دسته بندی را انتخاب کنید</label>
      <select class="@error('category_id') is-invalid @enderror" id="category_id" name="category_id" >
        <option value="0"> --- </option>
        @foreach ($category as $key=>$value)
        <option value="{{$key}}" @if($product->category_id == $key) selected @endif>{{$value}}
        </option>
        @endforeach
      </select>
      @error('category_id')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
  </div>

  <div class="form-group row">
    <div class="col-8">
      <label for="availablity" class="form-text text-muted">محصول موجود است؟</label>
      <br>
      <label>
        <input type="radio" class="with-gap" value="2" name="availablity"
        @if($product->availablity==2) checked @endif>
        <span>خیر</span>
      </label>
      <label>
        <input type="radio" class="with-gap" value="1" name="availablity"
        @if($product->availablity==1) checked @endif>
        <span>بله</span>
      </label>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-8">
      <label for="specialOffer" class="form-text text-muted">پشنهاد ویژه است؟</label>
      <br><label>
        <input type="radio" class="with-gap" value="2" name="specialOffer"
        @if($product->specialOffer==2) checked @endif>
        <span>خیر</span>
      </label>
      <label>
        <input type="radio" class="with-gap" value="1" name="specialOffer"
        @if($product->specialOffer==1) checked @endif>
        <span>بله</span>
      </label>
    </div>
  </div>

</fieldset>
<button type="submit" class="btn btn-success pull-left edit">ویرایش</button>
<a href="{{ route('products.index') }}" class="btn btn-danger pull-left" style="margin-left: 8px;">لغو</a>
</form>
</div>

</div>
@endsection



@section('script')
<script type="text/javascript">
  $(document).ready(function () {
      $('select').formSelect();
  });

  ClassicEditor
          .create( document.querySelector( 'textarea#editor' ), {
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
          } )
          .then( editor => {
            window.editor = editor;
          } )
          .catch( err => {
            console.error( err.stack );
          } );
</script>
@endsection
