(function($) {
  var $div = $('#template');
  console.log('ok');
  //console.log($div);

  $div.on( 'click', select );

  function select(event) {
    let target = $(event.target);
    //console.log(target[0].id);
    id_template = target[0].id;
    let div = 'div#addons-items';
    let view = $(div).find('div#image-' + id_template);
    console.log('Template: ');
    console.log(view);
    $(div).find('div#image-' + id_template).attr('sytle', 'display:block;');
    // .attr('sytle', 'display:block;');

  }

})(jQuery);
