<?php
$department_array = array();
if(isset($records)){
foreach ($records as $row_id => $record) { 
	if(isset($record[$department_name])){
	  $process =  $record[$department_name]; 
	  ?>
	  <div class="<?= get_row_id($row_id, $department_name); ?>">
	    <?php $this->load->view('form', array('process' => $process,'department'=>$department_name,'departments'=>$department_data)); ?>
	  </div>
<?php }}} ?>
