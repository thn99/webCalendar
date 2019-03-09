//enable login button after data input in all fields
$(document).ready(function() {
  $("input").keyup(function() {
    if ($("#loginField").val() == "" || $("#passwordField").val() == "") {
      $(".loginButton").attr("disabled", true);
    } else {
      $(".loginButton").attr("disabled", false);
    }
  });
});

//enable register button after data input in all fields
$(document).ready(function() {
  $("input").keyup(function() {
    if (
      $("#regName").val() == "" ||
      $("#regEmail").val() == "" ||
      $("#regPass").val() != $("#regConfirmPass").val()
    ) {
      $(".finishRegisterButton").attr("disabled", true);
    } else {
      $(".finishRegisterButton").attr("disabled", false);
    }
  });
});
