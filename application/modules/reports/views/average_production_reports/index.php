<div class="boxrow mb-2">
  <div class="float-left">   
    <h6 class="heading blue bold text-uppercase mb-0">Average Production Reports</h6>
  </div>
</div>
<?php $this->load->view('reports/average_production_reports/search',$data);?>
<hr>
<div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
      <th>Date</th>
      <th class="text-right">In-Weight</th>
      <th class="text-right">Out-Weight</th>
      <!-- <th class="text-right">Fine-Weight</th>
      <th class="text-right">Ghiss</th>
      <th class="text-right">Wastage</th> -->
      <th class="text-right">Loss</th>
     <!--  <th class="text-right">Gross Loss</th>
      <th class="text-right">Fine Loss</th> -->
      <th class="text-right">Workers Count</th>
      <th class="text-right">Average Production</th>
      <th class="text-right">Average Per Kg Loss</th>
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
        foreach ($process_outweights as $date => $process_outweight) {
          if(isset($department_workers[$date])) {
            $department_workers_count = $department_workers[$date][0]['workers_count'];
          }
          $total_outweight += $process_outweight[0]['out_weight'];
          $total_ghiss += $process_outweight[0]['ghiss'];
          $total_in_weight += $process_outweight[0]['in_weight'];
          $total_fine_wt += $process_outweight[0]['balance_fine'];
          $total_wastage += $process_outweight[0]['wastage'];
          $total_loss += (isset($process_loss[$date])) ? $process_loss[$date][0]['loss'] : 0;
          $total_loss_gross += (isset($process_loss[$date])) ? $process_loss[$date][0]['loss_gross'] : 0;
          $total_loss_fine += (isset($process_loss[$date])) ? $process_loss[$date][0]['loss_fine'] : 0;
          $total_department_workers += $department_workers_count;
          $total_loss_percentage += (!empty($process_loss[$date][0]['loss_fine'])&&$process_loss[$date][0]['loss_fine']!=0)?$process_loss[$date][0]['loss_fine']/$process_outweight[0]['out_weight']:0;
      ?>
        <tr>
          <td><?= date('d-m-Y', strtotime($date))?></td>
          <td class="text-right"><?= four_decimal($process_outweight[0]['in_weight']) ?></td>
          <?php if(!empty($department_process_value)){ ?>
          <td class="text-right"><a href="<?= ADMIN_PATH.'reports/average_production_reports/view?type='.$department_process_value.'&date='.$date.'&'.$_SERVER['QUERY_STRING'];?>" target="_blank"><?= four_decimal($process_outweight[0]['out_weight'])?></a></td>
        <?php }else{?>
          <td class="text-right"><?= four_decimal($process_outweight[0]['out_weight'])?></td>
        <?php }?>
         <!--  <td class="text-right"><?//= four_decimal($process_outweight[0]['balance_fine']) ?></td>
          <td class="text-right"><?//= four_decimal($process_outweight[0]['ghiss']) ?></td>
          <td class="text-right"><?//= four_decimal($process_outweight[0]['wastage']) ?></td>
          --> <td class="text-right"><?= (isset($process_loss[$date])) ? four_decimal($process_loss[$date][0]['loss']) : 0 ?></td>
          <!-- <td class="text-right"><?//= (isset($process_loss[$date])) ? four_decimal($process_loss[$date][0]['loss_gross']) : 0?></td>
          <td class="text-right"><?//= (isset($process_loss[$date])) ? four_decimal($process_loss[$date][0]['loss_fine']) : 0?></td> -->
          <td class="text-right"><?= $department_workers_count; ?></td>
          <td class="text-right"><?= ($department_workers_count!=0) ? four_decimal($process_outweight[0]['out_weight']/$department_workers_count) : 'NA'?></td>
          <td class="text-right">
            <?php if($process_outweight[0]['out_weight']!=0) { ?>
              <?= (isset($process_loss[$date])) ? four_decimal(($process_loss[$date][0]['loss_fine']/$process_outweight[0]['out_weight'])*1000) : 0?>
            <?php } else { 
              echo 'NA';
            }?>
           
        </tr>
      <?php } ?>
      
        
      <tr class="bg_gray">
        <td class="bold">Total</td>
        <td class="text-right bold"><?=four_decimal($total_in_weight);?></td>
        <td class="text-right bold"><?=four_decimal($total_outweight);?></td><!-- 
        <td class="text-right bold"><?//=four_decimal($total_fine_wt);?></td>
        <td class="text-right bold"><?//=four_decimal($total_ghiss);?></td>
        <td class="text-right bold"><?//=four_decimal($total_wastage);?></td> -->
        <td class="text-right bold"><?=four_decimal($total_loss);?></td><!-- 
        <td class="text-right bold"><?//=four_decimal($total_loss_gross);?></td>
        <td class="text-right bold"><?//=four_decimal($total_loss_fine);?></td> -->
        <td class="text-right bold"><?=$total_department_workers;?></td>
        <td class="text-right bold"><?=($total_department_workers!=0) ? four_decimal($total_outweight/$total_department_workers) : 'NA'?></td>
        <td class="text-right bold"><?=($total_outweight!=0) ? four_decimal(($total_loss_fine/$total_outweight)*1000) : 'NA'?></td>
      </tr>
      <?php } else { ?>
        <tr>
          <td colspan="8">No data found.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>