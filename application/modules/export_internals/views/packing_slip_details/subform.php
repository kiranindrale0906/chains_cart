<tr class="process_<?= $process['id']?>">
	<td>
		<?php load_field('checkbox', array('field' => 'packing_slip_id',
																		 	 'index' => $index,
																		 	 'class' => 'packing_slip_details_id',
																		 	 'option' => array(
																		 	 							array('chk_id' => $index,
																		                      'value' => $process['id'],
																		                      'label' => '',
																		                      'checked' => (!empty($packing_slip_details[$index]['packing_slip_id']) ? 'checked' : ''),
																		 	 						        )),
																		   'controller' => 'packing_slip_details'));?>
		<?php load_field('hidden', array('field' => 'process_id',
			                             				  'class' => 'process_id',
														  'index' => $index,
														  'value' => !empty($process['id'])?$process['id']:0,
														  'controller' => 'packing_slip_details')); ?>																   
	</td>
	<td><?php echo $process['created_at'];?></td>
	<td><?php echo $process['description'];?> </td>
  	<td class="text-right"><?php load_field('plain/text', array('field' => 'packing_slip_sr_no',
			                             				  'class' => 'packing_slip_sr_no',
														  'index' => $index,
														  'value' => !empty($process['packing_slip_sr_no'])?$process['packing_slip_sr_no']:0,
														  'controller' => 'packing_slip_details')); ?>
		
	</td>
  	<td class="text-right"><?= four_decimal($process['accept_packing_list']) ;?></td>
  	<td class="text-right"><?= four_decimal($process['packing_slip_balance']) ;?></td>
	<td class="text-right"><?= four_decimal($process['in_lot_purity']); ?></td>
	<td class="text-right"><?php load_field('plain/text', array('field' => 'packing_slip_gross_weight',
			                             				  'class' => 'packing_slip_net_weight',
														  'index' => $index,
														  'value' => !empty($process['packing_slip_gross_weight'])?$process['packing_slip_gross_weight']:0,
														  'controller' => 'packing_slip_details')); ?>
		
	</td>
	<td class="text-right"><?php load_field('plain/text', array('field' => 'packing_slip_quantity',
			                             				  'class' => 'packing_slip_quantity',
														  'index' => $index,
														  'value' => !empty($process['packing_slip_quantity'])?$process['packing_slip_quantity']:0,
														  'controller' => 'packing_slip_details')); ?>
		
	</td>
	
	<td class="text-right"><?php load_field('plain/text', array('field' => 'packing_slip_stone_percentag',
			                             				  'class' => 'packing_slip_stone_percentag',
														  'index' => $index,
														  'value' => !empty($process['packing_slip_stone_percentag'])?$process['packing_slip_stone_percentag']:0,
														  'controller' => 'packing_slip_details')); ?>
		
	</td>
	<td class="text-right"><?php load_field('plain/text', array('field' => 'packing_slip_stone',
			                             				  'class' => 'packing_slip_stone',
														  'index' => $index,
														  'value' => !empty($process['packing_slip_stone'])?$process['packing_slip_stone']:0,
														  'controller' => 'packing_slip_details')); ?>
		
	</td>
	<td class="text-right"><?php load_field('plain/text', array('field' => 'packing_slip_making_charge',
			                             				  'class' => 'packing_slip_making_charge',
														  'index' => $index,
														  'value' => !empty($process['packing_slip_making_charge'])?$process['packing_slip_making_charge']:0,
														  'controller' => 'packing_slip_details')); ?>
		
	</td>
	<td class="text-right"><?php load_field('plain/dropdown', array('field' => 'packing_slip_category_name',
			                             				  'class' => 'packing_slip_category_name',
														  'index' => $index,
														  'option'=>array(array('id'=>'-','name'=>'-'),
														  				  array('id'=>'CZ','name'=>'CZ'),
														  				  array('id'=>'Meena','name'=>'Meena'),
														  				  array('id'=>'Pearls','name'=>'Pearls'),
														  				  array('id'=>'Plastic','name'=>'Plastic'),
														  				  array('id'=>'Rudraksh','name'=>'Rudraksh')),
														  'value' => !empty($process['packing_slip_category_name'])?$process['packing_slip_category_name']:'',
														  'controller' => 'packing_slip_details')); ?>
		
	</td><td class="text-right"><?php load_field('plain/dropdown', array('field' => 'packing_slip_category_2',
			                             				  'class' => 'packing_slip_category_2',
														  'index' => $index,
														  'option'=>array(array('id'=>'-','name'=>'-'),
														  				  array('id'=>'CZ','name'=>'CZ'),
														  				  array('id'=>'Meena','name'=>'Meena'),
														  				  array('id'=>'Pearls','name'=>'Pearls'),
														  				  array('id'=>'Plastic','name'=>'Plastic'),
														  				  array('id'=>'Rudraksh','name'=>'Rudraksh')),
														  'value' => !empty($process['packing_slip_category_2'])?$process['packing_slip_category_2']:'',
														  'controller' => 'packing_slip_details')); ?>
		
	</td>
	<td class=""><?php load_field('plain/text', array('field' => 'packing_slip_colour',
			                             				  'class' => 'packing_slip_colour',
														  'index' => $index,
														  'value' => !empty($process['packing_slip_colour'])?$process['packing_slip_colour']:'',
														  'controller' => 'packing_slip_details')); ?>
		
	</td>
	<td class=""><?php load_field('plain/text', array('field' => 'packing_slip_code',
			                             				  'class' => 'packing_slip_code',
														  'index' => $index,
														  'value' => !empty($process['packing_slip_code'])?$process['packing_slip_code']:'',
														  'controller' => 'packing_slip_details')); ?>
		
	</td>
	<td class=""><?php load_field('plain/text', array('field' => 'packing_slip_description',
			                             				  'class' => 'packing_slip_description',
			                             				  'value' => !empty($process['packing_slip_description'])?$process['packing_slip_description']:'',
														  'index' => $index,
														  'controller' => 'packing_slip_details')); ?></td>
    </tr>
