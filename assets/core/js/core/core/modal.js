function modal_js(event){
	if(event == 'show'){
		$('#ajax-modal').modal();
		autofocus_field();
	}else{
		$('#ajax-modal').modal('hide');
	}
}