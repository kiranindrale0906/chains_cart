var count = 0;
function modal_js(event){
	if(event == 'show'){
		$('#ajax-modal').modal();
			autofocus_fields();
			dragAndDrop();
			if(count == 0){
				ajax_post_onclick_submit();
			}
	}else{
		$('#ajax-modal').modal('hide');
		$('.onclick_ajaxloader_js').hide();
	}
	count++;
}