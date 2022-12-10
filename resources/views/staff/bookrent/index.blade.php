@extends('layouts.myapp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">{{ 'Staff Book Rent List' }} </h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item active">{{ 'Staff Book Rent List' }}</li>
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
                                    <th>{{ 'Staff Name' }}</th>
                                    <th>{{ 'Book Name' }}</th>
                                    <th>{{ 'Start Date' }}</th>
                                    <th>{{ 'Retrun Date' }}</th>
                                    <th>{{ 'Status' }}</th>
                                    <th>{{ 'Rent Status' }}</th>
                                    @canany(['author.edit', 'author.delete'])
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
    {{ route('staff.rentbyStaff.destroy', 'id') }}
@endsection
@section('approve_route')
    {{ route('staff.rentbyStaff.destroy', 'id') }}
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            @can('author.mass_destroy')
                window.route_mass_crud_entries_destroy = "{{ route('staff.rentbyStaff.mass.destroy') }}";
            @endcan
            @can('author.show')
                window.route_mass_crud_entries_show = "{{ route('staff.rentbyStaff.mass.destroy') }}";
            @endcan

            $.ajax({
                url: "{{ route('staff.rentbyStaff.index') }}",
                cache: false,
            }).then(function(data, textStatus, jqXHR) {
                var response = JSON.parse(data);
                $('#dataTable').DataTable({
                    data: response["data"],
                    dom: 'Bfrtip',
                    buttons: [
                        @can('author.create')
                            {
                                text: '{{ __('message.createnew') }}',
                                className: "btn btn-primary",
                                action: function(e, dt, node, config) {
                                    window.location.href =
                                        '{{ route('staff.rentbyStaff.create') }}';
                                }
                            },
                        @endcan
                        'copy', 'csv',  {
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
                            data: 'teacher.name',
                        },
                        {

                            defaultContent: "-",
                            data: 'book.bookname',
                        },


                        {

                            defaultContent: "-",
                            "render": function(data, type, full, meta) {
                                var createdDate = new Date(full.startdate);
                                return createdDate.toLocaleString("en-US");
                            },
                        },
                        {

                            defaultContent: "-",
                            "render": function(data, type, full, meta) {
                                var returnDate = new Date(full.enddate);
                                return returnDate.toLocaleString("en-US");
                            },
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
                                            return '<p style="font-weight:bold;" class="btn btn-outline-success btn-sm btn-font-size-sm "aria-haspopup="true" aria-expanded="false"><i class="icon-check"></i> &nbsp;Duration Time';
                                        } else {
                                            return '<p style="font-weight:bold;" class="btn btn-outline-danger btn-sm btn-font-size-sm "aria-haspopup="true" aria-expanded="false"><i class="icon-clock"></i> &nbsp;Overred  Time  &nbsp;';
                                        }
                                    } else {
                                        return '<p style="font-weight:bold;" class="btn btn-outline-info btn-sm btn-font-size-sm "aria-haspopup="true" aria-expanded="false"><i class="icon-check"></i> &nbsp;Returned Time';

                                    }

                                } else {
                                    if (status == 'on') {
                                        return '<p style="font-weight:bold;" class="btn btn-outline-info btn-sm btn-font-size-sm "aria-haspopup="true" aria-expanded="false"><i class="icon-check"></i> &nbsp;Returned 4 Time';
                                    } else {
                                        var endTime = full.enddate;
                                        var ent = new Date(endTime);
                                        var currentTime = new Date();
                                        var rentingTime = (ent.getTime() - currentTime
                                            .getTime()) / 1000;
                                        if (rentingTime > 0) {
                                            return '<p style="font-weight:bold;" class="btn btn-outline-success btn-sm btn-font-size-sm "aria-haspopup="true" aria-expanded="false"><i class="icon-check"></i> &nbsp;Duration Time';
                                        } else {
                                            return '<p style="font-weight:bold;" class="btn btn-outline-danger btn-sm btn-font-size-sm "aria-haspopup="true" aria-expanded="false"><i class="icon-clock"></i> &nbsp;Overred Time  &nbsp;';
                                        }
                                    }

                                }

                            }

                        },
                        @canany(['member.approve', 'member.mass_approve'])
                            {
                                orderable: false,
                                "render": function(data, type, full, meta) {
                                    var sle = full.status;
                                    var approveURL =
                                        "{{ route('staff.rentbyStaff.approve', ':id') }}";
                                    approveURL = approveURL.replace(':id', full.id);
                                    var ApproveButton = '';

                                    if (response["can_edit"]) {
                                        if (full.status == 'on') {
                                            ApproveButton =
                                                '<div class="dropdown mx-1  disabled" data-href="' +
                                                approveURL +
                                                '"><button style="font-weight:bold;font-size:13px;" class="btn disabled btn-outline-success btn-sm btn-font-size-sm " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-check"></i> &nbsp; Return</button><div class="dropdown-menu py-0" btn-success aria-labelledby="dropdownMenuButton"><a class="dropdown-item bg-danger btn-sm text-white d-flex align-items-start "href="' +
                                                approveURL +
                                                '" id="set_clock" data-status="off"><i class="icon-clock"></i> &nbsp;Pending</a></div>';
                                        } else {
                                            ApproveButton =
                                                '<div class="dropdown mx-1" data-href="' +
                                                approveURL +
                                                '"><button style="font-weight:bold;font-size:13px;" class="btn btn-outline-info btn-sm btn-font-size-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-clock"></i> &nbsp; Renting</button><div class="dropdown-menu py-0" btn-success aria-labelledby="dropdownMenuButton"><a class="dropdown-item bg-success btn-sm text-white d-flex align-items-start "href="' +
                                                approveURL +
                                                '" id="set_clock" data-status="off"><i class="icon-check"></i> &nbsp;Return</a></div>';
                                        }
                                    }
                                    return ApproveButton;
                                }

                            },
                        @endcanany
                        @canany(['author.edit', 'author.delete', 'author.show'])
                            {
                                orderable: false,
                                "render": function(data, type, full, meta) {
                                    var editURL =
                                        "{{ route('staff.rentbyStaff.edit', ':id') }}";
                                    editURL = editURL.replace(':id', full.id);

                                    var showURL =
                                        "{{ route('staff.rentbyStaff.show', ':id') }}";
                                    showURL = showURL.replace(':id', full.id);

                                    var editButton = '';
                                    var showButton = '';
                                    var deleteButton = '';
                                    var approveButton = '';
                                    if (response["can_edit"]) {
                                        editButton = '<a href="' + editURL +
                                            '" class="btn btn-info btn-sm mx-2"><i class="fa fa-edit"></i></a>';
                                    }
                                    if (response["can_show"]) {
                                        showButton = '<a href="' + showURL +
                                            '" class="btn btn-primary btn-sm mx-2"><i class="fa fa-info-circle"></i></a>';
                                    }
                                    if (response["can_delete"]) {
                                        deleteButton =
                                            '<a class="btn btn-danger btn-sm delete-btn" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal" data-slug="' +
                                            full.id +
                                            '" data-container="body" data-togglePopover="popover" data-trigger="hover" data-placement="top" data-content="Delete" data-original-title="" title=""><i class="fa fa-trash"></i></a></form>';
                                    }
                                    return editButton + showButton + deleteButton;
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
