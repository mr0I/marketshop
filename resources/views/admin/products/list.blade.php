@extends('admin.index')

@section('content')

@if (\Session::has('product_del_success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>{{ \Session::get('product_del_success') }}</strong>
</div>
<script>
  $(".alert").alert();
</script>
@endif
@if (\Session::has('product_del_unsuccess'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>{{ \Session::get('product_del_unsuccess') }}</strong>
</div>
<script>
  $(".alert").alert();
</script>
@endif

<div class="container" style="width: 100% !important;">
  <h3 class="text-center">لیست محصولات</h3>
  <a class="btn btn-primary m-5 adding pull-left" href="{{ url('admin/products/create') }}"
  >افزودن محصول جدید <i class="fa fa-plus"></i></a>
  <br>
  <hr>

  <div class="tbl-container table-responsive text-nowrap">
    <table class="table table-hover table-fixed panel_tbl" id="tbl_prlist">
      <thead>
        <th>ردیف</th>
        <th>عنوان</th>
        <th>برند</th>
        <th>کد محصول</th>
        <th>موجود بودن</th>
        <th>پیشنهاد ویژه</th>
        <th>قیمت</th>
        <th>قیمت با تخفیف</th>
        <th>توضیحات</th>
        <th>دسته بندی</th>
        <th>رنگ ها</th>
        <th>تصویر شاخص</th>
        <th>عملیات</th>
      </thead>
      <tbody>
        @php
        $counter=1;
        @endphp
        @foreach ($products as $product)
        <tr>
          <td>{{$counter++}}</td>
          <td>{{$product->title}}</td>
          <td>{{$product->brand}}</td>
          <td>{{$product->code}}</td>
          <td>{{$product->availablity}}</td>
          <td>{{$product->specialOffer}}</td>
          <td>{{$product->price}}</td>
          <td>{{$product->offprice}}</td>
          <td>{{mb_strimwidth($product->description , 0 , 30 ,'---')}}</td>
          <td>{{$product->category['name']}}</td>
          <td class="d-flex justify-content-center align-items-center">
            @foreach ($product->colors()->pluck('name') as $color)
            <span>{{$color}} ,</span>
            @endforeach
          </td>
          @if ($product->indexImage == null)
          <td><img src="{{url('image/no_image.jpg')}}" alt="" width="35" height="35"></td>
          @else
          <td class="d-flex justify-content-center align-items-center align-content-around">
            <a href="{{ url('uploads/images/indexes') . '/' . $product->indexImage  }}">
              <img src="{{url('uploads/images/indexes'). '/' . $product->indexImage }}" width="35" height="35">
            </a>
          </td>
          @endif
          <td class="td_a">
            @if (count($product->product_galleries) != 0)
            <a href="{{ route('gallery', ['id'=> $product->id] ) }}"
              class="btn btn-info">ویرایش گالری تصویر</a> &nbsp;|&nbsp;
              @else
              <a href="{{ route('gallery', ['id'=> $product->id] ) }}"
                class="btn btn-info">افزودن گالری تصویر</a> &nbsp;|&nbsp;
                @endif
                <a href="{{ url('admin/specifications/'. $product->id) }}" class="btn btn-warning">ویژگی ها</a> &nbsp;|&nbsp;
                <a href="{{ route('products.edit', ['id'=> $product->id] ) }}"
                  class="btn btn-primary">ویرایش</a> &nbsp;|&nbsp;
                  <a class="btn btn-danger product-del" role="button"
                  data-id="{{ $product->id }}" data-toggle="modal" data-target="#modalId" data-url="{{ route('products.destroy', ['id'=> $product->id] ) }}">حذف
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

       <!-- Modal -->
      <div class="modal fade" id="modalId" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content" >
            <div class="modal-header">
              <button class="close mr-auto" data-dismiss="modal">&times;</button>
              <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
              <p class="text-justify">آيتم حذف شود؟</p>
            </div>
            <div class="modal-footer">
              <form class="form" action="" method="POST" id="product_modal_frm">
                {{method_field('delete')}}
                {{csrf_field()}}
                <button type="submit" class="btn btn-success pull-left">بله</button>
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">
                  خير</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->

      </div>


      <script type="text/javascript">
        $(document).ready(function(){
          $('.panel_tbl').DataTable({
            "paging":false,
            "ordering":true,
            "info":false
            // "order": [[ 0, "desc" ]]
            //"pagingType":"full_numbers"
          });
        });
      </script>
      @endsection
