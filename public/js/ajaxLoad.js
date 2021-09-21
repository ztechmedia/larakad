const loading = (target = ".content") => {
    $(target).html(
        '<div class="row">' +
            '<div class="col-md-12">' +
            '<div class="loader">Loading...</div>' +
            "</div>" +
            "</div>"
    );
};

const setLoading = (className, text = null) => {
    $(className).attr("disabled", "disabled");
    $(className).attr("value", text);
};

const setFinish = (className, text = null) => {
    $(className).removeAttr("disabled", "disabled");
    $(className).attr("value", text);
};

const loadView = (url, div) => {
    $(div).load(url);
};

const setUrl = (url, id) => {
    return encodeURI(url.replace(":id", id));
};

const customModal = (modal, title, url) => {
    $(`#${modal}`).modal("show");
    $(".modal-title").html(title);
    loadView(url, ".body-custom");
};
