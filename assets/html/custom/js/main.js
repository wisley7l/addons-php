// login
$("form.addons-partner-login").submit(function(event) {
  let username = $(this).find("input.addons-login-user").val(),
   password = md5($(this).find("input.addons-login-password").val()),
   legth_pass = $(this).find("input.addons-login-password").val().length;
  if (legth_pass >= 6) {
    $("#addons-login-user").val(username);
    $("#addons-login-pass").val(password);
    $("#addons-login").submit();
  }
  else {
    $("label#addons-login-pass").css( "color", "red");
  }
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
// test

$("#addons-download").click(function(event) {
  // console.log(event.target.id);
  let id = event.target.id,
      is_app = $("input#addons-buy-theme-"+id).val();

  // console.log(is_app);
  //addons-downlod-file
  //addons-id-plan
  $("#addons-is-app").val(is_app);
  $("#addons-id-buy").val(id);
  $("#addons-downlod-file").submit();
});

$('select#price_filter').on("change",function(ev){
  let price_filter = $(this).val(),
      category_filter = $('select#category_filter').val(),
      name_search = $('input#search_products').val(),
      type_page = $('input#type_page').val();

  console.log(price_filter);
  console.log(category_filter);
  console.log(name_search);
  console.log(type_page);
  window.location.href = "/apps-page?type=" + type_page + "&filter=" + price_filter +
   "&category=" + category_filter + "&name=" + name_search;

});

$('select#category_filter').on("change",function(ev){
  let category_filter = $(this).val(),
      price_filter = $('select#price_filter').val(),
      name_search = $('input#search_products').val(),
      type_page = $('input#type_page').val();

  console.log(price_filter);
  console.log(category_filter);
  console.log(name_search);
  console.log(type_page);
  window.location.href = "/apps-page?type=" + type_page + "&filter=" + price_filter +
   "&category=" + category_filter + "&name=" + name_search;

});

$( ".search-form" ).submit(function( event ) {
  let category_filter = $('select#category_filter').val(),
      price_filter = $('select#price_filter').val(),
      name_search = $('input#search_products').val(),
      type_page = $('input#type_page').val();

  console.log(price_filter);
  console.log(category_filter);
  console.log(name_search);
  console.log(type_page);

  if (category_filter == 'ALL') {
    category_filter = undefined;
  }else if (category_filter == 'apps') {
    category_filter = undefined;
    type_page = 'apps';
  }else if (category_filter == 'themes') {
    category_filter = undefined;
    type_page = 'themes';
  }



  window.location.href = "/apps-page?type=" + type_page + "&filter=" + price_filter +
   "&category=" + category_filter + "&name=" + name_search;
  // alert( "Handler for .submit() called." );
  event.preventDefault();
});
