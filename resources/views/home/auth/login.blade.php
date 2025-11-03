@extends('home.auth.layout.app')
@section('title', 'Login')
@section('content')
    <section class="section">
        <div class="container-xxl bg-white lolo p-0">
            <div class="container-xxl py-5 pb-lg-5 pb-0 px-0 wow fadeInUp" data-wow-delay="0.1s">
                <div class="row g-0">
                    <div class="col-xl-6 col-sm-8 col-11 mx-auto bg-primary d-flex align-items-center">
                        <div class="p-xl-5 p-4 wow fadeInUp light-box-shadow" data-wow-delay="0.2s">
                            <h5 class="section-title ff-secondary text-start text-dark fw-normal">Login</h5>
                            <h1 class="text-dark mb-4">Welcome back! Your Sugar Pappi cravings await.</h1>
                            <form method="POST" action="{{ url('users/login') }}" id="loginForm">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="Your Email">
                                            <label for="email">Your Email</label>
                                        </div>
                                        @error('email')
                                            <span class="text-danger">Email required</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating position-relative d-flex align-items-center">
                                            <input type="password" name="password" class="form-control" id="inputPassword"
                                                placeholder="Type Your Password" style="padding-right: 2.5rem">
                                            <label for="inputPassword">Password</label>
                                            <span toggle="#inputPassword" class="fa fa-eye toggle-password"></span>
                                        </div>
                                        @error('password')
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="text-end mb-3">
                                            <a href="{{ asset('forgot-password') }}" class="text-dark">Forget Password?</a>
                                        </div>
                                        {{--  <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group text-center">
                                                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                                    @if ($errors->has('g-recaptcha-response'))
                                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>  --}}
                                        <button class="btn btn-primary w-100 py-3" type="submit"
                                            id="loginButton">Login</button>
                                        <h5 class="text-dark text-center mt-4 mb-0">New User? <a
                                                href="{{ route('getRegistor') }}" class="text-dark">Sign Up</a></h5>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <script>
        // Wait for the DOM content to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Function to get the user data
            function getUserData() {
                // Replace this with your logic to obtain the user data
                var email = document.getElementById('email').value;
                var userData = {
                    email: email,
                };
                return userData;
            }

            // Add event listener to the form submit event
            document.getElementById('loginForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var userData = getUserData();

                // Check if window.ReactNativeWebView is defined before using it
                if (window.ReactNativeWebView) {
                    window.ReactNativeWebView.postMessage(JSON.stringify(userData));
                } else {
                    console.error("window.ReactNativeWebView is not defined");
                }

                this.submit();
            });
        });
    </script>
@endsection

@section('js')
    @if (\Illuminate\Support\Facades\Session::has('message'))
        <script>
            toastr.success('{{ \Illuminate\Support\Facades\Session::get('message') }}');
        </script>
    @endif
@endsection
