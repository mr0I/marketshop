@extends('admin.index')

@section('content')
    <div class="container" style="width: 90%">
        <h3 class="text-center">آپلود ویدئو</h3>
        <hr>

        <div class="row">
            <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                <fieldset>
                    {{ csrf_field() }}
                    <div class="form-group row" style="position: relative;">
                        <input type="file" class="form-control @error('video') is-invalid @enderror"
                               name="video" id="video" value="{{ old('video') }}">
                        @error('video')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div class="progress my-1">
                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                 role="progressbar" style="width: 0%;margin: 8px auto;border-radius: 0;" id="prog" aria-valuemin="0"
                                 aria-valuemax="100">
                            </div>
                        </div>
                        <div id="result"></div>
                        <div id="loaded"></div>
                        <div id="percent"></div>
                    </div>
                </fieldset>

                <button type="button" class="btn btn-success pull-left" onclick="uploadToServer()">
                    آپلود
                </button>
                <a class="btn btn-danger pull-left" onclick="Cancel()"
                   style="margin-left: 4px;">انصراف</a>
                <a class="btn btn-info pull-left" href="{{ route('videos.index') }}"
                   style="margin-left: 4px;">لیست ویدئو ها</a>
            </form>

        </div>


    </div>
@endsection