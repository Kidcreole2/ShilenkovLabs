$(document).ready(function () {
  $("form.form__signIn > button.signUp").on("click", function () {
    $(".form__signIn").css("display", "none");
    $(".form__signUp").css("display", "block");
    $("#login").val("");
    $("#password").val("");
  });
  

  $("#signIn").on("submit", function (e) {
    e.preventDefault();
    console.log("im here");
    let login = $("#login").val() != "" ? $("#login").val() : undefined;
    let pass = $("#password").val() != "" ? $("#password").val() : undefined;
    
    console.log($("#password").val() );
    console.log($("#login").val() );
    
    $.ajax({
      method: "POST",
      url: "./php/signIn.php",
      data: { login: login, password: pass },
      success: (data) => {
        console.log("im ");
        console.log(data);
        let jsonData = JSON.parse(data);

        if (jsonData.success == 1) {
          window.location.href = "main.php";
        }
      },
    });

    let timestamp = new Date().getTime();
    $("#login").val("");
    $("#password").val("");
  });

  $(".form__signUp > button.signIn").on("click", function () {
    $(".form__signIn").css("display", "block");
    $(".form__signUp").css("display", "none");
  });

  $("#signUp").on("submit", (e) => {
    e.preventDefault();
    let login = $("#login1").val() != "" ? $("#login1").val() : undefined;
    let pass = $("#password1").val() != "" ? $("#password1").val() : undefined;
    
    $.ajax({
      method: "POST",
      url: "/login",
      data: { login: login, password: pass, code: code },
      success: (data) => {
        console.log(data);
        console.log(data['login']);
        console.log(data['password']);
        let jsonData = JSON.parse(data);
        if (jsonData.success == 1) {
          window.location.href = "main.php";
        } else {
          alert("something wrong");
        }
      },
    });
    $("#login1").val("");
    $("#password1").val("");
  });
});
