function bar_code_input(){
	var value = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
	var value = value.replace('?barcode=1', '');
	if(value != '' && value != null && typeof(value) != 'undefined')
		ajax_post_request(base_url+'bar_codes/bar_codes/view/'+value+'?type=2','','autocomplete');
};

function set_cursor_on_input(id,department_data,row_id){
	
	if(row_id != null && typeof(row_id) != 'undefined' && department_data != null && typeof(department_data) != 'undefined'){
			var select_input = $("."+row_id+"_"+department_data.toLowerCase().replace(/ /g,"_")).find(":input").not(':input[readonly]').not(':input[type=hidden]')[0];
			console.log(select_input);	
			console.log("."+row_id+"_"+department_data.toLowerCase());	
			if(typeof(select_input) != 'undefined'){
				select_input.focus();
			}
	}
}

function genrate_bar_code(html){
	
  var divToPrint = html;

  var newWin=window.open('','Print-Window');


  newWin.document.write('<html><body onload="window.print(); window.close();">'+divToPrint+'</body></html>');

  newWin.document.close();
  


  setTimeout(function(){newWin.close();},10);
}



function scan_bar_code(process_id){
	$(".scanButtonDown").val(process_id);
	$('<form method="POST" action="'+base_url+'bar_codes/bar_codes/view/1"><input name="barcode_value" value="'+process_id+'"></form>').appendTo('body').submit();
}