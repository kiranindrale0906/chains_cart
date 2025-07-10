
$('.out_weight_search_date').click(function(){
  var date = $('input[name*="out_weight_reports[date]').val();
  var department_name = $('select[name*="out_weight_reports[department_name]').val();
  if(department_name!='' && department_name!=null){
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

$('select[name*="out_weight_reports[department_name]"]').on('change', function() {
  var department_name = $(this).val(); 
  var date = $('input[name*="out_weight_reports[date]').val();
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
    window.location = base_url+ 'reports/out_weight_reports?department_name='+department_name;  
  }
})

