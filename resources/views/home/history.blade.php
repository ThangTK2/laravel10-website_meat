@extends('master.main')
@section('title', 'Đơn Hàng Của Bạn')
@section('main')
    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Đơn Hàng Của Bạn </h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- contact-area -->
        <section class="contact-area">
            <div class="container" style="padding: 125px 0">
                <table class="table border table-striped table-inverse table-responsive table-bordered text-center">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ngày đặt hàng</th>
                            <th>Trạng thái</th>
                            <th>Tổng gía</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($auth->orders as $item) {{-- auth: bên CheckoutController.php(60 line) || orders: bên function Customer.php --}}
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @if ($item->status == 0)
                                        <span>Bạn chưa xác nhận đơn đặt hàng. Vui lòng kiểm tra Email để xác nhận</span>
                                    @elseif($item->status == 1)
                                        <span>Bạn đã xác nhận đơn đặt hàng. Chúng tôi sẽ giao trong thời gian sớm nhất</span>
                                    @elseif($item->status == 2)
                                        <span>Đơn hàng của bạn đang được giao</span>
                                    @else
                                        <span>Đơn hàng của bạn đã  được hủy</span>
                                    @endif
                                </td>
                                <td>{{ number_format($item->totalPrice) }} đ</td>  {{--  totalPrice ben Order.php --}}
                                <td>
                                    <a href="{{ route('order.detail', $item->id) }}" class="btn btn-sucess">Xem chi tiết</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->
@endsection
