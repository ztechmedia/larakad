const errorHandler = errors => {
    $.each(errors, function(key1, value1) {
        $(`#${key1}`).addClass("is-invalid");
        $(`.${key1}-errors`).append("<ul></ul>");
        $.each(value1, function(key2, value) {
            $(`.${key1}-errors ul`).append(
                `<li class="form-error">${value}</li>`
            );
        });
    });
};

const removeFormError = () => {
    $(".form-errors").html("");
    $(".is-invalid").removeClass("is-invalid");
};
