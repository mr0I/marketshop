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


    <h3 class="text-center">لیست دسته بندی ها</h3>
    <hr>
    <a class="btn btn-primary m-5 adding pull-left" href="{{ route('category.create') }}"
    >افزودن دسته بندی جدید <i class="fa fa-plus"></i></a>

    <form action="#" method="post" class="pull-right" style="margin-right: 36px;">
      <div class="form-row">
        <div class="col">
          <select class="form-control" name="operation" id="cat_ops">
            <option value="0" disabled selected>نوع عملیات</option>
            <option value="1">پاک کردن</option>
          </select>
        </div>
        <div class="col" style="padding: 16px;">
          <button type="submit" class="btn btn-success do_action" disabled>
            تایید<i class="fa fa-gear" style="margin: 0 4px;display: none"></i>
          </button>
        </div>
      </div>
    </form>
    <div class="tbl-container text-nowrap mt-3">
      <table class="table table-hover table-fixed panel_tbl" id="cat_list">
        <thead>
        <tr>
          <th>
            <label>
              <input type="checkbox" class="master_chk">
              <span></span>
            </label>
          </th>
          <th>ردیف</th>
          <th>نام دسته</th>
          <th>مادر دسته</th>
          <th>عملیات</th>
        </tr>
        </thead>
        <tbody>
        @php
          $counter = 1;
        @endphp
        @foreach ($category as $cat)
          <tr>
            <td>
              <label>
                <input type="checkbox" id="catChk{{ $counter }}" data-id="{{ $cat->id }}"
                       class="slave_chk">
                <span></span>
              </label>
            </td>
            <td>{{$counter++}}</td>
            <td style="cursor: pointer">{{ $cat->name }}</td>
            <td>{{ $cat->getParent['name'] }}</td>
            <td>
              <a href="{{ route('category.edit', ['id'=> $cat->id] ) }}" class="btn btn-primary">ویرایش</a> |
              <a href="#modelId" class="btn btn-danger cat-del"
                 data-id="{{ $cat->id }}" data-toggle="modal"
                 data-url="{{ route('category.destroy', ['id'=> $cat->id] ) }}">حذف</a>
            </td>
          </tr>
        @endforeach
        <input type="hidden" id="counter" value="{{ --$counter }}">
        </tbody>
      </table>
    </div>


    <!-- Modal -->
      <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modaledit" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">ويرايش دسته</h5>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <form class="form-horizontal" method="POST" action="" id="frm_catEdit">
                  <fieldset>
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group row">
                      <div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="cat_name" placeholder="نام دسته*"
                               autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                        @enderror
                      </div>
                    </div>
                    <div class="form-group row">
                      <div>
                        <label for="parent_id" class="form-text text-muted pull-right">نام دسته مادر</label>
                        <select class="form-control @error('parent_id') is-invalid @enderror" name="parent_id" id="cat_select">
                          <option value="0"> --- </option>
                          @foreach ($category as $cat)
                            <option value="{{$cat->id}}" class="cat_parent_id">
                                     {{$cat->name}}</option>
                          @endforeach
                        </select>
                        @error('parent_id')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                        @enderror
                      </div>
                    </div>
                  </fieldset>
                  <button type="submit" class="btn btn-success pull-left edit"
                          data-name=""
                  >ويرايش<i class=""></i></button>
                  <a href="#" class="btn btn-danger pull-left" data-dismiss="modal"
                     style="margin-left: 8px;">لغو
                  </a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
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
            <form class="form" action="" method="POST" id="cat_modal_frm">
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
