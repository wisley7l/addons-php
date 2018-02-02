(function($,event) {
  var $div = $('#template');

  $div.on( 'click', select );

  function select(event) {
    let target = $(event.target);
    //console.log(target[0].id);
    id_template = target[0].id;
    let div = 'div#addons-items';

    let view = $(div).find('div#image-' + id_template);
    let button =$(div).find('a#' + id_template);
    //console.log('Template: ');
    console.log(button);
    $(div).find('div#image-' + id_template).attr('style', '' );

    $div.each(function() {
      var $this = $(this),
        checkboxID = $this.find('a');
        console.log(checkboxID);
      });
  }

})(jQuery);
