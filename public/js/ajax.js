$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

const reqJson = (url, method, data, callback) => {
    if (method === "POST") {
        $.ajax({
            url: url,
            type: method,
            dataType: "json",
            contentType: "appliation/json; charset=utf-8",
            data: JSON.stringify(data),
            success: response => callback(null, response),
            error: err => callback(true, err)
        });
    } else if (method === "GET") {
        $.ajax({
            url: url,
            type: method,
            dataType: "json",
            contentType: "appliation/json; charset=utf-8",
            success: response => callback(null, response),
            error: err => callback(true, err)
        });
    }
};

const reqFormData = (url, method, data, callback) => {
    $.ajax({
        url: url,
        type: method,
        data: data,
        processData: false,
        contentType: false,
        success: response => callback(null, response),
        error: err => callback(true, err)
    });
};

const reqDelete = (url, callback) => {
    $.ajax({
        url: url,
        type: "DELETE",
        success: response => callback(null, response),
        error: err => callback(true, err)
    });
};
