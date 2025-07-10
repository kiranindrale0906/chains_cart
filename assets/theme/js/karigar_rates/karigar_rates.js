$(document).ready(function() {
  $(".k_rates_design_code").hide();
  $(".k_rates_puirty").hide();
  $(".k_rates_category").hide();
  $(".k_rates_wire_size").hide();
  $(".k_rates_code").hide();

   show_hide_design_code_purity();
});


$(function(){
  $("#product").on('change', function() {
    var product = $(this).val();
    var processes = get_object_keys(dropdown_data[product]);
    set_options_by_obj(processes, '#process');
    get_design_code_dropdown(product);
  });

  $("#process").on('change', function() {
    var product = $('#product').val();
    var process = $(this).val();
    //console.log(dropdown_data);
    // var departments = get_object_keys(dropdown_data[product][process]);
  
    // set_options_by_obj(departments, '#department');
    var base_url=$("#base_url").val()+'settings/same_karigars/index';
    var formdata=new FormData();
    formdata.append('product',product);
    formdata.append('process',process);
    formdata.append('dropdown_department','1');

    ajax_post_request(base_url,formdata);   
  });

  $("#department").on('change', function() {
    //console.log(dropdown_data);
    var product = $('#product').val();
    var process = $('#process').val();
    var department = $(this).val();

    var base_url=$("#base_url").val()+'settings/same_karigars/index';
    var formdata=new FormData();
    formdata.append('product',product);
    formdata.append('process',process);
    formdata.append('department',department);
    ajax_post_request(base_url,formdata); 
    var karigars = dropdown_data[product][process][department];
    set_options_by_obj(karigars, '#karigar');
  });

  $(".k_rate_karigar_name").on('change', function() {
    show_hide_design_code_purity();
  });

  $(".k_rates_category").on('change', function() {
    set_category_wire_size_karigar_rate_options();
  });

  $(".k_rates_wire_size").on('change', function() {
    set_category_design_code_karigar_rate_options();
  });
  
});

function show_hide_design_code_purity() {
  var karigar_name = $("#karigar").val();
  var department = $("#department").val();
  var product_name = $("#product").val();
  if(karigar_name=="Suman" || karigar_name=="Prashanto") {
    $(".k_rates_design_code").show();
    $(".k_rates_puirty").show();  
  }
  else if(karigar_name=="Hollow Bappy" && department=="Chain Making"){
    $(".k_rates_design_code").show();
  }
  else if(karigar_name=="Ashish" && department=="Joining Department" && product_name=="Machine Chain") {
    $(".k_rates_category").show();
    $(".k_rates_wire_size").show();
    $(".k_rates_design_code").show(); 
    //set_category_karigar_rate_options();
  }
  else if(karigar_name=="Ashish" && department=="Hook" && product_name=="Rope Chain") {
    $(".k_rates_code").show();
    
  }
}

function populate_karigar_option(reponse) {
  $("#karigars option").remove();
  
  $("#karigars").append(option_html);
  for (i=0; i < reponse.karigars.length; i++) {
      id = reponse.karigars[i].id;
      name = reponse.karigars[i].name;
      option_html = "<option data-subtext='' value='"+id+"'>"+name+"</option>";
      $("#karigars").append(option_html);
  }
  if(reponse.karigars.length=="0") {
    $("#karigars option").remove();
    var option_html = "<option > No Records Found</option>";
    $("#karigars").append(option_html);
  }

  $("#karigars").selectpicker('refresh');
}

function populate_department_option(reponse) {
  $("#department option").remove();
  
  $("#department").append(option_html);
  for (i=0; i < reponse.departments.length; i++) {
      id = reponse.departments[i].id;
      name = reponse.departments[i].name;
      option_html = "<option data-subtext='' value='"+id+"'>"+name+"</option>";
      $("#department").append(option_html);
  }
  if(reponse.departments.length=="0") {
    $("#department option").remove();
    var option_html = "<option > No Records Found</option>";
    $("#department").append(option_html);
  }

  $("#department").selectpicker('refresh');
}



function set_options_by_obj(options, field) {
  var _field = $(field);
  _field.html('');
  if(options != undefined){
    var option_html = '';
    $.each(options, function(index, option) {
      option_html += '<option value="'+option+'">'+option+'</option>';
    });
    _field.append(option_html);
    _field.selectpicker('refresh');
  }
}

