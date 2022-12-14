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
    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <div>
                        <!-- the result to be displayed apply here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {
            var existingRuleTable;
            window.route_mass_crud_entries_destroy = "{{ route('backend.book.mass.destroy') }}";
            existingRuleTable = $('#existingRulesDataTable').DataTable({
                "scrollX": true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.totalbook') }}",
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


                            var booksOrder =
                                "{{ route('users.bookorders', ':id') }}";
                            booksOrder = booksOrder.replace(':id', full.id);
                            var mybutton = '';
                            var exitbook = '';

                            if (full.availablebook >= 1) {
                                exitbook = "Order";
                            mybutton = '<button name="deleteRuleButton" href="' + booksOrder +
                                '" class="btn btn-outline-success orderbutton  btn-sm mx-2 orderConfirm" id="orderConfirm"  style="font-weight:bold; font-size:12px"  data-toggle="modal" data-target="#delete-confirmation-modal"  title="Order to Rent This Book!"><i class="fa fa-tasks"></i>' +
                                exitbook + ' </button>';
                            } else {
                                exitbook = "PreOrder";
                            mybutton = '<button name="deleteRuleButton" href="' + booksOrder +
                                '" class="btn btn-outline-primary orderbutton  btn-sm mx-2 orderConfirm" id="orderConfirm"  style="font-weight:bold; font-size:12px"  data-toggle="modal" data-target="#delete-confirmation-modal"  title="PreOrder to Rent This Book!"><i class="fa fa-first-order"> </i>' +
                                exitbook + ' </button>';
                            }

                            // if (full.availablebook >= 1) {
                            //     mybutton = '<button name="deleteRuleButton" href="' + booksOrder +
                            //         '" class="btn btn-outline-success orderbutton  btn-sm mx-2 orderConfirm" id="orderConfirm"  style="font-weight:bold; font-size:12px"  data-toggle="modal" data-target="#delete-confirmation-modal"  title="Order to Rent This Book!"><i class="fa fa-tasks"></i> Order </button>';
                            // } else {
                            //     mybutton= '<a href="' + booksOrder +
                            //         '" class="btn btn-outline-primary mybookorderbutton btn-sm mx-2" style="font-weight:bold;  font-size:12px"  data-attr="' +
                            //         booksOrder +
                            //         '" data-target="#smallModal" data-toggle="tooltip" title=" PreOrder to Rent This Book!"><i class="fa fa-first-order"></i> PreOrder </a>';

                            // }
                            return mybutton;
                        }
                    },
                ]
            });
            $('#existingRulesDataTable').on('click', 'tbody .orderbutton ', function() {
                deleteRecordData = existingRuleTable.row($(this).closest('tr')).data();
                var myid = deleteRecordData['id'];
                $.ajax({
                    url: "{{ route('users.bookorders', 'id') }}".replace(
                        'id', myid),
                    type: 'GET',
                    data: deleteRecordData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        return confirm("Are You Sure You Want This Book?");
                    },
                    complete: function() {
                        $(this).prop('disabled', false);
                    },
                    success: function(response) {
                        if (response) {
                            new swal({
                                    title: "Success!",
                                    text: "Hello",
                                    type: "success",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "OK",
                                    closeOnConfirm: false
                                },
                                function(isConfirm) {
                                    if (isConfirm) {}
                                });
                        }
                    },
                    error: function(data) {
                        let errors = data.responseJSON.errors;
                        if (errors) {
                            let firstErrorMsg = errors[Object.keys(errors)[0]][0];
                           new swal({
                                title: "Error!",
                                type: "error",
                                text: firstErrorMsg,
                                confirmButtonClass: "btn-danger"
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
