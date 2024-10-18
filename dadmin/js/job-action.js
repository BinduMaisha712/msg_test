$(document).on("submit", "#AddJobForms", function () {
    $.ajax({
        type: "POST",
        url: "ajax/job-module.php",
        processData: false,
        contentType: false,
        data: new FormData(this),
        beforeSend: function () {
            $("#addJob").attr("disabled", "disabled");
            $("#addJob").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");
            $("#loader").show();
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                swicon = "success";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                location.href = "vacancies.php";

            } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
            }
        },
        complete: function () {
            $("#addJob").removeAttr("disabled", "disabled");
            $("#addJob").html("Add Job");
        },
    });
});

// edit blog section 

$(document).on("submit", "#EditJobForms", function () {
    $.ajax({
        type: "POST",
        url: "ajax/job-module.php",
        processData: false,
        contentType: false,
        data: new FormData(this),
        beforeSend: function () {
            $("#EditJob").attr("disabled", "disabled");
            $("#EditJob").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");
            $("#loader").show();
        },
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                swicon = "success";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                location.href = "vacancies.php";

            } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
            }
        },
        complete: function () {
            $("#EditJob").removeAttr("disabled", "disabled");
            $("#EditJob").html("Save Job");
        },
    });
});


// Delete Job

$(document).on("click", "#jobDltBtn", function () {
    var jobId = $(this).attr("data-id");
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
                url: "ajax/job-module.php",
                type: "POST",
                async: false,
                data: {
                    jobId: jobId,
                    formType: "jobDlt",
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

// status of applicants

$(document).on("change", ".jobstatusHr", function(){
    id = $(this).attr('data-id');
    sts = $(this).val();
    $.ajax({
        url: "ajax/job-module.php",
        type: "POST",
        async: false,
        data: {
          id: id,
          sts: sts,
          formType: "applicantSts",
        },
        success: function (data) {
          data = JSON.parse(data);
          if (data.status) {
            swicon = "success";
            msg = data.message;
            srbSweetAlret(msg, swicon);
            window.setTimeout(function () {
              location.reload();
            }, 500);
          } else {
            swicon = "warning";
            msg = data.message;
            srbSweetAlret(msg, swicon);
          }
        },
      });
});