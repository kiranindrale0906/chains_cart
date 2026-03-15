<?php echo form_open(base_url().'processes/process_details/store');
	load_field('hidden', array('field' => 'id', 'name' => 'id', 
	                                     'class' => '',
	                                     'value' => '', 
	                                     'layout' => 'application'));
?>
	<div class="row">
		<?php 
		  
		 load_field('text', array('field' => 'parent_id', 'name' => 'parent_id', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

		 load_field('text', array('field' => 'row_id', 'name' => 'row_id', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

		 load_field('text', array('field' => 'type', 'name' => 'type', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

		 load_field('text', array('field' => 'product_name', 'name' => 'product_name', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application'));

		 load_field('text', array('field' => 'process_name', 'name' => 'process_name', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

			load_field('text', array('field' => 'department_name', 'name' => 'department_name', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application'));  

		 load_field('text', array('field' => 'account', 'name' => 'account', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

		 load_field('text', array('field' => 'karigar', 'name' => 'karigar', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

		 load_field('text', array('field' => 'machine_size', 'name' => 'machine_size', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

		 load_field('text', array('field' => 'length', 'name' => 'length', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

		 load_field('text', array('field' => 'remark', 'name' => 'remark', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application'));

		 load_field('text', array('field' => 'no_of_bunch', 'name' => 'no_of_bunch', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

		 load_field('text', array('field' => 'process_sequence', 'name' => 'process_sequence', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

		 load_field('text', array('field' => 'design_code', 'name' => 'design_code', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

		 load_field('text', array('field' => 'lot_no', 'name' => 'lot_no', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

		 load_field('text', array('field' => 'melting_lot_id', 'name' => 'melting_lot_id', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 


		 load_field('textarea', array('field' => 'description', 'name' => 'description', 
	                                     'col' => 'col-md-4',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

    ?>
  </div>
  	<div class="row">
  		<?php 
  			load_field('text', array('field' => 'in_weight', 'name' => 'in_weight', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 
  			load_field('text', array('field' => 'out_weight', 'name' => 'out_weight', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'balance', 'name' => 'balance', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'balance_gross', 'name' => 'balance_gross', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application'));

  			load_field('text', array('field' => 'balance_fine', 'name' => 'balance_fine', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'fe_in', 'name' => 'fe_in', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'fe_out', 'name' => 'fe_out', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application'));

  			load_field('text', array('field' => 'wastage_fe', 'name' => 'wastage_fe', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'melting_wastage', 'name' => 'melting_wastage', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'balance_melting_wastage', 'name' => 'balance_melting_wastage', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'hcl_wastage', 'name' => 'hcl_wastage', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'daily_drawer_wastage', 'name' => 'daily_drawer_wastage', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 	

  			load_field('text', array('field' => 'issue_out', 'name' => 'issue_out', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'in_purity', 'name' => 'in_purity', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'out_lot_purity', 'name' => 'out_lot_purity', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'out_purity', 'name' => 'out_purity', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'in_lot_purity', 'name' => 'in_lot_purity', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'tounch_purity', 'name' => 'tounch_purity', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'tounch_no', 'name' => 'tounch_no', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'tounch_in', 'name' => 'tounch_in', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'tounch_out', 'name' => 'tounch_out', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'tounch_ghiss', 'name' => 'tounch_ghiss', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'hook_in', 'name' => 'hook_in', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'hook_out', 'name' => 'hook_out', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'ghiss', 'name' => 'ghiss', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'loss', 'name' => 'loss', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application'));

  			load_field('text', array('field' => 'hcl_loss', 'name' => 'hcl_loss', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application'));

  			load_field('text', array('field' => 'tounch_loss_fine', 'name' => 'tounch_loss_fine', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'micro_coating', 'name' => 'micro_coating', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'expected_out_weight', 'name' => 'expected_out_weight', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'copper_in', 'name' => 'copper_in', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'copper_out', 'name' => 'copper_out', 
	                                     'col' => 'col-md-2',
	                                     'value' => '', 
	                                     'layout' => 'application')); 

  			load_field('text', array('field' => 'balance_daily_drawer_wastage', 
  															'name' => 'balance_daily_drawer_wastage', 
                                 'col' => 'col-md-2',
                                 'value' => '', 
                                 'layout' => 'application')); 

  			load_field('text', array('field' => 'out_daily_drawer_wastage', 
  															'name' => 'out_daily_drawer_wastage', 
                                 'col' => 'col-md-2',
                                 'value' => '', 
                                 'layout' => 'application')); 

  			load_field('text', array('field' => 'out_hcl_wastage', 
  															'name' => 'out_hcl_wastage', 
                                 'col' => 'col-md-2',
                                 'value' => '', 
                                 'layout' => 'application')); 

  			load_field('text', array('field' => 'balance_hcl_wastage', 
  															'name' => 'balance_hcl_wastage', 
                                 'col' => 'col-md-2',
                                 'value' => '', 
                                 'layout' => 'application')); 

  			load_field('text', array('field' => 'solder_in', 
  															'name' => 'solder_in', 
                                 'col' => 'col-md-2',
                                 'value' => '', 
                                 'layout' => 'application')); 

  			load_field('text', array('field' => 'hcl_ghiss', 'name' => 'hcl_ghiss', 'col' => 'col-md-2',
                                 'value' => '', 
                                 'layout' => 'application')); 

  			load_field('text', array('field' => 'out_tounch_out', 'name' => 'out_tounch_out', 
  																'col' => 'col-md-2',
                                 'value' => '', 'layout' => 'application')); 

  			load_field('text', array('field' => 'balance_tounch_out', 'name' => 'balance_tounch_out', 
  																'col' => 'col-md-2',
                                 'value' => '', 'layout' => 'application'));

  			load_field('text', array('field' => 'balance_ghiss', 'name' => 'balance_ghiss', 
  																'col' => 'col-md-2',
                                 'value' => '', 'layout' => 'application')); 

  			load_field('text', array('field' => 'out_ghiss', 'name' => 'out_ghiss', 
  																'col' => 'col-md-2',
                                 'value' => '', 'layout' => 'application')); 

  			load_field('text', array('field' => 'out_hcl_ghiss', 'name' => 'out_hcl_ghiss', 
  																'col' => 'col-md-2',
                                 'value' => '', 'layout' => 'application')); 

  			load_field('text', array('field' => 'out_hcl_ghiss', 'name' => 'out_hcl_ghiss', 
  																'col' => 'col-md-2',
                                 'value' => '', 'layout' => 'application')); 

  			load_field('text', array('field' => 'balance_hcl_ghiss', 'name' => 'balance_hcl_ghiss', 
  																'col' => 'col-md-2',
                                 'value' => '', 'layout' => 'application')); 

  			load_field('text', array('field' => 'out_loss', 'name' => 'out_loss', 
  																'col' => 'col-md-2',
                                 'value' => '', 'layout' => 'application'));

  			load_field('text', array('field' => 'balance_loss', 'name' => 'balance_loss', 
  																'col' => 'col-md-2',
                                 'value' => '', 'layout' => 'application')); 

  			load_field('text', array('field' => 'quantity', 'name' => 'quantity', 
  																'col' => 'col-md-2',
                                 'value' => '', 'layout' => 'application')); 

  			load_field('text', array('field' => 'skip_department', 'name' => 'skip_department', 
  																'col' => 'col-md-2',
                                 'value' => '', 'layout' => 'application')); 

  			load_field('text', array('field' => 'refine_loss', 'name' => 'refine_loss', 
  																'col' => 'col-md-2',
                                 'value' => '', 'layout' => 'application'));  
  		?>
  	</div>
  	<div class="row">
			<?php 
				load_field('text', array('field' => 'daily_drawer_in_weight', 
															'name' => 'daily_drawer_in_weight', 
															'col' => 'col-md-2',
                             'value' => '', 'layout' => 'application')); 

				load_field('text', array('field' => 'alloy_weight', 
															'name' => 'alloy_weight', 
															'col' => 'col-md-4',
                             'value' => '', 'layout' => 'application'));

				load_field('text', array('field' => 'next_department_name', 
															'name' => 'next_department_name', 
															'col' => 'col-md-2',
                             'value' => '', 'layout' => 'application'));

				load_field('text', array('field' => 'next_department_wastage', 
															'name' => 'next_department_wastage', 
															'col' => 'col-md-2',
                             'value' => '', 'layout' => 'application')); 

				load_field('text', array('field' => 'out_tounch_ghiss', 
															'name' => 'out_tounch_ghiss', 
															'col' => 'col-md-2',
                             'value' => '', 'layout' => 'application')); 

				load_field('text', array('field' => 'balance_tounch_ghiss', 
															'name' => 'balance_tounch_ghiss', 
															'col' => 'col-md-2',
                             'value' => '', 'layout' => 'application'));

				load_field('text', array('field' => 'daily_drawer_out_weight', 
															'name' => 'daily_drawer_out_weight', 
															'col' => 'col-md-2',
                             'value' => '', 'layout' => 'application')); 
			?>

  	</div>
  	<?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue float-right')); ?>
 <?php echo form_close();?>