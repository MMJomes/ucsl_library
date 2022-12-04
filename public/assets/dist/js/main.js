$(document).on("click", ".delete-btn", function () {
    let id = $(this).attr("data-id");
    $("#DeleteForm input[name=id]").val(id);
});

$("#btn-upload-photo").on("click", function () {
    $("#filePhoto").click();
});
let imgInp = document.getElementById("filePhoto");

if (imgInp) {
    let img = document.getElementById("user-photo");
    imgInp.onchange = (evt) => {
        const [file] = imgInp.files;
        if (file) {
            img.src = URL.createObjectURL(file);
        }
    };
}
