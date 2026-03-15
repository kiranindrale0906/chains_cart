<div class="boxrow mb-2">
  <div class="float-left">   
    <h6 class="heading blue bold text-uppercase mb-0">Machine No Production Reports</h6>
  </div>
</div>
<?php $this->load->view('reports/machine_no_production_reports/search',$data);?>
<hr>
<div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
      <th>Date</th>
      <!-- <th >Department Name</th> -->
      <th><?= ($record['group_by']=='Machine Size') ? 'Machine Size' : 'Machine No' ?></th>
      <th class="text-right">Capacity</th>
      <th class="text-right">Count</th>
      <th class="text-right">Total Capacity</th>
      <th class="text-right">Production</th>
      <th class="text-right">Under Utilization</th>
      <th class="text-right">Utilization (%)</th>
      <th ></th>
	  </tr>
	</thead>
	<tbody>
      <?php if(!empty($outweights)) {
        $total_outweight =$total_shortfall= $total_capacity=0;
        foreach ($outweights as $machine_no => $machine_outweights) {
          foreach ($machine_outweights as $date => $process_outweight) {
            $total_outweight += $process_outweight['out_weight'];
            $total_capacity += ($process_outweight['capacity'] * $process_outweight['machine_count']);
            $total_shortfall += $process_outweight['shortfall']; ?>
            <tr class="<?= $process_outweight['shortfall'] > 0 ? 'red' : 'green' ?>">
              <td><?= $date ?></td>
              <td ><?=($machine_no)  ?></td>
              <td class="text-right"><?= two_decimal($process_outweight['capacity'])?></td>
              <td class="text-right"><?= two_decimal($process_outweight['machine_count'])?></td>
              <td class="text-right"><?= two_decimal($process_outweight['capacity'] * $process_outweight['machine_count'])?></td>
              <td class="text-right"><?= two_decimal($process_outweight['out_weight'])?></td>
              <td class="text-right"><?= two_decimal($process_outweight['shortfall'])?></td>
              <td class="text-right"><?= two_decimal($process_outweight['out_weight'] * 100
                                                      / ($process_outweight['capacity'] * $process_outweight['machine_count'])); ?></td>
            </tr>
            <?php 
          } 
        } ?>
        <tr class="bg_gray">
        <td class="bold">Total</td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right bold"><?=two_decimal($total_capacity);?></td>
        <td class="text-right bold"><?=two_decimal($total_outweight);?></td>
        <td class="text-right bold"><?=two_decimal($total_shortfall);?></td>
        <td></td>
      </tr>
      <?php } else { ?>
        <tr>
          <td colspan="8">No data found.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>