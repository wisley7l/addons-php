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
      type_app = $form.find('select#type-app').val(),
      module_app = $form.find('select#module-type').val();
      authentication = is_app = $form.find('input#authentication').val(),


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
      $("#uploaditem-item_type_app").val(type_app);
      $("#uploaditem-item_module_app").val(module_app);
      $("#uploaditem-item_authetication").val(authentication);
      //
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

  let select = $('select#type-app');
	var $checkbox = $('.label-check'),
      $checkboxauth = $('.label-check-auth');

  enableSelect(select.val());

  select.on('click',selectType);

	$checkbox.on( 'click', deselectLinked );
  $checkboxauth.on( 'click', checkAuth);

  function checkAuth() {
    var $this = $(this),
    selectedCheckboxID = $this.prop('for'),
    selectedCheckboxStatus = $("#"+selectedCheckboxID).prop('checked');
    // function send yes or no
    $checkboxauth.each(function() {
      var $this = $(this),
        checkboxID = $this.prop('for'),
        checkboxStatus = $("#"+checkboxID).prop('checked');
      if( checkboxID != selectedCheckboxID ) {
        deselect($("#"+checkboxID))
      } else {

      }
    });

  }
function authentication(id){
  if (id == 'yes-id') {
    $('input#authentication').val(1);
  }
  else {
    $('input#authentication').val(0);
  }
}


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

  // function selected type app
  function selectType() {
    let $this = $(this);
    enableSelect($this.val());
  }
  // function enable select module type
  function enableSelect(id) {

    let div = $('select#module-type');

    if (id == 3) {
      div.prop('disabled', false);
      div.attr('style','display:block;');

    }else {
      div.prop('disabled', true);
      div.attr('style','display:none;');
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
