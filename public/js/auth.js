$(document.body).on("click", ".btn-logout", function(e) {
    var el = $(this);
    var url = el.data("url");
    var redirect = el.data("redirect");
    swal(
        {
            title: "Anda yakin ingin keluar ?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Ya, Keluar Sekarang",
            closeOnConfirm: true
        },
        function() {
            $.ajax({
                type: "POST",
                url: url,
                success: function(res) {
                    swal("Sukses", "Logout Sukses", "success");
                    setTimeout(() => {
                        window.location = redirect;
                    }, 500);
                },
                error: function(err) {
                    console.log("Error: ", err);
                }
            });
        }
    );
});
