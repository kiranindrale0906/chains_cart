
$('.product_wise_loss_search_date').click(function(){
  get_product_wise_lot_loss_and_refresh_page();
});
$('.loss_search_date').click(function(){
    var date = $('input[name*="loss_reports[date]').val();
    var department_name = $('select[name*="loss_reports[department_name]').val();
    
    if(department_name!=''){
      var url = window.location.href;
      if (url.indexOf("?") > -1) {
        var url = url.split('?')[0];
        new_url = '?department_name='+department_name+'&date='+date;
        window.location.href = url+new_url;
      }else{
        new_url = '?department_name='+department_name+'&date='+date;
        window.location.href = url+new_url;
      }

    }else{

      var url = window.location.href;
      if (url.indexOf("?") > -1) {
        var url = url.split('?')[0];
        new_url = '?date='+date;
        window.location.href = url+new_url;
      }else{
        new_url = '?date='+date;
        window.location.href = url+new_url;
      }
    }
    return true;
});

$('.clear_btn').click(function(){
    var url = window.location.href;
    var new_url = url.split('?')[0];
    window.location.href=new_url;
});

$('select[name*="loss_reports[department_name]"]').on('change', function() {
    var department_name = $(this).val(); 
    var date = $('input[name*="loss_reports[date]').val();
    if(date!=''){
      var url = window.location.href;
      if (url.indexOf("?") > -1) {
        var url = url.split('?')[0];
        new_url = '?date='+date+'&department_name='+department_name;
        window.location.href = url+new_url;
      }else{
        new_url = '?date='+date+'&department_name='+department_name;
        window.location.href = url+new_url;
      }
    }else{
      window.location = base_url+ 'loss_outs/loss_reports?department_name='+department_name;  
    }
  });

$('select[name*="product_wise_loss_reports[product_name]"]').on('change', function() {
    var product_name = $(this).val(); 
    window.location = base_url+ 'loss_outs/product_wise_loss_reports?product_name='+product_name;  
    
  });
function get_product_wise_lot_loss_and_refresh_page() {
  var start_date = $('input[name*="product_wise_loss_reports[start_date]').val();
    var end_date = $('input[name*="product_wise_loss_reports[end_date]"]').val();
    var product_name = $('select[name*="product_wise_loss_reports[product_name]"]').val();
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

  window.location = base_url+'loss_outs/product_wise_loss_reports?product_name='+product_name+date_wise;
}




