<?php echo form_open(base_url().'processes/process_details/update/'.$records['parent_id'],'class="fields-group-sm"');?>
	<?php
		$department_data = implode(',',array_keys(get_process_structures('rope_chain_ag'))); 
		foreach (@get_process_structures('rope_chain_ag') as $department_name => $department_columns) {
		 $this->load->view('tboady', array('department_columns' => $department_columns,
	                                                       'department_name' => @$department_name,
	                                                       'department_data' =>$department_data));	
	  }
	?>
