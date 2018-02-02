(function($) {
  var $div = $('#template');
  console.log('ok');
  console.log($div);
  
  $div.on( 'click', select );
	function select() {
      console.log('click');
  }

})(jQuery);
