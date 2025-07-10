<div class="boxrow mb-2">
  <div class="float-left">   
    <h6 class="heading blue bold text-uppercase mb-0">Loss Production Reports</h6>
  </div>
</div>
<?php $this->load->view('reports/loss_production_reports/search',$data);?>
<hr>
<div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
      <th>Date</th>
      <th class="text-right">In-Weight</th>
      <th class="text-right">Out-Weight</th>
      <th class="text-right">Fine-Weight</th>
      <th class="text-right">Ghiss</th>
      <th class="text-right">Wastage</th>
      <th class="text-right">Loss</th>
      <th class="text-right">Gross Loss</th>
      <th class="text-right">Fine Loss</th>
      <th class="text-right">Loss %</th>
	  </tr>
	</thead>
	<tbody>
      <?php if(!empty($process_outweights)) {
        $total_outweight = 0;
        $total_loss = 0;
        $total_ghiss = 0;
        $total_wastage = 0;
        $total_loss_gross = 0;
        $total_loss_fine = 0;
        $total_in_weight = 0;
        $total_fine_wt = 0;
        $total_department_workers = 0;
        $total_loss_percentage = 0;
        $department_workers_count = 0;
        foreach ($process_outweights as $index => $process_outweight) {
          $total_outweight += $process_outweight['out_weight'];
          $total_ghiss += $process_outweight['ghiss'];
          $total_in_weight += $process_outweight['in_weight'];
          $total_fine_wt += $process_outweight['balance_fine'];
          $total_wastage += $process_outweight['wastage'];
          $total_loss += (isset($process_outweight['loss'])) ? $process_outweight['loss'] : 0;
          $total_loss_gross += (isset($process_outweight['loss_gross'])) ? $process_outweight['loss_gross'] : 0;
          $total_loss_fine += (isset($process_outweight['loss_fine'])) ? $process_outweight['loss_fine'] : 0;
          $total_loss_percentage += (!empty($process_outweight['loss_fine'])&&$process_outweight['loss_fine']!=0)?$process_outweight['loss_fine']/$process_outweight['out_weight']:0;
      ?>
        <tr>
          <td><?= date('d-m-Y', strtotime($process_outweight['completed_at']))?></td>
          <td class="text-right"><?= four_decimal($process_outweight['in_weight']) ?></td>
          <?php if(!empty($department_process_value)){ ?>
          <td class="text-right"><a href="<?= ADMIN_PATH.'reports/average_production_reports/view?type='.$department_process_value.'&date='.$date.'&'.$_SERVER['QUERY_STRING'];?>" target="_blank"><?= four_decimal($process_outweight['out_weight'])?></a></td>
        <?php }else{?>
          <td class="text-right"><?= four_decimal($process_outweight['out_weight'])?></td>
        <?php }?>
          <td class="text-right"><?= four_decimal($process_outweight['balance_fine']) ?></td>
          <td class="text-right"><?= four_decimal($process_outweight['ghiss']) ?></td>
          <td class="text-right"><?= four_decimal($process_outweight['wastage']) ?></td>
          <td class="text-right"><?= (isset($process_outweight['loss'])) ? four_decimal($process_outweight['loss']) : 0 ?></td>
          <td class="text-right"><?= (isset($process_outweight['loss_gross'])) ? four_decimal($process_outweight['loss_gross']) : 0?></td>
          <td class="text-right"><?= (isset($process_outweight['loss_fine'])) ? four_decimal($process_outweight['loss_fine']) : 0?></td>
          <td class="text-right"><?= (!empty($process_outweight['loss_fine'])&&$process_outweight['loss_fine']!=0)?$process_outweight['loss_fine']/$process_outweight['out_weight']:0;?></td>
          
        </tr>
      <?php } ?>
      
        
      <tr class="bg_gray">
        <td class="bold">Total</td>
        <td class="text-right bold"><?=four_decimal($total_in_weight);?></td>
        <td class="text-right bold"><?=four_decimal($total_outweight);?></td>
        <td class="text-right bold"><?=four_decimal($total_fine_wt);?></td>
        <td class="text-right bold"><?=four_decimal($total_ghiss);?></td>
        <td class="text-right bold"><?=four_decimal($total_wastage);?></td>
        <td class="text-right bold"><?=four_decimal($total_loss);?></td>
        <td class="text-right bold"><?=four_decimal($total_loss_gross);?></td>
        <td class="text-right bold"><?=four_decimal($total_loss_fine);?></td>
        <td class="text-right bold"><?=four_decimal($total_loss_percentage);?></td>
      </tr>
      <?php } else { ?>
        <tr>
          <td colspan="8">No data found.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>