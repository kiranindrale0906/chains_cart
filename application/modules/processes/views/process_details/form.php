<?php 
echo 'Product / Process / Department : <b>'.$record['product_name'].' >> '.$record['process_name'].' >> '.$record['department_name'].'</b></br>';
echo 'Category One / Two : <b>'.$record['melting_lot_category_one'].' >> '.$record['melting_lot_category_two'].'</b></br>';
echo 'Machine Size : <b>'.$record['machine_size'].'</b></br>';
echo 'Design Name : <b>'.$record['design_code'].'</b><br />';
echo 'Lot No : <b>'.$record['lot_no'].'</b><br /><br />';
echo form_open(base_url().$this->router->module.'/'.$this->router->class.'/update/'.$record['id'].'?type=2','class="fields-group-sm"');?>
<div class="row">
	<input type="hidden" name="<?php echo $this->router->class;?>[row_id]" value="<?php echo $record['row_id']?>">
	<?php 
   
   	load_field('hidden', array('field' => 'id', 'col' => 'col-md-4','readonly'=>'readonly','id'=>'id')); 
	// 	$label_with_text = array();
	// 	$label_with_value = array();
	// 	$text_with_add_more = array();
	// 	$text = array();
	
	// /*	for($i=0; $i < count($process_array);$i++){
	// 		if($process_array[$i][2] == 'label_with_text')
	// 			$label_with_text[$i] = $process_array[$i];
	// 	}*/
	// 	//pr($process_array);
	
	// 	for($i=0; $i < count($process_array);$i++){
	// 		if($process_array[$i][2] == 'label_with_value')
	// 			$label_with_value[$i] = $process_array[$i];
	// 	}

	// 	for($i=0; $i < count($process_array);$i++){
	// 		if($process_array[$i][2] == 'text_with_add_more')
	// 			$text_with_add_more[$i] = $process_array[$i];
	// 	}

	// 	for($i=0; $i < count($process_array);$i++){
	// 		if($process_array[$i][2] == 'text')
	// 			$text[$i] = $process_array[$i];
	// 	}

		//$process_array = array_merge($label_with_text, $label_with_value, $text_with_add_more, $text);
		foreach ($process_array as $department_name => $department_columns) {
			
			$field_name = $department_columns[0];
			$field_column = $department_columns[1];
			$field_type = $department_columns[2];

			if (!in_array($field_type, array('label_with_text', 'text_with_add_more', 'text', 'label_with_value', 'dropdown'))) continue;
			if ($field_column == 'factory_karigar')  continue;
			
			if ($field_type == 'text_with_add_more') {
	      if (isset($department_columns[5]) && !empty($department_columns[5])) {
	        $process_details_fields = $department_columns[5];
	      } else {
	        $process_details_fields = array(array('label' => strtoupper($field_name), 
	                                              'field_type' => 'text', 'database_column' => $field_column)); 
	      }
	    }
			//print_r($field_type);
				/*if($field_type == 'text' && $field_column != 'bar_code'){
					load_field('text', array('field' => $field_column,'col' => 'col-md-4','readonly'=>'readonly')); 
				}*/

			if ($field_type == 'text_with_add_more' && $field_column != 'bar_code' && $field_column != 'created_by') {
				load_field('text', array('field' => $field_column, 'col' => 'col-md-4',
																 'class'=>$this->router->class.'_'.$field_column.' '.$field_column.'_'.$record['id'],
																 'value' => $record[$field_column] == 0 ? '' : $record[$field_column],
																 'readonly'=>'readonly'));?>

	      <div class="col-sm-12" style="margin-top:-10px; margin-bottom:10px;">
          <?php
            load_buttons('anchor', array('name'=>'ADD '.$field_name,
                                         'class'=>'btn-xs p-0 underline blue ajax '.$field_column.'_'.$record['id'],
                                         'data-toggle'=>'modal',
                                         'data-class'=>$this->router->class.'_'.$field_column,
                                         'onclick'=>'',
                                         'modal-size'=>'lg',
                                         'data-title'=>"Add ".$field_name."",
                                         'layout' => 'application',
                                         'href'=>base_url().'processes/process_fields/create/'.$record['id'].'?field_name='.$field_column.'&&product_name='.$record['product_name'].'&&process_name='.$record['process_name'].'&&process_details_fields='.json_encode(@$process_details_fields))); 
          ?> 
      	</div>                         
			<?php }

			if (in_array($field_column, array('tounch_in', 'fire_tounch_in', 'loss', 'balance', 'out_weight'))) { ?>
				</div><div class="row">
			<?php } 

			if ($field_type=='dropdown') { 
					load_field('dropdown', array('field' => $field_column, 'col' => 'col-md-4',
	                                           'option' => @$department_columns[4]));
			}	

			if($field_type == 'label_with_value'  && (	 $field_column == 'balance' 
																								|| $field_column == 'in_weight'
																								|| $field_column == 'in_lot_purity' 
																								|| $field_column == 'balance_fine')){
				 load_field('text', array('field' => $field_column, 
	      													'col' => 'col-md-4',
	      													'class'=>$field_column.' input_with_add '.$field_column.'_'.$record['id'],
	      													'readonly'=>'readonly'));
			}

			else if($field_type == 'text'){
	
				load_field('text', array('field' => $field_column, 
	      													'col' => 'col-md-4',
	      													'value' => $record[$field_column] == 0 ? '' : $record[$field_column],
	      													'class' => $field_column.' input_with_add '.$field_column.'_'.$record['id']));

				if($field_column == 'tounch_in'){
					load_field('text', array('field' => 'tounch_no', 
	      													'col' => 'col-md-4',
	      													'value' => $record[$field_column] == 0 ? '' : $record[$field_column],
	      													'class'=>'tounch_no input_with_add',
	      													'readonly'=>'readonly'));
				}
				if($field_column == 'fire_tounch_in'){
					load_field('text', array('field' => 'fire_tounch_no', 
	      													'col' => 'col-md-4',
	      													'value' => $record[$field_column] == 0 ? '' : $record[$field_column],
	      													'class'=>'fire_tounch_no input_with_add',
	      													'readonly'=>'readonly'));
				}
			}
		} 
		if($record['status'] == 'Pending'){?>
				<div class="col-sm-12">
					<?php 
						load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue'));
					?>
				</div>
		<?php }?>		
	<?php
		echo form_close();
	?>
	<hr>
</div>