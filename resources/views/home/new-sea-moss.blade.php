@extends('home.layout.app')
@section('title', 'Login')
@section('content')
    <section class="section">
        <div class="container-xxl position-relative p-0">
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-lg-5 pt-lg-5 pb-lg-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Guide Video</h1>
                </div>
            </div>
        </div>
        <div class="container-xxl bg-white p-0">
            <!-- Reservation Start -->
            <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
                <div class="container">
                    <div class="video">
                        <button type="button" class="btn-play" data-bs-toggle="modal" data-src={{ $data->video_link }}
                            data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>

            </div>

            <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content rounded-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">See it in Action</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- 16:9 aspect ratio -->
                            <div class="ratio ratio-16x9">
                                <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                                    allowscriptaccess="always" allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Reservation Start -->
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
