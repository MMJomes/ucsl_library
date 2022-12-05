@extends('layouts.myapp')
@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">Side Business Lists </h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Side Business List</li>
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
                                    <th>Name</th>
                                    <th>KeyWord</th>
                                    <th>Created Date</th>
                                    @canany(['sidebusiness.edit', 'sidebusiness.delete'])
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
    {{ route('backend.sidebusiness.destroy', 'slug') }}
@endsection
@section('approve_route')
    {{ route('backend.sidebusiness.destroy', 'slug') }}
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {

            var slug = "{{ $member_slug }}";
            console.log(slug);
            @can('sidebusiness.mass_destroy')
                window.route_mass_crud_entries_destroy = "{{ route('backend.sidebusiness.mass.destroy') }}";
            @endcan
            @can('sidebusiness.show')
                window.route_mass_crud_entries_show = "{{ route('backend.sidebusiness.mass.destroy') }}";
            @endcan
            @can('sidebusiness.create')
                var sidebusiness =
                    "{{ route('backend.sidebusiness.create', ':slug') }}";
                    sidebusiness = sidebusiness.replace(':slug', slug);
            @endcan
            $.ajax({
                url: "{{ route('backend.sidebusiness.index') }}",
                cache: false,
            }).then(function(data, textStatus, jqXHR) {
                var response = JSON.parse(data);
                $('#dataTable').DataTable({
                    data: response["data"],
                    dom: 'Bfrtip',
                    buttons: [
                        @if ($member_slug)
                        @can('bizcategory.create')
                            {
                                text: 'Create New',
                                className: "btn btn-primary",
                                action: function(e, dt, node, config) {
                                    window.location.href =sidebusiness;

                                }
                            },
                        @endcan
                        @endif
                        'copy', 'csv', 'excel', 'pdf', 'print', {
                            text: 'Delete Selected',
                            className: "btn btn-primary",
                            action: function(e, dt, node, config) {
                                deleteSelected();
                            }
                        },
                        // {
                        //     text: 'Approve Selected',
                        //     className: "btn btn-primary",
                        //     action: function(e, dt, node, config) {
                        //         approveSelected();
                        //     }
                        // }
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
                            data: 'name'
                        },
                        {
                            data: 'keyword'
                        },
                        {
                            "render": function(data, type, full, meta) {
                                var createdDate = new Date(full.created_at);
                                return createdDate.toLocaleString("en-US");
                            },
                        },
                        @canany(['sidebusiness.edit', 'sidebusiness.delete', 'sidebusiness.show'])
                            {
                                orderable: false,
                                "render": function(data, type, full, meta) {
                                    var editURL =
                                        "{{ route('backend.sidebusiness.edit', ':slug') }}";
                                    editURL = editURL.replace(':slug', full.slug);

                                    var showURL =
                                        "{{ route('backend.sidebusiness.show', ':slug') }}";
                                    showURL = showURL.replace(':slug', full.slug);
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
                                            full.slug +
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
