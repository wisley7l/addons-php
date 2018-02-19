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
  console.log('resigter password');
  event.preventDefault();
});




})(jQuery);


function form_popup() {
  //enable form send email for create password
  $('#create-password').attr('class', 'form-popup')
}
