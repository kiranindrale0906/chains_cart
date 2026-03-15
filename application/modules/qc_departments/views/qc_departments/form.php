<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
			action="<?= get_form_action($controller, $action, $record) ?>">
	<?php if ($action == 'edit' || $action == 'update'): ?>
		<?php load_field('hidden', array('field' => 'id')) ?>
	<?php endif;
	 ?>     
	<div class="row">    
	<?php 
	load_field('text', array('field' => 'product_name','readonly'=>'readonly'));
	load_field('text', array('field' => 'process_name','readonly'=>'readonly'));
	load_field('text', array('field' => 'department_name','readonly'=>'readonly'));
	load_field('text', array('field' => 'in_weight','readonly'=>'readonly','readonly'=>'readonly'));
	load_field('text', array('field' => 'gpc_out'));
	load_field('text', array('field' => 'repair_out'));
	load_field('text', array('field' => 'repair_out_quantity'));
	load_field('text', array('field' => 'micro_coating'));
	load_field('text', array('field' => 'balance','readonly'=>'readonly'));
	load_field('text', array('field' => 'balance_gross','readonly'=>'readonly'));
	load_field('text', array('field' => 'balance_fine','readonly'=>'readonly'));
	?>
	</div>
	<?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
	<div class="red"><?php// pd(validation_errors(),0); ?></div>
</form>