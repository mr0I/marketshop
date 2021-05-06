@extends('site.layouts.master')

@section('title')
خطای دسترسی
@endsection



@section('content')
	<div class="container text-center">
		<h6 class=" alert alert-danger">شما مجوز لازم برای دیدن این صفحه را ندارید</h6>
		<a href="{{url('/')}}" class="btn btn-success">بازگشت</a>
	</div>

@endsection