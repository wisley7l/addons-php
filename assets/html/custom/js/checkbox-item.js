(function($) {
  var $checkbox = $('.linked-check');
  //wisley edit
  let id = $checkbox.prop('for');
  let price1 = parseInt($checkbox.find('input#'+id).val());
  let coin = $("p.price large").find("span#coin");
  console.log(coin);
  //changePrice("<span>{{dictionary.coin}}$</span>"+price1);
  //console.log(v);
  //

	$checkbox.on( 'click', deselectLinked );

	function deselectLinked() {
		var $this = $(this),
			selectedCheckboxID = $this.prop('for'),
			selectedCheckboxStatus = $("#"+selectedCheckboxID).prop('checked');
			showDescription(selectedCheckboxID);
      // wisley edit
      let price2 = parseInt($checkbox.find('input#'+selectedCheckboxID).val());
      //
			$checkbox.each(function() {
				var $this = $(this),
					checkboxID = $this.prop('for'),
					checkboxStatus = $("#"+checkboxID).prop('checked');

				if( checkboxID != selectedCheckboxID ) {
					deselect($("#"+checkboxID))
					hideDescription(checkboxID);
					//changePrice("<span>$</span>28.00");
				} else {
					changePrice("<span>{{dictionary.coin}}$</span>"+price2);
				}
			});
	}

	//*
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
  //*/
})(jQuery);
