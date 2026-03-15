


function btnAddRow(){
      var lastRow = $('#tblAddRow tbody tr:first-child').html();
      var lenRow = $('#tblAddRow tbody tr').length;
      // alert(lenRow);
      if(lenRow >= 1)
      {
      $('#tblAddRow tbody').append('<tr>' + lastRow + '</tr>');
      $('#tblAddRow tbody tr:last input');   
      }
  }

  function btnDelLastRow() {
    var lenRow = $('#tblAddRow tbody tr').length;
    // alert(lenRow);
    if (lenRow == 1) {
        alert("Can't Delete row!");
    } else {
        $('#tblAddRow tbody tr:last').remove();
    }
  }

function check_nearest_checkbox(btnObj) {
    $(btnObj).closest('tr').children('td:nth-child(1)').find('input').click();
}

function cal_alloy_wt(actual_wt,actual_alloy_wt,entered_wt) {
    return  (actual_alloy_wt*entered_wt)/actual_wt;
}


function melting_lot_split_weight(btnObj) {
  var error_set =$(btnObj).closest('tr').find('p.text-danger');
  var actual_wt = parseFloat($(btnObj).closest('tr').children('td:nth-child(5)').text());
  var actual_alloy_wt = parseFloat($(btnObj).closest('tr').children('td:nth-child(6)').text());
  var entered_wt = parseFloat($(btnObj).val());
  
    error_set.html('');
   if (isNaN(entered_wt)) {
        error_set.html('InValid Input');
        $('#btn_save_wastages').attr('disabled','true');
   }else if (entered_wt > actual_wt) {
        error_set.html('Weight Exceed..')
        $('#btn_save_wastages').attr('disabled','true');
   }else{
    $('#btn_save_wastages').removeAttr('disabled');
       var alloy_wt =cal_alloy_wt(actual_wt,actual_alloy_wt,entered_wt);
           if (!isNaN(alloy_wt)) {
            if (!$(btnObj).closest('tr').children('td:nth-child(1)').find('input').is(":checked")) {
                $(btnObj).closest('tr').children('td:nth-child(1)').find('input').attr("checked", true);
            }
            $(btnObj).closest('tr').children('td:nth-child(8)').text(alloy_wt.toFixed(3));
            // get_alloy_weight(1);
           }
   }

}


$('.get_alloy_weight').change(function() {
      id=$(this).attr("id");
        if ($(this).closest('tr').children('td:nth-child(1)').find('input').is(":checked")) {
            $(this).closest('tr').children('td:nth-child(7)').find('input');
            var actual_wt =$(this).closest('tr').children('td:nth-child(5)').text();
            var actual_alloy_wt =$(this).closest('tr').children('td:nth-child(6)').text();
        }
        $(this).closest('tr').children('td:nth-child(7)').find('input').val(actual_wt);
        $(this).closest('tr').children('td:nth-child(8)').text(actual_alloy_wt);
        
    });

$(".melting_lot_weight").keyup(function () {
  id=$(this).attr("id");
  $('.checked_'+id).prop("checked", this.value != "");
});




