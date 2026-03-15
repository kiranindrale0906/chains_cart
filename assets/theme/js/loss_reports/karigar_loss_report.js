$('.karigar_loss_search_date').click(function(){
  get_karigar_names_loss_record();
});
function get_karigar_names_loss_record() {
  var start_date = $('input[name*="karigar_loss_reports[start_date]').val();
    var end_date = $('input[name*="karigar_loss_reports[end_date]"]').val();
    var karigar_names = $('select[name*="karigar_loss_reports[karigar_name]"]').val();
    if((start_date=="" && end_date!='')||(start_date!="" && end_date=='')){
      alert("Please select both dates.");
      return false;
    }

    if(moment(start_date, 'DD MMM YYYY').unix() > moment(end_date, 'DD MMM YYYY').unix())
    {
      alert("From Date Can't be greater than To date");
      return false;
    }
    date_wise='';
    if(start_date!=""&&end_date!=''){
        date_wise='&start_date='+start_date+'&end_date='+end_date;
    }
  //  $('select[name*="loss_out_processes_department_id"]').on('change', function() {
  //  department_names.push(""+$(this).val()+"");
  // });

  // department_names = encodeURIComponent(JSON.stringify(department_names));

  window.location = base_url+'reports/karigar_loss_reports?karigar_name='+karigar_names+date_wise;
}

$('.clear_btn').click(function(){
  var url = window.location.href;
  var new_url = url.split('?')[0];
  window.location.href=new_url;
});

// $('select[name*="karigar_loss_reports[karigar_name]"]').on('change', function() {
//     var karigar_name = $(this).val(); 
//     var date = $('input[name*="karigar_loss_reports[date]').val();
//     if(date!=''){
//       var url = window.location.href;
//     if (url.indexOf("?") > -1) {
//       var url = url.split('?')[0];
//       new_url = '?date='+date+'&karigar_name='+karigar_name;
//       window.location.href = url+new_url;
//     }else{
//       new_url = '?date='+date+'&karigar_name='+karigar_name;
//       window.location.href = url+new_url;
//     }
//     }else{
//     window.location = base_url+ 'reports/karigar_loss_reports?karigar_name='+karigar_name;  
//     }
//   });

