$(document).ready(function () {
  $("form.form__signIn > button.signUp").on("click", function () {
    $(".form__signIn").css("display", "none");
    $(".form__signUp").css("display", "block");
    let timestamp = new Date().getTime();
    $(".captcha__image1").attr("src", "php/captcha.php?t=" + timestamp);
    $("#login").val("");
    $("#password").val("");
    $("#captcha").val("");
  });
  

  $("#signIn").on("submit", function (e) {
    e.preventDefault();
    console.log("im here");
    let login = $("#login").val() != "" ? $("#login").val() : undefined;
    let pass = $("#password").val() != "" ? $("#password").val() : undefined;
    let code = $("#code").val() != "" ? $("#code").val() : undefined;
    
    console.log($("#password").val() );
    console.log($("#login").val() );
    console.log($("#code").val() );
    
    $.ajax({
      method: "POST",
      url: "./php/signIn.php",
      data: { login: login, password: pass, code: code },
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
    $("#captcha").val("");
    $(".captcha__image").attr("src", "php/captcha.php?t=" + timestamp);
  });

  $(".form__signUp > button.signIn").on("click", function () {
    $(".form__signIn").css("display", "block");
    $(".form__signUp").css("display", "none");
    let timestamp = new Date().getTime();
    $(".captcha__image").attr("src", "php/captcha.php?t=" + timestamp);
  });

  $("#signUp").on("submit", (e) => {
    e.preventDefault();
    let login = $("#login1").val() != "" ? $("#login1").val() : undefined;
    let pass = $("#password1").val() != "" ? $("#password1").val() : undefined;
    let code = $("#code").val() != "" ? $("#code").val() : undefined;
    
    $.ajax({
      method: "POST",
      url: "./php/signUp.php",
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
    var timestamp = new Date().getTime();
    $(".captcha__image1").attr("src", "php/captcha.php?t=" + timestamp);
    $("#code").val("");
    $("#login1").val("");
    $("#password1").val("");
  });
  
  $("button.captcha__refresh").on("click", () => {
    let timestamp = new Date().getTime();
    $(".captcha__image").attr("src", "php/captcha.php?t=" + timestamp);
  });
  $("button.captcha__refresh1").on("click", () => {
    let timestamp = new Date().getTime();
    $(".captcha__image1").attr("src", "php/captcha.php?t=" + timestamp);
  });
});
