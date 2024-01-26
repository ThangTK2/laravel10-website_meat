@extends('master.main')

@section('main')
    <!-- main-area -->
    <main>

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-content">
                            <h2 class="title">Reset Password</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
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
                                    <span class="sub-title">Reset Password!</span>
                                </div>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="contact-form-wrap">
                                        <div class="form-grp">
                                            <input name="password" type="password" placeholder="Your New Password *" value="{{ old('password') }}">
                                        </div>
                                        @error('password')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror

                                        <div class="form-grp">
                                            <input name="confirm_password" type="password" placeholder="Your New Confirm Password *">
                                        </div>
                                        @error('confirm_password')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                        <button type="submit">Reset Your Password</button>
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
