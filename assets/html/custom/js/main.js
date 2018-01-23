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
  let div = "div.form-box-item";
  let id = $(div).find("input.addons-up-id").val();
  let user = $(div).find("input.addons-up-user").val();
  let name = $(div).find("input.addons-up-name").val();
  let pass = md5($(div).find("input.addons-up-pass").val());
  let rp_pass = md5($(div).find("input.addons-up-rp-pass").val());
  let email = $(div).find("input.addons-up-email").val();
  let website = $(div).find("input.addons-up-website").val();
  let about = $(div).find("input.addons-up-about").val();
  if(pass != rp_pass || pass == md5("") || rp_pass == md5("") ){
    pass = NULL;
    rp_pass = NULL;    
  }
  $("#addons-up-id").val(id);
  $("#addons-up-user").val(user);
  $("#addons-up-name").val(name);
  $("#addons-up-pass").val(pass);
  $("#addons-up-rp-pass").val(rp_pass);
  $("#addons-up-email").val(email);
  $("#addons-up-website").val(website);
  $("#addons-up-about").val(about);
  $("#addons-up-partner").submit();
  event.preventDefault();
});
