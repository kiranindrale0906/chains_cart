$(document).delegate(".process_chain", "change", function(){
 	var chain_name=$(".process_chain option:selected").val();
	 $.ajax({
	    type : 'POST',
	    url : base_url+'dashboards/chain_dashboards/view/1?type=1&chain_name='+chain_name,
	    dataType: 'JSON',
	    success: function(response) {
	     department_options(response);
	    }
  });

});

$(document).delegate("select[name*='chain_dashboards[departments]']", "change", function(){
 	var department_id=$("select[name*='chain_dashboards[departments]']").val();
	 	$.ajax({
		    type : 'POST',
		    url : base_url+'chain_dashboards/chain_dashboards/view/1?type=2',
		    dataType: 'JSON',
		    success: function(response) {
		    	dept_name=response.result.department_name.replace(' ', '_').replace('+', '_').toLowerCase();
		    	url=base_url+response.result.product_name+'/'+response.result.process_name+'#dept_'+dept_name;
		    	window.location.href = url;
		    	 $('#ajax-modal').modal('hide');
		    }
	  });
});

function department_options(response) {
  $("select[name*='chain_dashboards[departments]'] option").remove();
  var option_html="<option value=''>Select</option>";
  for (i=0; i < response.result.length; i++) {
    name = response.result[i].department_name;
    option_html += "<option data-subtext='' value="+response.result[i].id+">"+name+"</option>";
  }
  	if(response.result.length==0){
  		var option_html="<option value=''>No Record Found.</option>";
  	}
   	$("select[name*='chain_dashboards[departments]']").append(option_html);
}
