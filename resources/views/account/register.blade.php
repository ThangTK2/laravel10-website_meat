@extends('master.main')
@section('title', 'Đăng Ký')
@section('main')
    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Đăng Ký</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Register</li>
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
            <div class="contact-wrap">
                <div class="">
                    <div class="row align-items-center">
                        <div class="">
                            <div class="contact-content">
                                <div class="section-title mb-15">
                                    <span class="sub-title">Đăng Ký</span>
                                </div>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="contact-form-wrap">
                                        <div class="form-grp">
                                            <input name="name" type="text" placeholder="Tên *" value="{{ old('name') }}">
                                        </div>
                                        @error('name')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror

                                        <div class="form-grp">
                                            <input name="email" type="text" placeholder="Email *" value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror

                                        <div class="form-grp">
                                            <input name="phone" type="text" placeholder="Số điện thoại *" value="{{ old('phone') }}">
                                        </div>
                                        @error('phone')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror

                                        <div class="form-grp">
                                            <input name="address" type="text" placeholder="Địa chỉ *" value="{{ old('address') }}">
                                        </div>
                                        @error('address')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror

                                        <div class="form-grp">
                                            <select name="gender" class="form-control" id="" style="background: #f7f3ec; color: #999ea2;; padding: 14px 20px">
                                                <option value="">Giới tính *</option>
                                                <option value="1">Nam</option>
                                                <option value="0">Nữ</option>
                                            </select>
                                        </div>
                                        @error('gender')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror

                                        <div class="form-grp">
                                            <input name="password" type="password" placeholder="Mật khẩu *">
                                        </div>
                                        @error('password')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror

                                        <div class="form-grp">
                                            <input name="confirm_password" type="password" placeholder="Xác nhận mật khẩu *">
                                        </div>
                                        @error('confirm_password')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                        <button type="submit">Đăng ký</button>
                                        <div class="login-register" >
                                            <p class="" style="margin: 0">
                                                <small>Bạn đã có tài khoản?</small>
                                            </p>
                                            <a class="" href="{{ route('account.login') }}">Đăng nhập ngay</a>
                                        </div>
                                    </div>
                                </form>
                                <p class="ajax-response mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-area-end -->

    </main>
    <!-- main-area-end -->
@endsection
