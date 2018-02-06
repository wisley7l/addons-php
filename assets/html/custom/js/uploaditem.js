let num_category = 1;
$("#send_review_item").click(function(event){
  let $form = $('form#upload_form'),
      category = $form.find('select#category').val();
      console.log(category);


event.preventDefault();
});

$("#add_category").click(function(event){
  num_category +=;
  console.log(num_category);



  event.preventDefault();
})
