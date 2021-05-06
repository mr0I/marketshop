@extends('admin.index')

@section('content')
    <div class="container" style="width: 90%">
        <h3 class="text-center">ویرایش اسلاید</h3>
        <hr>

        <div class="row">
            <form class="form-horizontal" method="POST" id="frm_slideEdit"
                  action="{{ route('sliders.update', ['id'=> $slide->id]) }}" enctype="multipart/form-data">
                <fieldset>
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group row">
                        <div>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="نام اسلاید*"
                                   value="{{ $slide->name ?? old('name') }}" autocomplete="name" autofocus>
                            @error('name')
                            <small class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div>
                            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" placeholder="لینک اسلاید*"
                                   value="{{ $slide->url ?? old('url') }}" autocomplete="url" autofocus>
                            @error('url')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div>
                            <input type="file" accept=".png, .jpeg" class="form-control @error('image') is-invalid @enderror" name="image" placeholder="تصویر اسلاید*"
                                   value="{{ $slide->image ?? old('image') }}" autocomplete="image" autofocus>
                            @if(isset($slide->image))
                                <img src="{{ url('/uploads/images/slides/'.$slide->image) }}"
                                     alt="" style="width: 50px;height: auto;">
                            @endif
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                </fieldset>

                <button type="submit" class="btn btn-success pull-left submit"
                        id="editSlide" disabled>ویرایش
                </button>
                <a class="btn btn-danger pull-left" href="{{ route('sliders.index') }}"
                   style="margin-left: 4px;">لیست اسلایدها</a>
            </form>
        </div>

    </div>
@endsection