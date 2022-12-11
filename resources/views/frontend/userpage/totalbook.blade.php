@inject('request', 'Illuminate\Http\Request')
@extends('layouts.stduent')
@section('content')
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
            <table class="table table-bordered data-table ">
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
    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
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
                            if (full.bookpdflink) {
                                var pdfURL = full.bookpdflink;
                                return '<a href="' + pdfURL +
                                    '" class="btn btn-outline-info btn-sm mx-2"  style="font-weight:bold;  font-size:12px" target="_blank" data-toggle="tooltip" title="Read OR Download On Internet!"><i class="fa fa-download"></i> Download </a>';
                            } else {
                                return '-';
                            }
                        }
                    },
                    {
                        orderable: false,
                        "render": function(data, type, full, meta) {
                            if (full.availablebook >= 1) {
                                var pdfURL = full.bookpdflink;
                                return '<a href="' + pdfURL +
                                    '" class="btn btn-outline-success btn-sm mx-2"  style="font-weight:bold; font-size:12px"  data-toggle="tooltip" title="Order to Rent This Book!"><i class="fa fa-tasks"></i> Order </a>';
                            } else {
                                var pdfURL = full.bookpdflink;
                                return '<a href="' + pdfURL +
                                    '" class="btn btn-outline-primary btn-sm mx-2"  style="font-weight:bold;  font-size:12px"  data-toggle="tooltip" title="Order to Rent This Book!"><i class="fa fa-first-order"></i> PreOrder </a>';

                            }
                        }
                    },
                ]
            });

        });
    </script>
@endsection
