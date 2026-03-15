<h6 class='blue text-uppercase bold mb-3'>Common Dashboard</h6>
<?php load_view('dashboards/dashboards/common');?>
<?php 
	$process_names = array_keys($process_balance_custom);
	foreach($process_names as $process_name){
?>
<hr>
<div class="row">
<div class="col-sm-12">
<h5><?php echo singular(ucfirst(str_replace('_', " ", $process_name)));?>
</h5>
</div>
	<?php load_view('dashboards/common_dashboards/process_balance',array('process'=>$process_name));?>
</div>
<div class="row">
	<?php $this->load->view('dashboards/common_dashboards/department_wise_list',array('process'=>$process_name));?>
</div>
<?php }?>