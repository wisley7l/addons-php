console.log("Carregado...");
$("form.addons-partner-login").submit(function(event) {
  console.log("estou aqui");
  let username = $(this).find("input.addons-login-user").val();
  let password = md5($(this).find("input.addons-login-password").val());
  $("#addons-login-user").val(username);
  $("#addons-login-pass").val(password);
  $("#addons-login").submit();
  event.preventDefault();
});
