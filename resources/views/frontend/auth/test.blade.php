@extends('layouts.front')
<div class="wrapper">
    <div class="inner">
        <div class="image-holder">

            <img src="{{ url('/assets/frontend/images/registration-form-6.jpg') }}" alt="image">
        </div>
        <form action="">
            <h3>Member Login</h3>
            <div class="form-row">
                <input type="text" class="form-control" placeholder="Name">
                <input type="text" class="form-control" placeholder="Mail">
            </div>
            <div class="form-row">
                <input type="text" class="form-control" placeholder="Phone">
                <div class="form-holder">
                    <select name="" id="" class="form-control">
                        <option value="" disabled selected>Choose Your Class</option>
                        <option value="class 01">Class 01</option>
                        <option value="class 02">Class 02</option>
                        <option value="class 03">Class 03</option>
                    </select>
                    <i class="zmdi zmdi-chevron-down"></i>
                </div>
            </div>
            <textarea name="" id="" placeholder="Message" class="form-control" style="height: 130px;"></textarea>
            <button>Book Now
                <i class="zmdi zmdi-long-arrow-right"></i>
            </button>
        </form>

    </div>
</div>

@section('content')
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body style="margin-top:20px;">
    <div bgcolor="#f6f6f6" style="color: #333; height: 100%; width: 100%;" height="100%" width="100%">
        <table bgcolor="#f6f6f6" cellspacing="0" style="border-collapse: collapse; padding: 40px; width: 100%;"
            width="100%">
            <tbody>
                <tr>
                    <td width="5px" style="padding: 0;"></td>
                    <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                        <table width="100%" cellspacing="0" style="border-collapse: collapse;">
                            {{-- <tbody>
                                <tr>
                                    <td style="padding: 0;">
                                        <a href="#" style="color: #348eda;" target="_blank">
                                            <img src="//ssl.gstatic.com/accounts/ui/logo_2x.png" alt="Bootdey.com"
                                                style="height: 50px; max-width: 100%; width: 157px;" height="50"
                                                width="157" />
                                        </a>
                                    </td>
                                    <td style="color: #999; font-size: 12px; padding: 0; text-align: right;"
                                        align="right">
                                        Bootdey<br />
                                        Invoice #3440952<br />
                                        August 04, 2018
                                    </td>
                                </tr>
                            </tbody> --}}
                        </table>
                    </td>
                    <td width="5px" style="padding: 0;"></td>
                </tr>

                <tr>
                    <td width="5px" style="padding: 0;"></td>
                    <td bgcolor="#FFFFFF"
                        style="border: 1px solid #000; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                        {{-- <table width="100%"
                            style="background: #f9f9f9; border-bottom: 1px solid #eee; border-collapse: collapse; color: #999;">
                            <tbody>
                                <tr>
                                    <td width="50%" style="padding: 20px;"><strong
                                            style="color: #333; font-size: 24px;">$23.95</strong> Paid</td>
                                    <td align="right" width="50%" style="padding: 20px;">Thanks for using <span
                                            class="il">Bootdey.com</span></td>
                                </tr>
                            </tbody>
                        </table> --}}
                    </td>
                    <td style="padding: 0;"></td>
                    <td width="5px" style="padding: 0;"></td>
                </tr>
                <tr>
                    <td width="5px" style="padding: 0;"></td>
                    <td
                        style="border: 1px solid #000; border-top: 0; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                        <table cellspacing="0"
                            style="border-collapse: collapse; border-left: 1px solid #000; margin: 0 auto; max-width: 600px;">
                            <tbody>
                                <tr>
                                    <td valign="top" style="padding: 20px;">
                                        <h3
                                            style="
                                                border-bottom: 1px solid #000;
                                                color: #000;
                                                font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;
                                                font-size: 18px;
                                                font-weight: bold;
                                                line-height: 1.2;
                                                margin: 0;
                                                margin-bottom: 15px;
                                                padding-bottom: 5px;
                                            ">
                                            Summary
                                        </h3>
                                        <table cellspacing="0" style="border-collapse: collapse; margin-bottom: 40px;">
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 5px 0;">Old Plan</td>
                                                    <td align="right" style="padding: 5px 0;">Free plan (10,000
                                                        msg/month)</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 5px 0;">New Plan</td>
                                                    <td align="right" style="padding: 5px 0;">Concept Plan</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 5px 0;">Prorated subscription amount due</td>
                                                    <td align="right" style="padding: 5px 0;">$23.95</td>
                                                </tr>
                                                <tr>
                                                    <td
                                                        style="border-bottom: 2px solid #000; border-top: 2px solid #000; font-weight: bold; padding: 5px 0;">
                                                        Amount paid</td>
                                                    <td align="right"
                                                        style="border-bottom: 2px solid #000; border-top: 2px solid #000; font-weight: bold; padding: 5px 0;">
                                                        $23.95</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="5px" style="padding: 0;"></td>
                </tr>

                <tr style="color: #666; font-size: 12px;">
                    <td width="5px" style="padding: 10px 0;"></td>
                    <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                        <table width="100%" cellspacing="0" style="border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <td width="40%" valign="top" style="padding: 10px 0;">
                                        <h4 style="margin: 0;">Questions?</h4>
                                        <p
                                            style="color: #666; font-size: 12px; font-weight: normal; margin-bottom: 10px;">
                                            Please visit our
                                            <a href="#" style="color: #666;" target="_blank">
                                                Support Center
                                            </a>
                                            with any questions.
                                        </p>
                                    </td>
                                    <td width="10%" style="padding: 10px 0;">&nbsp;</td>
                                    <td width="40%" valign="top" style="padding: 10px 0;">
                                        <h4 style="margin: 0;"><span class="il">Bootdey</span> Technologies</h4>
                                        <p
                                            style="color: #666; font-size: 12px; font-weight: normal; margin-bottom: 10px;">
                                            <a href="#">535 Mission St., 14th Floor San Francisco, CA 94105</a>
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="5px" style="padding: 10px 0;"></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>

