function deleteSelected() {
    var ids = [];

    $("#dataTable")
        .find("tbody .checkbox-tick:checked")
        .each(function () {
            ids.push($(this).data("entry-id"));
        });

    if (ids.length > 0) {
        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this records!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "POST",
                    url: window.route_mass_crud_entries_destroy,
                    data: {
                        _token: $("#token").val(),
                        ids: ids,
                    },
                    success: function (data) {
                        Swal.fire(
                            "Deleted!",
                            "Successfully Deleted!",
                            "success"
                        ).then(function () {
                            window.location.reload();
                        });
                    },
                    error: function (err) {
                        Swal.fire(
                            "Warrning!",
                            "You are not allowed to delete this item.",
                            "Failed"
                        );
                        console.log(err);
                        // $.toast({
                        //     text: err.responseText,
                        //     position: "bottom-right",
                        //     loaderBg: "#ff6849",
                        //     icon: "error",
                        //     hideAfter: 3500,
                        //     stack: 6,
                        // });
                    },
                }).fail(function () {
                    // $.toast({
                    //     text: "Processing Failed!",
                    //     position: "bottom-right",
                    //     loaderBg: "#ff6849",
                    //     icon: "error",
                    //     hideAfter: 3500,
                    //     stack: 6,
                    // });
                    Swal.fire(
                        "Warrning!",
                        "Processing Failed!",
                        "Failed"
                    );
                });
            }
        });
    } else {
        // $.toast({
        //     text: "Please, Select at least one row!",
        //     position: "bottom-right",
        //     loaderBg: "#ff6849",
        //     icon: "error",
        //     hideAfter: 3500,
        //     stack: 6,
        // });
        Swal.fire(
            "Warrning!",
            "Please, Select at least one row!",
            "Failed"
        );
        return false;
    }
}

function approveSelected() {
    var ids = [];

    $("#dataTable")
        .find("tbody .checkbox-tick:checked")
        .each(function () {
            ids.push($(this).data("entry-id"));
        });

    if (ids.length > 0) {
        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure to approve the selected records?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sure, Continue",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "POST",
                    url: window.route_mass_crud_entries_approve,
                    data: {
                        _token: $("#token").val(),
                        ids: ids,
                    },
                    success: function (data) {
                        Swal.fire(
                            "Approved!",
                            "Successfully Approved!",
                            "success"
                        ).then(function () {
                            window.location.reload();
                        });
                    },
                    error: function (err) {
                        console.log(err);
                        Swal.fire(
                            "Warrning!",
                            "You are not allowed to delete this item.",
                            "Failed"
                        );
                        // $.toast({
                        //     text: err.responseText,
                        //     position: "bottom-right",
                        //     loaderBg: "#ff6849",
                        //     icon: "error",
                        //     hideAfter: 3500,
                        //     stack: 6,
                        // });
                    },
                }).fail(function () {
                    // $.toast({
                    //     text: "Processing Failed!",
                    //     position: "bottom-right",
                    //     loaderBg: "#ff6849",
                    //     icon: "error",
                    //     hideAfter: 3500,
                    //     stack: 6,
                    // });
                    Swal.fire(
                        "Warrning!",
                        "Processing Failed!",
                        "Failed"
                    );
                });
            }
        });
    } else {
        // $.toast({
        //     text: "Please, Select at least one row!",
        //     position: "bottom-right",
        //     loaderBg: "#ff6849",
        //     icon: "error",
        //     hideAfter: 3500,
        //     stack: 6,
        // });
        Swal.fire(
            "Warrning!",
            "Please, Select at least one row!",
            "Failed"
        );
        return false;
    }
}

function createnewdata()
{
    console.log(window.route_create_entries);
    console.log("window.location.href")
    $.ajax({
        method: "GET",
        url: window.route_create_entries,
    });
}
