$("#send_review_item").click(function(event){
  let $form = $('form#upload_form'),
      category = $form.find('select#category').val();
      console.log(category);


event.preventDefault();
});

$("#add_category").click(function(event){
  console.log('click');
})
