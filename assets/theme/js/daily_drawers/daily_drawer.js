/*$(".daily_drawer_process").change(function () {
  var purity=$(".daily_drawer_process option:selected").val();
  var formData = new FormData();
  formData.append('purity',purity);
  ajax_post_request(base_url+'daily_drawer/daily_drawer_processes/view/1?daily_drawer_process=1',formData);
});*/

$('.search_date_daily_drawer').click(function(){

    var from_date = $('input[name*="daily_drawer_in_out_views[start_date]').val();
    var to_date = $('input[name*="daily_drawer_in_out_views[end_date]"]').val();
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
    if (url.indexOf("&&") > -1) {
      var newurl = url.split('&&')[2];
      new_url = '&&start_date='+from_date+'&end_date='+to_date+'';
      window.location.href = url+newurl+new_url;
    }else{
      new_url = '&&start_date='+from_date+'&end_date='+to_date+'';
      window.location.href = url+new_url;
    }
    return true;
});

$('.clear_btn').click(function(){
    var url = window.location.href;
    var new_url = url.split('&&')[2];

    window.location.href=url+new_url;
});
