$("#emp_Password").on("keyup", function (e) {
  $(this).prop("type", "password");
  var value = $(this).val();
  $("#ErrMsg").hide();
  if (value != "") {
    var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$/;
    var isValid = regex.test(value);
    if (!isValid) {
      $("#AddEmpBtn").attr("disabled", "disabled");
      $("#emp_Password").addClass("err_bdr");
      $("#ErrMsg").show();
      $("#ErrMsg").html(
        "<div class='err_msg' id='" +
          this.id +
          "ErrMsg'>Password must between 6 to 15 characters which contain at least one numeric digit, one uppercase and one lowercase letter</div>"
      );
    } else {
      $("#ErrMsg").hide();
      $("#AddEmpBtn").removeAttr("disabled", "disabled");
      $("#emp_Password").removeClass("err_bdr");
    }
  } else {
    $("#ErrMsg").hide();
    $("#AddEmpBtn").removeAttr("disabled", "disabled");
    $("#emp_Password").removeClass("err_bdr");
  }
});

$("#signUpwithmobileBtn").hide();

$(function () {
  "use strict";

  if ($("#c_code").length) {
    $("#c_code").select2({
      placeholder: "Select Country Code",
    });
  }
});

$(document).on("click", ".toggle-password", function () {
  if ($(".pass2").find("input").attr("type") == "password") {
    $(".pass2").find("input").attr("type", "text");
    $(this).addClass("fa-eye");
    $(this).removeClass("fa-eye-slash");
  } else {
    $(".pass2").find("input").attr("type", "password");
    $(this).removeClass("fa-eye");
    $(this).addClass("fa-eye-slash");
  }
});

// employee function

$(document).on("submit", "#AddEmpForm", function () {
  $.ajax({
    type: "POST",
    url: "ajax/employees.php",
    processData: false,
    contentType: false,
    data: new FormData(this),
    beforeSend: function () {
      $("#AddEmpBtn").attr("disabled", "disabled");
      $("#AddEmpBtn").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");
      $("#loader").show();
    },
    success: function (data) {
      data = JSON.parse(data);
      if (data.status == 1) {
        $("#AddEmpBtn").removeAttr("disabled", "disabled");
        $("#AddEmpBtn").html("Submit");
        $("#AddEmpForm").hide();
        $("#VerEmpForm").show();
        $("#emailEmp").val(data.email);
      } else {
        swicon = "warning";
        msg = data.message;
        srbSweetAlret(msg, swicon);
        $("#AddEmpBtn").removeAttr("disabled", "disabled");
        $("#AddEmpBtn").html("Submit");
      }
    },
  });
});

$(document).on("submit", "#VerEmpForm", function () {
  $.ajax({
    type: "POST",
    url: "ajax/employees.php",
    processData: false,
    contentType: false,
    data: new FormData(this),
    beforeSend: function () {
      $("#VerifyEmpBtn").attr("disabled", "disabled");
      $("#VerifyEmpBtn").html(
        "Please Wait <i class='fa fa-spinner fa-spin'></i>"
      );
    },
    success: function (data) {
      data = JSON.parse(data);
      if (data.status == 1) {
        $("#VerifyEmpBtn").removeAttr("disabled", "disabled");
        $("#VerifyEmpBtn").html("Submit");
        swicon = "success";
        msg = data.message;
        srbSweetAlret(msg, swicon);
        window.setTimeout(function () {
          window.location.href = "employee-list.php";
        }, 500);
      } else {
        swicon = "warning";
        msg = data.message;
        srbSweetAlret(msg, swicon);
        $("#VerifyEmpBtn").removeAttr("disabled", "disabled");
        $("#VerifyEmpBtn").html("Submit");
      }
    },
  });
});

// role function
$(document).on("submit", "#AddRoleForm", function (e) {
  $.ajax({
    type: "POST",
    url: "ajax/roles.php",
    processData: false,
    contentType: false,
    data: new FormData(this),
    beforeSend: function () {
      $("#AddRoleBtn").attr("disabled", "disabled");
      $("#AddRoleBtn").html(
        "Please Wait <i class='fa fa-spinner fa-spin'></i>"
      );
      $("#loader").show();
    },
    success: function (data) {
      data = JSON.parse(data);
      if (data.status) {
        swicon = "success";
        msg = data.message;
        srbSweetAlret(msg, swicon);
        $("#AddRoleBtn").removeAttr("disabled", "disabled");
        $("#AddRoleBtn").html("Submit");
        window.setTimeout(function () {
          location.reload();
        }, 500);
      } else {
        swicon = "warning";
        msg = data.message;
        srbSweetAlret(msg, swicon);
        $("#AddRoleForm")[0].reset();
        $("#AddRoleBtn").removeAttr("disabled", "disabled");
        $("#AddRoleBtn").html("Submit");
      }
    },
  });
});
$(document).on("change", ".roleStsCHange", function () {
  var roleid = $(this).attr("data-id");
  var sts = $(this).val();
  $.ajax({
    url: "ajax/roles.php",
    type: "POST",
    async: false,
    data: {
      roleid: roleid,
      sts: sts,
      type: "RolestatusChnage",
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
$(document).on("click", "#dltRole", function () {
  var roleid = $(this).attr("data-id");
  $.ajax({
    url: "ajax/roles.php",
    type: "POST",
    async: false,
    data: {
      roleid: roleid,
      type: "RoleDlt",
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

// Permission function

$(document).on("submit", "#AddPerForm", function () {
  $.ajax({
    type: "POST",
    url: "ajax/permission.php",
    processData: false,
    contentType: false,
    data: new FormData(this),
    beforeSend: function () {
      $("#SavePerBtn").attr("disabled", "disabled");
      $("#SavePerBtn").html(
        "Please Wait <i class='fa fa-spinner fa-spin'></i>"
      );
    },
    success: function (data) {
      data = JSON.parse(data);
      if (data.status) {
        swicon = "success";
        msg = data.message;
        srbSweetAlret(msg, swicon);
        $("#SavePerBtn").removeAttr("disabled", "disabled");
        $("#SavePerBtn").html("Save Permission");
        window.setTimeout(function () {
          location.reload();
        }, 500);
      } else {
        swicon = "warning";
        msg = data.message;
        srbSweetAlret(msg, swicon);
        $("#AddPerForm")[0].reset();
        $("#SavePerBtn").removeAttr("disabled", "disabled");
        $("#SavePerBtn").html("Save Permission");
      }
    },
  });
});
