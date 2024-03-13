@extends('master.admin')
@foreach ($orders as $item)
    @if ($item->status == 0)
        @section('title', 'Admin | Đơn hàng của khách hàng' . ' - Chưa xác nhận')
    @elseif ($item->status == 1)
        @section('title', 'Admin | Đơn hàng của khách hàng' . ' - Đã xác nhận')
    @elseif ($item->status == 2)
        @section('title', 'Admin | Đơn hàng của khách hàng' . ' - Đã được giao hàng')
    @elseif ($item->status == 3)
        @section('title', 'Admin | Đơn hàng của khách hàng' . ' - Đã hủy hàng')
    @endif
@endforeach
@section('main')
    <table class="table border table-striped table-inverse table-responsive table-bordered text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Ngày giao hàng</th>
                <th>Trạng thái</th>
                <th>Tổng giá</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $item) {{-- orders: bên OrderController.php --}}
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if ($item->status == 0)
                            <span>Khách hàng chưa xác nhận đơn đặt hàng</span>
                        @elseif($item->status == 1)
                            <span>Khách hàng đã xác nhận đơn đặt hàng</span>
                        @elseif($item->status == 2)
                            <span>Đơn hàng của khách hàng đang được giao</span>
                        @else
                            <span>Đơn hàng của khách hàng đã bị hủy</span>
                        @endif
                    </td>
                    <td>${{ number_format($item->totalPrice) }}</td>  {{--  totalPrice ben Order.php --}}
                    <td>
                        <a href="{{ route('order.show', $item->id) }}" class="btn btn-sm btn-success">Xem chi tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
