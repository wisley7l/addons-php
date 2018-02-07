var num = 1;
$("form#upload_form").submit(function(event){
  let $form = $('form#upload_form'),
      categories = $form.find('select#category').val(), // not null
      name_app = $form.find('input#item_name').val(), // not null
      num_version = $form.find('input#item_numversion').val(),
      description = $form.find('textarea#item_description').val(),// not null
      script_url = $form.find('input#item_scripturl').val(),
      github = $form.find('input#item_github').val(),
      website = $form.find('input#item_website').val(),
      video = $form.find('input#item_linkvideo').val();
      is_app = $form.find('input#item_is_app').val();

  console.log(is_app);
  console.log(categories);
  console.log(name_app);
  console.log(num_version);
  console.log(description);
  console.log(script_url);
  console.log(github);
  console.log(website);
  console.log(video);

  $("#uploaditem-name_app").val(name_app);
  $("#uploaditem-is_app").val(is_app);
  $("#uploaditem-category").val(categories);
  $("#uploaditem-item_numversion").val(num_version);
  $("#uploaditem-item_description").val(description);
  $("#uploaditem-item_scripturl").val(script_url);
  $("#uploaditem-item_github").val(github);
  $("#uploaditem-item_website").val(website);
  $("#uploaditem-item_linkvideo").val(video);
  //$("#addons-uploaditem").submit();

  event.preventDefault();
});

$("#add_category").click(function(event){
  num += 1;
  //console.log(num);
  event.preventDefault();
});


(function($) {
	var $checkbox = $('.label-check');
  console.log($checkbox);
	$checkbox.on( 'click', deselectLinked );

	function deselectLinked() {
      var $this = $(this),
			selectedCheckboxID = $this.prop('for'),
			selectedCheckboxStatus = $("#"+selectedCheckboxID).prop('checked');
      //$('input#inv-'+selectedCheckboxID).attr('value','true');
    	//showDescription(selectedCheckboxID);
      enable(selectedCheckboxID);

			$checkbox.each(function() {
				var $this = $(this),
					checkboxID = $this.prop('for'),
					checkboxStatus = $("#"+checkboxID).prop('checked');

				if( checkboxID != selectedCheckboxID ) {
					deselect($("#"+checkboxID))
          //desable(checkboxID);
					//hideDescription(checkboxID);
					//changePrice("<span>$</span>28.00");
				} else {
					//changePrice("<span>$</span>56.00");
				}
			});
	}


	function deselect(checkbox) {
		checkbox.prop('checked', false);
	}
  function enable(id) {
    //console.log(id);
    console.log($('input#item_is_app').val());
    console.log('***');
    if (id == 'item_is_app') {
      console.log('app');
      $('input#item_is_app').val('app');
    }else if (id == 'item_is_theme') {
      console.log('theme');
      $('input#item_is_app').val('theme');
    }
	}

/*
	function showDescription(container) {
		$(".license-text[data-license='"+container+"']").slideDown();
	}

	function hideDescription(container) {
		$(".license-text[data-license='"+container+"']").slideUp();
	}

	function changePrice(price) {
		$('.sidebar-item .price.large').html(price);
	}
  */
})(jQuery);
