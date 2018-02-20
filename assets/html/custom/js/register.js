(function(event) {

$('#bt-create-pass').click(function() {
  form_popup();
});
//
$('form.addons-partner-create-pass').submit(function(event){
  let $form = $(this),
    email = $form.find('#email_register').val();
    console.log(email);
    $("#addons-email-user").val(email);
    $("#addons-create-pass").submit();
    event.preventDefault();

});

//
$('form#addons-form-password').submit(function(event){
  let $div = $("div#addons-form-pass"),
      pass = md5($div.find("input.addons-pass").val()),
      rp_pass = md5($div.find("input.addons-rp-pass").val()),
      empty = md5('undefined'),
      test = $div.find("input.addons-pass").val();
  if(pass != rp_pass || pass == empty){
    //If the confirmation password and password are different, activate "span"
    $div.find("span.pass-p").css( "color", "red");
    $div.find("span.rp-pass-p").css( "color", "red");
    alert('Error Password');
  }
  else {
    $div.find("span.pass-p").css( "color", "black");
    $div.find("span.rp-pass-p").css( "color", "black");
    // TODO: send password save bd
    $('#addons-register-pass').val('test');
    $('form#addons-register').submit();
  }
  event.preventDefault();
});

})(jQuery);


function form_popup() {
  //enable form send email for create password
  $('#create-password').attr('class', 'form-popup')
}
