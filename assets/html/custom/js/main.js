// login
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
  // treat buttons on profile page
  let page = window.location.pathname;
  let profile_page = page.indexOf("profile-page");
  let items_page = page.indexOf("author-items-page");
  let dashboard_statement = page.indexOf("dashboard-statement");
  let dashboard_settings = page.indexOf("dashboard-settings");
  let dashboard_uploaditem = page.indexOf("dashboard-uploaditem");
  if(profile_page != -1){
    let ul = "ul#addons-board-profile"
    $(ul).find("#board-profile-page").attr('class', 'dropdown-item active');
    $(ul).find("#board-author-itens-page").attr('class', 'dropdown-item');
  }
  if(items_page != -1){
    let ul = "ul#addons-board-profile"
    $(ul).find("#board-profile-page").attr('class', 'dropdown-item');
    $(ul).find("#board-author-itens-page").attr('class', 'dropdown-item active');
  }
  // treat buttons on the panel
  if (dashboard_statement != -1) {
    // page dashboard_statement
    let div = "div#dashboard-options-menu";
    $(div).find("#addons-li-dashboard-settings").attr('class', 'dropdown-item');
    $(div).find("#addons-li-dashboard-statement").attr('class', 'dropdown-item active');
    $(div).find("#addons-li-dashboard-upitem").attr('class', 'dropdown-item');
    $(div).find("#addons-li-dashboard-manageitem").attr('class', 'dropdown-item');
    $(div).find("#addons-li-dashboard-withdrawals").attr('class', 'dropdown-item');
  }
  if (dashboard_settings != -1) {
    //page dashboard_settings
    let div = "div#dashboard-options-menu";
    $(div).find("#addons-li-dashboard-settings").attr('class', 'dropdown-item active');
    $(div).find("#addons-li-dashboard-statement").attr('class', 'dropdown-item');
    $(div).find("#addons-li-dashboard-upitem").attr('class', 'dropdown-item');
    $(div).find("#addons-li-dashboard-manageitem").attr('class', 'dropdown-item');
    $(div).find("#addons-li-dashboard-withdrawals").attr('class', 'dropdown-item');
  }
  if (dashboard_uploaditem != -1) {
    //page dashboard_uploaditem
    let div = "div#dashboard-options-menu";
    $(div).find("#addons-li-dashboard-settings").attr('class', 'dropdown-item');
    $(div).find("#addons-li-dashboard-statement").attr('class', 'dropdown-item');
    $(div).find("#addons-li-dashboard-upitem").attr('class', 'dropdown-item active');
    $(div).find("#addons-li-dashboard-manageitem").attr('class', 'dropdown-item');
    $(div).find("#addons-li-dashboard-withdrawals").attr('class', 'dropdown-item');
  }

});
// update partners
$("#addons-button-save").click(function(event){
  let div = "div.form-box-item";
  let id = $(div).find("input.addons-up-id").val();
  let user = $(div).find("input.addons-up-user").val();
  let name = $(div).find("input.addons-up-name").val();
  let pass = md5($(div).find("input.addons-up-pass").val());
  let rp_pass = md5($(div).find("input.addons-up-rp-pass").val());
  let website = $(div).find("input.addons-up-website").val();
  let about = $(div).find("input.addons-up-about").val();
  let occupation = $(div).find("input.addons-up-occupation").val();
  let city = $(div).find("input.addons-up-city").val();
  let country = $(div).find("select#new_country").val();

  if(pass != rp_pass ){
    //If the confirmation password and password are different, activate "span"
    $(div).find("span.pass").css( "color", "red");
    $(div).find("span.rp-pass").css( "color", "red");
  }
  else {
    $(div).find("span.pass").css( "color", "black");
    $(div).find("span.rp-pass").css( "color", "black");
  }

  if(name == ""){
    // If the name is empty, activate "span"
    $(div).find("span.name").css( "color", "red");
  }
  else {
    $(div).find("span.name").css( "color", "black");
  }

  if(pass == md5("")){
    // If the password is empty, do not change the current password, send the word "empty" to be treated from the other side
    pass = rp_pass = "empty";
  }
  $("#addons-up-id").val(id);
  $("#addons-up-user").val(user);
  $("#addons-up-name").val(name);
  $("#addons-up-pass").val(pass);
  $("#addons-up-rp-pass").val(rp_pass);
  $("#addons-up-website").val(website);
  $("#addons-up-about").val(about);
  $("#addons-up-occupation").val(occupation);
  $("#addons-up-city").val(city);
  $("#addons-up-country").val(country);
  // just accept "submit" if the passwords and the name are "ok"
  if(pass == rp_pass && name != ""){
  $("#addons-up-partner").submit();
  }
  event.preventDefault();
});
