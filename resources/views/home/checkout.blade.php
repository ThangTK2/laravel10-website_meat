@extends('master.main')
@section('title', 'Thanh Toán')
@section('main')
    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Thanh Toán</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Check Out</li>
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
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-striped table-inverse table-responsive table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên</th>
                                        <th>Số lượng</th>
                                        <th>Hình ảnh</th>
                                        <th>Ngày</th>
                                        <th>Giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0; ?>
                                    @foreach ($carts as $item) {{-- carts: bên AppServiceProvider.php || prod: bên function Cart.php --}}
                                        <tr>
                                            <td scope="row">{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->prod->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td><img src="uploads/product/{{ $item->prod->image }}" width="50" alt="Image"></td>
                                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $item->price }} đ</td>
                                        </tr>
                                        <?php $total += $item->price * $item->quantity; ?>
                                    @endforeach
                                </tbody>
                                <tr>
                                    <th colspan="5">Thành tiền:</th>
                                    <th>{{ number_format($total)}} đ</th>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <form action="" method="post">
                               @csrf
                               <div class="contact-form-wrap">
                                    <span>Tên:</span>
                                    <div class="form-grp">
                                        <input name="name" type="text" placeholder="Your Name *" value="{{ $auth->name }}">
                                    </div>
                                    @error('name')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror

                                    <span>Email:</span>
                                    <div class="form-grp">
                                        <input name="email" type="text" placeholder="Your Email *" value="{{ $auth->email }}">
                                    </div>
                                    @error('email')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror

                                    <span>Số điện thoại:</span>
                                    <div class="form-grp">
                                        <input name="phone" type="text" placeholder="Your Phone *" value="{{ $auth->phone }}">
                                    </div>
                                    @error('phone')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror

                                    <span>Địa chỉ:</span>
                                    <div class="form-grp">
                                        <input name="address" type="text" placeholder="Your Address *" value="{{ $auth->address }}">
                                    </div>
                                    @error('address')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror

                                    <button type="submit">Thanh toán khi nhận hàng</button>
                                </div>
                            </form>
                            <br>

                            {{-- momo --}}
                            <form action="{{ route('momo.payment') }}" method="post">
                                @csrf
                                <div class="contact-form-wrap">
                                    <input type="hidden" name="total_momo" value="{{ $total }}">
                                    <button onclick="return confirm('Bạn có muốn xác nhận thanh toán bằng momo?')" type="submit"><img style="padding-right: 10px" src="uploads/MoMo_Logo.png" alt="momo" width=30>Thanh toán bằng Momo</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->
@endsection
