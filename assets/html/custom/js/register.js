(function(event) {
$('#bt-create-pass').click(function() {
  create();
  alert( "Handler for .click() called." );
});

})(jQuery);

function create() {
  //create-password
  $('#create-password').attr('class', 'form-popup mfp-hide')
}
