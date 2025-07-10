<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Dd Karigar Rolling Report</h6>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Date</th>
      <th>Karigar Name</th>
      <th>Purity</th>
      <th>Opening</th>
      <th>IN</th>
      <th>OUT</th>
      <th>Balance</th>
      <th>Rolling</th>
      <th>Utilization %</th>
    </tr>
	</thead>
	<tbody>
    <?php
      if(!empty($record['dd_karigar_rolling_data'])){
        foreach ($record['dd_karigar_rolling_data'] as $index => $month_wise_records) {
      $total_in_weight = 0;
      $total_out_weight = 0;
      $total_balance = 0;
      ?>
      <tr class="bg_yellow">
            <td class=" bold"><?=$index?></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
      </tr>
      <?php  foreach ($month_wise_records as $month_wise_record_index => $record) {          
          $total_in_weight += $record['in_weight'];
          $total_out_weight += $record['out_weight'];
          $total_balance += $record['balance'];
          ?>
         <tr>
            <td><?= $date=!empty($record['date'])?$record['date']:'-' ?></td>
            <td><?= !empty($record['karigar'])?$record['karigar']:'-' ?></td>
            <td><?= !empty($record['purity'])?$record['purity']:'-' ?></td>
            <td><?= !empty($record['opening'])?four_decimal($record['opening']):'-' ?></td>
            <td><?= !empty($record['in_weight'])?four_decimal($record['in_weight']):'-' ?></td>
            <td><?= !empty($record['out_weight'])?four_decimal($record['out_weight']):'-' ?></td>
            <td><?= !empty($record['balance'])?four_decimal($record['balance']):'-' ?></td>
            <td><?= !empty($record['rolling'])?four_decimal($record['rolling']):'-' ?></td>
            <td><?= !empty($record['utilization'])?four_decimal($record['utilization']):'-' ?></td>
        </tr>
        
        <?php }
        $last_date_of_month=date('d',strtotime($date));
// echo $last_date_of_month;
        ?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td class=" bold"><?=four_decimal($total_in_weight);?></td>
          <td class=" bold"><?=four_decimal($total_out_weight);?></td>
          <td class=" bold"><?=four_decimal($total_balance);?></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
        </tr> 
        <tr class="bg_gray">
          <td class=" bold">Average Stock:</td>
          <td  class=" bold"><?=$avg_stock=four_decimal($total_balance/$last_date_of_month);?></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
        </tr> 
        <tr class="bg_gray">
          <td class=" bold">Rolling:</td>
          <td  class=" bold"><?=four_decimal($total_out_weight/$avg_stock);?></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
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
