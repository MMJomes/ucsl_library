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
                        <th>Image</th>
                        <th>Book Name</th>
                        <th>Edtion</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Remark</th>
                        <th>Status </th>
                        <th width="100px">Continue</th>
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
                ajax: "{{ route('users.rents') }}",
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
                        data: 'startdate',
                        defaultContent: "-"

                    },
                    {
                        data: 'enddate',
                        defaultContent: "-"
                    },
                    {
                        defaultContent: "-",
                        name: 'remark',
                        data: 'remark',

                    },
                    {
                        orderable: false,
                        "render": function(data, type, full, meta) {
                            var status = full.status;
                            var returnStatus = full.rentstatus;
                            if (returnStatus == 'on') {
                                if (status == 'on') {
                                    var endTime = full.enddate;
                                    var updatedTime = full.updated_at;
                                    var updatetim = new Date(updatedTime);
                                    var ent = new Date(endTime);
                                    var rentingTime = (ent
                                        .getTime() - updatetim.getTime()) / 1000;
                                    if (rentingTime >= 0) {
                                        return '<p style="font-weight:bold;" class="btn btn-outline-info btn-sm btn-font-size-sm" aria-haspopup="true" aria-expanded="false"><i class="icon-check"></i>&nbsp;Returned Duration Time';
                                    } else {
                                        return '<p style="font-weight:bold;" class="btn btn-outline-danger btn-sm btn-font-size-sm "aria-haspopup="true" aria-expanded="false"><i class="icon-clock"></i>&nbsp;Returned Overed Time';
                                    }
                                } else {
                                    return '<p style="font-weight:bold;" class="btn btn-outline-info btn-sm btn-font-size-sm"aria-haspopup="true" aria-expanded="false"><i class="icon-check"></i> &nbsp;Returned Time';
                                }
                            } else {
                                if (status == 'on') {
                                    return '<p style="font-weight:bold;" class="btn btn btn-outline-info btn-sm btn-font-size-sm "aria-haspopup="true" aria-expanded="false"><i class="icon-check"></i> &nbsp;Returned 4 Time';
                                } else {
                                    var endTime = full.enddate;
                                    var ent = new Date(endTime);
                                    var currentTime = new Date();
                                    var rentingTime = (ent.getTime() - currentTime
                                        .getTime()) / 1000;
                                    if (rentingTime > 0) {
                                        return '<p style="font-weight:bold;" class=" btn-outline-success btn-sm btn-font-size-sm "aria-haspopup="true" aria-expanded="false"><i class="icon-check"></i> &nbsp;Duration Time';
                                    } else {
                                        return '<p style="font-weight:bold;" class=" btn-outline-danger btn-sm btn-font-size-sm "aria-haspopup="true" aria-expanded="false"><i class="icon-clock"></i> &nbsp;Overed Time  &nbsp;';
                                    }
                                }
                            }
                        }
                    },
                    {
                        orderable: false,
                        "render": function(data, type, full, meta) {
                            var booksOrder =
                                "{{ route('users.rentbooks', ':id') }}";
                            booksOrder = booksOrder.replace(':id', full.id);
                            var endTime = full.enddate;
                            var rentstatusd = full.requesttatus;
                            if (rentstatusd == 'on') {
                                return '<a href="javascript:void(0)" class="btn btn-outline-info btn-sm mx-2" disabled disabled=true  style="font-weight:bold;  font-size:12px"  data-attr="" data-target="#smallModal" data-toggle="tooltip" disabled title=" Your  Continue State Is Pending Now!"><i class="icon-clock"></i> Pending </a>';

                            } else {
                                var status = full.status;
                                var returnStatus = full.rentstatus;
                                if (returnStatus == 'on') {
                                    if (status == 'on') {
                                        return '<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm mx-2" disabled disabled=true  style="font-weight:bold;  font-size:12px"  data-attr="" data-target="#smallModal" data-toggle="tooltip" disabled title=" Come To Library To Take Continue This Book!"><i class="fa fa-ban"></i> Returned </a>';
                                    }
                                } else {
                                    var ent = new Date(endTime);
                                    var currentTime = new Date();
                                    var rentingTime = (ent.getTime() - currentTime
                                        .getTime()) / 1000;
                                    var mybutton = '';
                                    var exitbook = '';
                                    if (rentingTime > 0) {
                                        exitbook = "Continue";
                                        mybutton = '<button name="deleteRuleButton" href="' +
                                            booksOrder +
                                            '" class="btn btn-outline-success orderbutton  btn-sm mx-2 orderConfirm" id="orderConfirm"  style="font-weight:bold; font-size:12px"  data-toggle="modal" data-target="#delete-confirmation-modal"  title="Order to Rent This Book!"><i class="fa fa-tasks"></i> ' +
                                            exitbook + ' </button>';
                                    } else {
                                        mybutton =
                                            '<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm mx-2" disabled disabled=true  style="font-weight:bold;  font-size:12px"  data-attr="" data-target="#smallModal" data-toggle="tooltip" disabled title=" Come To Library To Take Continue This Book!"><i class="fa fa-ban"></i> Overed </a>';
                                    }
                                    return mybutton;
                                }
                            }
                        }
                    },
                ]
            });
            $('#existingRulesDataTable').on('click', 'tbody .orderbutton ', function() {
                deleteRecordData = existingRuleTable.row($(this).closest('tr')).data();
                var myid = deleteRecordData['id'];
                $.ajax({
                    url: "{{ route('users.rentbooks', 'id') }}".replace(
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
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
