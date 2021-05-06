@extends('site.layouts.master')

@section('content')
    <div class="row">
        <div id="content" class="col-sm-12">
          <p class="text-center lead">متاسفیم!<br>
            صفحه ی مورد نظرتان را پیدا نکردیم! </p>
          <div class="buttons text-center"> <a class="btn btn-primary btn-lg" href="{{ url('/') }}">بازگشت به صفحه اصلی</a> </div>
        </div>
      </div>
@endsection