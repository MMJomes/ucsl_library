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
            <h2 style="font-family:Verdana, sans-serif">DIGITAL LIBRARY MANAGENMENT SYSTEM FOR UCSL</h2>
            <hr style="font-weight:bold ">
            <h6 style="font-family:Verdana, sans-serif">Total Number Of PreQuest Books</h6>
            <table class="table table-bordered data-table " id="existingRulesDataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Book Name</th>
                        <th>Edtion</th>
                        <th>Request Date</th>
                        <th>Remark</th>
                        <th>Status </th>
                        <th width="100px">Action</th>
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
                ajax: "{{ route('users.prerequest') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'book.image',
                        name: 'book.image',
                        defaultContent: '',
                        render: function(data) {
                            return '<img src="' + data + '" width="50" height="50">';
                        },
                    },
                    {
                        defaultContent: '-',
                        data: 'book.bookname',
                        name: 'book.bookname'
                    },
                    {

                        defaultContent: '-',
                        data: 'book.edtion',
                        name: 'book.edtion'
                    },
                    {
                        defaultContent: "-",
                        "render": function(data, type, full, meta) {
                            var createdDate = new Date(full.created_at);
                            return createdDate.toLocaleString("en-US");
                        },

                    },
                    {
                        defaultContent: "-",
                        name: 'remark',
                        data: 'remark',

                    },
                    {
                        orderable: false,
                        "render": function(data, type, full, meta) {
                            if (full.status == 'off') {
                                var pdfURL = full.bookpdflink;
                                return '<a href="javascript:void(0)" class="btn btn-outline-info btn-sm mx-2"  style="font-weight:bold;  font-size:12px"  data-toggle="tooltip" title="Your Request is Pending State!"><i class="icon-clock"></i> Pending </a>';
                            } else {
                                return '<a href="javascript:void(0)" class="btn btn-outline-success btn-sm mx-2"  style="font-weight:bold;  font-size:12px"  data-toggle="tooltip" title="Your Request is State! Approved"><i class="icon-clock"></i> Approved </a>';
                            }
                        }
                    },
                    {

                        orderable: false,
                        "render": function(data, type, full, meta) {
                            if (full.status == 'on') {
                                return '<a href="javascript:void(0)" class="btn btn-outline-info btn-sm mx-2"  style="font-weight:bold;  font-size:12px"  data-toggle="tooltip" title="Your Request is State! Approved"><i class="icon-clock"></i> Approved </a>';

                            } else {

                                var booksOrder =
                                    "{{ route('users.prerequestAction', ':id') }}";
                                booksOrder = booksOrder.replace(':id', full.id);
                                var mybutton = '';
                                var exitbook = '';
                                exitbook = "Cancel";
                                mybutton = '<button name="deleteRuleButton" href="' + booksOrder +
                                    '" class="btn btn-outline-danger orderbutton  btn-sm mx-2 orderConfirm" id="orderConfirm"  style="font-weight:bold; font-size:12px"  data-toggle="modal" data-target="#delete-confirmation-modal"  title="Cancel Prequest Book!"><i class="fa fa-times"> </i>  Cancel</button>';
                                return mybutton;
                            }
                        }
                    },
                ]
            });
            $('#existingRulesDataTable').on('click', 'tbody .orderbutton ', function() {
                deleteRecordData = existingRuleTable.row($(this).closest('tr')).data();
                var myid = deleteRecordData['id'];
                $.ajax({
                    url: "{{ route('users.prerequestAction', 'id') }}".replace(
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
                                    text: response.message,
                                    type: "success",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "OK",
                                    closeOnConfirm: false
                                },
                                function(isConfirm) {
                                    if (isConfirm) {}
                                }).then(function() {
                                location.reload();
                            });
                        }
                    },
                    error: function(data) {
                        let errors = data.responseJSON.errors;
                        if (errors) {
                            let firstErrorMsg = errors[Object.keys(errors)[0]][0];
                            swal({
                                title: "Error!",
                                type: "error",
                                text: response.message,
                                confirmButtonClass: "btn-danger"
                            }).then(function() {
                                location.reload();
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
