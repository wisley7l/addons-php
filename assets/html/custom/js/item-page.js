(function($) {
  var $div = $('#template');
  let target1 = $(event.target);
  console.log(target1);

  $div.on( 'click', select );

  function select(event) {
    let target = $(event.target);
    //console.log(target[0].id);
    id_template = target[0].id;
    let div = 'div#addons-items';
    //let view = $(div).find('div#image-' + id_template);
    //console.log('Template: ');
    //console.log(view);
    $(div).find('div#image-' + id_template).attr('style', '' );

    // $checkbox.each(function() {
    //   var $this = $(this),
    //     checkboxID = $this.prop('for'),
    //     checkboxStatus = $("#"+checkboxID).prop('checked');
    //   }
  }

})(jQuery);
