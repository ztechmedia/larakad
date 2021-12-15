$(document.body).on("submit", ".ajax-create", function(e) {
    e.preventDefault();
    const el = $(this);
    const url = el.data("url");
    const resStatus = el.data("response") === "custom" ? true : false;
    const data = new FormData(this);

    const btnName = $(".btn-submit").val();

    setLoading(".btn-submit", "Loading...");

    reqFormData(url, "POST", data, (err, res) => {
        removeFormError();
        if (res) {
            if (!err) {
                if (resStatus) {
                    ajaxResponse(this, res);
                } else {
                    swal("Sukses", res.message, "success");
                    this.reset();
                }
            } else {
                errorHandler(res.responseJSON.errors);
            }
        }
        setFinish(".btn-submit", btnName);
    });
});

$(document.body).on("submit", ".ajax-update", function(e) {
    e.preventDefault();
    const el = $(this);
    const url = el.data("url");
    const data = new FormData(this);
    const resStatus = el.data("response") === "custom" ? true : false;
    const btnName = $(".btn-submit").val();

    setLoading(".btn-submit", "Loading...");

    reqFormData(url, "POST", data, (err, res) => {
        removeFormError();
        if (res) {
            if (!err) {
                if (resStatus) {
                    res.update = true;
                    ajaxResponse(this, res);
                } else {
                    swal("Sukses", res.message, "success");
                }
            } else {
                errorHandler(res.responseJSON.errors);
            }
        }
        setFinish(".btn-submit", btnName);
    });
});

$(document.body).on("click", ".ajax-delete", function(e) {
    const el = $(this);
    const url = el.data("url");
    const message = el.data("message");

    swal(
        {
            title: "Hapus",
            text: message,
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Ya, Hapus!",
            closeOnConfirm: false
        },
        function() {
            reqDelete(url, (err, res) => {
                if (res.status === "error") {
                    swal("Error", res.message, "error");
                } else {
                    swal.close();
                    row = el.closest("tr");
                    row.fadeOut(200, function() {
                        el.remove();
                    });
                }
            });
        }
    );
});

$(document.body).on("click", ".ajax-confirm", function(e) {
    const el = $(this);
    const url = el.data("url");
    const message = el.data("message");

    swal(
        {
            title: "Konfirmasi",
            text: message,
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Ya, Konfirmasi!",
            closeOnConfirm: false
        },
        function() {
            reqAction(url, (err, res) => {
                if (res.status === "error") {
                    swal("Error", res.message, "error");
                } else {
                    swal("Success", res.message, "success");
                    swal.close();
                    row = el.closest("tr");
                    row.fadeOut(200, function() {
                        el.remove();
                    });
                }
            });
        }
    );
});
