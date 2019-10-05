<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kredo IMS') }}</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>

<body id="page-top" class="{{ Request::url() === 'http://kredoims.test/login' ? '' : '' }}">

    <div id="app">
      
    </div>

</body>
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<!-- Bootstrap core JavaScript-->
<!-- <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script> -->
<!-- <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->

<!-- Core plugin JavaScript-->
<!-- <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script> -->

<!-- Custom scripts for all pages-->
<script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<!-- <script src="{{asset('assets/vendor/chart.js/Chart.min.js')}}"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="{{asset('assets/js/demo/chart-area-demo.js')}}"></script> -->
<!-- <script src="{{asset('assets/js/demo/chart-pie-demo.js')}}"></script> -->

<script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('assets/js/demo/datatables-demo.js')}}"></script>

</html>
