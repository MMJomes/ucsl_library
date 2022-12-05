@extends('layouts.myapp')

@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">Member Lists</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Contact List</li>
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
                    <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                    <div class="table-responsive m-t-40">
                        <table id="dataTable" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <input type="checkbox" id="select-all" class="select-checkbox">
                                    </th>
                                    <th>No</th>
                                    <th>Batch No.</th>
                                    <th>Name</th>
                                    <th>Mobile No.</th>
                                    <th>Email</th>
                                    @canany(['member.approve', 'member.mass_approve'])
                                        <th>Status</th>
                                    @endcanany
                                    @canany(['member.edit', 'member.delete'])
                                        <th>Actions</th>
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
    {{ route('backend.memberLists.destroy', 'slug') }}
@endsection
@section('approve_route')
    {{ route('backend.memberLists.destroy', 'slug') }}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            @can('member.mass_destroy')
                window.route_mass_crud_entries_destroy = "{{ route('backend.memberLists.mass.destroy') }}";
            @endcan
            @can('member.show')
                window.route_mass_crud_entries_show = "{{ route('backend.memberLists.mass.destroy') }}";
            @endcan
            @can('member.mass_approve')
                window.route_mass_crud_entries_approve = "{{ route('backend.memberLists.mass.approve') }}";
            @endcan
            $.ajax({
                url: "{{ route('backend.memberLists.index') }}",
                cache: false,
            }).then(function(data, textStatus, jqXHR) {
                var response = JSON.parse(data);
                $('#dataTable').DataTable({
                    data: response["data"],
                    dom: 'Bfrtip',
                    buttons: [
                        @can('member.create')
                            {
                                text: 'Create',
                                className: "btn btn-primary",
                                action: function(e, dt, node, config) {
                                    window.location.href =
                                        '{{ route('backend.memberLists.create') }}';
                                }
                            },
                        @endcan
                        @can('member.create')
                            {
                                text: 'Multi Create',
                                className: "btn btn-primary",
                                action: function(e, dt, node, config) {
                                    window.location.href =
                                        '{{ url('admin/memberLists/multilecreate') }}';
                                }
                            },
                        @endcan
                        @can('member.create')
                            {
                                text: 'Export',
                                className: "btn btn-primary",
                                action: function(e, dt, node, config) {
                                    window.location.href =
                                        '{{ route('backend.memberLists.excel.excelexport') }}';
                                }
                            },
                        @endcan
                        'copy', 'csv', 'pdf', {
                            text: 'Delete Selected',
                            className: "btn btn-primary",
                            action: function(e, dt, node, config) {
                                deleteSelected();
                            }
                        },
                        {
                            text: 'Approve Selected',
                            className: "btn btn-primary",
                            action: function(e, dt, node, config) {
                                approveSelected();
                            }
                        }
                    ],
                    columns: [
                        {
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
                            data: 'batch_no'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'mobile'
                        },
                        {
                            data: 'email'
                        },
                        @canany(['member.approve', 'member.mass_approve'])
                            {
                                orderable: false,
                                "render": function(data, type, full, meta) {
                                    var sle = full.status;
                                    var approveURL =
                                        "{{ route('backend.memberLists.approve', ':slug') }}";
                                    approveURL = approveURL.replace(':slug', full.slug);
                                    var ApproveButton = '';

                                    // if (response["can_edit"]) {
                                    //     if (full.status == 'on') {
                                    //         ApproveButton =
                                    //             '<div class="dropdown mx-1" data-href="' +
                                    //             approveURL +
                                    //             '"><button class="btn btn-outline-success btn-sm btn-font-size-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-check"></i> &nbsp; Active</button><div class="dropdown-menu py-0" btn-success aria-labelledby="dropdownMenuButton"><a class="dropdown-item bg-danger btn-sm text-white d-flex align-items-start "href="' +
                                    //             approveURL +
                                    //             '" id="set_ban" data-status="off"><i class="icon-ban"></i> &nbsp;InActive</a></div>';
                                    //     } else {
                                    //         ApproveButton =
                                    //             '<div class="dropdown mx-1" data-href="' +
                                    //             approveURL +
                                    //             '"><button class="btn btn-outline-danger btn-sm btn-font-size-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-ban"></i> &nbsp; InActive</button><div class="dropdown-menu py-0" btn-success aria-labelledby="dropdownMenuButton"><a class="dropdown-item bg-success btn-sm text-white d-flex align-items-start "href="' +
                                    //             approveURL +
                                    //             '" id="set_ban" data-status="off"><i class="icon-check"></i> &nbsp;Active</a></div>';
                                    //     }
                                    // }
                                    return ApproveButton;
                                }

                            },
                        @endcanany
                        @canany(['member.edit', 'member.delete', 'member.show','mainbusiness.create'])
                            {
                                orderable: false,
                                "render": function(data, type, full, meta) {
                                    var editURL =
                                        "{{ route('backend.memberLists.edit', ':slug') }}";
                                    editURL = editURL.replace(':slug', full.slug);

                                    var showURL =
                                        "{{ route('backend.memberLists.show', ':slug') }}";
                                    showURL = showURL.replace(':slug', full.slug);
                                    var editButton = '';
                                    var showButton = '';
                                    var deleteButton = '';
                                    var approveButton = '';
                                    var mainBussiness = '';
                                    var sideBussiness = '';
                                    var mainbussiness =
                                        "{{ route('backend.mainbusiness.mybusiness', ':slug') }}";
                                    mainbussiness = mainbussiness.replace(':slug', full
                                        .slug);

                                    var sidebusiness =
                                        "{{ route('backend.sidebusiness.mysidebusiness', ':slug') }}";
                                    sidebusiness = sidebusiness.replace(':slug', full.slug);

                                    if (response["can_multi_create"]) {
                                        mainBussiness = '<a href="' + mainbussiness +
                                            '" class="btn btn-success btn-sm mx-2" tabindex="0" data-placement="top" data-toggle="tooltip" title="Add Main Business"><i class="fa fa-plus"></i></a>';
                                    }
                                    if (response["can_multi_create"]) {
                                        sideBussiness = '<a href="' + sidebusiness +
                                            '" class="btn btn-secondary btn-sm mx-2 d-inline-block"  tabindex="0" data-placement="top" data-toggle="tooltip" title="Add Side Business"><i class="fa fa-plus"></i></a>';
                                    }

                                    if (response["can_edit"]) {
                                        editButton = '<a href="' + editURL +
                                            '" class="btn btn-info btn-sm mx-2"  data-toggle="tooltip" title="Update Member Information"><i class="fa fa-edit"></i></a>';
                                    }
                                    if (response["can_show"]) {
                                        showButton = '<a href="' + showURL +
                                            '" class="btn btn-primary btn-sm mx-2"  data-toggle="tooltip" title="Member Detail"><i class="fa fa-info-circle"></i></a>';
                                    }
                                    if (response["can_delete"]) {
                                        var id = full.id;
                                        deleteButton =
                                            '<a class="btn btn-danger btn-sm delete-btn" data-toggle="tooltip" title="Delete Member Data"  href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal" data-slug="' +
                                            id +
                                            '" data-container="body" data-togglePopover="popover" data-trigger="hover" data-placement="top" data-content="Delete" data-original-title="" title=""><i class="fa fa-trash"></i></a></form>';
                                    }
                                    return mainBussiness + sideBussiness+ editButton + showButton + deleteButton;
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
