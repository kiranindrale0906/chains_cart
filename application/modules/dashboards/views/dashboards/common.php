
	<div class='row'>
		<?php load_view('dashboards/cards/metal_balance_row')?>
	</div>
	<?php if(isset($gpc_out)){?>
		<div class='row'>
			<?php  load_view('dashboards/cards/common_card',array('process'=>'gpc_out'));?>
		</div>
	<?php }?>

	<div class='row'>
		<?php load_view('dashboards/cards/office_row')?>
	</div>

	<div class='row'>
		<?php load_view('dashboards/cards/dd_row')?>
	</div>


	<div class='row'>
		<?php load_view('dashboards/cards/ghiss_row')?>
	</div>	

	<div class='row'>
		<?php load_view('dashboards/cards/rope_ghiss_row')?>
	</div>	
	<div class='row'>
		<?php load_view('dashboards/cards/loss_process_row')?>
	</div>

	<div class='row'>
		<?php load_view('dashboards/cards/loss_row')?>
	</div>

	<div class='row'>
		<?php load_view('dashboards/cards/tounch_row')?>
	</div>

	<div class='row'>
		<?php load_view('dashboards/cards/hcl_row')?>
	</div>


<div class='row'>
	<?php load_view('dashboards/dashboards/process_cards');?>
</div>

<?php	load_view('dashboards/dashboards/department_wise_list');
?>


