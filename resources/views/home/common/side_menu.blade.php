<div id="sidenav-overlay"></div>
<div class="d-lg-none hidden sidebar">
    <h6 class="section-title ff-secondary text-start text-dark fw-normal mb-4">Links</h6>
    <a class="w-100 link" href="{{ route('index') }}">Home</a>
    <a class="w-100 link" href="{{ route('get-our-gallery') }}">Our Sugar Pappi Gallery</a>
    {{-- <a class="w-100 link" href="{{ route('loyality-points') }}">Loyalty Points</a>
    <a class="w-100 link" href="{{ route('get-our-menu') }}">Our Menu</a>
    {{-- <a class="w-100 link" href="{{ route('get-new-sea-moss') }}">NEW! Sea Moss</a>
    <a class="w-100 link" href="https://squareup.com/gift/ML9HY7TG18CE2/order" target="_blank">Gift card</a>
    <a class="w-100 link" href="{{ route('get-our-menu') }}">Order Online</a> --}}
    <a href="" class="w-100 link">Privacy Policy</a>
    <a href="" class="w-100 link">Terms & Conditions</a>
    <a href="" class="w-100 link">Contact Us</a>
    <a href="" class="w-100 link">FAQ's</a>
    @if (Auth::guard('user')->check())
        <a href='{{ route('user-logout') }}' class="w-100 link logout" id="">Logout</a>
        <script>
            function logout() {
                window.ReactNativeWebView.postMessage(JSON.stringify({
                    logout: true
                }));
            }
           $('.logout').click(function(){
                logout();
           })
        </script>
    @else
        <a href="" class="w-100 link">Login</a>
    @endif
    {{-- <div class="footer">
        <h6 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact Us</h6>
        <p class="mb-2"><a href="mailto:contact@sugarpappi.com" class="text-white"><span class="fa fa-envelope me-3"></span>contact@sugarpappi.com</a></p>
        <div class="d-flex pt-2">
            <a class="me-2 btn btn-outline-light btn-social" href=""><span class="fab fa-facebook-f"></span></a>
            <a class="me-2 btn btn-outline-light btn-social" href=""><span class="fab fa-youtube"></span></a>
            <a class="me-2 btn btn-outline-light btn-social" href=""><span class="fab fa-instagram"></span></a>
        </div>
    </div> --}}
</div>
