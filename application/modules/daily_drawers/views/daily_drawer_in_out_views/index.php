<div class="table-responsive m-t-20">
<?php
$column_name=($column=='in_weight')?'In':'Out';
?>
<h6 class="bold">Daily Drawer <?=$column_name?> Weight </h6>

<table class="table table-sm fixedthead table-default">
<thead>
  <tr>
    <th>ID</th>
    <th>Lot No</th>
    <th>Product Name</th>
    <th>Process Name</th>
    <th>Department Name</th>
    <th>Karigar</th>
    <th>Purity</th>
    <?php if($column=='in_weight' || $column=='balance'){?>
    <th class="text-right">IN Weight</th>
    <?php }if($column=='out_weight' || $column=='balance'){?>
    <th class="text-right">OUT Weight</th>
    <?php }if($column=='balance'){?>
    <th class="text-right">Balance</th>
    <?php }?>
    <th class="text-right">Date</th>
  </tr>
</thead>
<tbody>
<?php
$sum_of_in_weight=$sum_of_out_weight=$sum_of_balance=0;

 foreach ($daily_drawers as $index => $daily_drawer) {
 	$sum_of_in_weight+=$daily_drawer['in_weight'];
 	$sum_of_out_weight+=$daily_drawer['out_weight'];
 	$sum_of_balance+=($daily_drawer['in_weight']-$daily_drawer['out_weight']);
 	?>
	  <tr>
	  	<td><?=$daily_drawer['process_id']?></td>
        <td><?=$daily_drawer['lot_no']?></td>
	  	<td><?=$daily_drawer['product_name']?></td>
	  	<td><?=$daily_drawer['daily_drawer_type']?></td>
	  	<td><?=$daily_drawer['department_name']?></td>
      <td><?=$daily_drawer['karigar']?></td>
	  	<td><?=$daily_drawer['hook_kdm_purity']?></td>
	  	<?php if($column=='in_weight' || $column=='balance'){?>
	  	<td class="text-right" style="background-color: yellow;"><?=isset($daily_drawer['in_weight'])?$daily_drawer['in_weight']:0;?></td>
	  	<?php } if($column=='out_weight' || $column=='balance'){?>
		  <td class="text-right" style="background-color: yellow;"><?=isset($daily_drawer['out_weight'])?$daily_drawer['out_weight']:0;?></td>
		  <?php }if($column=='balance'){?>
    	<td class="text-right" style="background-color: yellow;"><?=$daily_drawer['in_weight']-$daily_drawer['out_weight'];?></td>
    <?php }?>
	  	<td class="text-right"><?=date($daily_drawer['created_at'])?></td>
	  </tr>
<?php } 
?>
<tr class="bg_gray bold">
<td>Total</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<?php if($column=='in_weight' || $column=='balance'){?>
    <td class="text-right"><?=$sum_of_in_weight?></td>
    <?php }if($column=='out_weight' || $column=='balance'){?>
    <td class="text-right"><?=$sum_of_out_weight?></td>
    <?php } if($column=='balance'){?>
    <td class="text-right"><?=$sum_of_balance?></td>
<?php
}
?>
<td></td>
</tr>
</tbody> 

</table>
</div>
