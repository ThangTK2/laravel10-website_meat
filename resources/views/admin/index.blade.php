@extends('master.admin')
@section('title', 'Admin | Dashboard')
@section('main')
<div class="row">
    <div class="col-lg-4">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $totalCategories ?? '0' }}</h3>
                <p>Tổng Số Danh Mục</p>
            </div>
            <div class="icon">
                <i class="fa fa-table"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $totalProducts ?? '0' }}</h3>
                <p>Tổng Số Sản Phẩm</p>
            </div>
            <div class="icon">
                <i class="fa fa-th"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $totalOrders ?? '0' }}</h3>
                <p>Tổng Số Đơn Hàng</p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
        </div>
    </div>
</div>
@endsection
