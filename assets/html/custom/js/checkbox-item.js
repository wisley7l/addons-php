(function($) {
  var $checkbox = $('.linked-check');

	$checkbox.on( 'click', deselectLinked );

	function deselectLinked() {
		var $this = $(this),
			selectedCheckboxID = $this.prop('for'),
			selectedCheckboxStatus = $("#"+selectedCheckboxID).prop('checked');
			showDescription(selectedCheckboxID);
    let v = $checkbox.find('span#'+selectedCheckboxID).innerText;
    console.log("Price: ");
    console.log(v);

			$checkbox.each(function() {
				var $this = $(this),
					checkboxID = $this.prop('for'),
					checkboxStatus = $("#"+checkboxID).prop('checked');
          console.log("checkboxID: ");
          console.log(checkboxID);
          console.log("\n selecionado: ");
          console.log(selectedCheckboxID);

				if( checkboxID != selectedCheckboxID ) {
					deselect($("#"+checkboxID))
					hideDescription(checkboxID);
					//changePrice("<span>$</span>28.00");
				} else {
					//changePrice("<span>$</span>66.00");
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
