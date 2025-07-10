<h6 class='blue text-uppercase bold mb-3'>Department Wise Dashboard</h6>
<div class="d-flex align-items-center ">
  <div class="pr-3 ">
    <?php echo form_open(base_url().'dashboards/department_dashboards');?>
        <div class="m-3">
        <input type="text" autocomplete="off" placeholder="Enter Lot Number" name="lot_no" value = "<?= $lot_no ?>" class="scanButtonDown form-control">
        </div>
    <?php echo form_close();?>
  </div>
  <div class="pr-3 ">
        <div class="m-3">
        <?php load_field('plain/dropdown', array('field' => 'in_lot_purity',
                                           		 'option'=>$in_lot_purity)); ?>
      	</div>
  </div>
</div>

<div class="table-responsive col-sm-8">
	<table class="table table-sm table-default table-hover">
		<thead>
			<th>Balance</th>
			<th>Balance Gross</th>
			<th>Balance Fine</th>
		</thead>
		<tbody>
			<tr>
				<td><?=$total_of_balance['balance']?></td>
				<td><?=$total_of_balance['balance_gross']?></td>
				<td><?=$total_of_balance['balance_fine']?></td>
			</tr>
		</tbody>
	</table>
</div>	
<div class='row'>
	<?php load_view('dashboards/cards/reports_card')?>
</div>