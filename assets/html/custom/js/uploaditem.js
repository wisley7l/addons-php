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

  console.log(categories);
  console.log(name_app);
  console.log(num_version);
  console.log(description);
  console.log(script_url);
  console.log(github);
  console.log(website);
  console.log(video);
  event.preventDefault();
});

$("#add_category").click(function(event){
  num += 1;
  //console.log(num);
  event.preventDefault();
})
