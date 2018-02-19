(function(event) {

$('#bt-create-pass').click(function() {
  form_popup();
});


})(jQuery);


function form_popup() {
  //enable form send email for create password
  $('#create-password').attr('class', 'form-popup')
}
