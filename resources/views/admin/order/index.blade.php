@extends('master.admin')
@section('title', 'Admin | Đơn hàng của khách hàng')
@section('main')
    <table class="table border table-striped table-inverse table-responsive table-bordered text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Order date</th>
                <th>Status</th>
                <th>Total price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $item) {{-- orders: bên OrderController.php --}}
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                    <td>
                        @if ($item->status == 0)
                            <span>Khách hàng chưa xác nhận đơn đặt hàng</span>
                        @elseif($item->status == 1)
                            <span>Khách hàng đã xác nhận đơn đặt hàng</span>
                        @elseif($item->status == 2)
                            <span>Đơn hàng của khách hàng đã được giao</span>
                        @else
                            <span>Đơn hàng của khách hàng đã bị hủy</span>
                        @endif
                    </td>
                    <td>${{ number_format($item->totalPrice) }}</td>  {{--  totalPrice ben Order.php --}}
                    <td>
                        <a href="{{ route('order.show', $item->id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