@inject('request', 'Illuminate\Http\Request')
@extends('layouts.stduent')
@section('content')
    <div class="modal fade " id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <p> Helloo..................</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <!--.box-header -->
        <div class="box-header with-border">
            <div class="box-tools pull-right">
            </div>
        </div>
        <div class="container">
            <h2 style="font-family:Verdana, sans-serif">DIGITAL LIBRARY MANAGENMENT SYSTEM</h2>
            <hr style="font-weight:bold ">
            <h6 style="font-family:Verdana, sans-serif">Total Number Books & There're Information!</h6>
            <table class="table table-bordered data-table " id="existingRulesDataTable">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Book Name</th>
                        <th>Edtion</th>
                        <th>Author Name</th>
                        <th>Produce Year</th>
                        <th>Available Count</th>
                        <th>Download </th>
                        <th width="100px">Rent</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>

    <script src="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/sweetalert2/sweet-alert.init.js') }}"></script>
    <script type="text/javascript">
        $(function() {


            var existingRuleTable;
            window.route_mass_crud_entries_destroy = "{{ route('backend.book.mass.destroy') }}";
            existingRuleTable = $('#existingRulesDataTable').DataTable({
                "scrollX": true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        defaultContent: '-',
                        data: 'bookname',
                        name: 'bookname'
                    },
                    {

                        defaultContent: '-',
                        data: 'edtion',
                        name: 'edtion'
                    },
                    {
                        data: 'category.name',
                        defaultContent: "-"

                    },
                    {
                        data: 'author.name',
                        defaultContent: "-"
                    },
                    {
                        defaultContent: "0",
                        name: 'availablebook',
                        data: 'availablebook',

                    },
                    {
                        orderable: false,
                        "render": function(data, type, full, meta) {

                            var bookPreorder =
                                "{{ route('users.preorders', ':id') }}";
                            bookPreorder = bookPreorder.replace(':id', full.id);

                            if (full.bookpdflink) {
                                var pdfURL = full.bookpdflink;
                                return '<a href="' + pdfURL +
                                    '" class="btn btn-outline-info btn-sm mx-2"  style="font-weight:bold;  font-size:12px" target="_blank" data-toggle="tooltip" title="Read OR Download On Internet!"><i class="fa fa-download"></i> Download ' +
                                    bookPreorder + ' </a>';
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        orderable: false,
                        "render": function(data, type, full, meta) {
                            var mydol =
                                '<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true"><div class="modal-dialog modal-sm" role="document"><div class="modal-content"></div></div></div>';
                            var bookPreorder =
                                "{{ route('users.preorders', ':id') }}";
                            bookPreorder = bookPreorder.replace(':id', full.id);

                            if (full.availablebook >= 1) {
                                var pdfURL = full.bookpdflink;
                                return '<a data-toggle="modal" id="smallButton" data-target="#smallModal" data-attr="' +
                                    bookPreorder +
                                    '" title="Delete Project"><i class="fas fa-trash text-danger  fa-lg"></i></a>';
                                // return '<a name="deleteRuleButton" href="' + pdfURL +
                                //     '" class="btn btn-outline-success orderbutton btn-sm mx-2 orderConfirm" id="orderConfirm"  id="smallButton"  style="font-weight:bold; font-size:12px"  data-toggle="modal" data-target="#smallModal"  title="Order to Rent This Book!"><i class="fa fa-tasks"></i> Order </a>';
                            } else {
                                var pdfURL = full.bookpdflink;
                                return '<a href="' + bookPreorder +
                                    '" class="btn btn-outline-primary btn-sm mx-2"  style="font-weight:bold;  font-size:12px"  data-attr="' +
                                    bookPreorder +
                                    '" data-target="#smallModal" data-toggle="tooltip" title="Order to Rent This Book!"><i class="fa fa-first-order"></i> PreOrder ' +
                                    bookPreorder + ' </a>';

                            }
                        }
                    },
                ]
            });
            $(document).on('click', '#smallButton', function(event) {
                event.preventDefault();
                let href = $(this).attr('data-attr');
                console.log(href);

                $.ajax({
                    url: "{{ route('users.preorders',1) }}",
                    type: 'GET',
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $(this).prop('disabled', true);
                    },
                    complete: function() {
                        $(this).prop('disabled', false);
                    },
                    success: function(response) {
                        swal({
                                title: "Success!",
                                text: response.message,
                                type: "success",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "OK",
                                closeOnConfirm: false
                            },
                            function(isConfirm) {
                                if (isConfirm) {

                                }
                            });
                    },

                });
                // $.ajax({
                //     url: href,
                //     // beforeSend: function() {
                //     //     $('#loader').show();
                //     // },
                //     // // return the result
                //     // success: function(result) {
                //     //     $('#smallModal').modal("show");
                //     //     $('#smallBody').html(result).show();
                //     // },
                //     // complete: function() {
                //     //     $('#loader').hide();
                //     // },
                //     // error: function(jqXHR, testStatus, error) {
                //     //     console.log(error);
                //     //     alert("Page " + href + " cannot open. Error:" + error);
                //     //     $('#loader').hide();
                //     // },
                //     timeout: 8000
                // })
            });

            // $('#existingRulesDataTable').on('click', 'tbody .orderbutton', function() {
            //     deleteRecordData = existingRuleTable.row($(this).closest('tr')).data();
            //     $("table .smallModal").modal('show');
            // });
        });
    </script>
