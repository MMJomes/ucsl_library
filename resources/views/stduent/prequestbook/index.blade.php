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
                                    <th>{{ __('message.no') }}</th>
                                    <th>{{ 'Stduent Name' }}</th>
                                    <th>{{ 'Book Name' }}</th>
                                    <th>{{ 'Edtion' }}</th>
                                    <th>{{ 'Request Date' }}</th>
                                    <th>{{ 'Status' }}</th>

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
        $(document).ready(function() {
            @can('author.mass_destroy')
                window.route_mass_crud_entries_destroy = "{{ route('stduent.preRequestBooks.mass.destroy') }}";
            @endcan
            @can('author.show')
                window.route_mass_crud_entries_show = "{{ route('stduent.preRequestBooks.mass.destroy') }}";
            @endcan
            @can('member.mass_approve')
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

                        @can('author.create')
                            {
                                text: '{{ __('message.createnew') }}',
                                className: "btn btn-primary",
                                action: function(e, dt, node, config) {
                                    window.location.href =
                                        '{{ route('stduent.preRequestBooks.create') }}';
                                }
                            },
                        @endcan
                        'copy', 'csv', 'excel', 'pdf', 'print', {
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
                        @canany(['member.approve', 'member.mass_approve'])
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
                    ],
                });
                $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel')
                    .addClass(
                        'btn btn-primary mr-1');
            });
        });
    </script>
@endpush
