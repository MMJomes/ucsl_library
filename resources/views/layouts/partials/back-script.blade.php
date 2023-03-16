<script src="{{ asset('assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('assets/node_modules/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('assets/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('assets/dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('assets/dist/js/sidebarmenu.js') }}"></script>
<!--stickey kit -->
<script src="{{ asset('assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<script src="{{ asset('assets/node_modules/sparkline/jquery.sparkline.min.js') }}"></script>

<!--Custom JavaScript -->
<script src="{{ asset('assets/dist/js/custom.min.js') }}"></script>

<script src="{{ asset('js/env-setup.js') }}"></script>

<script src="{{ asset('assets/dist/js/dataTable.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('assets/dist/js/main.js') }}"></script>
<script src="{{ asset('assets/dist/js/createform.js') }}"></script>

@if ($select ?? false)
<script src="{{ asset('assets/node_modules/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/dist/select2/select2.min.js') }}"></script>
<link href="{{ asset('assets/dist/select2/select2.min.css') }}" rel="stylesheet" />
@endif

@if ($rolesJS ?? false)
    <script src="{{ asset('assets/dist/js/roles.js') }}"></script>
@endif

@if ($toast ?? false)
    <script src="{{ asset('assets/node_modules/toast-master/js/jquery.toast.js') }}"></script>
    <script>
        $(document).ready(function() {
    $('.select2').select2({
    closeOnSelect: false
});
});
        @if ($errors->any())
            let errors = @json($errors->all());
            errors.forEach(element => {
                $.toast({
                    text: element,
                    position: 'bottom-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 3500,
                    stack: 6
                });
            });
        @endif
        @if (session('success'))
            let msg = "{{ session('success') }}";
            $.toast({
                text: msg,
                position: 'bottom-right',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3500,
                stack: 6
            });
        @endif
    </script>
    <script>
        function isNumber(e) {
            e = e || window.event;
            var charCode = e.which ? e.which : e.keyCode;
            return /\d/.test(String.fromCharCode(charCode));
        }
    </script>
@endif

@if ($datatable ?? false)
    <!-- This is data table -->
    <script src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>

    @if ($datatable_export ?? false)
        <!-- start - This is for export functionality only -->
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
        <!-- end - This is for export functionality only -->
    @endif
    <script>
        $(document).on("click", "#select-all", function() {
            if (this.checked) {
                $(this).parents('table').find('.checkbox-tick').each(function() {
                    this.checked = true;
                });
            } else {
                $(this).parents('table').find('.checkbox-tick').each(function() {
                    this.checked = false;
                });
            }
        });

        $(document).on("click", ".checkbox-tick", function() {
            if ($(this).parents('table').find('.checkbox-tick:checked').length == $(this).parents('table').find(
                    '.checkbox-tick').length) {
                $(this).parents('table').find('#select-all').prop('checked', true);
            } else {
                $(this).parents('table').find('#select-all').prop('checked', false);
            }
        });
    </script>
@endif



@if ($form ?? false)
    <script>
        $(document).on("click", ".browse", function() {
            var file = $(this).parents().find(".file");
            file.trigger("click");
        });
        $('input[type="file"].preview-img').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("preview").src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        });
        $('input[type="file"].preview-1-img').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("preview-1").src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        });
        $('input[type="file"].preview-2-img').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#file").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("preview-2").src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endif

@if ($sweet_alert ?? false)
    <script src="{{ asset('assets/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/sweetalert2/sweet-alert.init.js') }}"></script>
@endif

<script>
    $(document).on("click", ".delete-btn", function() {
        let slug = $(this).attr("data-slug");
        $("#DeleteForm input[name=slug]").val(slug);
    });
    $(document).on("click", ".approve-btn", function() {
        let slug = $(this).attr("data-slug");
        $("#ApproveForm input[name=slug]").val(slug);
    });
</script>

@stack('scripts')
