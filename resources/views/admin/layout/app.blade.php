<!DOCTYPE html>
<html lang="en">
<!-- index.html  21 Nov 2019 03:44:50 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Dashboard</title>
    <!-- Favicon -->
    {{-- <link href="{{ asset('public/img/az-logo.png') }}" rel="icon"> --}}
        <link href="{{ asset('public/img/logo.png') }}" rel="icon">

    <!-- Developed By Ranglerz -->
      <link rel="stylesheet" href="https://www.ranglerz.com/cost-to-make-a-web-ios-or-android-app-and-how-long-does-it-take.php">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('public/admin/assets/toastr/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/custom.css') }}">
    <!-- Favicon -->
    {{-- <link href="{{ asset('public/img/az-logo.png') }}" rel="icon"> --}}
        <link href="{{ asset('public/img/logo.png') }}" rel="icon">

    <link rel="stylesheet" href="{{ asset('public/admin/assets/css/datatables.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/admin/assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/bundles/datatables/datatables.min.css') }}">
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('public/admin/assets/bundles/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/bundles/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/bundles/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/assets/bundles/jquery-selectric/selectric.css') }}">
</head>

<body>
    <div class="loader"></div>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('admin.common.header')
            @include('admin.common.side_menu')
            @yield('content')
            @include('admin.common.footer')
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('public/admin/assets/js/app.min.js') }}"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('public/admin/assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('public/admin/assets/js/page/index.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('public/admin/assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('public/admin/assets/js/custom.js') }}"></script>
    <script src="{{ asset('public/admin/assets/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/datatables.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/bundles/datatables/export-tables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('publicadmin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('public/admin/assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/bundles/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('public/admin/assets/bundles/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('public/admin/assets/bundles/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('public/admin/assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('public/admin/assets/bundles/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('public/admin/assets/js/page/ckeditor.js') }}"></script>

    <script>
        /*toastr popup function*/
        function toastrPopUp() {
            toastr.options = {
                "closeButton": true,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "3000",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }

        /*toastr popup function*/
        toastrPopUp();
    </script>

    @yield('js')
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>
