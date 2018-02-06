let num = 1;
$("form#upload_form").submit(function(event){
  let $form = $('form#upload_form'),
      category = $form.find('select#category').val();
      console.log(category);


event.preventDefault();
});

$("#add_category").click(function(event,num){
  num += 1;
  console.log(num);
  event.preventDefault();
})
