<div class="boxrow mb-2">
  <div class="float-left">   
    <h6 class="heading blue bold text-uppercase mb-0">Person Production Reports</h6>
  </div>
</div>
<?php $this->load->view('reports/person_production_charts/search',$data);?>
<hr>
<div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
    <thead>
    <tr>
      <th>SR No</th>
      <th>Deapartment Name</th>
      <th class="text-right">No Of Person</th>
      <th class="text-right">Production</th>
      <th class="text-right">Per Person Production</th>
      <th class="text-right">Per Person Per Day</th>
      <th class="text-right">Working Day</th>
    </tr>
  </thead>
  <tbody>
      <?php if(!empty($process_outweights)) {
        $total_outweight =$person_count=$per_person_production=$working_day= 0;
        $i=1;
        foreach ($process_outweights as $department_name => $process_outweight) {
          $workers_count=$process_outweight['worker_count'];
          $total_outweight+=$process_outweight['out_weight'];
          $working_day=30;
        ?>
        <tr>
          <td><?= $i?></td>
          <td><?= $department_name?></td>
          <td class="text-right"><?=$person_count= four_decimal($workers_count) ?></td>
          <td class="text-right"><?= four_decimal($process_outweight['out_weight']) ?></td>
          <td class="text-right"><?=$per_person_production= !empty($person_count)?four_decimal($process_outweight['out_weight']/$person_count):0; ?></td>
          <td class="text-right"><?= four_decimal($per_person_production/$working_day) ?></td>
          <td class="text-right"><?=$working_day  ?></td>
        </tr>
      <?php $i++;} ?>
      
        
      <tr class="bg_gray">
        <td class="bold">Total</td>
	<td class="bold"></td>
        <td class="bold"></td>
        <td class="text-right bold"><?=four_decimal($total_outweight);?></td>
        <td class="bold"></td>
        <td class="bold"></td>
        <td class="bold"></td>
        <td class="bold"></td>
      </tr>
      <?php } else { ?>
        <tr>
          <td colspan="8">No data found.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
