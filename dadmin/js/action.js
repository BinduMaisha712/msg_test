$(document).on("submit", "#MainlogInForm", function () {
  $.ajax({
    type: "POST",
    url: "ajax/login.php",
    processData: false,
    contentType: false,
    data: new FormData(this),
    beforeSend: function () {
      $("#loginBtn").attr("disabled", "disabled");
      $("#loginBtn").html(
        "<b> Please Wait </b> <i class='fa fa-spinner fa-spin' aria-hidden='true'></i>"
      );
    },

    success: function (data) {
      data = JSON.parse(data);
      if (data.status) {
        swicon = "success";
        msg = data.message;
        srbSweetAlret(msg, swicon);
        location.href = "index.php";
      } else {
        swicon = "warning";
        msg = data.message;
        srbSweetAlret(msg, swicon);
      }
    },
    complete: function () {
      $("#loginBtn").removeAttr("disabled", "disabled");
      $("#loginBtn").html("Login");
    },
  });
});


$(document).on("submit", "#remarkForm", function () {
  $.ajax({
    type: "POST",
    url: "ajax/enquiry-remark.php",
    processData: false,
    contentType: false,
    data: new FormData(this),
    beforeSend: function () {
      $("#submitbutton").attr("disabled", "disabled");
      $("#submitbutton").html(
        "<i class='fa fa-spinner fa-spin' aria-hidden='true'></i>"
      );
    },

    success: function (data) {
      data = JSON.parse(data);
      if (data.status) {
        swicon = "success";
        msg = data.message;
        srbSweetAlret(msg, swicon);
        window.setTimeout(function () {
          location.reload();
      }, 100);
      } else {
        swicon = "warning";
        msg = data.message;
        srbSweetAlret(msg, swicon);
      }
    },
    complete: function () {
      $("#submitbutton").removeAttr("disabled", "disabled");
      $("#submitbutton").html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>');
    },
  });
});
