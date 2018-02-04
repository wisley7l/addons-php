(function($,event) {
  var $div_button = $('#template');
  let $div_item = $('div#addons-items');
  let page = window.location.hash;

  if (page != '') {
    var res = page.split("#template");
    let id = parseInt(res[1]);
    let button =$div_button.find('a#' + id);
    showImage(button);
  }

  $div_button.on( 'click', select );

  function select(event) {
    let target = $(event.target);
    id_template = target[0].id;
    let button =$div_button.find('a#' + id_template);
    showImage(button);
  }

  function showImage(button){
    $div_button.each(function() {
      var $this = $(this),
        buttonID = $this.find('a');
      //  console.log(buttonID);
      for (var i = 0; i < buttonID.length; i++) {
        if (buttonID[i]== button[0]) {
          $div_item.find('div#image-' + buttonID[i].id).attr('style', '' );
        }else {
          $div_item.find('div#image-' + buttonID[i].id).attr('style', 'display:none;' );
        }
      }
    });
  }
})(jQuery);

// treat click buy now
$('#buy-item').click(function(){
  console.log('test');
  let div_id = 'div#addons-buy';
  let id_app = $(div_id).find('input#id-item').val();
  let is_app = $(div_id).find('input#item-is-app').val();
  console.log(is_app);
  console.log(id_app);
  // if app
  // else theme
});
