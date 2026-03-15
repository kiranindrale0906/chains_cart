<?php
	$machine_names = get_machine_names(@$process['department_name'], @$process['id']);
	$department_machine_names = array_merge(array(array('name'=>'', 'id'=>'')), $machine_names); 
?>

<?php load_field('plain/dropdown', array('field' => 'machine_no',
	                                       'value' => @$process[$field],
	                                       'layout' => 'table',
	                                       'option' => $department_machine_names)); ?>