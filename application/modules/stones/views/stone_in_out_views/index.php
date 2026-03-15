<div class="table-responsive m-t-20">
<?php
$column_name=($column=='in_weight')?'In':'Out';
?>
<h6 class="bold">Stone <?=$column_name?> Weight </h6>

<table class="table table-sm fixedthead table-default">
<thead>
  <tr>
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

 foreach ($stones as $index => $stone) {
 	$sum_of_in_weight+=$stone['in_weight'];
 	$sum_of_out_weight+=$stone['out_weight'];
 	$sum_of_balance+=($stone['in_weight']-$stone['out_weight']);
 	?>
	  <tr>
	  	<td><?=$stone['lot_no']?></td>
	  	<td><?=$stone['product_name']?></td>
	  	<td><?=$stone['type']?></td>
	  	<td><?=$stone['department_name']?></td>
      <td><?=$stone['karigar']?></td>
	  	<td><?=$stone['hook_kdm_purity']?></td>
	  	<?php if($column=='in_weight' || $column=='balance'){?>
	  	<td class="text-right" style="background-color: yellow;"><?=isset($stone['in_weight'])?$stone['in_weight']:0;?></td>
	  	<?php } if($column=='out_weight' || $column=='balance'){?>
		  <td class="text-right" style="background-color: yellow;"><?=isset($stone['out_weight'])?$stone['out_weight']:0;?></td>
		  <?php }if($column=='balance'){?>
    	<td class="text-right" style="background-color: yellow;"><?=$stone['in_weight']-$stone['out_weight'];?></td>
    <?php }?>
	  	<td class="text-right"><?=date($stone['created_at'])?></td>
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
