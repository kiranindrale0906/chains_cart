<!-- <?php 
$add_col_master_name = $this->router->class;
// echo "<pre>";print_r($master_name);exit;
$add_colmns='';
foreach ($table_columns as $key => $value) {
	$add_colmns[$key] = $value[0];
}
if(isset($filter_columns) && $filter_columns !=''){
	$selected_filter_columns=array_column($filter_columns, 0);	
}
// echo "<pre>";print_r(ADMIN_PATH.$add_col_master_name);exit;
/*echo "<pre>";print_r($add_colmns);//exit;
echo "<pre>";print_r($selected_filter_columns);exit;*/

?> -->

<!-- <div class="col-sm-12 float-rigth"> -->
	<!-- <form name="add_column_form" id="add_column_form_id" action=""> -->
	<!-- <form name="add_column_form" id="add_column_form_id" method="post" action="<?=@ADMIN_PATH.$add_col_master_name?>/">
	<label style="color: #666666;font-weight: 600;">Select Column(s):</label> -->

	<!-- <?php
		foreach ($add_colmns as $key => $value) {?>  -->
		<!-- 	<span class="add_column" style="margin: 2px;"><input type="checkbox" class="add_column_checkbox" name="selected_columns[<?php echo $key;?>]"  id="selected_columns[<?php echo $key;?>]" <?=(isset($selected_filter_columns) && in_array($value, $selected_filter_columns) ) ? 'checked':''?> value="<?php echo $key;?>" style="padding: 5px;"><span class="checkbox_name" style="padding: 5px;"><?php echo $value; ?></span></span> -->

<!-- 	<?php 
		}
	?> -->
	<!-- <input type="submit" class="btn btn-info" value="Submit"/> -->
	<!-- <input type="button" onclick="addColumns('<?=@$add_col_master_name?>');" value="Submit"/> -->
<!-- 	</form>

</div> -->
