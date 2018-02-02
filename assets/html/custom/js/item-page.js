(function($) {
  var $div = $('#template');
  console.log('ok');
  console.log($div);

  $div.on( 'click', select );

  function select(event) {
    let target = $(event.target);
    console.log(target);
    // 
    // var $this = $(this),
		// 	selectedCheckboxID = $this.prop('for');
    //   console.log($this);
    //   console.log(selectedCheckboxID);
  }

})(jQuery);
