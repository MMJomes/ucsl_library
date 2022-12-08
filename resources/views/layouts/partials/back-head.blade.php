<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
<title>UCSL Library Mangement System</title>
<link rel="icon" href="{{ url('assets/images/logo.jpg') }}" type="image/x-icon">
<!-- Custom CSS -->
<link href="{{ asset('assets/dist/css/style.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/dist/css/custom.css') }}">
<link href="{{ asset('assets/dist/css/pages/login-register-lock.css') }}" rel="stylesheet">


<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}">

@if ($select ?? false)
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/node_modules/bootstrap-select/bootstrap-select.min.css') }}">
@endif
@if ($datatable ?? false)
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css"> --}}
@endif
