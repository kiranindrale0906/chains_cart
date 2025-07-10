<div class="boxrow mb-2">
  <div class="float-left">   
    <h6 class="heading blue bold text-uppercase mb-0">Timing Reports</h6>
  </div>
</div>

<?php $this->load->view('reports/timing_reports/search',$data);?>

<hr>
<table class="table table-bordered table-sm table-default">
<thead>
  <tr>
    <th class="text-center">Lot No/Parent Lot No</th>
    <?php if(HOST=='ARF'){?>
    <th class="text-center">Design Code</th>
    <th class="text-center">Machine Size</th>
    <?php }?>
    <th class="text-center">In Weight</th>
    <th class="text-center">Out Weight</th>
    <th class="text-center">Created At</th>  
    <th class="text-center">Completed At </th>
    <th class="text-center">Diff in Hour</th>
  </tr>
</thead>
<tbody>
  <?php 
  if(!empty($process_details)){ 
    $in_weight=0;
    $out_weight=0;
    foreach ($process_details as $process) { 
     if ($process['diff'] > $record['hours']) {
      $in_weight+=$process['in_weight'];
      $out_weight+=$process['out_weight'];
      ?>
  <tr>
    <td class=""><?php echo in_array($process['product_name'], array('Indo tally Chain','Hollow Choco Chain','Rope Chain','Imp Italy Chain','Machine Chain'))?$process['parent_lot_name']:$process['lot_no']; ?></td>
    <?php if(HOST=='ARF'){?>
    <td class="text-right"><?php echo ($process['design_code']); ?></td>
    <td class="text-right"><?php echo ($process['machine_size']); ?></td>
    <?php }?>
    <td class="text-right"><?php echo four_decimal($process['in_weight']); ?></td>
    <td class="text-right"><?php echo four_decimal($process['out_weight']); ?></td>
    <td class="text-right"><?php echo $process['created_at']; ?></td>
    <td class="text-right"><?php echo $process['completed_at']; ?></td>
    <td class="text-right"><?php echo $process['diff']; ?></td>
  </tr>
  <?php } }?>
  <tr>
    <td class="font-weight-bold">Total</td>
    <?php if(HOST=='ARF'){?>
    <td class="font-weight-bold"></td>
    <td class="font-weight-bold"></td>
    <?php }?>
    <td class="text-right font-weight-bold"><?=$in_weight?></td>
    <td class="text-right font-weight-bold"><?=$out_weight?></td>
    <td></td>  
    <td></td>
    <td></td>
  </tr>
  <?php  } else { ?>
    <tr>
      <td colspan="7">No rates data found.</td>
    </tr>
  <?php } ?>
</tbody>
</table>
<hr>
