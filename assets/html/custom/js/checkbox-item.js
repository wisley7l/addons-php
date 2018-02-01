(function($) {
  var $checkbox = $('.linked-check');

  let id = $checkbox.prop('for');
  let v = $checkbox.find('input#'+id);
  console.log(v);

	$checkbox.on( 'click', deselectLinked );

	function deselectLinked() {
		var $this = $(this),
			selectedCheckboxID = $this.prop('for'),
			selectedCheckboxStatus = $("#"+selectedCheckboxID).prop('checked');
			showDescription(selectedCheckboxID);

			$checkbox.each(function() {
				var $this = $(this),
					checkboxID = $this.prop('for'),
					checkboxStatus = $("#"+checkboxID).prop('checked');

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
