(function($) {
  var $div = $('#template');
  console.log('ok');
  console.log($div);

  $div.on( 'click', select );
	function select() {
    let $this = $(this),
			selectedCheckboxID = $this.prop('id')
      console.log(selectedCheckboxID);
  }

})(jQuery);
