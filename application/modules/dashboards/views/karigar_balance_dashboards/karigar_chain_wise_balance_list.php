<?php 
if(!empty($total_karigar_wise_balances)){
foreach ($total_karigar_wise_balances as $total_karigar_balance_index => $chain_wise_columns) {
?>
<div class='col-sm-6'>
    <br><h6 class="bold"><?=$total_karigar_balance_index?></h6>
    <table class="table table-sm fixedthead table-default">
    <thead>
    	  <tr>
          <th>Parent Lot Name</th>
    	    <th>Department Name</th>
          <th>Balance</th>
    	  </tr>
    	</thead>
    	<tbody>
        <?php 
        $balance=0;
        if(!empty($chain_wise_columns)){
        	foreach ($chain_wise_columns as $index => $chain_wise_balance) {
        		$balance+=$chain_wise_balance['balance'];
              ?>
             <tr>
                </td><td><?= !empty($index)?$index:'-' ?></td>
                </td><td><?= !empty($chain_wise_balance['department_name'])?$chain_wise_balance['department_name']:'-' ?></td>
                <td><?= four_decimal($chain_wise_balance['balance']) ?></td>
              </tr> 
        <?php }
        ?>
    		<tr class="bg_gray">
          <td class=" bold">Total</td>
    			<td class=" bold"></td>
    			<td class=" bold"><?=four_decimal($balance);?></td>
    		</tr>
        <?php }else{ ?>
            <tr>
              <td>No Record Found.</td>
            </tr>
          <?php }?>
         
      </tbody>
 </table>
</div>
<?php }}?>    	