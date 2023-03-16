<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('layouts.partials.back-head')
</head>

<body class="horizontal-nav skin-green fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">DIGITAL LIBRARY MANAGENMENT SYSTEM FOR UCSL</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('layouts.partials.back-header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        @include('layouts.partials.back-sidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <form action="{{ route('logout') }}" method="POST" id="logout-form">@csrf</form>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        @include('layouts.partials.back-footer')
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <div class="modal fade" id="delete-confirmation-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalCenterTitle"> Are you sure to delete?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <form action="@yield('delete_route')" method="post" class="d-inline" id="DeleteForm">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="slug" id="slug">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
                    </form>
                    <button type="button" class="btn btn-outline-success" data-dismiss="modal"><i
                            class="fa fa-times"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="approve-confirmation-modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalCenterTitle"> Are you sure to update?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to approve these records? </p>
                </div>
                <div class="modal-footer">
                    <form action="@yield('approve_route')" method="post" class="d-inline" id="ApproveForm">
                        @csrf

                        <input type="hidden" name="slug" id="slug">
                        <button type="submit" class="btn btn-success"><i class="fa fa-trash-o"></i> Sure,
                            Continue</button>
                    </form>
                    <button type="button" class="btn btn-outline-success" data-dismiss="modal"><i
                            class="fa fa-times"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.back-script')
</body>

</html>
