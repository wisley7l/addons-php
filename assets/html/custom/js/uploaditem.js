$("form#upload_form").submit(function(event){
  let $form = $('form#upload_form'),
      category = $form.find('select#category').val();
      console.log(category);


event.preventDefault();
});
