@extends('admin.index')

@section('content')
    <div class="container" style="width: 100% !important;">

        <h3 class="text-center">لیست اسلایدها</h3>
        <hr>
        <a class="btn btn-primary m-5 adding pull-left" href="{{ route('sliders.create') }}"
        >افزودن اسلایدر جدید <i class="fa fa-plus"></i></a>

        <div class="tbl-container text-nowrap mt-3">
            <table class="table table-hover table-fixed panel_tbl">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام اسلایدر</th>
                    <th>آدرس</th>
                    <th>تصویر</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $counter = 1;
                @endphp
                @foreach ($slides as $slide)
                    <tr>
                        <td>{{$counter++}}</td>
                        <td>{{ $slide->name }}</td>
                        <td><a href="{{ $slide->url }}">لینک</a></td>
                        <td>
                            <img src="{{ url('/uploads/images/slides/'.$slide->image) }}" alt="{{ $slide->name }}"
                            style="width: 100px;height: auto;">
                        </td>
                        <td>
                            <a href="{{ route('sliders.edit', ['id'=> $slide->id] ) }}" class="btn btn-primary">ویرایش</a> |
                            <a href="#modal_remove_slider" class="btn btn-danger slider-del"
                               data-id="{{ $slide->id }}" data-toggle="modal"
                               data-url="{{ route('sliders.destroy', ['id'=> $slide->id] ) }}">حذف</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="modal_remove_slider" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                        <form class="form" action="" method="POST" id="slider_modal_frm">
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
