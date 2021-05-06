@extends('admin.index')


@section('content')
<h3 class="text-center">لیست نظرات</h3>
<hr>


<div class="tbl-container table-responsive text-nowrap mt-3">
  <table class="table table-hover table-fixed panel_tbl">
    <thead>
      <th>ردیف</th>
      <th>نام وارد شده</th>
      <th>متن نظر</th>
      <th>امتیاز</th>
      <th>محصول</th>
      <th>نام اصلی کاربر</th>
      <th>وضعیت نظر</th>
      <th>عملیات</th>
    </thead>
    <tbody>
      @php
      $counter = 1;
      @endphp
      @foreach ($reviews as $review)
      <tr>
        <td>{{$counter++}}</td>
        <td>{{ $review->name }}</td>
        <td>{{  mb_strimwidth($review->text , 0 , 50 , '---') }}</td>
        <td>{{ $review->vote }}</td>
        <td>{{ $review->product->title }}</td>
        <td>{{ $review->user->name }}</td>
        @if ($review->confirmed == 0)
            <td class="text-danger">تایید نشده</td>
            @else
            <td class="text-success">تایید شده</td>
        @endif
        <td>
          <a href="#" class="btn btn-success accept_review" id="{{ $review->id }}"
          @if($review->confirmed == 1) disabled @endif>
          <i class="fa fa-check"></i></a> |
          <a href="#" class="btn btn-danger reject_review" id="{{ $review->id }}"
          @if($review->confirmed == 0) disabled @endif>
            <i class="fa fa-close"></i></a>
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
</div>

@endsection