@endsection



////////////////
<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.partials.back-head')
    <title>W3.CSS Template</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1">
    {{-- <link href="{{ asset('assets/dist/user/user.css') }}" rel="stylesheet" /> --}}
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="{{ asset('assets/dist/js/dataTable.js') }}"></script>
    <script src="{{ asset('assets/dist/js/dataTable.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: "Lato", sans-serif
        }

        .mySlides {
            display: none
        }
    </style>
</head>

<body>

    @include('frontend.user.navbar')
    <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top"
        style="margin-top:46px">
        <a href="#band" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">BAND</a>
        <a href="#tour" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">TOUR</a>
        <a href="#contact" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">CONTACT</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">MERCH</a>
    </div>
    <div class="w3-content" style="max-width:2000px;margin-top:46px">

        @yield('content')
    </div>


    <!-- Footer -->
    @include('frontend.user.footer')

    <script>
        // Automatic Slideshow - change image every 4 seconds
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 4000);
        }

        // Used to toggle the menu on small screens when clicking on the menu button
        function myFunction() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

        // When the user clicks anywhere outside of the modal, close it
        var modal = document.getElementById('ticketModal');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


</body>

</html>

@inject('request', 'Illuminate\Http\Request')
<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.back-head')
    <title>DIGITAL LIBRARY MANAGENMENT SYSTEM</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1">
    <link href="{{ asset('assets/dist/user/user.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/dist/user/jquery.dataTables.min.css') }}" rel="stylesheet" />
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    <script src="{{ asset('assets/dist/user/jquery-1.9.1.js') }}"></script>
    <script src="{{ asset('assets/dist/user/jquery.validate.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: "Lato", sans-serif
        }
        .mySlides {
            display: none
        }
    </style>
