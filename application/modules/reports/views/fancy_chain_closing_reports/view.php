<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Fancy Chain Closing Report</h6>
<div>
  <?php
    load_field('dropdown', array('field' => 'in_lot_purity',
                                 'option' => @$purities));
  ?>
</div>
<div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th></th>
      <th>Purity</th>
      <th>Balance</th>
      <th>Balance Fine</th>
	  </tr>
	</thead>
	<tbody>
    <?php 
    $factory_hold=0;
    $chain_making=$chain_making_75=$chain_making_balance=$chain_making_balance_fine=$chain_making_75_balance=$chain_making_75_balance_fine=$fancy_hold_balance=$fancy_hold_balance_fine=0;
    $daily_drawer_count=0;
    if(!empty($fancy_hold_details)){
    foreach ($fancy_hold_details as $index => $fancy_hold_detail) {
      $fancy_hold_balance+=$fancy_hold_detail['balance'];
      $fancy_hold_balance_fine+=$fancy_hold_detail['balance_fine'];
      ?>
    <tr>
      <td><?=($factory_hold==0)?'Fancy Hold':''?></td>
      <td><?= !empty($fancy_hold_detail['in_lot_purity'])?four_decimal($fancy_hold_detail['in_lot_purity']):'-' ?></td>
      <td><?= !empty($fancy_hold_detail['balance'])?four_decimal($fancy_hold_detail['balance']):'-' ?></td>
      <td><?= !empty($fancy_hold_detail['balance_fine'])?four_decimal($fancy_hold_detail['balance_fine']):'-'?></td>
    </tr>
    <?php $factory_hold++;
      }?>
      <tr class='bold bg_cyan'>
      <td>Total</td>
      <td></td>
      <td><?= four_decimal($fancy_hold_balance); ?></td>
      <td><?= four_decimal($fancy_hold_balance_fine)?></td>
    </tr>
     <?php } 
      if(!empty($fancy_chain_making_details)){
      foreach ($fancy_chain_making_details as $index => $fancy_chain_making_detail) {
        $chain_making_balance+=$fancy_chain_making_detail['balance'];
        $chain_making_balance_fine+=$fancy_chain_making_detail['balance_fine'];
      ?>
    <tr>
      <td><?=($chain_making==0)?'Chain Making':''?></td>
      <td><?= !empty($fancy_chain_making_detail['in_lot_purity'])?four_decimal($fancy_chain_making_detail['in_lot_purity']):'-' ?></td>
      <td><?= !empty($fancy_chain_making_detail['balance'])?four_decimal($fancy_chain_making_detail['balance']):'-' ?></td>
      <td><?= !empty($fancy_chain_making_detail['balance_fine'])?four_decimal($fancy_chain_making_detail['balance_fine']):'-'?></td>
    </tr>
    <?php $chain_making++;
      }?>
      <tr class='bold bg_cyan'>
      <td>Total</td>
      <td></td>
      <td><?= four_decimal($chain_making_balance); ?></td>
      <td><?= four_decimal($chain_making_balance_fine)?></td>
    </tr>
     <?php }
      if(!empty($fancy_chain_making_75_details)){
      foreach ($fancy_chain_making_75_details as $index => $fancy_chain_making_75_detail) {
        $chain_making_75_balance+=$fancy_chain_making_75_detail['balance'];
        $chain_making_75_balance_fine+=$fancy_chain_making_75_detail['balance_fine'];
      ?>
    <tr>
      <td><?=($chain_making_75==0)?'Chain Making 75':''?></td>
      <td><?= !empty($fancy_chain_making_75_detail['in_lot_purity'])?four_decimal($fancy_chain_making_75_detail['in_lot_purity']):'-' ?></td>
      <td><?= !empty($fancy_chain_making_75_detail['balance'])?four_decimal($fancy_chain_making_75_detail['balance']):'-' ?></td>
      <td><?= !empty($fancy_chain_making_75_detail['balance_fine'])?four_decimal($fancy_chain_making_75_detail['balance_fine']):'-'?></td>
    </tr>
    <?php $chain_making++;
      }?>
      <tr class='bold bg_cyan'>
      <td>Total</td>
      <td></td>
      <td><?= four_decimal($chain_making_75_balance); ?></td>
      <td><?= four_decimal($chain_making_75_balance_fine)?></td>
    </tr>
     <?php } 
     $total_balance=$total_balance_fine=0;
     foreach ($daily_drawers as $index => $daily_drawer) {
      $balance=$daily_drawer['in']-$daily_drawer['out'];
      $total_balance+=$balance;
      $total_balance_fine+=($balance*$index/100);
      ?>
      <tr>
        <td><?=($daily_drawer_count==0)?'Daily Drawer Fancy':''?></td>
        <td><?= !empty($index)?four_decimal($index):'-' ?></td>
        <td><?= $balance=!empty($balance)?four_decimal($balance):0 ?></td>
        <td><?= $balance_fine=!empty($balance)?four_decimal($balance*$index/100):0 ?></td>
      </tr>
    <?php $daily_drawer_count++; } ?>
    <tr class='bold bg_cyan'>
      <td>Total</td>
      <td></td>
      <td><?= four_decimal($total_balance); ?></td>
      <td><?= four_decimal($total_balance_fine)?></td>
    </tr>
    </tbody>
	</table>
</div>
</div>
</div>