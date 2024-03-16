@extends('master.admin')
@section('title', 'Admin | Chi tiết đơn đặt hàng')
@section('main')
    @if ($order->status != 2)
        @if ($order->status != 3)
            @if ($order->status != 0)
                <a href="{{ route('order.update', $order->id) }}?status=2" onclick="return confirm('Bạn có muốn xác nhận giao hàng của khách hàng?')" class="btn btn-success">Xác nhận giao hàng</a>
                <a href="{{ route('order.update', $order->id) }}?status=3" onclick="return confirm('Bạn có muốn hủy xác nhận giao hàng của khách hàng?')" class="btn btn-danger">Xác nhận hủy</a>
            @endif
        @else
            <a href="{{ route('order.update', $order->id) }}?status=1" onclick="return confirm('Bạn có muốn khôi phục lại đơn hàng của khách hàng?')" class="btn btn-warning">Khôi phục</a>
        @endif
    @endif
    <div class="row">
        <div class="col-md-12">
            <h3>Thông tin giao hàng:</h3>
            <table class="table table-bordered table-striped table-inverse table-responsive">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <td>{{ $order->name }}</td>
                    </tr>
                    <tr>
                        <th>Số điện thoại</th>
                        <td>{{ $order->phone }}</td>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <td>{{ $order->address }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $order->email }}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <h3>Thông tin sản phẩm:</h3>
    <table class="table table-striped table-inverse table-responsive table-bordered text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng giá</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            @foreach ($order->details as $item) {{-- details: bên function Order.php --}}
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td><img src="uploads/product/{{ $item->product->image }}" width="50" alt="Hình ảnh"></td>  {{-- product OrderDetail.php --}}
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }}</td>
                    <td>{{ number_format($item->price * $item->quantity) }}</td>
                </tr>
                <?php $total += $item->price * $item->quantity; ?>
            @endforeach
        </tbody>
        <tr>
            <th colspan="5">Thành tiền:</th>
            <th>{{ number_format($total)}} đ</th>
        </tr>
    </table>
    <br>

    <!-- Nút in PDF -->
    @if ($order->status != 3 && $order->status != 0 && $order->status != 1)
        <a href="{{ route('order.pdf', $order->id) }}" class="btn btn-success"> <i style="padding-right: 4px" class="fa fa-download"></i> In PDF</a>
    @endif
@endsection
