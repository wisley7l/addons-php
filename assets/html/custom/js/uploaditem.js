var num = 1;
$("form#upload_form").submit(function(event){
  let $form = $('form#upload_form'),
      name_app = $form.find('input#item_name').val(), // not null
      num_version = $form.find('input#item_numversion').val(),
      description = $form.find('textarea#item_description').val(),// not null
      script_url = $form.find('input#item_scripturl').val(),
      github = $form.find('input#item_github').val(),
      website = $form.find('input#item_website').val(),
      video = $form.find('input#item_linkvideo').val(),
      is_app = $form.find('input#inp-item_is_app').val(),
      categories = $form.find('select#category-'+is_app).val(), // not null
      linkdoc = $form.find('input#item_linkdoc').val();


  if (name_app == '' || num_version == '' || description == '' || categories == undefined ) {
    alert('Error');
    $form.find("#cat-required").css( "color", "red");
    $form.find("#name-required").css( "color", "red");
    $form.find("#version-required").css( "color", "red");
    $form.find("#desc-required").css( "color", "red");

  }else {
    //$form.find("#inp-requerid").css( "color", "black");
    if (is_app == 1 ) { // app
      $("#uploaditem-is_app").val(is_app);
      $("#uploaditem-name_app").val(name_app);
      $("#uploaditem-category").val(categories);
      $("#uploaditem-item_numversion").val(num_version);
      $("#uploaditem-item_description").val(description);
      $("#uploaditem-item_scripturl").val(script_url);
      $("#uploaditem-item_github").val(github);
      $("#uploaditem-item_website").val(website);
      $("#uploaditem-item_linkvideo").val(video);
      $("#addons-uploaditem").submit();
    } else if (is_app == 0 ) { // theme
      $("#uploaditem-is_app").val(is_app);
      $("#uploaditem-name_app").val(name_app);
      $("#uploaditem-category").val(categories);
      $("#uploaditem-item_numversion").val(num_version);
      $("#uploaditem-item_description").val(description);
      $("#uploaditem-item_linkdoc").val(linkdoc);
      $("#uploaditem-item_linkvideo").val(video);
      $("#addons-uploaditem").submit();
    }
  }
  event.preventDefault();
});

$("#add_category").click(function(event){
  num += 1;
  //console.log(num);
  event.preventDefault();
});


(function($) {

  let $form = $("form#upload_form"),
      select = $('select#type-app');
	var $checkbox = $('.label-check');

  showDiv(select.val());
  select.on('click',selectType);

  function selectType() {
    console.log("Teste");
    let $this = $(this);
    //console.log($this.val());
  }

  function showDiv(id) {
    // module-type
    let div = $('div#module-type');

    if (id == 3) {
            console.log(3);
    }else {
      console.log('not');
    }

  }



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
    if (id == 'item_is_app') {
      $('input#inp-item_is_app').val(1);
      $('div#enable-app').attr('style','display:block;');
      $('div#enable-theme').attr('style','display:none;');
    }else if (id == 'item_is_theme') {
      $('div#enable-app').attr('style','display:none;');
      $('div#enable-theme').attr('style','display:block;');
      $('input#inp-item_is_app').val(0);
    }else {
      $('div#enable-app').attr('style','display:none;');
      $('div#enable-theme').attr('style','display:none;');
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
