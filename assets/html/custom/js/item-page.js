(function($,event) {
  var $div_button = $('#template');
  let $div_item = $('div#addons-items');
  let page = window.location.hash;
  var res = page.split("#template");
  let id = parseInt(res[1]);
  let button =$div_button.find('a#' + id);
  showImage(button);

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
