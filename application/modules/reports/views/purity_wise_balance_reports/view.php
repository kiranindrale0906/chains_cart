<div class="row">
<div class="col-sm-12">
<h5 class='blue text-uppercase bold mb-3'>Purity Wise Process Balance Report</h5>
  <div class="table-responsive m-t-10">
  <h6 class='blue text-uppercase bold mb-3'>Purity Wise Process Balance</h6>
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Purity</th>
      <th>Balance </th>
      <th>Balance Gross</th>
      <th>Balance Fine</th>
	  </tr>
	</thead>
	 <tbody>
    <?php
      $total_process_balance = 0;
      $total_process_balance_gross = 0;
      $total_process_balance_fine = 0;
      if(!empty($process_balance_detail)){
        foreach ($process_balance_detail as $process_index => $process_balance) {
          $total_process_balance += $process_balance['balance'];
          $total_process_balance_gross += $process_balance['balance_gross'];
          $total_process_balance_fine += $process_balance['balance_fine'];
          ?>
         <tr>
            <td><?= $process_index ?></td>
            <td><?= four_decimal($process_balance['balance']) ?></td>
            <td><?= four_decimal($process_balance['balance_gross']) ?></td>
            <td><?= four_decimal($process_balance['balance_fine']) ?></td>
          </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"><?=four_decimal($total_process_balance);?></td>
          <td class=" bold"><?=four_decimal($total_process_balance_gross);?></td>
          <td class=" bold"><?=four_decimal($total_process_balance_fine);?></td>
        </tr> 

     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
	</table>
</div>
<div class="table-responsive m-t-10">
  <h6 class='blue text-uppercase bold mb-3'>Purity Wise Melting Wastage Balance</h6>
  <table class="table table-sm fixedthead table-default">
    <thead>
    <tr>
      <th>Purity</th> 
      <th>Balance</th>
      <th>Balance Gross</th>
      <th>Balance Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $total_melting_wastage_balance = 0;
      $total_melting_wastage_balance_gross = 0;
      $total_melting_wastage_balance_fine = 0;
      if(!empty($melting_wastage_detail)){
        foreach ($melting_wastage_detail as $index => $wastage_balance) {
          $total_melting_wastage_balance += $wastage_balance['balance'];
          $total_melting_wastage_balance_gross += $wastage_balance['balance_gross'];
          $total_melting_wastage_balance_fine += $wastage_balance['balance_fine'];
          ?>
         <tr>
            <td><?= $index ?></td>
            <td><?= four_decimal($wastage_balance['balance']) ?></td>
            <td><?= four_decimal($wastage_balance['balance_gross']) ?></td>
            <td><?= four_decimal($wastage_balance['balance_fine']) ?></td>
          </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"><?=four_decimal($total_melting_wastage_balance);?></td>
          <td class=" bold"><?=four_decimal($total_melting_wastage_balance_gross);?></td>
          <td class=" bold"><?=four_decimal($total_melting_wastage_balance_fine);?></td>
        </tr> 

     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
  </table>
</div>

<div class="table-responsive m-t-10">
  <h6 class='blue text-uppercase bold mb-3'>Purity Wise Daily Drawer Wastage Balance</h6>
 
  <table class="table table-sm fixedthead table-default">
    <thead>
    <tr>
      <th>Purity</th> 
      <th>Balance</th>
      <th>Balance Gross</th>
      <th>Balance Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $total_daily_drawer_wastage_balance = 0;
      $total_daily_drawer_wastage_balance_gross = 0;
      $total_daily_drawer_wastage_balance_fine = 0;
      if(!empty($daily_drawer_wastage_detail)){
        foreach ($daily_drawer_wastage_detail as $daily_drawer_wastage_index => $daily_drawer_wastage_balance) {
          $total_daily_drawer_wastage_balance += $daily_drawer_wastage_balance['balance'];
          $total_daily_drawer_wastage_balance_gross += $daily_drawer_wastage_balance['balance_gross'];
          $total_daily_drawer_wastage_balance_fine += $daily_drawer_wastage_balance['balance_fine'];
          ?>
         <tr>
            <td><?= $daily_drawer_wastage_index ?></td>
            <td><?= four_decimal($daily_drawer_wastage_balance['balance']) ?></td>
            <td><?= four_decimal($daily_drawer_wastage_balance['balance_gross']) ?></td>
            <td><?= four_decimal($daily_drawer_wastage_balance['balance_fine']) ?></td>
          </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"><?=four_decimal($total_daily_drawer_wastage_balance);?></td>
          <td class=" bold"><?=four_decimal($total_daily_drawer_wastage_balance_gross);?></td>
          <td class=" bold"><?=four_decimal($total_daily_drawer_wastage_balance_fine);?></td>
        </tr> 

     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
  </table>
</div>
<div class="table-responsive m-t-10">
  <h6 class='blue text-uppercase bold mb-3'>Purity Wise Hcl Wastage Balance</h6>
  <table class="table table-sm fixedthead table-default">
    <thead>
    <tr>
      <th>Purity</th>
      <th>Balance</th>
      <th>Balance Gross</th>
      <th>Balance Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $total_hcl_wastage_balance = 0;
      $total_hcl_wastage_balance_gross = 0;
      $total_hcl_wastage_balance_fine = 0;
      if(!empty($hcl_wastage_detail)){
        foreach ($hcl_wastage_detail as $hcl_wastage_index => $hcl_wastage_balance) {
          $total_hcl_wastage_balance += $hcl_wastage_balance['balance'];
          $total_hcl_wastage_balance_gross += $hcl_wastage_balance['balance_gross'];
          $total_hcl_wastage_balance_fine += $hcl_wastage_balance['balance_fine'];
          ?>
         <tr>
            <td><?= $hcl_wastage_index ?></td>
            <td><?= four_decimal($hcl_wastage_balance['balance']) ?></td>
            <td><?= four_decimal($hcl_wastage_balance['balance_gross']) ?></td>
            <td><?= four_decimal($hcl_wastage_balance['balance_fine']) ?></td>
          </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"><?=four_decimal($total_hcl_wastage_balance);?></td>
          <td class=" bold"><?=four_decimal($total_hcl_wastage_balance_gross);?></td>
          <td class=" bold"><?=four_decimal($total_hcl_wastage_balance_fine);?></td>
        </tr> 

     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
  </table>
</div>
<div class="table-responsive m-t-10">
  <h6 class='blue text-uppercase bold mb-3'>Purity Wise Daily Drawer Balance</h6>
 
  <table class="table table-sm fixedthead table-default">
    <thead>
    <tr>
      <th>Purity</th> 
      <th>Balance</th>
      <th>Balance Gross</th>
      <th>Balance Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $total_karigar_drawer_balance = 0;
      $total_karigar_drawer_balance_gross = 0;
      $total_karigar_drawer_balance_fine = 0;
      $karigar_balance=0;
      if(!empty($karigar_daily_drawers)){
        foreach ($karigar_daily_drawers as $karigar_drawer_index => $karigar_drawer_balance) {
          $karigar_balance=$karigar_drawer_balance['in']-$karigar_drawer_balance['out'];
          $karigar_balance_fine=(($karigar_balance*$karigar_drawer_index)/100);
          $total_karigar_drawer_balance += $karigar_balance;
          $total_karigar_drawer_balance_gross += $karigar_balance;
          $total_karigar_drawer_balance_fine += $karigar_balance_fine;
          ?>
         <tr>
            <td><?= $karigar_drawer_index ?></td>
            <td><?= four_decimal($karigar_balance) ?></td>
            <td><?= four_decimal($karigar_balance) ?></td>
            <td><?= four_decimal($karigar_balance_fine) ?></td>
          </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"><?=four_decimal($total_karigar_drawer_balance);?></td>
          <td class=" bold"><?=four_decimal($total_karigar_drawer_balance_gross);?></td>
          <td class=" bold"><?=four_decimal($total_karigar_drawer_balance_fine);?></td>
        </tr> 

     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
  </table>
</div>

<?php 
  if (!empty($hcl_ghiss_detail))
    $this->load->view('reports/purity_wise_balance_reports/purity_wise_details', array('title' => 'HCL Ghiss', 'balances' => $hcl_ghiss_detail)); 

  if (!empty($ghiss_detail))
    $this->load->view('reports/purity_wise_balance_reports/purity_wise_details', array('title' => 'Ghiss', 'balances' => $ghiss_detail)); 

  if (!empty($pending_ghiss_detail))
    $this->load->view('reports/purity_wise_balance_reports/purity_wise_details', array('title' => 'Pending Ghiss', 'balances' => $pending_ghiss_detail)); 

  if (!empty($loss_detail))
    $this->load->view('reports/purity_wise_balance_reports/purity_wise_details', array('title' => 'Loss', 'balances' => $loss_detail)); 
?>

 
 <div class="table-responsive m-t-10">
  <h6 class='blue text-uppercase bold mb-3'>GPC Out Process Balance</h6>
  <table class="table table-sm fixedthead table-default">
    <thead>
    <tr>
      <th>Purity</th>
      <th>Balance </th>
      <th>Balance Gross</th>
      <th>Balance Fine</th>
    </tr>
  </thead>
   <tbody>
    <?php
      $total_gpc_out_balance = 0;
      $total_gpc_out_balance_gross = 0;
      $total_gpc_out_balance_fine = 0;
      //pd($gpc_out);
      if(!empty($gpc_out_detail)){
        foreach ($gpc_out_detail as $gpc_out_index => $gpc_out_balance) {
          $total_gpc_out_balance += $gpc_out_balance['balance'];
          $total_gpc_out_balance_gross += $gpc_out_balance['balance_gross'];
          $total_gpc_out_balance_fine += $gpc_out_balance['balance_fine'];
          ?>
         <tr>
            <td><?= $gpc_out_index ?></td>
            <td><?= four_decimal($gpc_out_balance['balance']) ?></td>
            <td><?= four_decimal($gpc_out_balance['balance_gross']) ?></td>
            <td><?= four_decimal($gpc_out_balance['balance_fine']) ?></td>
          </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"><?=four_decimal($total_gpc_out_balance);?></td>
          <td class=" bold"><?=four_decimal($total_gpc_out_balance_gross);?></td>
          <td class=" bold"><?=four_decimal($total_gpc_out_balance_fine);?></td>
        </tr> 

     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
  </table>
</div>
<div class="table-responsive m-t-10">
     <h6 class='blue text-uppercase bold mb-3'>Total Purity Wise <?= $title ?></h6>
  <table class="table table-sm fixedthead table-default">
    <thead>
    <tr>
      <th>Purity</th> 
      <th>Balance</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <td>100%</td>
      <td><?=(!empty($process_balance_detail['100%']['balance_gross'])?$process_balance_detail['100%']['balance_gross']:0)+(!empty($melting_wastage_detail['100%']['balance_gross'])?$melting_wastage_detail['100%']['balance_gross']:0)+(!empty($daily_drawer_wastage_detail['100%']['balance_gross'])?$daily_drawer_wastage_detail['100%']['balance_gross']:0)+(!empty($hcl_wastage_detail['100%']['balance_gross'])?$hcl_wastage_detail['100%']['balance_gross']:0)+(!empty($karigar_daily_drawers['100%']['in'])&&!empty($karigar_daily_drawers['100%']['out'])?$karigar_daily_drawers['100%']['in']-$karigar_daily_drawers['100%']['out']:0)+(!empty($hcl_ghiss_detail['100%']['balance_gross'])?$hcl_ghiss_detail['100%']['balance_gross']:0)+(!empty($ghiss_detail['100%']['balance_gross'])?$ghiss_detail['100%']['balance_gross']:0)+(!empty($pending_ghiss_detail['100%']['balance_gross'])?$pending_ghiss_detail['100%']['balance_gross']:0)+(!empty($loss_detail['100%']['balance_gross'])?$loss_detail['100%']['balance_gross']:0)+(!empty($gpc_out_detail['100%']['balance_gross'])?$gpc_out_detail['100%']['balance_gross']:0)?></td>
    </tr> 
    <tr>
      <td>88% +</td>
      <td><?=(!empty($process_balance_detail['88% +']['balance_gross'])?$process_balance_detail['88% +']['balance_gross']:0)+(!empty($melting_wastage_detail['88% +']['balance_gross'])?$melting_wastage_detail['88% +']['balance_gross']:0)+(!empty($daily_drawer_wastage_detail['88% +']['balance_gross'])?$daily_drawer_wastage_detail['88% +']['balance_gross']:0)+(!empty($hcl_wastage_detail['88% +']['balance_gross'])?$hcl_wastage_detail['88% +']['balance_gross']:0)+(!empty($karigar_daily_drawers['88% +']['in'])&&!empty($karigar_daily_drawers['88% +']['out'])?$karigar_daily_drawers['88% +']['in']-$karigar_daily_drawers['88% +']['out']:0)+(!empty($hcl_ghiss_detail['88% +']['balance_gross'])?$hcl_ghiss_detail['88% +']['balance_gross']:0)+(!empty($ghiss_detail['88% +']['balance_gross'])?$ghiss_detail['88% +']['balance_gross']:0)+(!empty($pending_ghiss_detail['88% +']['balance_gross'])?$pending_ghiss_detail['88% +']['balance_gross']:0)+(!empty($loss_detail['88% +']['balance_gross'])?$loss_detail['88% +']['balance_gross']:0)+(!empty($gpc_out_detail['88% +']['balance_gross'])?$gpc_out_detail['88% +']['balance_gross']:0)?></td>
    </tr>
    <tr>
      <td>80% - 88%</td>
      <td><?=(!empty($process_balance_detail['80% - 88%']['balance_gross'])?$process_balance_detail['80% - 88%']['balance_gross']:0)+(!empty($melting_wastage_detail['80% - 88%']['balance_gross'])?$melting_wastage_detail['80% - 88%']['balance_gross']:0)+(!empty($daily_drawer_wastage_detail['80% - 88%']['balance_gross'])?$daily_drawer_wastage_detail['80% - 88%']['balance_gross']:0)+(!empty($hcl_wastage_detail['80% - 88%']['balance_gross'])?$hcl_wastage_detail['80% - 88%']['balance_gross']:0)+(!empty($karigar_daily_drawers['80% - 88%']['in'])&&!empty($karigar_daily_drawers['80% - 88%']['out'])?$karigar_daily_drawers['80% - 88%']['in']-$karigar_daily_drawers['80% - 88%']['out']:0)+(!empty($hcl_ghiss_detail['80% - 88%']['balance_gross'])?$hcl_ghiss_detail['80% - 88%']['balance_gross']:0)+(!empty($ghiss_detail['80% - 88%']['balance_gross'])?$ghiss_detail['80% - 88%']['balance_gross']:0)+(!empty($pending_ghiss_detail['80% - 88%']['balance_gross'])?$pending_ghiss_detail['80% - 88%']['balance_gross']:0)+(!empty($loss_detail['80% - 88%']['balance_gross'])?$loss_detail['80% - 88%']['balance_gross']:0)+(!empty($gpc_out_detail['80% - 88%']['balance_gross'])?$gpc_out_detail['80% - 88%']['balance_gross']:0)?></td>
    </tr>
    <tr>
      <td>70% - 80%</td>
      <td><?=(!empty($process_balance_detail['70% - 80%']['balance_gross'])?$process_balance_detail['70% - 80%']['balance_gross']:0)+(!empty($melting_wastage_detail['70% - 80%']['balance_gross'])?$melting_wastage_detail['70% - 80%']['balance_gross']:0)+(!empty($daily_drawer_wastage_detail['70% - 80%']['balance_gross'])?$daily_drawer_wastage_detail['70% - 80%']['balance_gross']:0)+(!empty($hcl_wastage_detail['70% - 80%']['balance_gross'])?$hcl_wastage_detail['70% - 80%']['balance_gross']:0)+(!empty($karigar_daily_drawers['70% - 80%']['in'])&&!empty($karigar_daily_drawers['70% - 80%']['out'])?$karigar_daily_drawers['70% - 80%']['in']-$karigar_daily_drawers['70% - 80%']['out']:0)+(!empty($hcl_ghiss_detail['70% - 80%']['balance_gross'])?$hcl_ghiss_detail['70% - 80%']['balance_gross']:0)+(!empty($ghiss_detail['70% - 80%']['balance_gross'])?$ghiss_detail['70% - 80%']['balance_gross']:0)+(!empty($pending_ghiss_detail['70% - 80%']['balance_gross'])?$pending_ghiss_detail['70% - 80%']['balance_gross']:0)+(!empty($loss_detail['70% - 80%']['balance_gross'])?$loss_detail['70% - 80%']['balance_gross']:0)+(!empty($gpc_out_detail['70% - 80%']['balance_gross'])?$gpc_out_detail['70% - 80%']['balance_gross']:0)?></td>
    </tr>
    <tr>
      <td>50% - 60%</td>
      <td><?=(!empty($process_balance_detail['50% - 60%']['balance_gross'])?$process_balance_detail['50% - 60%']['balance_gross']:0)+(!empty($melting_wastage_detail['50% - 60%']['balance_gross'])?$melting_wastage_detail['50% - 60%']['balance_gross']:0)+(!empty($daily_drawer_wastage_detail['50% - 60%']['balance_gross'])?$daily_drawer_wastage_detail['50% - 60%']['balance_gross']:0)+(!empty($hcl_wastage_detail['50% - 60%']['balance_gross'])?$hcl_wastage_detail['50% - 60%']['balance_gross']:0)+(!empty($hcl_ghiss_detail['50% - 60%']['balance_gross'])?$hcl_ghiss_detail['50% - 60%']['balance_gross']:0)+(!empty($ghiss_detail['50% - 60%']['balance_gross'])?$ghiss_detail['50% - 60%']['balance_gross']:0)+(!empty($pending_ghiss_detail['50% - 60%']['balance_gross'])?$pending_ghiss_detail['50% - 60%']['balance_gross']:0)+(!empty($loss_detail['50% - 60%']['balance_gross'])?$loss_detail['50% - 60%']['balance_gross']:0)+(!empty($gpc_out_detail['50% - 60%']['balance_gross'])?$gpc_out_detail['50% - 60%']['balance_gross']:0)+(!empty($karigar_daily_drawers['50% - 60%']['in'])&&!empty($karigar_daily_drawers['50% - 60%']['out'])?$karigar_daily_drawers['50% - 60%']['in']-$karigar_daily_drawers['50% - 60%']['out']:0)?></td>
    </tr>
    <tr>
      <td>40% - 50%</td>
      <td><?=(!empty($process_balance_detail['40% - 50%']['balance_gross'])?$process_balance_detail['40% - 50%']['balance_gross']:0)+(!empty($melting_wastage_detail['40% - 50%']['balance_gross'])?$melting_wastage_detail['40% - 50%']['balance_gross']:0)+(!empty($daily_drawer_wastage_detail['40% - 50%']['balance_gross'])?$daily_drawer_wastage_detail['40% - 50%']['balance_gross']:0)+(!empty($hcl_wastage_detail['40% - 50%']['balance_gross'])?$hcl_wastage_detail['40% - 50%']['balance_gross']:0)+(!empty($hcl_ghiss_detail['40% - 50%']['balance_gross'])?$hcl_ghiss_detail['40% - 50%']['balance_gross']:0)+(!empty($ghiss_detail['40% - 50%']['balance_gross'])?$ghiss_detail['40% - 50%']['balance_gross']:0)+(!empty($pending_ghiss_detail['40% - 50%']['balance_gross'])?$pending_ghiss_detail['40% - 50%']['balance_gross']:0)+(!empty($loss_detail['40% - 50%']['balance_gross'])?$loss_detail['40% - 50%']['balance_gross']:0)+(!empty($gpc_out_detail['40% - 50%']['balance_gross'])?$gpc_out_detail['40% - 50%']['balance_gross']:0)+(!empty($karigar_daily_drawers['40% - 50%']['in'])&&!empty($karigar_daily_drawers['40% - 50%']['out'])?$karigar_daily_drawers['40% - 50%']['in']-$karigar_daily_drawers['40% - 50%']['out']:0)?></td>
    </tr>
    <tr>
      <td>30% - 40%</td>
      <td><?=(!empty($process_balance_detail['30% - 40%']['balance_gross'])?$process_balance_detail['30% - 40%']['balance_gross']:0)+(!empty($melting_wastage_detail['30% - 40%']['balance_gross'])?$melting_wastage_detail['30% - 40%']['balance_gross']:0)+(!empty($daily_drawer_wastage_detail['30% - 40%']['balance_gross'])?$daily_drawer_wastage_detail['30% - 40%']['balance_gross']:0)+(!empty($hcl_wastage_detail['30% - 40%']['balance_gross'])?$hcl_wastage_detail['30% - 40%']['balance_gross']:0)+(!empty($hcl_ghiss_detail['30% - 40%']['balance_gross'])?$hcl_ghiss_detail['30% - 40%']['balance_gross']:0)+(!empty($ghiss_detail['30% - 40%']['balance_gross'])?$ghiss_detail['30% - 40%']['balance_gross']:0)+(!empty($pending_ghiss_detail['30% - 40%']['balance_gross'])?$pending_ghiss_detail['30% - 40%']['balance_gross']:0)+(!empty($loss_detail['30% - 40%']['balance_gross'])?$loss_detail['30% - 40%']['balance_gross']:0)+(!empty($gpc_out_detail['30% - 40%']['balance_gross'])?$gpc_out_detail['30% - 40%']['balance_gross']:0)+(!empty($karigar_daily_drawers['30% - 40%']['in'])&&!empty($karigar_daily_drawers['30% - 40%']['out'])?$karigar_daily_drawers['30% - 40%']['in']-$karigar_daily_drawers['30% - 40%']['out']:0)?></td>
    </tr>
    </tbody>
  </table>
 </div>
</div>
</div>