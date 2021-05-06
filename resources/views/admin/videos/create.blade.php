@extends('admin.index')

@section('content')
    <div class="container" style="width: 90%">
        <h3 class="text-center">افزودن ویدئو</h3>
        <hr>

        <div class="row">
            <form class="form-horizontal" method="POST" action="{{ route('videos.store') }}" enctype="multipart/form-data">
                <fieldset>
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="نام ویدئو*"
                                   value="{{ old('name') }}" autocomplete="name" autofocus
                            >
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <select class="form-control" name="status" id="status">
                            <option value="0" disabled selected> وضعیت انتشار </option>
                            <option value="1"> انتشار </option>
                            <option value="2"> عدم انتشار </option>
                        </select>
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                </fieldset>

                <button type="submit" class="btn btn-success pull-left submit">
                    ثبت<i class="fa fa-check"></i>
                </button>
                <a class="btn btn-info pull-left" href="{{ route('videos.index') }}"
                   style="margin-left: 4px;">لیست ویدئو ها</a>
            </form>

        </div>


    </div>
@endsection