(function($) {
  var $checkbox = $('.linked-check');
  // edit
  let id = $checkbox.prop('for');
  let price1 = parseFloat($checkbox.find('input#i-'+id).val());
  let coin = $("p#coin").find('span#coin')[0].innerText;
  changePrice("<span>"+coin+"</span>"+price1);


	$checkbox.on( 'click', deselectLinked );

	function deselectLinked() {
		var $this = $(this),
			selectedCheckboxID = $this.prop('for'),
			selectedCheckboxStatus = $("#"+selectedCheckboxID).prop('checked');
			showDescription(selectedCheckboxID);
      let price2 = parseFloat($checkbox.find('input#'+selectedCheckboxID).val());

			$checkbox.each(function() {
				var $this = $(this),
					checkboxID = $this.prop('for'),
					checkboxStatus = $("#"+checkboxID).prop('checked');

				if( checkboxID != selectedCheckboxID ) {
					deselect($("#"+checkboxID))
					hideDescription(checkboxID);
					//changePrice("<span>$</span>28.00");
				} else {
					changePrice("<span>"+coin+"</span>"+price2);
				}
			});
	}

  function deselect(checkbox) {
		checkbox.prop('checked', false);
	}

	function showDescription(container) {
		$(".license-text[data-license='"+container+"']").slideDown();
	}

	function hideDescription(container) {
		$(".license-text[data-license='"+container+"']").slideUp();
	}

	function changePrice(price) {
		$('.sidebar-item .price.large').html(price);
	}
})(jQuery);

// buy item click buy
$("#buy-item").click(function(event){
  let div = 'div#item-page',
      input = $(div).find('input.checkbox-plan');
  for (var i = 0; i < input.length; i++) {
    if (input[i].checked == true) {
      //console.log(input[i]);
      id_license = input[i].id;
      console.log(input[i]);
    }
  }
  let value = $(div).find('input#id_license').val();
  console.log(value);
  /*  capture item id
      License ID
      value
      shopkeeper id
      if it's app or theme
  */

});
/*
// treat click buy now
$('#buy-item').click(function(){
  let div_id = 'div#addons-buy',
      $div_item = $('div#addons-items'),
      id_app = $(div_id).find('input#id-item').val(),
      is_app = $(div_id).find('input#item-is-app').val(),
      var $checkbox = $('.linked-check');
      let id = $checkbox.prop('for');
      let price1 = parseFloat($checkbox.find('input#'+id).val());
      console.log(price1);

  // capture type licence
  // if is_app = 1 app
  // else theme
  if (is_app == 1) { // treat app purchase
    //

  }
  else { // treat theme purchase
    //If there is more than one template, capture template id.
    $div_item.each(function(){
      let views = $(this).find('div');
      for (var i = 0; i < views.length; i++) {
        if (views[i].style.display == 'block' && views[i].id.indexOf("image-") != -1) {
          console.log(views[i]);
        }
      }

    })

  }

});
*/
