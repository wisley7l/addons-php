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
      legth_pass = $div.find("input.addons-pass").val().length;
      rp_pass = md5($div.find("input.addons-rp-pass").val()),
      test = $div.find("input.addons-pass").val();
  if(pass != rp_pass || pass == md5('undefined') || pass == md5('') || (legth_pass < 6)){
    //If the confirmation password and password are different, activate "span"
    $div.find("span.pass-p").css( "color", "red");
    $div.find("span.rp-pass-p").css( "color", "red");
    alert('Error Password');
  }
  else {
    $div.find("span.pass-p").css( "color", "black");
    $div.find("span.rp-pass-p").css( "color", "black");
    // TODO: send password save bd
    $('#addons-register-pass').val(pass);
    information = "\n id: " + $('addons-register-id').val() +
            "e-mail: " + $('addons-register-user').val() + "\n Confirm ? ";
    decisao = confirm("YOUR information " + information );
    /*
    addons-register-id
    addons-register-user
    */

    if (decisao){
    alert ("Você clicou no botão OK,\n"+
    "porque foi retornado o valor: "+decisao);
    $('form#addons-register').submit();
    } else {
    alert ("Você clicou no botão CANCELAR,\n"+
    "porque foi retornado o valor: "+decisao);
    }



  }
  event.preventDefault();
});

})(jQuery);


function form_popup() {
  //enable form send email for create password
  $('#create-password').attr('class', 'form-popup');
}
