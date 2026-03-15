	$('select[name*="approval_processes[account]"]').on('change', function() {
		var account = $(this).val();	
		if(account!=''){
		window.location = base_url+'domestic_internals/approval_processes/create?account='+account;	
		}
	});

