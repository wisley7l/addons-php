(function($,event) {
  var $div_button = $('#template');
  let $div_item = $('div#addons-items');
  let page = window.location.hash;
  //let profile_page = page.indexOf("profile-page");
  var res = page.split("#template");
  console.log(parseInt(res[1]));
  let id = parseInt(res[1]);

  //$div_item.find('div#image-' + id).attr('style', '' );

  $div_button.on( 'click', select );

  function select(event) {
    let target = $(event.target);
    //console.log(target[0].id);
    id_template = target[0].id;


    let view = $div_item.find('div#image-' + id_template);
    let button =$div_button.find('a#' + id_template);
    //console.log('Template: ');
    //console.log(button);
    //$(div).find('div#image-' + id_template).attr('style', '' );

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