</head>
<body>
    @include('frontend.user.navbar')
    <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top"
        style="margin-top:46px">
        <a href="{{route('users.rents')}}" class="w3-bar-item w3-button w3-padding-large">RENTED BOOKS</a>
        <a href="{{route('users.prerequest')}}" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">PREQUEST BOOKS</a>
        <a href="{{route('member.profile')}}" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">PROFILE</a>
    </div>
    <div class="w3-content" style="max-width:2000px;margin-top:46px">

        @yield('content')
    </div>


    <!-- Footer -->
    @include('frontend.user.footer')

    <script>
        // Automatic Slideshow - change image every 4 seconds
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 4000);
        }

        // Used to toggle the menu on small screens when clicking on the menu button
        function myFunction() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

        // When the user clicks anywhere outside of the modal, close it
        var modal = document.getElementById('ticketModal');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>





@extends('layouts.myapp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">{{ 'Stduent PreRequest  Books List' }} </h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item Approve">{{ 'Stduent PreRequest Books List' }}</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="bg-primary" style="padding: 10px 3px 1px 10px; margin-bottom:10px;">
                            <p>{{ $errors->first() }}</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    @if (\Session::get('stdtotalBookApproved'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('stdtotalBookApproved') !!}</li>
                            </ul>
                        </div>
                    @endif
                    @if (\Session::get('stdtotalBook'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{!! \Session::get('stdtotalBook') !!}</li>
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ __('message.dataexport') }}</h4>
                    <h6 class="card-subtitle">Export data to Copy, CSV</h6>
                    <div class="table-responsive m-t-40">
                        <table id="dataTable" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <input type="checkbox" id="select-all" class="select-checkbox">
                                    </th>
                                    <th>{{ __('message.no') }}</th>
                                    <th>{{ 'Stduent Name' }}</th>
                                    <th>{{ 'Book Name' }}</th>
                                    <th>{{ 'Edtion' }}</th>
                                    <th>{{ 'Request Date' }}</th>

                                    <th>{{ 'Status' }}</th>

                                    @canany(['stduentBookPreRent.edit', 'stduentBookPreRent.delete'])
                                        <th>{{ __('message.action') }}</th>
                                    @endcanany

                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
@endsection

@section('delete_route')
    {{ route('stduent.preRequestBooks.destroy', 'slug') }}
@endsection
@section('approve_route')
    {{ route('stduent.preRequestBooks.destroy', 'slug') }}
@endsection
@push('scripts')
    <script>
        {{ Session::forget('stdtotalBookApproved') }}
        {{ Session::forget('stdtotalBook') }}
        $(document).ready(function() {
            @can('stduentBookPreRent.mass_destroy')
                window.route_mass_crud_entries_destroy = "{{ route('stduent.preRequestBooks.mass.destroy') }}";
            @endcan
            @can('stduentBookPreRent.show')
                window.route_mass_crud_entries_show = "{{ route('stduent.preRequestBooks.mass.destroy') }}";
            @endcan
            @can('stduentBookPreRent.mass_approve')
                window.route_mass_crud_entries_approve = "{{ route('stduent.preRequestBooks.mass.approve') }}";
            @endcan
            $.ajax({
                url: "{{ route('stduent.preRequestBooks.index') }}",
                cache: false,
            }).then(function(data, textStatus, jqXHR) {
                var response = JSON.parse(data);
                $('#dataTable').DataTable({
                    data: response["data"],
                    dom: 'Bfrtip',
                    buttons: [

                        @can('stduentBookPreRent.create')
                            {
                                text: '{{ __('message.createnew') }}',
                                className: "btn btn-primary",
                                action: function(e, dt, node, config) {
                                    window.location.href =
                                        '{{ route('stduent.preRequestBooks.create') }}';
                                }
                            },
                        @endcan
                        'copy', 'csv', {
                            text: 'Delete Selected',
                            className: "btn btn-primary",
                            action: function(e, dt, node, config) {
                                deleteSelected();
                            }
                        },

                    ],
                    columns: [{
                            className: 'select-checkbox text-center',

                            orderable: false,
                            "render": function(data, type, full, meta) {
                                var id = full.id;
                                return '<input type="checkbox" class="checkbox-tick" data-entry-id=' +
                                    id + '>';
                            },
                        },
                        {
                            "render": function(data, type, full, meta) {
                                return meta.row + 1;
                            },
                        },
                        {
                            defaultContent: "-",
                            data: 'stduent.name',
                        },
                        {
                            defaultContent: "-",
                            data: 'book.bookname',
                        },
                        {
                            defaultContent: "-",
                            data: 'book.edtion',
                        },
                        {

                            defaultContent: "-",
                            "render": function(data, type, full, meta) {
                                var createdDate = new Date(full.created_at);
                                return createdDate.toLocaleString("en-US");
                            },
                        },

                        @canany(['stduentBookPreRent.approve', 'stduentBookPreRent.mass_approve'])
                            {
                                orderable: false,
                                "render": function(data, type, full, meta) {
                                    var sle = full.status;
                                    var approveURL =
                                        "{{ route('stduent.preRequestBooks.approve', ':id') }}";
                                    approveURL = approveURL.replace(':id', full.id);
                                    var ApproveButton = '';

                                    if (response["can_edit"]) {
                                        if (full.status == 'on') {
                                            ApproveButton =
                                                '<div class="dropdown mx-1  disabled" data-href="' +
                                                approveURL +
                                                '"><button class="btn disabled btn-outline-success btn-sm btn-font-size-sm " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-check"></i> &nbsp; Approve</button><div class="dropdown-menu py-0" btn-success aria-labelledby="dropdownMenuButton"><a class="dropdown-item bg-danger btn-sm text-white d-flex align-items-start "href="' +
                                                approveURL +
                                                '" id="set_clock" data-status="off"><i class="icon-clock"></i> &nbsp;Pending</a></div>';
                                        } else {
                                            ApproveButton =
                                                '<div class="dropdown mx-1" data-href="' +
                                                approveURL +
                                                '"><button class="btn btn-outline-danger btn-sm btn-font-size-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-clock"></i> &nbsp; Pending</button><div class="dropdown-menu py-0" btn-success aria-labelledby="dropdownMenuButton"><a class="dropdown-item bg-success btn-sm text-white d-flex align-items-start "href="' +
                                                approveURL +
                                                '" id="set_clock" data-status="off"><i class="icon-check"></i> &nbsp;Approve</a></div>';
                                        }
                                    }
                                    return ApproveButton;
                                }

                            },
                        @endcanany
                        @canany(['stduentBookPreRent.edit', 'stduentBookPreRent.delete', 'stduentBookPreRent.show'])
                            {
                                orderable: false,
                                "render": function(data, type, full, meta) {
                                    var showURL =
                                        "{{ route('stduent.preRequestBooks.show', ':id') }}";
                                    showURL = showURL.replace(':id', full.id);

                                    var showButton = '';
                                    if (response["can_show"]) {
                                        showButton = '<a href="' + showURL +
                                            '" class="btn btn-primary btn-sm mx-2"><i class="fa fa-info-circle"></i></a>';
                                    }

                                    return showButton;
                                }
                            },
                        @endcanany
                    ],
                });
                $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel')
                    .addClass(
                        'btn btn-primary mr-1');
            });
        });
    </script>
@endpush
///////////////////
{{-- Staff Prerequest --}}
{{-- @can('staffBookPreRent.create')
{
    text: '{{ __('message.createnew') }}',
    className: "btn btn-primary",
    action: function(e, dt, node, config) {
        window.location.href =
            '{{ route('staff.requestbyStaffs.create') }}';
    }
},
@endcan --}}
/////////////////
