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


  <h3 class="text-center">لیست کد ها</h3>
  <hr>
  <a class="btn btn-primary m-5 adding pull-left" href="{{ route('discounts.create') }}"
  >افزودن کد تخفیف جدید <i class="fa fa-plus"></i></a>


  <div class="tbl-container table-responsive text-nowrap mt-3">
    <table class="table table-hover table-fixed panel_tbl">
      <thead>
        <th><input type="checkbox" name=""></th>
        <th>ردیف</th>
        <th>نام کد</th>
        <th>درصد</th>
        <th>عملیات</th>
      </thead>
      <tbody>
        @php
        $counter = 1;
        @endphp
        @foreach ($discounts as $discount)
        <tr>
          <td><input type="checkbox"></td>
          <td>{{$counter++}}</td>
          <td>{{ $discount->name }}</td>
          <td>{{ $discount->percent }}%</td>
          <td>
            <a href="{{ route('discounts.edit', ['id'=> $discount->id] ) }}" class="btn btn-primary">ویرایش</a> |
            <a href="#modelId" class="btn btn-danger discount-del"
            data-id="{{ $discount->id }}" data-toggle="modal"
            data-url="{{ route('discounts.destroy', ['id'=> $discount->id] ) }}">حذف</a>
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
          <form class="form" action="" method="POST" id="discount_modal_frm">
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
