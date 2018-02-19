(function(event) {

$('#bt-create-pass').click(function() {
  form_popup();
});
//
$('form.addons-partner-create-pass').submit(function(){
  let $form = $(this),
    email = $form.find('#email_address2').val();
    console.log(email);

});

})(jQuery);


function form_popup() {
  //enable form send email for create password
  $('#create-password').attr('class', 'form-popup')
}
