<div class="table-responsive m-t-20">
<?php
$column_name=($column=='in_weight')?'In':'Out';
?>
<h6 class="bold">Wastage <?=$column_name?> Weight </h6>

<table class="table table-sm fixedthead table-default">
<thead>
  <tr>
    <th>Lot No</th>
    <th>Product Name</th>
    <th>Process Name</th>
    <th>Department Name</th>
    <th>Type</th>
    <th>Karigar</th>
    <th>Purity</th>
     <?php if($column=='in_weight' || $column=='balance'){?>
    <th class="text-right">IN Weight</th>
    <?php }if($column=='out_weight' || $column=='balance'){?>
    <th class="text-right">OUT Weight</th>
    <?php }if($column=='issue_weight' || $column=='balance'){?>
    <th class="text-right">Issue Weight</th>
    <?php }if($column=='balance'){?>
    <th class="text-right">Balance</th>
    <?php }?>
    <th class="text-right">Date</th>
  </tr>
</thead>
<tbody>
<?php
$sum_of_in_weight=$sum_of_out_weight=$sum_of_balance=$sum_of_issue_weight=0;
 foreach ($wastage_weights as $index => $wastage_weight) {
			 $sum_of_in_weight+=$wastage_weight['in_weight'];
             $sum_of_out_weight+=$wastage_weight['out_weight'];
			 $sum_of_issue_weight+=$wastage_weight['issue_weight'];
			 $sum_of_balance+=$wastage_weight['in_weight']-$wastage_weight['out_weight']-$wastage_weight['issue_weight'];
 	?>
	  <tr>
	  	<td><?=$wastage_weight['lot_no']?></td>
	  	<td><?=$wastage_weight['product_name']?></td>
	  	<td><?=$wastage_weight['process_name']?></td>
	  	<td><?=$wastage_weight['department_name']?></td>
	  	<td><?=$wastage_weight['process_name']?></td>
	  	<td><?=$wastage_weight['karigar']?></td>
        <td><?=$wastage_weight['hook_kdm_purity']?></td>
	  	<?php if($column=='in_weight' || $column=='balance'){?>
	  	<td class="text-right" style="background-color: yellow;"><?=isset($wastage_weight['in_weight'])?$wastage_weight['in_weight']:0;?></td>
	  	<?php } if($column=='out_weight' || $column=='balance'){?>
		  <td class="text-right" style="background-color: yellow;"><?=isset($wastage_weight['out_weight'])?$wastage_weight['out_weight']:0;?></td>
        <?php }if($column=='issue_weight' || $column=='balance'){?>
           <td class="text-right" style="background-color: yellow;"><?=isset($wastage_weight['issue_weight'])?$wastage_weight['issue_weight']:0;?></td>
		  <?php }if($column=='balance'){?>
    	<td class="text-right" style="background-color: yellow;"><?=$wastage_weight['in_weight']-$wastage_weight['out_weight']-$wastage_weight['issue_weight'];?></td>
    <?php }?>
	  	<td class="text-right"><?=date($wastage_weight['created_at'])?></td>
	  </tr>
<?php } ?>
<tr class="bg_gray bold">
<td>Total</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<?php if($column=='in_weight' || $column=='balance'){?>
    <td class="text-right"><?=$sum_of_in_weight?></td>
    <?php }if($column=='out_weight' || $column=='balance'){?>
    <td class="text-right"><?=$sum_of_out_weight?></td>
    <?php }if($column=='issue_weight' || $column=='balance'){?>
    <td class="text-right"><?=$sum_of_issue_weight?></td>
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
