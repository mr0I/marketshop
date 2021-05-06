@extends('admin.index')

@section('content')
<div class="container" style="width: 90%">
  <div class="row">
    <h3 class="text-center">افزودن محصول</h3>
    <hr>

    <form class="form-horizontal" method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
      <fieldset>
        {{ csrf_field() }}
        <div class="form-group row">
          <div class="col-8">
            <input type="text" class="form-control @error('title')
                    is-invalid @enderror" name="title" placeholder="عنوان*"  title="عنوان" value="{{ old('title') }}" autocomplete="title"
            autofocus>
            @error('title')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <div class="col-8">
            <input type="number" id="code" class="form-control @error('code') is-invalid @enderror" name="code"
            placeholder="*کد محصول" title="کد محصول" value="{{ old('code') }}" autocomplete="code">
            @error('code')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>
        </div>
        <div class="form-group row">
          <div class="col-8">
            <input type="number" class="form-control @error('price')
                    is-invalid @enderror" name="price" placeholder="*قیمت"  title="قیمت" value="{{ old('price') }}" autocomplete="price">
            @error('price')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
            @enderror
          </div>
        </div>
        <div class="form-group row">
          <div class="col-8">
            <input type="number" class="form-control @error('offprice') is-invalid @enderror" name="offprice" placeholder="قيمت با تخفیف" title="قيمت با تخفیف" value="{{ old('offprice') }}"
            autocomplete="offprice">
            @error('offprice')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong></span>
            @enderror
          </div>
        </div>
        <div class="form-group row" >
          <div class="col-8" id="test">
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="editor" rows="5" cols="5"
            placeholder="توضیحات"  title="توضیحات">
          </textarea>
          @error('description')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <label for="indexImage" class="form-text text-muted">تصویر شاخص</label>
        <input type="file" class="form-control" name="indexImage" id="indexImage"
        accept=".png,.jpeg,.jpg">
        @error('indexImage')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

        <div class="form-group row">
          <div class="col-8">
            <label class="form-text text-muted" for="brand">برند</label>
            <select id="brand" class="@error('brand') is-invalid @enderror" name="brand">
              @foreach($brands as $key=>$value)
                <option {{ $key }}>{{ $value }}</option>
              @endforeach
            </select>
            @error('brand')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>
        </div>
      <div class="form-group row">
        <div class="col-8">
          <label class="form-text text-muted" for="color_id">رنگ را انتخاب کنید</label>
          <select class="@error('color_id') is-invalid @enderror" name="color_id[]"
          multiple id="color_id" data-placeholder="رنگ های محصول" >
          @foreach ($colors as $key=>$value)
          <option value="{{$key}}">{{$value}}</option>
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
      <select class="@error('category_id') is-invalid @enderror" name="category_id" id="category_id" >
      <option value="">---</option>
      @foreach ($category as $key=>$value)
      <option value="{{$key}}">{{$value}}</option>
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
      <input type="radio" value="2" name="availablity" checked>
      <span>خیر</span>
    </label>
    <label>
      <input type="radio" value="1" name="availablity">
      <span>بله</span>
    </label>
  </div>
</div>
<div class="form-group row">
  <div class="col-8">
    <label for="specialOffer" class="form-text text-muted">پشنهاد ویژه است؟</label>
    <br>
    <label>
      <input type="radio" value="2" name="specialOffer" checked>
      <span>خیر</span>
    </label>
    <label>
      <input type="radio" value="1" name="specialOffer">
      <span>بله</span>
    </label>
  </div>
</div>

</fieldset>
<button type="submit" class="btn btn-success pull-left submit">ثبت<i class="fa fa-check"></i></button>
<a class="btn btn-danger pull-left" href="{{ route('products.index') }}" style="margin-left: 4px;">بازگشت به لیست محصولات</a>
</form>
</div>
</div>
@endsection


@section('script')
<script type="text/javascript">
  $(document).ready(function () {

    $('select').formSelect();

    // mask
  //   $('input#code').mask("(999) 999");
  //   // chosen
  //   $('#color_id').chosen({no_results_text:"گزینه مدنظر شما در لیست وجود ندارد",
  //   max_selected_options:2,
  //   width:"100%",
  //   disable_search_threshold:2
  // }).change(function(){}).trigger('chosen:updated');
  // $('#color_id').bind("chosen:maxselected", function() {alert('تعداد انتخابهای شما به اتمام رسید');})
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






