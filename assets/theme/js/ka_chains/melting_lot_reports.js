$('.search_melting_lot_reports').click(function(){
  var from_date = $('input[name*="from_date').val();
  var to_date = $('input[name*="to_date"]').val();
  if(from_date==""){
    alert("Please select both dates.");
    return false;
  }
  if(to_date==""){
    alert("Please select both dates.");
    return false;
  }

  if(moment(from_date, 'DD MMM YYYY').unix() > moment(to_date, 'DD MMM YYYY').unix())
  {
    alert("From Date Can't be greater than To date");
    return false;
  }

  var url = window.location.href;
  if(url.indexOf("?") > -1) {
    new_url = '&from_date='+from_date+'&to_date='+to_date+'';
    window.location.href = url+new_url;
  }else{
    new_url = '?from_date='+from_date+'&to_date='+to_date+'';
    window.location.href = url+new_url;
  }
  return true;
});

$('.clear_btn').click(function(){
  var url = window.location.href;
  var new_url = url.split('?')[0];
  window.location.href=new_url;
});