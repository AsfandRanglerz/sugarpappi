@extends('home.layout.app')
@section('title', 'Login')
@section('content')
    <style>
        .gallery-img-block {
            margin-bottom: 24px;
        }

        .gallery-img-block:nth-last-child(0),
        .gallery-img-block:nth-last-child(1),
        .gallery-img-block:nth-last-child(2) {
            margin-bottom: 0;
        }

        .gallery-img {
            height: 300px;
            object-fit: cover;
        }

        @media (max-width: 991px) {
            .gallery-img {
                height: 255px;
            }
        }

        @media (max-width: 767px) {
            .gallery-img {
                height: 215px;
            }
        }

        @media (max-width: 575px) {
            .gallery-img {
                height: 115px;
            }
        }
    </style>
    <section class="section">
        <div class="container-xxl position-relative p-0">
            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-lg-5 pt-lg-5 pb-lg-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Our Gallery</h1>
                </div>
            </div>
        </div>
        <div class="container-xxl bg-white p-0">
            <!-- Menu Start -->
            <div class="container py-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="container-xxl">
                    <div class="text-center">
                        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Our Gallery</h5>
                        <h3 class="mb-5 col-sm-8 mx-auto">Explore Our Delicious Gallery</h3>
                    </div>

                    <div class="row" id="azGallery">
                        @foreach ($galleries as $gallery)
                            <a class="col-sm-4 col-6 gallery-img-block" href="{{ asset($gallery->image) }}"
                                data-lg-size="1600-2400" data-sub-html="<h4 class='text-white'>Delicious Smoothie</h4>">
                                <img class="gallery-img w-100" src="{{ asset($gallery->image) }}" />
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Menu End -->
        </div>
    </section>
@endsection
@section('js')
    @if (\Illuminate\Support\Facades\Session::has('message'))
        <script>
            toastr.success('{{ \Illuminate\Support\Facades\Session::get('message') }}');
        </script>
    @endif
    <script>
        $(function() {
            $('#azGallery').lightGallery({
                thumbnail: true,
                zoom: true,
                fullScreen: true,
                counter: true,
                clone: true,
                autoplayControls: false,
                download: false,
                share: false
            });
        });
    </script>

@endsection
