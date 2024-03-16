<div style="border: 1px solid #337ab7; padding: 10px 20px; width: 600px;">
    <h3>Hi, {{ $order->customer->name }}</h3>  {{-- customer ben Order.php || $order ben OrderEmail.php --}}
    <h3>
        Verify Order Email
    </h3>
    <h4>Your order detail:</h4>
    <table class="table" border="1" >
        <thead>
            <tr>
                <th>STT</th>
                <th>Product name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            @foreach ($order->details as $detail) {{-- details: ben Order.php --}}
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->price }} đ</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->price * $detail->quantity) }} đ</td>
                </tr>
                <?php $total += $detail->price * $detail->quantity; ?>
            @endforeach
        </tbody>
        <tr>
            <th colspan="4">Total price:</th>
            <th>{{ number_format($total)}} đ</th>
        </tr>
    </table>
    <p><a href="{{ route('order.verify', $token) }}" style="display: inline-block; padding: 7px 25px; color: white; background: blue; text-decoration: none;">Click here get to Verify Order!!!</a></p>

</div>
