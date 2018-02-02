(function($,event) {
  var $div = $('#template');

  $div.on( 'click', select );

  function select(event) {
    let target = $(event.target);
    //console.log(target[0].id);
    id_template = target[0].id;
    let div = 'div#addons-items';

    let view = $(div).find('div#image-' + id_template);
    let button =$div.find('a#' + id_template);
    //console.log('Template: ');
    //console.log(button);
    //$(div).find('div#image-' + id_template).attr('style', '' );

    $div.each(function() {
      var $this = $(this),
        buttonID = $this.find('a');
      //  console.log(buttonID);
      for (var i = 0; i < buttonID.length; i++) {
        if (buttonID[i]== button[0]) {
          $(div).find('div#image-' + buttonID[i].id).attr('style', '' );
        }else {
          $(div).find('div#image-' + buttonID[i].id).attr('style', 'display:none;' );
        }

      }

      });
  }

})(jQuery);
