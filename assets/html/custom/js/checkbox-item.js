(function($) {
  var $checkbox = $('.linked-check');
  // edit
  let id = $checkbox.prop('for');
  let price1 = parseFloat($checkbox.find('input#'+id).val());
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

$("div.item-page").submit(function(event){
  console.log("item");

})
