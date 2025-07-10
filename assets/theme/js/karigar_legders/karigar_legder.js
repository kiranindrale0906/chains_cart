
$('select[name*="karigar_ledgers[karigar]"]').on('change', function() {
  var karigar = $(this).val(); 
  var purity = $('select[name*="karigar_ledgers[purity]"]').val(); 
  if(purity==''){
    window.location = base_url+ 'reports/karigar_ledgers/create?karigar='+karigar;  
  }else{
    window.location = base_url+ 'reports/karigar_ledgers/create?karigar='+karigar+'&purity='+purity;  
  }
});

$('select[name*="karigar_ledgers[purity]"]').on('change', function() {
  var purity = $(this).val(); 
  var karigar = $('select[name*="karigar_ledgers[karigar]"]').val(); 
  window.location = base_url+ 'reports/karigar_ledgers/create?karigar='+karigar+'&purity='+purity;  
});