@extends('admin.index')

@section('content')
<div class="container" style="width: 100% !important;">

  @if (\Session::has('delete_success'))
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ \Session::get('delete_success') }}</strong>
  </div>
  <script>
    $(".alert").alert();
  </script>
  @endif
  @if (\Session::has('delete_unsuccess'))
  <div class="alert alert-danger alert-dismissible show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ \Session::get('delete_unsuccess') }}</strong>
  </div>
  <script>
    $(".alert").alert();
  </script>
  @endif


  <h3 class="text-center">لیست برند ها</h3>
  <hr>
  <a class="btn btn-primary m-5 adding pull-left" href="{{ route('brands.create') }}"
  >افزودن برند جدید <i class="fa fa-plus"></i></a>




  <div class="tbl-container table-responsive text-nowrap mt-3">
    <table class="table table-hover table-fixed panel_tbl">
      <thead>
        <th><input type="checkbox" name=""></th>
        <th>ردیف</th>
        <th>نام برند</th>
        <th>تصویر</th>
        <th>عملیات</th>
      </thead>
      <tbody>
        @php
        $counter = 1;
        @endphp
        @foreach ($brands as $brand)
        <tr>
          <td><input type="checkbox"></td>
          <td>{{$counter++}}</td>
          <td>{{ $brand->name }}</td>
          @if ($brand->image == null)
          <td><img src="{{url('image/no_image.jpg')}}" alt="" width="35" height="35"></td>
          @else
          <td class="d-flex justify-content-center align-items-center align-content-around">
            <a href="{{ url('uploads/images') . '/' . $brand->image  }}">
              <img src="{{url('uploads/images'). '/' . $brand->image }}" width="35" height="35">
            </a>
              <a class="btn del_brand_pic" id="{{$brand->id}}" href="#" title="حذف تصویر">
              <i class="fa fa-remove" style="color: red"></i>
              </a>
              <a class="btn" href="{{ url('uploads/images').'/'.$brand->image }}" title="دانلود"
                download="brand-image"><i class="fa fa-download" style="color: darkcyan"></i></a>
          </td>
          @endif
          <td>
            <a href="{{ route('brands.edit', ['id'=> $brand->id] ) }}" class="btn btn-primary">ویرایش</a> |
            <a href="#modelId" class="btn btn-danger brand-del"
            data-id="{{ $brand->id }}" data-toggle="modal"
            data-url="{{ route('brands.destroy', ['id'=> $brand->id] ) }}">حذف</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            آیتم حذف شود؟
          </div>
        </div>
        <div class="modal-footer">
          <form class="form" action="" method="POST" id="brand_modal_frm">
            {{method_field('delete')}}
            {{csrf_field()}}
            <button type="submit" class="btn btn-success pull-left">بله</button>
            <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">
              خیر</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>




  @endsection
