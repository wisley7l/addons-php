$("form#upload_form").submit(function(event){
  let $form = $('form#upload_form'),
      category = $form.find('select#category');
      console.log(category[0].value);


event.preventDefault();
});
