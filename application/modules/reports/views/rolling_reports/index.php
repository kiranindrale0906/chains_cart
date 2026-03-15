<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Rolling Report</h6>
  <div class="table-responsive m-t-10">
  <form class="fields-group-sm">
  <div class="row">
    <?php load_field('dropdown',array('field' => 'product_name', 'col'=>'col-sm-4','option' => @$processes));?>
    <?php load_field('text',array('field' => 'lot_no', 'col'=>'col-sm-4'));?>
  </div>
    <?php load_buttons('anchor', array('name' =>'SEARCH', 
                                       'class' =>'btn_blue rolling_search',
                                       'col' => 'col-md-3',)); ?></form>
    <?php 
      $product_name = (isset($_GET['product_name'])) ? $_GET['product_name'] : '';
    ?>
    <a href="<?= ADMIN_PATH.'reports/rolling_reports?product_name='.$product_name.'&detail='.$show_detail_breakup?>">
      <?php echo ($show_detail_breakup == 'no') ? "Without Details" : "With Details" ?>
    </a>
    
    
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
      <th>Date</th>
      <th class="text-right">IN Weight</th>
	    <th class="text-right">Wastage</th>
      <th class="text-right">Out Weight</th>
      <th class="text-right">Day Wise Balance</th>
      <th class="text-right">Actual Balance</th>
      <th></th>
	  </tr>
	</thead>
	<tbody>
    <?php
      $total_in_weight =$total_out_weight = $total_wastage =$total_balance =$total_diff = $total_total_balance =  $total_no_of_row= $total_month_no_of_row=$total_month=$total_year=$total_change_month_year=0;
      if(!empty($rolling_records)){
        foreach ($rolling_records as $month_year_index => $month_year_record) {
          $month_in_weight =$month_out_weight =$month_wastage =$month_balance = $month_diff = $month_total_balance = $month_no_of_row=$month_month_no_of_row=$month_month=$month_year=$month_change_month_year=0;
          foreach ($month_year_record as $index => $record) {
            $total_no_of_row++;
            $total_in_weight += $record['in_weight'];
            $total_out_weight += $record['out_weight'];
            $total_wastage += $record['wastage'];
            $total_balance += $record['in_weight']-($record['wastage']+$record['out_weight']);
            $total_total_balance+=$total_balance;
            $month_no_of_row=$total_no_of_row;
            $month_in_weight += $record['in_weight'];
            $month_out_weight += $record['out_weight'];
            $month_wastage += $record['wastage'];
            $month_balance += $record['in_weight']-($record['wastage']+$record['out_weight']);
            $month_total_balance+=$total_balance;?>
            
           <tr>
              <td><?= !empty($record['date'])?$record['date']:'0'?></td>
              <td class="text-right"><?= !empty($record['in_weight'])?four_decimal($record['in_weight']):'0' ?></td>
              <td class="text-right"><?= !empty($record['wastage'])?four_decimal($record['wastage']):'0' ?></td>
              <td class="text-right"><?= !empty($record['out_weight'])?four_decimal($record['out_weight']):'0' ?></td>
              <td class="text-right"><?= four_decimal($record['in_weight']-$record['wastage']-$record['out_weight']) ?></td>
              <td class="text-right"><?= four_decimal($total_balance) ?></td>
              <td></td>
          </tr>
          <?php if($show_detail_breakup=='yes') { ?>
          <tr>
            <td></td>
            <td class="text-right"><?= '<PRE>'?><?= print_r($record['in_weight_details']);?></td>
            <td class="text-right"><?= '<PRE>'?><?= print_r($record['wastage_details']);?></td>
            <td class="text-right"><?= '<PRE>'?><?= print_r($record['out_weight_details']);?></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <?php } ?>
         

     <?php } ?>
      <tr class="bg_gray">
            <td class=" bold">Total</td>
            <td class="text-right bold"><?=four_decimal($month_in_weight);?></td>
            <td class="text-right bold"><?=four_decimal($month_wastage);?></td>
            <td class="text-right bold"><?=four_decimal($month_out_weight);?></td>
            <td class="text-right bold"><?=four_decimal($month_balance);?></td>
            <td class="text-right bold">
            Avg. Actual Balance
            <br>
            <?=four_decimal(($month_total_balance / 30))?>
            </td>
            <td class="text-right bold">
             Rolling <br> <?=!empty($month_out_weight) ? four_decimal($month_out_weight / ($month_total_balance / 30)): four_decimal(($month_total_balance / 30))?>
            </td>
          </tr> 
     


     <?php }?>
          <!-- <tr class="bg_cyan">
            <td class=" bold">Sub Total</td>
            <td class="text-right bold"><?=four_decimal($total_in_weight);?></td>
            <td class="text-right bold"><?=four_decimal($total_wastage);?></td>
            <td class="text-right bold"><?=four_decimal($total_out_weight);?></td>
            <td class="text-right bold"><?=four_decimal($total_balance);?></td>
            <td class="text-right bold">
            Avg. Actual Balance
            <br>
            <?=four_decimal(($total_total_balance/$total_no_of_row))?>
            </td>
            <td class="text-right bold">
             Rolling <br> <?=!empty($total_out_weight)?four_decimal(($total_total_balance/$total_no_of_row)/$total_out_weight):four_decimal(($total_total_balance/$total_no_of_row))?>
            </td>
          </tr> -->
     <?php }else{ ?>
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