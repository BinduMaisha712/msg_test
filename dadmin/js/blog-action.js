$(document).on("submit", "#blogCatForms", function () {
    $.ajax({
        type: "POST",
        url: "ajax/blog-module.php",
        processData: false,
        contentType: false,
        data: new FormData(this),
        beforeSend: function () {
            $("#addBlogCat").attr("disabled", "disabled");
            $("#addBlogCat").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");
            $("#loader").show();
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                swicon = "success";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                location.href = "blog-category.php";

            } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
            }
        },
        complete: function () {
            $("#addBlogCat").removeAttr("disabled", "disabled");
            $("#addBlogCat").html("Add Category");
        },
    });
});

// Edit Blog Category 

$(document).on("submit", "#blogCatEditForms", function () {
    $.ajax({
        type: "POST",
        url: "ajax/blog-module.php",
        processData: false,
        contentType: false,
        data: new FormData(this),
        beforeSend: function () {
            $("#EditBlogCat").attr("disabled", "disabled");
            $("#EditBlogCat").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");
            $("#loader").show();
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                swicon = "success";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                location.href = "blog-category.php";
            } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
            }
        },
        complete: function () {
            $("#EditBlogCat").removeAttr("disabled", "disabled");
            $("#EditBlogCat").html("Save Category");
        },
    });
});

// Delete Blog Category 

$(document).on("click", ".blgCatDltBtn", function () {
    var catid = $(this).attr("data-id");
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/blog-module.php",
                type: "POST",
                async: false,
                data: {
                    catid: catid,
                    formType: "DltblogCat",
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        window.setTimeout(function () {
                            location.reload();
                        }, 300);
                    } else {
                        swicon = "warning";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                    }
                },
            });
        }
    });


});

// Status Blog Category 

$(document).on("change", "#blogCatSts", function () {
    var catid = $(this).attr("data-id");
    var sts = $(this).val();
    $.ajax({
        url: "ajax/blog-module.php",
        type: "POST",
        async: false,
        data: {
            catid: catid,
            sts: sts,
            formType: "stsblogCat",
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                swicon = "success";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                window.setTimeout(function () {
                    location.reload();
                }, 300);
            } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
            }
        },
    });
});
// Add New Blog

$(document).on("submit", "#AddblogForms", function () {
    $.ajax({
        type: "POST",
        url: "ajax/blog-module.php",
        processData: false,
        contentType: false,
        data: new FormData(this),
        beforeSend: function () {
            $("#addBlog").attr("disabled", "disabled");
            $("#addBlog").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");
            $("#loader").show();
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                swicon = "success";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                location.href = data.url;
            } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
            }
        },
        complete: function () {
            $("#addBlog").removeAttr("disabled", "disabled");
            $("#addBlog").html("Add Blog");
            $("#loader").hide();
        },
    });
});

// blog published

$(document).on("click", "#blogPublish", function () {
    var blogtoken = $(this).attr("data-token");
    $.ajax({
        url: "ajax/blog-module.php",
        type: "POST",
        async: false,
        data: {
            blogtoken: blogtoken,
            formType: "blogPublished",
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                swicon = "success";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                location.href = "view-blog.php";
            } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
            }
        },
    });


});


// Status Blog 

$(document).on("change", "#blogSts", function () {
    var blogid = $(this).attr("data-id");
    var sts = $(this).val();
    $.ajax({
        url: "ajax/blog-module.php",
        type: "POST",
        async: false,
        data: {
            blogid: blogid,
            sts: sts,
            formType: "stsblog",
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                swicon = "success";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                window.setTimeout(function () {
                    location.reload();
                }, 300);
            } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
            }
        },
    });
});

// Delete Blog

$(document).on("click", ".blgDltBtn", function () {
    var blogid = $(this).attr("data-id");
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/blog-module.php",
                type: "POST",
                async: false,
                data: {
                    blogid: blogid,
                    formType: "dltBlog",
                },
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        window.setTimeout(function () {
                            location.reload();
                        }, 300);
                    } else {
                        swicon = "warning";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                    }
                },
            });
        }
    });

});


// Edit Blog

$(document).on("submit", "#EditblogForms", function () {
    $.ajax({
        type: "POST",
        url: "ajax/blog-module.php",
        processData: false,
        contentType: false,
        data: new FormData(this),
        beforeSend: function () {
            $("#EditBlog").attr("disabled", "disabled");
            $("#EditBlog").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");
            $("#loader").show();
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                swicon = "success";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                location.href = "view-blog.php";
            } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
            }
        },
        complete: function () {
            $("#EditBlog").removeAttr("disabled", "disabled");
            $("#EditBlog").html("Save Blog's Changes");
            $("#loader").hide();
        },
    });
});