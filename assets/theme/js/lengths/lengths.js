function onready_length() {
  onclick_get_length_values();
  //onclick_show_cart();
}
function onclick_get_length_values(){
  var json_data = [];
  $('.length_add_to_cart').click(function() {
    $(this).parents('tr').find('td').css("background-color", "rgb(255, 255, 255)");
    $(this).css("background-color", "rgb(255, 255, 0)");
    var design_code = $(this).parents('tr').find("td:eq(0)").text();
    var range = $(this).parents('tr').find("td:eq(1)").text();
    var weight_length = $(this).parents('tr').find("td:eq(4)").text();
    var weight = $(this).parents('tr').find("td:eq(2)").text();
    var length = $(this).parents('tr').find("td:eq(3)").text();
    var selected_value = $(this).text();
    var insert = "TRUE";
    if(json_data.length != 0) {
      for(var i=0; i<json_data.length; i++){
        if((json_data[i].design_code == design_code) && (json_data[i].weight_length == weight_length)){
          insert = "FALSE";
          json_data.splice([i], 1);
        }else {
          insert = "TRUE";
        }
      }
    }
    if(insert) {
      json_data.push({design_code:design_code, range:range, weight:weight, length:length, selected_value:selected_value});
    }
    var myString = JSON.stringify(json_data);
    $(".append_json_data").val(myString);
    console.log(myString);
  });
  
}

function get_json() {
  var data = $(".append_json_data").val();
  var obj = jQuery.parseJSON(data);
  var html="";
  if(obj == '') {
    html = "<tr><td colspan=4>No Data</td></tr>";
  } else {
    $.each(obj, function(key,value) {
      html+= "<tr><td><input type='text' readonly name='length_cart_details["+key+"][design_code]' value='"+value.design_code+"' /></td>\n\
                <td><input type='text' readonly name='length_cart_details["+key+"][range]' value='"+value.range+"' /></td>\n\
                <td><input type='text' readonly name='length_cart_details["+key+"][weight]' value='"+value.weight+"' /></td>\n\
                <input type='hidden' readonly name='length_cart_details["+key+"][length]' value='"+value.length+"' />\n\
                <td><input type='text' readonly name='length_cart_details["+key+"][selected_value]' value='"+value.selected_value+"' /></td>\n\
                <td><input type='number' required name='length_cart_details["+key+"][quantity]' value='' /></tr>"
    });
  }
  $('.set_json_data').html(html);
}