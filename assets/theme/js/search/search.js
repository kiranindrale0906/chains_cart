$(document).delegate(".search_melting_lots", "change", function(){
 	var lots=$(".search_melting_lots option:selected").val();
	 $.ajax({
	    type : 'POST',
	    url : base_url+'search/search/view/'+lots+'?type=1',
	    dataType: 'JSON',
	    success: function(response) {
	     search_department_options(response);
	    }
  });

});

$(document).delegate("select[name*='search[departments]']", "change", function(){
 	var department_id=$("select[name*='search[departments]']").val();
	 	$.ajax({
		    type : 'POST',
		    url : base_url+'search/search/view/'+department_id+'?type=2',
		    dataType: 'JSON',
		    success: function(response) {
		    	dept_name=response.result.department_name.replace(' ', '_').replace('+', '_').toLowerCase();
		    	url=base_url+response.result.product_name+'/'+response.result.process_name+'#dept_'+dept_name;
		    	window.location.href = url;
		    	 $('#ajax-modal').modal('hide');
		    }
	  });
});

function search_department_options(response) {
  $("select[name*='search[departments]'] option").remove();
  var option_html="<option value=''>Select</option>";
  
  for (i=0; i < response.result.length; i++) {
    name = response.result[i].department_name+'('+ response.result[i].balance+')';
    option_html += "<option data-subtext='' value="+response.result[i].id+">"+name+"</option>";
  }
	if(response.result.length==0){
		var option_html="<option value=''>No Record Found.</option>";
	}
 	$("select[name*='search[departments]']").append(option_html);
}