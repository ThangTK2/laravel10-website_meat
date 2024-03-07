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
                                <a href="{{ $topBanner->link }}" class="btn wow fadeInUp" data-wow-delay=".6s">order now</a>
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
                                        <span> {{ $item->cat->name }}</span>
                                        <h4 class="title"><a href="{{ route('home.product', $item->id) }}">{{ $item->name }}</a></h4>
                                        <p>{!! $item->description !!}</p>
                                        @if ($item->sale_price > 0) {{-- nếu có khuyến mãi --}}
                                            <span><s>${{ $item->price }}</s></span>
                                            <span class="price">${{ $item->sale_price }}</span>
                                        @else
                                            <span class="price">${{ $item->price }}</span>
                                        @endif

                                        {{-- auth('cus') bên config.auth  ||  favorited: bên Product.php line 30 --}}
                                        <div class="favorite-action">
                                            @if (auth('cus')->check())
                                                @if ($item->favorited)
                                                    <span><a title="Unlike" onclick="return confirm('Do you want to unlike the product?')" href="{{ route('home.favorite', $item->id) }}"><i class="fas fa-heart"></i></a></span>
                                                @else
                                                    <span><a title="Like" href="{{ route('home.favorite', $item->id) }}"><i class="far fa-heart"></i></a></span>
                                                @endif

                                                <a title="Add to cart" href="{{ route('cart.add', $item->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                            @else
                                                <a title="Add to cart" href="{{route('account.login')}}" onclick="return confirm('Please log in to add products to cart')"><i class="fa fa-shopping-cart"></i></a>
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
                            <span class="sub-title">Organic Shop</span>
                            <h2 class="title">Sale Products</h2>
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
                                    <p>{!! $item->description !!}</p>
                                    @if ($item->sale_price > 0)
                                        <span><s>${{ $item->price }}</s></span>
                                        <span class="price">${{ $item->sale_price }}</span>
                                    @else
                                        <span class="price">${{ $item->price }}</span>
                                    @endif

                                    <div class="favorite-action">
                                        @if (auth('cus')->check())
                                            @if ($item->favorited)
                                                <span><a title="Unlike" onclick="return confirm('Do you want to unlike the product?')" href="{{ route('home.favorite', $item->id) }}"><i class="fas fa-heart"></i></a></span>
                                            @else
                                                <span><a title="Like" href="{{ route('home.favorite', $item->id) }}"><i class="far fa-heart"></i></a></span>
                                            @endif

                                            <a title="Add to cart" href="{{ route('cart.add', $item->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                        @else
                                            <a title="Add to cart" href="{{route('account.login')}}" onclick="return confirm('Please log in to add products to cart')"><i class="fa fa-shopping-cart"></i></a>
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
                            <span class="sub-title">Organic Shop</span>
                            <h2 class="title">Feature Products</h2>
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
                                        <p>{!! $item->description !!}</p>
                                        <div class="favorite-action">
                                            @if (auth('cus')->check())
                                                @if ($item->favorited)
                                                    <span><a title="Unlike" onclick="return confirm('Do you want to unlike the product?')" href="{{ route('home.favorite', $item->id) }}"><i class="fas fa-heart"></i></a></span>
                                                @else
                                                    <span><a title="Like" href="{{ route('home.favorite', $item->id) }}"><i class="far fa-heart"></i></a></span>
                                                @endif

                                                <a title="Add to cart" href="{{ route('cart.add', $item->id) }}"><i class="fa fa-shopping-cart"></i></a>
                                            @else
                                                <a title="Add to cart" href="{{route('account.login')}}" onclick="return confirm('Please log in to add products to cart')"><i class="fa fa-shopping-cart"></i></a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        @if ($item->sale_price > 0)
                                            <span><s>${{ $item->price }}</s></span>
                                            <span class="price">${{ $item->sale_price }}</span>
                                        @else
                                            <span class="price">${{ $item->price }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="shop-now-btn text-center mt-40">
                    <a href="shop.html" class="btn">Shop Now</a>
                </div>
            </div>
        </section>
        <!-- product-area-end -->

        <!-- team-area -->
        <section class="team-area team-bg" data-background="uploads/bg/team_bg.jpg">
            <div class="container custom-container-two">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="team-content-wrap">
                            <div class="section-title white-title mb-50">
                                <span class="sub-title">Meet Our Team</span>
                                <h2 class="title">Our CREATIVE Team</h2>
                            </div>
                            <p>BUY SMOKEY GRILLED meats and CHICKEN <span>GET catling</span>  FREE</p>
                            <a href="shop.html" class="btn">Shop Now</a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="team-item-wrap">
                            <div class="row justify-content-center">
                                <div class="col-lg-4 col-md-6 col-sm-8">
                                    <div class="team-item">
                                        <div class="team-thumb">
                                            <img src="uploads/team/team_img01.jpg" alt="">
                                            <a href="team-details.html" class="link-btn"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <div class="team-content">
                                            <div class="line" data-background="uploads/images/line.png"></div>
                                            <h4 class="title"><a href="team-details.html">Alaxzender pilot</a></h4>
                                            <span>stack expert</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-8">
                                    <div class="team-item">
                                        <div class="team-thumb">
                                            <img src="uploads/team/team_img02.jpg" alt="">
                                            <a href="team-details.html" class="link-btn"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <div class="team-content">
                                            <div class="line" data-background="uploads/images/line.png"></div>
                                            <h4 class="title"><a href="team-details.html">Starlee jonson</a></h4>
                                            <span>stack expert</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-8">
                                    <div class="team-item">
                                        <div class="team-thumb">
                                            <img src="uploads/team/team_img03.jpg" alt="">
                                            <a href="team-details.html" class="link-btn"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <div class="team-content">
                                            <div class="line" data-background="uploads/images/line.png"></div>
                                            <h4 class="title"><a href="team-details.html">Alaxzender pilot</a></h4>
                                            <span>stack expert</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- team-area-end -->

        <!-- faq-area -->
        <section class="faq-area tg-motion-effects faq-bg" data-background="uploads/bg/faq_bg.jpg">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <div class="faq-img-wrap">
                            <img src="uploads/images/faq_img01.png" alt="">
                            <img src="uploads/images/faq_img02.png" alt="">
                            <img src="uploads/images/faq_img03.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="faq-content">
                            <div class="section-title mb-60">
                                <span class="sub-title">Customer Quotes</span>
                                <h2 class="title">Frequently <span>Asked</span> Questions.</h2>
                            </div>
                            <div class="faq-wrap">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                hamburg Meat is animal flesh food.
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>Meat provide well shaped fresh and the organic meat well animals is Humans have hunted schistoric times</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Revolution allowed the of animals
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>Meat provide well shaped fresh and the organic meat well animals is Humans have hunted schistoric times</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Meat is animal flesh food.
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>Meat provide well shaped fresh and the organic meat well animals is Humans have hunted schistoric times</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="faq-shape-wrap">
                <img src="uploads/images/faq_shape01.png" alt="" class="tg-motion-effects3">
                <img src="uploads/images/faq_shape02.png" alt="" class="tg-motion-effects2">
            </div>
        </section>
        <!-- faq-area-end -->

        <!-- cta-area -->
        <section class="cta-area position-relative">
            <div class="cta-bg" data-background="uploads/bg/cta_bg.jpg"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="cta-content">
                            <img src="uploads/icons/cta_icon.png" alt="">
                            <h2 class="title">Get a Free Quote</h2>
                            <div class="cta-bottom">
                                <a href="shop.html" class="btn">buy now</a>
                                <a href="tel:0123456789" class="btn call-btn"><i class="fas fa-headphones-alt"></i>make a call</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- cta-area-end -->

        <!-- blog-post-area -->
        <section class="blog-post-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center mb-70">
                            <span class="sub-title">Latest News</span>
                            <h2 class="title">Latest News Update</h2>
                            <div class="title-shape" data-background="uploads/images/title_shape.png"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-post-item">
                            <div class="blog-post-thumb">
                                <a href="blog-details.html"><img src="uploads/blog/blog_post01.jpg" alt=""></a>
                            </div>
                            <div class="blog-post-content">
                                <div class="blog-meta">
                                    <ul class="list-wrap">
                                        <li><a href="blog.html"><i class="fas fa-user"></i>Hamolin Pilot</a></li>
                                        <li><i class="fas fa-comments"></i>03</li>
                                    </ul>
                                </div>
                                <h4 class="title"><a href="blog-details.html">Hamburg Meat is Animal Flesh Food</a></h4>
                                <p>Meat provide well shapd fresh and organic meat well animals is Humans.</p>
                                <div class="blog-post-bottom">
                                    <a href="blog-details.html" class="link-btn">Read More</a>
                                    <a href="blog-details.html" class="link-arrow"><i class="fas fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-post-item">
                            <div class="blog-post-thumb">
                                <a href="blog-details.html"><img src="uploads/blog/blog_post02.jpg" alt=""></a>
                            </div>
                            <div class="blog-post-content">
                                <div class="blog-meta">
                                    <ul class="list-wrap">
                                        <li><a href="blog.html"><i class="fas fa-user"></i>Hamolin Pilot</a></li>
                                        <li><i class="fas fa-comments"></i>03</li>
                                    </ul>
                                </div>
                                <h4 class="title"><a href="blog-details.html">Good Source of Iron And Flesh Food</a></h4>
                                <p>Meat provide well shapd fresh and organic meat well animals is Humans.</p>
                                <div class="blog-post-bottom">
                                    <a href="blog-details.html" class="link-btn">Read More</a>
                                    <a href="blog-details.html" class="link-arrow"><i class="fas fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-post-item">
                            <div class="blog-post-thumb">
                                <a href="blog-details.html"><img src="uploads/blog/blog_post03.jpg" alt=""></a>
                            </div>
                            <div class="blog-post-content">
                                <div class="blog-meta">
                                    <ul class="list-wrap">
                                        <li><a href="blog.html"><i class="fas fa-user"></i>Hamolin Pilot</a></li>
                                        <li><i class="fas fa-comments"></i>03</li>
                                    </ul>
                                </div>
                                <h4 class="title"><a href="blog-details.html">Chicken Sausage For Sale Humanely Raised</a></h4>
                                <p>Meat provide well shapd fresh and organic meat well animals is Humans.</p>
                                <div class="blog-post-bottom">
                                    <a href="blog-details.html" class="link-btn">Read More</a>
                                    <a href="blog-details.html" class="link-arrow"><i class="fas fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog-post-area-end -->

    </main>
    <!-- main-area-end -->
@endsection
