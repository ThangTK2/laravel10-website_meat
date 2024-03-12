@extends('master.main')
@section('title', 'Sản phẩm yêu thích')
@section('main')
    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Sản phẩm yêu thích</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Your product favorite</li>
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
                <table class="table table-striped table-inverse table-responsive table-bordered text-center">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th>Ngày thích</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($favorites as $item) {{-- favorites: bên AccountController.php || prod: bên function Favorite.php --}}
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td>{{ $item->prod->name }}</td>
                                <td><u style="text-decoration: line-through; padding-right: 6px">${{ $item->prod->price }}</u>/ ${{ $item->prod->sale_price }}</td>
                                <td><img src="uploads/product/{{ $item->prod->image }}" width="50" alt="Image"></td>
                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <span><a title="Unlike" onclick="return confirm('Bạn có muốn bỏ thích sản phẩm này?')" href="{{ route('home.favorite', $item->product_id) }}"><i class="fas fa-heart"></i></a></span>
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
