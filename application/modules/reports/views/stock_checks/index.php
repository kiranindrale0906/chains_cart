<div class="table-responsive m-t-10">
  <h5> Melting Lot ID: 
    <a class="ml-5" href='<?= base_url() ?>reports/stock_checks'>Weight / Gross</a>
    <a class="ml-5" href='<?= base_url() ?>reports/stock_checks?weight=fine'>Fine</a> 
    <!--<a class="ml-5">Fine</a> - (Coming Soon)-->
  </h5>
  <h5> Parent Lot ID: 
    <a class="ml-5" href='<?= base_url() ?>reports/stock_checks?type=parent_lot_id'>Weight</a>
    <a class="ml-5" href='<?= base_url() ?>reports/stock_checks?type=parent_lot_id&weight=gross'>Gross</a>
    <a class="ml-5" href='<?= base_url() ?>reports/stock_checks?type=parent_lot_id&weight=fine'>Fine</a>
    <!--<a class="ml-5">Fine</a> - (Coming Soon)-->
  </h5>
  <h5> Office Outside: 
    <a class="ml-5" href='<?= base_url() ?>reports/stock_checks?office_outside=1'>Weight</a>
    <a class="ml-5" href='<?= base_url() ?>reports/stock_checks?office_outside=1&weight=gross'>Gross</a>
    <a class="ml-5" href='<?= base_url() ?>reports/stock_checks?office_outside=1&weight=fine'>Fine</a>
    <!--<a class="ml-5">Fine</a> - (Coming Soon)-->
  </h5>
  <hr>
  <table class="table table-sm fixedthead table-default">
    <thead>
	  <tr>  
        <th><?= ($type == 'melting_lot_id') ? 'Melting Lot No.' : 'Parent Lot No.'?></th>
        <th class="text-right">IN Melting-Weight</th>
        <th class="text-right">IN Process-Weight</th>
        <?php if(isset($strip_cutting_weights)) {?>
        <th class="text-right">IN Spring-Cutting-Weight</th>
        <?php } ?>
        <th class="text-right">OUT GPC-Weight</th>
        <th class="text-right">OUT Wastge-Weight</th>
        <th class="text-right">Balance</th>
	  </tr>
	</thead>
	<tbody>
      <?php if(!empty($ids)) {
        foreach ($ids as $lot_no) {
          $gross_weight   = (isset($in_melting_weights[$lot_no])) ? $in_melting_weights[$lot_no][0]['gross_weight'] : 0;
          $in_opening_weight = (isset($in_opening_weights[$lot_no])) ? $in_opening_weights[$lot_no][0]['in_opening_weight'] : 0;
          $gross_weight = $gross_weight + $in_opening_weight;
          $in_weights     = (isset($in_process_weights[$lot_no])) ? $in_process_weights[$lot_no][0]['in_weights'] : 0;
          $in_strip_cutting_weights = (isset($strip_cutting_weights[$lot_no])) ? $strip_cutting_weights[$lot_no][0]['strip_cutting_weight'] : 0;
          $gpc_out_weight = (isset($out_gpc_bounch_weights[$lot_no])) ? $out_gpc_bounch_weights[$lot_no][0]['gpc_out_weight'] : 0;
          $wastage_loss   = (isset($out_wastages[$lot_no])) ? $out_wastages[$lot_no][0]['wastage_loss'] : 0;
          $process_group_weight  = (isset($process_group_balance[$lot_no])) ? $process_group_balance[$lot_no][0]['balance_group'] : 0;
          $balance_weight = ($gross_weight + $in_weights + $in_strip_cutting_weights) - ($gpc_out_weight + $wastage_loss + $process_group_weight);
      ?>
      <?php if(four_decimal($balance_weight) != 0) {
        if($type == 'parent_lot_id') {
          $query = "Select product_name,process_name,department_name,in_weight,in_purity,in_lot_purity,out_weight,balance,id as url from processes where parent_lot_id=".$out_wastages[$lot_no][0]['parent_lot_id'];
        } else {
          $query = "Select product_name,process_name,department_name,in_weight,in_purity,in_lot_purity,out_weight,balance,id as url from processes where melting_lot_id=".$out_wastages[$lot_no][0]['melting_lot_id'];
        }
        
      ?>
      <?php if($lot_no!=0) { ?>
        <tr>
          <td><?= $lot_no;?></td>
          <!--<td class="text-right"><a href="<?= ADMIN_PATH.'reports/stock_checks/view?type='.$type.'&id='.$lot_no?>" target="_blank"><?= $gross_weight;?></a></td>-->
          <td class="text-right"><?= four_decimal($gross_weight);?></td>
          <td class="text-right"><?= four_decimal($in_weights);?></td>
          <?php if(isset($strip_cutting_weights)) {?>
          <td class="text-right"><?= four_decimal($in_strip_cutting_weights);?></td>
          <?php } ?>
          <td class="text-right"><?= four_decimal($gpc_out_weight);?></td>
          <td class="text-right"><?= four_decimal($wastage_loss);?></td>
          <td class="text-right"><a href='<?= ADMIN_PATH?>settings/run_sql_query/index?query=<?= $query?>'><?= four_decimal($balance_weight); ?></a></td>
        </tr>
      <?php } } } } else { ?>
        <tr>
          <td colspan="6">No data found.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
