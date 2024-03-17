@extends('master.main')
@section('titile', 'Trang chủ')
@section('main')
    <!-- main-area -->
    <main>

        <!-- area-bg -->
        <div class="area-bg" data-background="uploads/bg/area_bg.jpg">

            <!-- banner-area -->
            <section class="banner-area banner-bg tg-motion-effects" data-background="uploads/banner/{{ $topBanner->image }}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="banner-content">
                                <h1 class="title wow fadeInUp" data-wow-delay=".2s">{{ $topBanner->name }}</h1>
                                <span class="sub-title wow fadeInUp" data-wow-delay=".4s">Butcher & Meat shop</span>
                                <a href="{{ $topBanner->link }}" class="btn wow fadeInUp" data-wow-delay=".6s">Mua ngay</a>
                            </div>
                            <div class="banner-img text-center wow fadeInUp" data-wow-delay=".8s">
                                <img src="uploads/banner/banner_img.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner-shape-wrap">
                    <img src="uploads/banner/banner_shape01.png" alt="" class="tg-motion-effects5">
                    <img src="uploads/banner/banner_shape02.png" alt="" class="tg-motion-effects4">
                    <img src="uploads/banner/banner_shape03.png" alt="" class="tg-motion-effects3">
                    <img src="uploads/banner/banner_shape04.png" alt="" class="tg-motion-effects5">
                </div>
            </section>
            <!-- banner-area-end -->

            <!-- features-area -->
            <section class="features-area pt-130 pb-70">
                <div class="container">
                    <div class="row">
                        @foreach ($new_products as $item)
                            <div class="col-lg-6">
                                <div class="features-item tg-motion-effects">
                                    <div class="features-content">
                                        <span style="padding-bottom: 8px"> {{ $item->cat->name }}</span>
                                        <h4 class="title"><a href="{{ route('home.product', $item->id) }}">{{ $item->name }}</a></h4>
                                        <div style="display: flex; align-items: center;">
                                            @if ($item->sale_price > 0) {{-- nếu có khuyến mãi --}}
                                            <div style="color: #7F6F6C; padding-right: 8px"><span><s>{{ number_format($item->price) }} đ</s></span></div>
                                            <span class="price">{{ number_format($item->sale_price) }} đ</span>
                                            @else
                                                <span class="price">{{ number_format($item->price) }} đ</span>
                                            @endif
                                        </div>

                                        {{-- auth('cus') bên config.auth  ||  favorited: bên Product.php line 30 --}}
                                        <div class="favorite-action" style="display: flex; align-items: center;">
                                            @if (auth('cus')->check())
                                                @if ($item->favorited)
                                                    <span><a title="Unlike" onclick="return confirm('Bạn có muốn bỏ thích sản phẩm này?')" href="{{ route('home.favorite', $item->id) }}"><i class="fas fa-heart"></i></a></span>
                                                @else
                                                    <span><a title="Like" href="{{ route('home.favorite', $item->id) }}"><i class="far fa-heart"></i></a></span>
                                                @endif

                                                <div style="padding-left: 10px"><a title="Add to cart" href="{{ route('cart.add', $item->id) }}"><i class="fa fa-shopping-cart"></i></a></div>
                                            @else
                                                <a title="Add to cart" href="{{route('account.login')}}" onclick="return confirm('Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng')"><i class="fa fa-shopping-cart"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="features-img">
                                        <img src="uploads/product/{{ $item->image }}" alt="">
                                        <div class="features-shape">
                                            <img src="uploads/images/features_shape.png" alt="" class="tg-motion-effects4">
                                        </div>
                                    </div>
                                    <div class="features-overlay-shape" data-background="uploads/images/features_overlay.png"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!-- features-area-end -->

        </div>
        <!-- area-bg-end -->

        <!-- product-area -->
        <section class="product-area product-bg" data-background="uploads/bg/product_bg01.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center mb-60">
                            <span class="sub-title">Sản phẩm bán chạy</span>
                            <div class="title-shape" data-background="uploads/images/title_shape.png"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach ($sale_products as $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="product-item">
                                <div class="product-img">
                                    <a href="{{ route('home.product', $item->id) }}"><img src="uploads/product/{{ $item->image }}" alt="Image"></a>
                                </div>
                                <div class="product-content">
                                    <div class="line" data-background="uploads/images/line.png"></div>
                                    <h4 class="title"><a href="{{ route('home.product', $item->id) }}">{{ $item->name }}</a></h4>
                                    <div style="display: flex; align-items: center; justify-content: center">
                                        @if ($item->sale_price > 0)
                                            <div style="color: #7F6F6C; padding-right: 8px"><span><s>{{ number_format($item->price) }} đ</s></span></div>
                                            <span style="color:#df2614; font-size:24px; font-weight:700; grid-area:auto; line-height:48px" class="price">{{ number_format($item->sale_price) }} đ</span>
                                        @else
                                            <span class="price">{{ number_format($item->price) }} đ</span>
                                        @endif
                                    </div>

                                    <div class="favorite-action" style="display: flex; align-items: center; justify-content: center">
                                        @if (auth('cus')->check())
                                            @if ($item->favorited)
                                                <span><a title="Unlike" onclick="return confirm('Bạn có muốn bỏ thích sản phẩm này?')" href="{{ route('home.favorite', $item->id) }}"><i class="fas fa-heart"></i></a></span>
                                            @else
                                                <span><a title="Like" href="{{ route('home.favorite', $item->id) }}"><i class="far fa-heart"></i></a></span>
                                            @endif

                                            <div style="padding-left: 10px"><a title="Add to cart" href="{{ route('cart.add', $item->id) }}"><i class="fa fa-shopping-cart"></i></a></div>
                                        @else
                                            <a title="Add to cart" href="{{route('account.login')}}" onclick="return confirm('Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng')"><i class="fa fa-shopping-cart"></i></a>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-shape">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 401 314" preserveAspectRatio="none">
                                        <path d="M331.5,1829h361a20,20,0,0,1,20,20l-29,274a20,20,0,0,1-20,20h-292a20,20,0,0,1-20-20l-40-274A20,20,0,0,1,331.5,1829Z" transform="translate(-311.5 -1829)" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="shop-shape">
                <img src="uploads/product/product_shape01.png" alt="">
            </div>
        </section>
        <!-- product-area-end -->

        <!-- gallery-area -->
        <div class="gallery-area gallery-bg" data-background="uploads/gallery/{{ $galleries[0]->image }}">
            <div class="container">
                <div class="gallery-item-wrap">
                    <div class="row justify-content-center">
                        <div class="col-88">
                            <div class="gallery-active">
                                @foreach ($galleries as $ga)
                                    <div class="gallery-item">
                                        <a href="uploads/gallery/{{ $ga->image }}" class="popup-image"><img src="uploads/gallery/gallery_img01.png" alt=""></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- gallery-area-end -->

        <!-- product-area -->
        <section class="product-area-two product-bg-two" data-background="uploads/bg/product_bg02.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center mb-70">
                            <span class="sub-title">Sản phẩm nổi bật</span>
                            <div class="title-shape" data-background="uploads/images/title_shape.png"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach ($feature_products as $item)
                        <div class="col-lg-6 col-md-10">
                            <div class="product-item-two">
                                <div class="product-img-two">
                                    <a href="{{ route('home.product', $item->id) }}"><img src="uploads/product/{{ $item->image }}" alt="Image"></a>
                                </div>
                                <div class="product-content-two">
                                    <div class="product-info">
                                        <h4 class="title"><a href="{{ route('home.product', $item->id) }}">{{ $item->name }}</a></h4>
                                        <div class="favorite-action" style="display: flex; align-items: center;">
                                            @if (auth('cus')->check())
                                                @if ($item->favorited)
                                                    <span><a title="Unlike" onclick="return confirm('Bạn có muốn bỏ thích sản phẩm này?')" href="{{ route('home.favorite', $item->id) }}"><i class="fas fa-heart"></i></a></span>
                                                @else
                                                    <span><a title="Like" href="{{ route('home.favorite', $item->id) }}"><i class="far fa-heart"></i></a></span>
                                                @endif

                                                <div style="padding-left: 10px"><a title="Add to cart" href="{{ route('cart.add', $item->id) }}"><i class="fa fa-shopping-cart"></i></a></div>
                                            @else
                                                <a title="Add to cart" href="{{route('account.login')}}" onclick="return confirm('Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng')"><i class="fa fa-shopping-cart"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        @if ($item->sale_price > 0)
                                            <span><s>{{ number_format($item->price) }} đ</s></span>
                                            <span style="color:#df2614; font-size:24px; font-weight:700; grid-area:auto; line-height:48px" class="price">{{ number_format($item->sale_price) }}đ</span>
                                        @else
                                            <span class="price">{{ number_format($item->price) }} đ</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="shop-now-btn text-center mt-40">
                    <a href="" class="btn">Mua ngay</a>
                </div>
            </div>
        </section>
        <!-- product-area-end -->

        <!-- cta-area -->
        <section class="cta-area position-relative">
            <div class="cta-bg" data-background="uploads/bg/cta_bg.jpg"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="cta-content">
                            <img src="uploads/icons/cta_icon.png" alt="">
                            <h2 class="title">Bemet</h2>
                            <div class="cta-bottom">
                                <a href="shop.html" class="btn">Mua ngay</a>
                                <a href="tel:0929029035" class="btn call-btn"><i class="fas fa-headphones-alt"></i>Gọi ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cta-area-end -->

    </main>
    <!-- main-area-end -->


@endsection
