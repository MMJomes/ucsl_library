@extends('layouts.myapp')

@section('content')
    <div class="row page-titles">
        <div class="col-md-12">
            <h4 class="text-white">{{ __('message.books') }}</h4>
        </div>
        <div class="col-md-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.dashboard.index') }}">{{ __('message.home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('message.books') }}</li>
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
                    <h6 class="card-subtitle">Export data to Excel Export, Copy</h6>
                    <div class="table-responsive m-t-40">
                        <table id="dataTable" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%" style="font-size: 14px !important">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        <input type="checkbox" id="select-all" class="select-checkbox">
                                    </th>
                                    <th>{{ __('message.no') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('message.titlenumber') }}</th>
                                    <th>{{ __('message.author') }}</th>
                                    <th>{{ __('message.bookname') }}</th>
                                    <th>{{ __('message.producetime') }}</th>
                                    <th>{{ __('message.category') }}</th>
                                    <th>{{ __('message.totalbook') }}</th>
                                    <th>{{ __('message.availablebook') }}</th>
                                    @canany(['book.edit', 'book.delete'])
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
    {{ route('backend.book.destroy', 'slug') }}
@endsection
@section('approve_route')
    {{ route('backend.book.destroy', 'slug') }}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            @can('member.mass_destroy')
                window.route_mass_crud_entries_destroy = "{{ route('backend.book.mass.destroy') }}";
            @endcan
            @can('member.show')
                window.route_mass_crud_entries_show = "{{ route('backend.book.mass.destroy') }}";
            @endcan
            @can('member.mass_approve')
                window.route_mass_crud_entries_approve = "{{ route('backend.book.mass.approve') }}";
            @endcan
            $.ajax({
                url: "{{ route('backend.book.index') }}",
                cache: false,
            }).then(function(data, textStatus, jqXHR) {
                var response = JSON.parse(data);
                $('#dataTable').DataTable({
                    data: response["data"],
                    dom: 'Bfrtip',
                    buttons: [
                        @can('book.create')
                            {
                                text: '{{ __('message.createnew') }}',
                                className: "btn btn-primary",
                                action: function(e, dt, node, config) {
                                    window.location.href =
                                        '{{ route('backend.book.create') }}';
                                }
                            },
                        @endcan
                        @can('book.create')
                            {
                                text: '{{ __('message.excelimport') }}',
                                className: "btn btn-primary",
                                action: function(e, dt, node, config) {
                                    window.location.href =
                                        '{{ url('admin/book/bookmultilecreate') }}';
                                }
                            },
                        @endcan
                        @can('book.create')
                            {
                                text: 'Excel Export',
                                className: "btn btn-primary",
                                action: function(e, dt, node, config) {
                                    window.location.href =
                                        '{{ route('backend.book.excel.excelexport') }}';
                                }
                            },
                        @endcan
                        'copy', {
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
                            data: 'image',
                            name: 'image',
                            defaultContent: '',
                            render: function(data) {
                                return '<img src="' + data + '" width="50" height="50">';
                            },
                        },
                        {
                            data: 'titlename',
                            defaultContent: "-"
                        },
                        {
                            data: 'author.name',
                            defaultContent: "-"
                        },
                        {
                            data: 'bookname',
                            defaultContent: "-"
                        },

                        {
                            data: 'edtion',
                            defaultContent: "-"
                        },

                        {
                            data: 'category.name',
                            defaultContent: "-"
                        },

                        {

                            data: 'totalbook',
                            defaultContent: "-"
                        },
                        {

                            data: 'availablebook',
                            defaultContent: "-"
                        },
                        @canany(['book.edit', 'book.delete', 'book.show'])
                            {
                                orderable: false,
                                "render": function(data, type, full, meta) {
                                    var editURL =
                                        "{{ route('backend.book.edit', ':slug') }}";
                                    editURL = editURL.replace(':slug', full.slug);

                                    var showURL =
                                        "{{ route('backend.book.show', ':slug') }}";
                                    showURL = showURL.replace(':slug', full.slug);
                                    var editButton = '';
                                    var showButton = '';
                                    var deleteButton = '';


                                    if (response["can_edit"]) {
                                        editButton = '<a href="' + editURL +
                                            '" class="btn btn-info btn-sm mx-2"  data-toggle="tooltip" title="Update Member Information"><i class="fa fa-edit"></i></a>';
                                    }
                                    if (response["can_show"]) {
                                        showButton = '<a href="' + showURL +
                                            '" class="btn btn-primary btn-sm mx-2"  data-toggle="tooltip" title="Member Detail"><i class="fa fa-info-circle"></i></a>';
                                    }
                                    if (response["can_delete"]) {
                                        deleteButton =
                                            '<a class="btn btn-danger btn-sm delete-btn" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal" data-slug="' +
                                            full.slug +
                                            '" data-container="body" data-togglePopover="popover" data-trigger="hover" data-placement="top" data-content="Delete" data-original-title="" title=""><i class="fa fa-trash"></i></a></form>';
                                    }
                                    return editButton +
                                        showButton + deleteButton;
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
