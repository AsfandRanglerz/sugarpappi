@extends('home.layout.app')
@section('title', 'Login')
@section('content')
    <style>
        .gallery-item {
            margin-bottom: 24px;
        }

        .gallery-item:nth-last-child(1),
        .gallery-item:nth-last-child(2),
        .gallery-item:nth-last-child(3) {
            margin-bottom: 0;
        }
    </style>
    <section class="section">
        <div class="container-xxl bg-white p-0">
            <div class="container-xxl position-relative p-0">

                <div class="container-xxl py-5 bg-dark hero-header mb-5">
                    <div class="container text-center my-lg-5 pt-lg-5 pb-lg-4">
                        <h1 class="display-3 text-white mb-3 animated slideInDown">Menu Gallery</h1>
                    </div>
                </div>
            </div>
            <!-- Navbar & Hero End -->

            <!-- Menu Start -->
            <div class="container py-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="container-xxl">
                    <div class="text-center">
                        <h5 class="section-title ff-secondary text-center text-primary fw-normal">Our Menu Gallery</h5>
                        <h3 class="mb-5 col-sm-8 mx-auto">Delicious Smoothie Selection</h3>
                    </div>
                    <div class="row" id="menuGallery">
                        @foreach ($menuGalleries as $menuGallery)
                            <a class="col-sm-4 col-6 gallery-item" href="{{ asset($menuGallery->image) }}"
                                data-lg-size="1600-2400">
                                <div class="bg-transparent border rounded p-4">
                                    <img class="w-100" src="{{ asset($menuGallery->image) }}" alt="Gallery Image" />
                                </div>
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
            $('#menuGallery').lightGallery({
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
