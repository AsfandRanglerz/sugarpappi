@extends('admin.auth.layout.app')
@section('title', 'Register')
@section('style')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Register</h4>
                        </div>
                        <div class="card-body">

                            <form method="POST" action="{{ route('branch.register') }}" class="needs-validation"
                                novalidate="">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="name">Branch Name</label>
                                        <input id="name" type="text" class="form-control" name="name"
                                            tabindex="1" autofocus>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="email">Branch Email</label>
                                        <input id="email" type="email" class="form-control" name="email"
                                            tabindex="1" autofocus>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="phone">Branch Phone</label>
                                        <input id="phone" type="number" class="form-control" name="phone_number"
                                            tabindex="1" autofocus>
                                        @error('phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="phone">Branch No#</label>
                                        <input id="branch_number" type="number" class="form-control" name="branch_number"
                                            tabindex="1" autofocus>
                                        @error('branch_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="phone">Location</label>
                                        <input type="text" class="form-control" name="location" tabindex="1" autofocus>
                                        @error('location')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password" class="control-label">Password</label>
                                        <input id="password" type="password" class="form-control" name="password"
                                            tabindex="2">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="control-label">Password Confirmation</label>
                                        <input id="password_confirmation" type="password" class="form-control"
                                            name="password_confirmation" tabindex="2">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- <div class="mt-5 text-muted text-center">
                        Don't have an account? <a href="{{ route('admin.register') }}">Create One</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    @if (\Illuminate\Support\Facades\Session::has('message'))
        <script>
            toastr.success('{{ \Illuminate\Support\Facades\Session::get('message') }}');
        </script>
    @endif
@endsection
