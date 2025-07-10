<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Daily Change Rolling Balance Report</h6>
<form class="fields-group-sm">
    <div class="row">
      <?php load_field('dropdown',array('field' => 'chain_name', 'col'=>'col-sm-4','option'=>$chain_name))?> 
    </div>
  </form>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Date</th>
      <th>Chain Name</th>
      <th>Balance Gross </th>
	    <th>Balance Fine</th>
      <th>GPC OUT</th>
      <th>IMP OUT</th>
      <th>Repair OUT</th>
      <th>Bounch OUT</th>
      <th>Fancy OUT</th>
      <th>Pipe And Para OUT</th>
      <th> OUT Total</th>
	  </tr>
	</thead>
	<tbody>
    <?php
      if(!empty($record['rolling_data'])){
        foreach ($record['rolling_data'] as $rolling_index => $rolling_data) {
      $total=$total_fine =$total_gpc_out=$total_imp_out=$total_bunch_out=$total_fancy_out=$total_repair_out=$total_pipe_and_para_out=$total_out=$avg_total= 0;
          foreach ($rolling_data as $index => $record) {
          $total += $record['balance_gross'];
          $total_fine += $record['balance_fine'];
          $total_gpc_out += $record['gpc_out'];
          $total_imp_out += $record['imp_out'];
          $total_bunch_out += $record['bunch_out'];
          $total_fancy_out += $record['fancy_out'];
          $total_repair_out += $record['repair_out'];
          $total_pipe_and_para_out += $record['pipe_and_para_out'];
          $total_out += four_decimal(($record['gpc_out']+$record['imp_out']+$record['repair_out']+$record['bunch_out']+$record['fancy_out']+$record['pipe_and_para_out']));
          ?>
         <tr>
            <td><?= $date=!empty($record['transaction_date'])?date('d-m-Y',strtotime($record['transaction_date'])):'-' ?></td>
            <td><?= !empty($record['product_name'])?$record['product_name']:'-' ?></td>
             <td><?= four_decimal($record['balance_gross']) ?></td>
            <td><?= four_decimal($record['balance_fine']) ?></td>
            <td><?= four_decimal($record['gpc_out']) ?></td>
            <td><?= four_decimal($record['imp_out']) ?></td>
            <td><?= four_decimal($record['repair_out']) ?></td>
            <td><?= four_decimal($record['bunch_out']) ?></td>
            <td><?= four_decimal($record['fancy_out']) ?></td>
            <td><?= four_decimal($record['pipe_and_para_out']) ?></td>
            <td><?= four_decimal(($record['gpc_out']+$record['imp_out']+$record['repair_out']+$record['bunch_out']+$record['fancy_out']+$record['pipe_and_para_out'])) ?></td>
             </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td  class=" bold"></td>
          <td class=" bold"><?=four_decimal($total);?></td>
          <td class=" bold"><?=four_decimal($total_fine);?></td>
          <td class=" bold"><?=four_decimal($total_gpc_out);?></td>
          <td class=" bold"><?=four_decimal($total_imp_out);?></td>
          <td class=" bold"><?=four_decimal($total_repair_out);?></td>
          <td class=" bold"><?=four_decimal($total_bunch_out);?></td>
          <td class=" bold"><?=four_decimal($total_fancy_out);?></td>
          <td class=" bold"><?=four_decimal($total_pipe_and_para_out);?></td>
          <td class=" bold"><?=four_decimal($total_out);?></td>
        </tr> 
        <tr class="bg_gray">
          <td class=" bold">AVG Total</td>
       	<td  class=" bold"><?php  $month=date('m',strtotime($rolling_index)); 
          if($month==5){
            echo $avg_total=four_decimal($total/21);
            echo $avg_total_out=four_decimal($total_out/21);
          }else{
           echo $avg_total=four_decimal($total/date('d',strtotime($date)));
           echo $avg_total_out=four_decimal($total_out/date('d',strtotime($date)));
          } ?></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
        </tr> <tr class="bg_gray">
          <td class=" bold">Rolling</td>
          <td class=" bold"><?=$rolling=four_decimal($total_out/$avg_total);?></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
        </tr> 
        <tr class="bg_gray">
          <td class=" bold">Expected Rolling</td>
          <td class=" bold"><?=four_decimal(($avg_total_out*30)/$avg_total);?></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
        </tr> 

     <?php }}else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
	</table>
</div>
</div>
</div>
