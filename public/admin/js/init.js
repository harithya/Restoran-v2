$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

const _alert = (status, message) => {
    if (status == "success") {
        alertify.success(message);
    } else {
        alertify.error(message);
    }
};

const resetForm = () => {
    $(".form-control").removeClass("is-invalid");
    $(".invalid-feedback").remove();
};

const validationCheck = (result, form) => {
    if ($.isEmptyObject(result) == false) {
        $.each(result.errors, function (key, value) {
            $("#" + form + " .form-control[name=" + key + "]").after(
                `<div class="invalid-feedback">
               ${value}
              </div>`
            );
            $("#" + form + " .form-control[name=" + key + "]").addClass(
                "is-invalid"
            );
        });
    }
};

const _insert = (url, data) => {
    $.ajax({
        type: "POST",
        url: url,
        contentType: false,
        processData: false,
        data: data,
        beforeSend: function (data) {
            resetForm();
        },
        success: function (data) {
            $("#modalAdd").modal("hide");
            $("#table").DataTable().ajax.reload();
            if (data.status == true) {
                _alert("success", "Berhasil menambahkan data");
            }
            $("#formAdd").trigger("reset");
        },
        error: function (data) {
            const result = data.responseJSON;
            validationCheck(result, "formAdd");
        },
    });
};

const _delete = (url, id) => {
    let conf = confirm("Apakah Yakin ?");
    if (conf == true) {
        $.ajax({
            type: "delete",
            url: url,
            success: function (data) {
                if (data.status == true) {
                    _alert("success", "Berhasil menghapus data");
                }
                $("#table").DataTable().ajax.reload();
            },
            error: function (data) {
                _alert("danger", "Gagal menghapus data");
            },
        });
    }

    return false;
};

const _update = (url, data) => {
    $.ajax({
        type: "POST",
        url: url,
        contentType: false,
        processData: false,
        data: data,
        beforeSend: function (data) {
            resetForm();
        },
        success: function (data) {
            $("#modalUpdate").modal("hide");
            $("#table").DataTable().ajax.reload();
            if (data.status == true) {
                _alert("success", "Berhasil mengubah data");
            }
            $("#formUpdate").trigger("reset");
        },
        error: function (data) {
            const result = data.responseJSON;
            validationCheck(result, "formUpdate");
        },
    });
};
