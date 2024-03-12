<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Đơn Hàng:</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.6;
        }

        h1, h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #999;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            background-color: #fff;
        }

        p {
            margin: 0;
        }
    </style>
</head>
<body>
    <h1>Chi Tiết Đơn Hàng:</h1>
    <table>
        <thead>
            <tr>
                <th>Tên</th>
                <th>Số Điện Thoại</th>
                <th>Địa Chỉ</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order->name }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->email }}</td>
            </tr>
        </tbody>
    </table>
    <h2>Chi Tiết Sản Phẩm: </h2>
    <table>
        <thead>
            <tr>
                <th>Tên</th>
                <th>Số Lượng</th>
                <th>Giá</th>
                <th>Tổng giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->details as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->price }}</td>
                    <td>${{ $item->price * $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>Tổng tiền: ${{ number_format($order->total) }}</p>

</body>
</html>
