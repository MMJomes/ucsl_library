function selectAllOrNot(id) {
    if ($(`#group-${id}`).is(":checked")) {
        $(`.group-${id}`).each(function() {
            this.checked = true;
        });
    } else {
        $(`.group-${id}`).each(function() {
            this.checked = false;
        });
    }
}

function selectItem(id) {
    var isChecked = false;
    for (let index = 0; index < $(`.group-${id}`).length; index++) {
        const checked = $(`.group-${id}`)[index].checked;
        if (checked) {
            isChecked = true;
        } else {
            isChecked = false;
            break;
        }
    }
    $(`#group-${id}`).each(function() {
        this.checked = isChecked
    })
}
