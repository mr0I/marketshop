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
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ \Session::get('delete_unsuccess') }}</strong>
  </div>
  <script>
    $(".alert").alert();
  </script>
  @endif


  <h3 class="text-center">لیست رنگ ها</h3>
  <hr>
  <a class="btn btn-primary m-5 adding pull-left" href="{{ route('colors.create') }}"
  >افزودن رنگ جدید <i class="fa fa-plus"></i></a>

  <div class="tbl-container table-responsive text-nowrap mt-3">
    <table class="table table-hover table-fixed panel_tbl">
    <thead>
      <th>ردیف</th>
      <th>نام رنگ</th>
      <th>کد رنگ</th>
      <th>عملیات</th>
    </thead>
    <tbody>
      @php
      $counter = 1;
      @endphp
      @foreach ($colors as $color)
      <tr>
        <td>{{$counter++}}</td>
        <td>{{ $color->name }}</td>
        <td class="colorcode">
          <span class="color_sqr" style="background: {{$color->colorcode}}"></span>
        </td>
        <td>
          <a href="{{ route('colors.edit', ['id'=> $color->id] ) }}" class="btn btn-primary">ویرایش</a> |
          <a href="#modelId" class="btn btn-danger color-del"
          data-id="{{ $color->id }}" data-toggle="modal"
          data-url="{{ route('colors.destroy', ['id'=> $color->id] ) }}">حذف</a>
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
          {{-- <h5 class="modal-title">Modal title</h5> --}}
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
          <form class="form" action="" method="POST" id="color_modal_frm">
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