function get_object_keys(obj) {
  var options = Object.keys(obj);
  $.each(options, function(index, option) {
    if($.isNumeric(option)) {
      options[index] = obj[option];
    }
  });
  return options;
}

function get_design_code_dropdown(product) {
  var base_url=$("#base_url").val()+'settings/karigar_rates/index';
  var formdata=new FormData();
  formdata.append('product_name_design_code',product);
  ajax_post_request(base_url,formdata);
}

function populate_design_code_option(reponse) {
  $("select[name*='design_code'] option").remove();
  var option_html="<option> </option>";
  $("select[name*='design_code']").append(option_html);
  for (i=0; i < reponse.design_codes.length; i++) {
      id = reponse.design_codes[i].id;
      name = reponse.design_codes[i].name;
      option_html = "<option data-subtext='' value='"+id+"'>"+name+"</option>";
      $("select[name*='design_code']").append(option_html);
  }
  if(reponse.design_codes.length=="0") {
    $("select[name*='design_code'] option").remove();
    var option_html = "<option > No Records Found</option>";
    $("select[name*='design_code']").append(option_html);
  }

  $("select[name*='design_code']").selectpicker('refresh');

  populate_purity_options(reponse.purities);
}

function populate_purity_options(purities) {
  var product=$("#product").val();

  $("select[name*='purity'] option").remove();
  var option_html="<option> </option>";
  $("select[name*='purity']").append(option_html);

  var purity=[];
  
  if(product=="Choco Chain") {
    purity=purities['Other Chain'];
  }

  for (i=0; i < purity.length; i++) {
      id = purity[i].id;
      name = purity[i].name;
      option_html = "<option data-subtext='' value='"+id+"'>"+name+"</option>";
      $("select[name*='purity']").append(option_html);
  }
  if(purity.length=="0") {
    $("select[name*='purity'] option").remove();
    var option_html = "<option > No Records Found</option>";
    $("select[name*='purity']").append(option_html);
  }

  $("select[name*='purity']").selectpicker('refresh');  
}

function set_category_karigar_rate_options() {
  $('#category').empty();
  var product_name = $('select[name*="karigar_rates[product_name]"] option:selected').val();
  var category_values = category_one[product_name];
  // console.log(category_values);
  // console.log(product_name);
  if (typeof category_values  != 'undefined' ) {
    for (var i = 0; i < category_values.length; i++) {
      $('#category').append("<option value="+category_values[i].id+">"+category_values[i].name+"</option>");
    }
    $("select[name*='karigar_rates[category]']").selectpicker('refresh');
  }
  if (product_name == 'Machine Chain' || product_name == 'Rope Chain'
      || product_name == 'Round Box Chain' || product_name == 'Choco Chain' || product_name == 'KA Chain' ) {
    set_category_wire_size_karigar_rate_options();
  }
}

function set_category_wire_size_karigar_rate_options() {
  $('#wire_size').empty();
  var product_name = $('select[name*="karigar_rates[product_name]"] option:selected').val();
  var category = $('select[name*="karigar_rates[category]"] option:selected').val();
  var category_two_values = category_two[product_name][category];
  if (typeof category_two_values != 'undefined' ) {
    for (var i = 0; i < category_two_values.length; i++) {
      $('#wire_size').append("<option value="+category_two_values[i].id+">"+category_two_values[i].name+"</option>");
    }
    $("select[name*='karigar_rates[wire_size]']").selectpicker('refresh');
  }
  if (product_name == 'Machine Chain' || product_name == 'Rope Chain'
      || product_name == 'Round Box Chain' || product_name == 'KA Chain' && category == 'Box_Chain') {
    set_category_design_code_karigar_rate_options();
  }
}


function set_category_design_code_karigar_rate_options() {
  $('#design_code').empty();
  var product_name = $('select[name*="karigar_rates[product_name]"] option:selected').val();
  var category = $('select[name*="karigar_rates[category]"] option:selected').val();
  var wire_size = $('select[name*="karigar_rates[wire_size]"] option:selected').val();
  var category_designs_values = category_three[product_name][category][wire_size];
  if (typeof category_designs_values != 'undefined' ) {
    for (var i = 0; i < category_designs_values.length; i++) {
      $('#design_code').append("<option value="+category_designs_values[i].id+">"+category_designs_values[i].name+"</option>");
    }
    $("select[name*='karigar_rates[design_code]']").selectpicker('refresh');
  }
}