<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon icon -->
<title>DIGITAL LIBRARY MANAGENMENT SYSTEM FOR (UCSL)</title>
<link rel="icon" href="{{ url('assets/images/logo.png') }}" type="image/x-icon">
<!-- Custom CSS -->
<link href="{{ asset('assets/dist/css/style.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/dist/css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dist/css/customradio.css') }}">
<link href="{{ asset('assets/dist/css/pages/login-register-lock.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}">
<script src="{{ asset('assets/dist/user/toastr.min.css') }}"></script>
@if ($select ?? false)
    <link rel="stylesheet" href="{{ asset('assets/dist/css/selecteds2.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}">
@endif
@if ($datatable ?? false)
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
@endif
