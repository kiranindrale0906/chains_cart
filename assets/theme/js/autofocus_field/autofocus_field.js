function autofocus_fields() {	
  var first_element = $("#ajax-modal").find('form').find('input').not("input[type=hidden]").not("input[readonly]")[0];
  var get_input_name = $(first_element).attr('name');
	if (!$("input[name*='"+get_input_name+"]'").hasClass("datepicker_js") && typeof(get_input_name) != 'undefined') {
    first_element.focus();
  }
}

function autofocus_table_field(){
  $(".scanButtonDown").focus();
 /* var first_table_element = $('form:first-child .tcell').find(':input').not("input[type=hidden]").not("input[readonly]")[0];
  var get_input_name = $(first_table_element).attr('name');

  if (!$("input[name*='"+get_input_name+"]'").hasClass("datepicker_js") && typeof(get_input_name) != 'undefined') {
    first_table_element.focus();
  }*/

}