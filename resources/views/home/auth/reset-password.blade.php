@extends('home.auth.layout.app')
@section('title', 'Login')
@section('content')
    <section class="section">
        <!-- Reset Password Start -->
        <div class="container-xxl py-5 pb-lg-5 pb-0 px-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-0">
                <div class="col-xl-6 col-sm-8 col-11 mx-auto bg-primary d-flex align-items-center">
                    <div class="w-100 p-xl-5 p-4 wow fadeInUp light-box-shadow" data-wow-delay="0.2s">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reset Password</h5>
                        <h1 class="text-dark mb-4">Retrieve Your Password</h1>
                        @if (session()->has('message'))
                            <div class="alert alert-{{ session('alert') }}">
                            </div>
                        @endif
                        <form method="POST" action="{{ url('user-reset-password') }}">
                            <input value="{{ $user->email }}" type="hidden" name="email">
                            @csrf
                            <div class="row g-3">
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
                                    <div class="form-floating position-relative d-flex align-items-center">
                                        <input type="password" name="confirmed" class="form-control"
                                            id="inputConfirmPassword" placeholder="Confirm Your Password"
                                            style="padding-right: 2.5rem">
                                        <label for="inputConfirmPassword">Confirm Your Password</label>
                                        <span toggle="#inputConfirmPassword" class="fa fa-eye toggle-password"></span>
                                    </div>
                                </div>
                                @error('confirmed')
                                    <span class="text-danger">{{ $errors->first('confirmed') }}</span>
                                @enderror
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Reset Password End -->
    </section>
@endsection
@section('js')
    @if (\Illuminate\Support\Facades\Session::has('message'))
        <script>
            toastr.success('{{ \Illuminate\Support\Facades\Session::get('message') }}');
        </script>
    @endif
@endsection
