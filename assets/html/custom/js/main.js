//
$("form.addons-partner-login").submit(function(event) {
  let username = $(this).find("input.addons-login-user").val();
  let password = md5($(this).find("input.addons-login-password").val());
  $("#addons-login-user").val(username);
  $("#addons-login-pass").val(password);
  $("#addons-login").submit();
  event.preventDefault();
});
// alert login sucess or error
$( document ).ready(function() {
  if ($(this).find("div.addons-error-login").length > 0) {
    $('body').xmalert({
    	x: 'right',
    	y: 'top',
    	xOffset: 30,
    	yOffset: 30,
    	alertSpacing: 40,
    	lifetime: 6000,
    	fadeDelay: 0.3,
    	template: 'messageError',
    	title: 'ERROR LOGIN',
    	paragraph: $(this).find("div.addons-error-login").text(),
    });
  }
  if ($(this).find("div.addons-sucess-login").length > 0) {
    $('body').xmalert({
    	x: 'right',
    	y: 'top',
    	xOffset: 30,
    	yOffset: 30,
    	alertSpacing: 40,
    	lifetime: 6000,
    	fadeDelay: 0.3,
    	template: 'messageSuccess',
    	title: 'LOGIN SUCESS',
    	paragraph: $(this).find("div.addons-sucess-login").text(),
    });
  }
});
//
$("#addons-button-save").click(function(event){
  let div = "div#form-box-item";
  console.log("OK");
  let id = $(div).find("input.addons-up-id").val();
  let name = $(div).find("input.addons-up-name").val();
  let pass = $(div).find("input.addons-up-pass").val();
  let rp_pass = $(div).find("input.addons-up-rp-pass").val();
  let email = $(div).find("input.addons-up-email").val();
  let website = $(div).find("input.addons-up-website").val();
  let country_val = $(div).find("select.addons-up-country").val();
  console.log(id);
  console.log(name);
  console.log(pass);
  console.log(rp_pass);
  console.log(email);
  console.log(website);
  console.log(country_val);
  event.preventDefault();
});
