<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>In Process Balance Report</h6>
  <div class="table-responsive m-t-10">
    <a href="<?= base_url().'reports/completed_melting_reports'?>" class="btn btn-xs btn_green">Completed Melting Report</a>
    <a href="<?= base_url().'reports/melting_lot_time_reports'?>" class="btn btn-xs btn_green">In Process Melting Report</a>
  </div>
   <div class="row">
    
        <?php  load_field('dropdown', array('field' => 'product_name',
                                       'class' => '',
                                       'col' => 'col-md-4',
                                       'option' => $product_names));?>
        <?php  load_field('dropdown', array('field' => 'genarate_lot_no',
                                             'class' => '',
                                             'col' => 'col-md-4',
                                             'option' => $genarate_lots));?>
        <?php  load_field('dropdown', array('field' => 'customer_name',
                                       'class' => '',
                                       'col' => 'col-md-4',
                                       'option' => $customer_names));?>
        <?php  load_field('dropdown', array('field' => 'order_type',
                                       'class' => '',
                                       'col' => 'col-md-4',
                                       'option' => $order_types));?>
  </div> 
  <div class="table-responsive m-t-10">
  <?php
      $sub_total = 0;
      $total = 0;
      $total_weight = 0;
      if(!empty($record['in_process_balance_data'])){
        foreach ($record['in_process_balance_data'] as $index_product_name => $value_product_name) {
      ?>
    <h5><?=$index_product_name?></h5>
    <table class="table table-sm fixedthead table-default">
      <thead>
      <tr>
        <th>Lot No</th>
        <th>Order Date</th>
        <th>Melting Date</th>
        <th>Product Name</th>
        <th>Genarate Lot no</th>
        <th>Customer Name</th>
        <th>Order Type</th>
        <th>Melting Weight</th>
        <th>Melting Purity</th>
        <th>Current Dep Date</th>
        <th>Live Date</th>
        <th>Delay</th>
        <th>Process Name</th>
        <th>Department(Current Balance Dep)</th>
        <th>Current Dep Weight</th>
        <th>Complete Time </th>
      </tr>
    </thead>
    <tbody>
    <?php
//pd($value_product_name);
    $sum_total = 0;
      $sum_total_weight = 0;
      $sum_dd_total_weight = 0;
      foreach ($value_product_name as $index_melting_date => $melting_date_detail) {
      ?>
      <tr class="bg_gray"><td><b><?=$index_melting_date?></b></td><td></td><td></td><td></td><td></td><td></td><td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
      <tr>
<?php foreach ($melting_date_detail as $melting_date_index => $melting_lot_data) {
  $total = 0;
        foreach ($melting_lot_data as $index => $melting_lot_value) {
           $class="";
           $delay_class="";
           $delay_color_class="";
          if($melting_lot_value['is_out_off_time']==1){
            $class="red";
          }if($melting_lot_value['is_out_off_delay_time']==1){
            $delay_class="bold";
            $delay_color_class=" yellow";
          }
            $sum_total+= $melting_lot_value['balance'];
            $total += $melting_lot_value['balance'];
        ?>
          <tr class=<?=$class?>>
            <td><?= !empty($melting_lot_value['lot_no'])?$melting_lot_value['lot_no']:'-' ?></td>
            <td><?= !empty($melting_lot_value['order_date'])? date('d-m-Y',strtotime($melting_lot_value['order_date'])):'-' ?></td>
            <td><?= !empty($melting_lot_value['melting_date'])?$melting_lot_value['melting_date']:'-' ?></td>
            <td><?= !empty($melting_lot_value['product_name'])?$melting_lot_value['product_name']:'-' ?></td>
            <td><?= !empty($melting_lot_value['genarate_lot_no'])?$melting_lot_value['genarate_lot_no']:'-' ?></td>
            <td><?= !empty($melting_lot_value['customer_name'])?$melting_lot_value['customer_name']:'-' ?></td>
            <td><?= !empty($melting_lot_value['order_type'])?$melting_lot_value['order_type']:'-' ?></td>
            <td><?= !empty($melting_lot_value['melting_weight'])?$melting_lot_value['melting_weight']:'-' ?></td>
            <td><?= !empty($melting_lot_value['lot_purity'])?$melting_lot_value['lot_purity']:'-' ?></td>
            <td><?= !empty($melting_lot_value['created_at'])?$melting_lot_value['created_at']:'-' ?></td>
            <td><?= !empty($melting_lot_value['live_date'])?$melting_lot_value['live_date']:'-' ?></td>
            <td class="<?=$delay_class?> <?=$delay_color_class?>"><?= !empty($melting_lot_value['delay'])?$melting_lot_value['delay']:'-' ?></td>
            <td><?= !empty($melting_lot_value['process_name'])?$melting_lot_value['process_name']:'-' ?></td>
            <td><?= !empty($melting_lot_value['department_name'])?$melting_lot_value['department_name']:'-' ?></td>
            <td><?= !empty($melting_lot_value['balance'])?$melting_lot_value['balance']:'-' ?></td>
             <td><?= !empty($melting_lot_value['diff_melting_date_with_complted_date'])?$melting_lot_value['diff_melting_date_with_complted_date']:'-' ?></td></tr>
  
  <?php }?>
        </tr>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"><?=$total?></td>
          <td  class=" bold"></td>
        </tr> 
        </tr>
          <?php }?>
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Sub Total</td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"><?=$sum_total?></td>
          <td  class=" bold"></td>
        </tr> 
        </tr>   
        <?php if(!empty($record['in_process_balance_dd_karigar_data'])){ foreach ($record['in_process_balance_dd_karigar_data'][$index_product_name] as $in_process_balance_dd_karigar_data_key => $in_process_balance_dd_karigar_data_value) {
          $sum_dd_total_weight+=$in_process_balance_dd_karigar_data_value['balance'];

          $dd_karigar_data=explode(':',$in_process_balance_dd_karigar_data_key);
          ?>
          <tr class="bg_gray"><td><b><?=$in_process_balance_dd_karigar_data_key?></b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><?= !empty($in_process_balance_dd_karigar_data_value['balance'])?$in_process_balance_dd_karigar_data_value['balance']:'-' ?></td><td><?php load_buttons('anchor',array('name'=>'View',
                                                  'layout' => 'application',
                                                  'class'=>'btn-xs bold blue float-left bar_code_genrate',
                                                  'href'=>ADMIN_PATH."reports/daily_drawer_karigar_rolling_reports?karigar=".$dd_karigar_data[0]."&&hook_kdm_purity=".$dd_karigar_data[1]));
                  ?></td></tr>
        <tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
         </tr>
        <?php }}?>
        <tr class="bg_gray">
          <td class=" bold">All Total</td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"><?=$sum_total+$sum_dd_total_weight?></td>
          <td  class=" bold"></td>
        </tr> 
  </tbody>
  </table>
<?php }} ?>
</div>
</div>
</div>
