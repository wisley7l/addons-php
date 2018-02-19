(function(event) {

$('#bt-create-pass').click(function() {
  form_popup();
});

$('form.addons-partner-create-pass').submit(function(){
  console.log('click');
});

})(jQuery);


function form_popup() {
  //enable form send email for create password
  $('#create-password').attr('class', 'form-popup')
}
