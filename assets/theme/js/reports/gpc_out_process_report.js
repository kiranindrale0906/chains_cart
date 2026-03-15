function outside_initialization(){
  $(".process_outside").click(function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    const form = document.createElement('form');
    form.method = 'post';
    form.action = base_url+'processes/process_outsides/update/'+id;
    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'process_outsides[id]';
    hiddenField.value = id;
    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
  })
}

$('select[name="gpc_out_city_reports[city]"]').on('change', function() {
    var city = $(this).val();  
    var product_name = $('select[name="gpc_out_city_reports[product_name]"]').val(); 
    var in_purity = $('select[name="gpc_out_city_reports[in_lot_purity]"]').val(); 
    var from_date = $('input[name*="gpc_out_city_reports[from_date]').val();
var to_date = $('input[name*="gpc_out_city_reports[to_date]"]').val();
if((from_date=="" && to_date!='')||(from_date!="" && to_date=='')){
  alert("Please select both dates.");
  return false;
}

if(moment(from_date, 'DD MMM YYYY').unix() > moment(to_date, 'DD MMM YYYY').unix())
{
  alert("From Date Can't be greater than To date");
  return false;
}
date_wise='';
if(from_date!=""&&to_date!=''){
  date_wise='&from_date='+from_date+'&to_date='+to_date;
}
    window.location = base_url+ 'reports/gpc_out_city_reports?in_lot_purity='+in_purity+'&city='+city+'&product_name='+product_name+date_wise;
});

$('select[name="gpc_out_city_reports[in_lot_purity]"]').on('change', function() {
    var in_purity = $(this).val();  
    var city = $('select[name="gpc_out_city_reports[city]"]').val(); 
    var product_name = $('select[name="gpc_out_city_reports[product_name]"]').val();
    var from_date = $('input[name*="gpc_out_city_reports[from_date]').val();
var to_date = $('input[name*="gpc_out_city_reports[to_date]"]').val();
if((from_date=="" && to_date!='')||(from_date!="" && to_date=='')){
  alert("Please select both dates.");
  return false;
}

if(moment(from_date, 'DD MMM YYYY').unix() > moment(to_date, 'DD MMM YYYY').unix())
{
  alert("From Date Can't be greater than To date");
  return false;
}
date_wise='';
if(from_date!=""&&to_date!=''){
  date_wise='&from_date='+from_date+'&to_date='+to_date;
}
    window.location = base_url+ 'reports/gpc_out_city_reports?in_lot_purity='+in_purity+'&product_name='+product_name+'&city='+city+date_wise;
});
$('select[name="gpc_out_city_reports[product_name]"]').on('change', function() {
    var product_name = $(this).val();  
    var city = $('select[name="gpc_out_city_reports[city]"]').val(); 
    var in_purity = $('select[name="gpc_out_city_reports[in_lot_purity]"]').val();
    var from_date = $('input[name*="gpc_out_city_reports[from_date]').val();
    var to_date = $('input[name*="gpc_out_city_reports[to_date]"]').val();
    if((from_date=="" && to_date!='')||(from_date!="" && to_date=='')){
      alert("Please select both dates.");
      return false;
    }

if(moment(from_date, 'DD MMM YYYY').unix() > moment(to_date, 'DD MMM YYYY').unix())
{
  alert("From Date Can't be greater than To date");
  return false;
}
date_wise='';
if(from_date!=""&&to_date!=''){
  date_wise='&from_date='+from_date+'&to_date='+to_date;
}
    window.location = base_url+ 'reports/gpc_out_city_reports?in_lot_purity='+in_purity+'&product_name='+product_name+'&city='+city+date_wise;
});