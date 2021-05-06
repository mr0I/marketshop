@extends('admin.index')

@section('content')
  <div class="page_title w-100 text-center p-3 mt-3">
    <h3 class="text-muted">پیشخوان</h3>
  </div>

  <div class="dash mt-3 p-5" style="border: 1px dashed #bdbdbd">
    <div class="card text-white bg-info mb-3">
      <div class="card-body">
        <h5 class="card-title count">{{ $products_count }}</h5>
        <p class="card-text">تعداد محصولات</p>
      </div>
    </div>
    <div class="card text-white bg-warning mb-3">
      <div class="card-body">
        <h5 class="card-title count">{{ $cats_count }}</h5>
        <p class="card-text">تعداد دسته ها</p>
      </div>
    </div>
    <div class="card text-white bg-success mb-3">
      <div class="card-body">
        <h5 class="card-title count">{{ $reviews_count }}</h5>
        <p class="card-text">تعداد نظرات</p>
      </div>
    </div>
    <div class="card text-white bg-danger mb-3">
      <div class="card-body">
        <h5 class="card-title count">{{ $colors_count }}</h5>
        <p class="card-text">تعداد رنگ ها</p>
      </div>
    </div>
    <div class="card text-white bg-info mb-3">
      <div class="card-body">
        <h5 class="card-title count">{{ $brands_count }}</h5>
        <p class="card-text">تعداد برندها</p>
      </div>
    </div>
  </div>
@endsection