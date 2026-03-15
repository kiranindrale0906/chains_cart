function get_departments(product_name) {
  var product=$(product_name).val();
  var base_url=$("#base_url").val()+'settings/karigar_rates/index';
  var formdata=new FormData();
  formdata.append('product_name_post',product);
  ajax_post_request(base_url,formdata);
}

function populate_department_option(reponse) {
  $("select[name*='department_name'] option").remove();
  // var option_html="<option value="">Select all</option>";
  $("select[name*='department_name']").append(option_html);
  for (i=0; i < reponse.departments.length; i++) {
      id = reponse.departments[i].id;
      name = reponse.departments[i].name;
      option_html = "<option data-subtext='' value='"+id+"'>"+name+"</option>";
      $("select[name*='department_name']").append(option_html);
  }
  if(reponse.departments.length=="0") {
    $("select[name*='department_name'] option").remove();
    var option_html = "<option > No Records Found</option>";
    $("select[name*='department_name']").append(option_html);
  }

  $("select[name*='department_name']").selectpicker('refresh');

  // populate_karigar_option(reponse);
}


function populate_karigar_option(reponse) {
  $("select[name*='karigar_name'] option").remove();
  // var option_html="<option value="">Select all</option>";
  $("select[name*='karigar_name']").append(option_html);
  for (i=0; i < reponse.karigars.length; i++) {
      id = reponse.karigars[i].id;
      name = reponse.karigars[i].name;
      option_html = "<option data-subtext='' value='"+id+"'>"+name+"</option>";
      $("select[name*='karigar_name']").append(option_html);
  }
  if(reponse.karigars.length=="0") {
    $("select[name*='karigar_name'] option").remove();
    var option_html = "<option > No Records Found</option>";
    $("select[name*='karigar_name']").append(option_html);
  }

  $("select[name*='karigar_name']").selectpicker('refresh');
}