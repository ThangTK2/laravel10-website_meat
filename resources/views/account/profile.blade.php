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
                            <h2 class="title">Your Profile</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Your Profile</li>
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
                                    <span class="sub-title">Your Profile</span>
                                </div>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="contact-form-wrap">
                                        <div class="form-grp">
                                            <input name="name" value="{{ $auth->name }}" type="text" placeholder="Your Name *" value="{{ old('name') }}">
                                        </div>
                                        @error('name')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror

                                        <div class="form-grp">
                                            <input name="email" value="{{ $auth->email }}" type="text" placeholder="Your Email *" value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror

                                        <div class="form-grp">
                                            <input name="phone" value="{{ $auth->phone }}" type="text" placeholder="Your Phone *" value="{{ old('phone') }}">
                                        </div>
                                        @error('phone')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror

                                        <div class="form-grp">
                                            <input name="address" value="{{ $auth->address }}" type="text" placeholder="Your Address *" value="{{ old('address') }}">
                                        </div>
                                        @error('address')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror

                                        <div class="form-grp">
                                            <select name="gender" class="form-control" id="" style="background: #f7f3ec; color: #337ab7;; padding: 14px 20px">
                                                {{-- <option value="">Select Gender *</option> --}}
                                                <option value="1" {{ $auth->gender == 1 ? 'selected' : ''  }}>Male</option>
                                                <option value="0" {{ $auth->gender == 0 ? 'selected' : ''  }}>Female</option>
                                            </select>
                                        </div>
                                        @error('gender')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror

                                        <div class="form-grp">
                                            <input name="password" type="password" placeholder="Your Password *" value="{{ old('password') }}">
                                        </div>
                                        @error('password')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                        <button type="submit">Update Profile</button>
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
