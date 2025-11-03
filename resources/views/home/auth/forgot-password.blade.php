@extends('home.auth.layout.app')
@section('title', 'Login')
@section('content')
    <section class="section">
        <!-- Forget Password Start -->
        <div class="container-xxl py-5 pb-lg-5 pb-0 px-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-0">
                <div class="col-xl-6 col-sm-8 col-11 mx-auto bg-primary d-flex align-items-center">
                    <div class="w-100 p-xl-5 p-4 wow fadeInUp light-box-shadow" data-wow-delay="0.2s">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Forget Password</h5>
                        <h1 class="text-dark mb-4">Retrieve Your Password</h1>
                        @if (session()->has('message'))
                            <div class="alert alert-{{ session('alert') }}">
                            </div>
                        @endif
                        <form method="POST" action="{{ url('user-reset-password-link') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="form-group text-center">
                                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                                    <small class="mt-2 d-block text-danger">(Note: Please check your Spam/Junk folder in case the email is not received in the inbox. If it's not there as well, please contact us at contact@sugarpappi.com)</small>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Forget Password End -->
    </section>
@endsection
@section('js')
    @if (\Illuminate\Support\Facades\Session::has('message'))
        <script>
            toastr.success('{{ \Illuminate\Support\Facades\Session::get('message') }}');
        </script>
    @endif
@endsection
