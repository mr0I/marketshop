@extends('admin.index')


@section('content')
    <div class="container" style="width: 100% !important;">

        <h3 class="text-center">لیست ویدئوها</h3>
        <hr>
        <br>
        <a class="btn btn-primary m-5 adding pull-left" href="{{ route('videos.create') }}"
        >افزودن ویدئوی جدید <i class="fa fa-plus"></i></a>
        <br>

        @if(sizeof($videos) != 0 )
        <div class="tbl-container table-responsive text-nowrap mt-3">
            <table class="table table-hover table-fixed panel_tbl">
                <thead>
                <th>ردیف</th>
                <th>نام</th>
                <th>آدرس ویدئو</th>
                <th>وضعیت</th>
                <th>عملیات</th>
                </thead>
                <tbody>
                @php
                    $counter = 1;
                @endphp
                @foreach ($videos as $video)
                    <tr>
                        <td>{{$counter++}}</td>
                        <td>{{ $video->name }}</td>
                        <td>
                            @if($video->video != '') {{ $video->video }}
                            @else --- @endif
                        </td>
                        <td>{{ $video->status }}</td>
                        <td>
                            <a href="{{ url('admin/video_upload/'.$video->id) }}" class="btn btn-warning">آپلود ویدئو</a> |
                            <a href="#modal_edit_video" class="btn btn-info edit_video_modal"
                               data-id="{{ $video->id }}" data-toggle="modal" data-name="{{ $video->name }}"
                               data-status="{{ $video->status }}"
                               data-url="{{ route('videos.update', ['id'=> $video->id] ) }}">ویرایش
                            </a> |
                            <a href="#modal_del_video" class="btn btn-danger video-del"
                               data-id="{{ $video->id }}" data-toggle="modal"
                               data-url="{{ route('videos.destroy', ['id'=> $video->id] ) }}">حذف
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
            <div class="alert alert-danger" style="margin: 16px auto">
                <p>موردی برای نمایش وجود ندارد!</p>
            </div>
        @endif


        <!-- Modal -->
        <div class="modal fade" id="modal_del_video" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <form class="form" action="" method="POST" id="video_modal_frm">
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

        <div class="modal fade" id="modal_edit_video" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ويرايش ویدئو</h5>
                    </div>
                    <div class="modal-body" style="padding: 40px 30px;">
                        <form class="form-horizontal" method="POST" action="" id="frm_videoEdit">
                            <fieldset>
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <div class="form-group row">
                                    <div>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="video_name" placeholder="نام ویدئو*"
                                               autocomplete="name" autofocus>
                                        <small id="errors" class="text-danger text-center"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div>
                                        <label for="status" class="form-text text-muted pull-right">نام دسته مادر</label>
                                        <select class="form-control @error('status') is-invalid @enderror" name="status" id="status_select">
                                            <option value="0" disabled class="video_status"> وضعیت انتشار </option>
                                            <option value="1" class="video_status"> انتشار </option>
                                            <option value="2" class="video_status"> عدم انتشار </option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" value="" id="videoID" />
                            </fieldset>
                            <button type="button" class="btn btn-success pull-left edit" id="editVideo" disabled>
                                ويرايش
                            </button>
                            <a href="#" class="btn btn-danger pull-left" data-dismiss="modal"
                               style="margin-left: 8px;">لغو
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

