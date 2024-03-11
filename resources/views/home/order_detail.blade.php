@extends('master.main')
@section('title', 'Your Order Detail')
@section('main')
    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Your Order Detail</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Your Order Detail</li>
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
                <div class="row">
                    <div class="col-md-6">
                        <h3>Customer Information:</h3>
                        <table class="table table-striped table-inverse table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $auth->name }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $auth->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $auth->address }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $auth->email }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h3>Delivery Information:</h3>
                        <table class="table table-bordered table-striped table-inverse table-responsive">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $order->name }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $order->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
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

                <br><br>

                <h3>Product Information:</h3>
                <table class="table table-striped table-inverse table-responsive table-bordered text-center">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Sub total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        @foreach ($order->details as $item) {{-- details: bên function Order.php --}}
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td><img src="uploads/product/{{ $item->product->image }}" width="50" alt="Image"></td>  {{-- product OrderDetail.php --}}
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price) }}</td>
                                <td>{{ number_format($item->price * $item->quantity) }}</td>
                            </tr>
                            <?php $total += $item->price * $item->quantity; ?>
                        @endforeach
                    </tbody>
                    <tr>
                        <th colspan="5">Total price:</th>
                        <th>${{ number_format($total)}}</th>
                    </tr>
                </table>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->
@endsection