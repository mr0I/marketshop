@extends('admin.index')

@section('content')
  <div class="container" style="width: 90%">
    <div class="row">
      <h3 class="text-center">گالری تصویر</h3>
      <hr>
      @if (count($product->product_galleries) >0)
        <section class="border-info">
          <p>تصاویر موجود در گالری</p>
          <div class="d-flex justify-content-center align-items-center">
            @foreach ($product->product_galleries as $item)
              <img src="{{ url('uploads/images/gallery/' . $item->image) }}"
                   width="50" alt="">
            @endforeach
          </div>
        </section>
      @endif
      <form class="form-horizontal" method="POST" action="{{ route('addgallery') }}" enctype="multipart/form-data">
        <fieldset>
          {{ csrf_field() }}
          <div class="form-group row" id="inputs">
            <label for="images" class="form-text text-muted">افزودن تصویر</label>
            <input type="file" class="form-control" name="images[]" id="images">
            <a class="btn btn-primary pull-left" href="#" id="newfile">
              <i class="fa fa-plus"></i>
            </a>
            @error('images')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
            @enderror
          </div>
          <input type="hidden" name="productid" value="{{ $product->id }}">
        </fieldset>
        <button type="submit" class="btn btn-success pull-left submit">ثبت</button>
        <a class="btn btn-danger pull-left" href="{{ route('products.index') }}" style="margin-left: 4px;">بازگشت به لیست محصولات</a>
      </form>
      <script>
        // function addNewField(){
        //   // document.getElementById('inputs').innerHTML +=
        //   // "<br><input type='file' class='form-control' name='images[]'>";
        // }

        jQuery(document).ready(function($) {
          $(document).on("click", "#newfile", function() {
            jQuery.data(document.body, 'prevElement', $(this).prev());
            var inputText = jQuery.data(document.body, 'prevElement');
            if(inputText != undefined && inputText != '')
            {
              $('<br><input type="file" class="form-control" name="images[]" id="images">').appendTo($(inputText).closest('div'));// $('<br><input type="file" class="form-control" name="images[]" id="images"><a class="btn btn-primary" href="#" id="newfile"> <i class="fa fa-plus"></i></a>').appendTo($(inputText).closest('div'));
            }

            return false;
          });
        });
      </script>

    </div>
  </div>

@endsection