@extends('home.layout.app')
@section('title', 'Login')
@section('content')
<section class="section">
    <div class="container-xxl bg-white p-0">
        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="p-xl-5 p-4 col-sm-8 col-11 mx-auto bg-primary">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-dark fw-normal">Contact Us</h5>
                    <h1 class="mb-xl-5 mb-4 text-dark">Contact For Any Query</h1>
                </div>
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <form action="{{route('sendMail')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="subject" id="subject"
                                        placeholder="Subject">
                                    <label for="subject">Subject</label>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" name="message" placeholder="Leave a message here"
                                        id="message" style="height: 150px"></textarea>
                                    <label for="message">Message</label>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Contact End -->
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
