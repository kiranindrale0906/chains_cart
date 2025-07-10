<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Process Remark Report</h6>
<form class="fields-group-sm" method="GET" enctype="multipart/form-data" 
    action="<?=ADMIN_PATH."reports/process_remark_reports/index"?>">
  <div class="row">
    <?php //load_field('date',array('field' => 'from_date', 'col'=>'col-sm-3', 'id' => 'customer_order_from_date', 'class' => 'customer_order_filter datepicker_js'));?>
    <?php //load_field('date',array('field' => 'to_date', 'col'=>'col-sm-3', 'id' => 'customer_order_to_date', 'class' => 'customer_order_filter datepicker_js'));?>
    <?php load_field('dropdown',array('field' => 'product_name','option'=>$product_name, 'col'=>'col-sm-3', 'id' => 'customer_order_product_name', 'class' => ''));?>
    <?php load_field('dropdown',array('field' => 'process_name','option'=>$process_name, 'col'=>'col-sm-3', 'id' => 'customer_order_process_name', 'class' => 'rejected_quantity_filter'));?>
    <?php load_field('dropdown',array('field' => 'department_name','option'=>$department_name, 'col'=>'col-sm-3', 'id' => 'customer_order_department_name', 'class' => ''));?>
    <?php load_field('dropdown',array('field' => 'in_lot_purity','option'=>$in_lot_purity, 'col'=>'col-sm-3', 'id' => 'customer_order_in_lot_purity', 'class' => ''));?>
    </div>

  <div class="row">
    <div class="col-sm-3">
      <div class="form-group ">
        <?php load_buttons('submit',array('class'=> 'btn-sm btn_blue float-left', 'name'=>'Submit')); ?> 
      </div>
    </div>
  </div>

</form>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
    <thead>
    <tr>
      <th>Product Name</th>
      <th>Process Name</th>
      <th>Department Name</th>
      <th>Lot Purity</th>
      <th>IN</th>
      <th>OUT</th>
      <th>DAILY DRAWER WASTAGE</th>
      <th>Remark</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $total = 0;
      $total_fine = 0;
      if(!empty($record['customer_order_data'])){
        foreach ($record['customer_order_data'] as $index => $record) {
          $total += $record['out_weight'];
          ?>
         <tr>
            <td><?= !empty($record['product_name'])?$record['product_name']:'-' ?></td>
            <td><?= !empty($record['process_name'])?$record['process_name']:'-' ?></td>
            <td><?= !empty($record['department_name'])?$record['department_name']:'-' ?></td>
            <td><?= !empty($record['in_lot_purity'])?$record['in_lot_purity']:'-' ?></td>
            <td><?= !empty($record['in_weight'])?$record['in_weight']:'-' ?></td>
            <td><?= !empty($record['out_weight'])?$record['out_weight']:'-' ?></td>
            <td><?= !empty($record['daily_drawer_wastage'])?$record['daily_drawer_wastage']:'-' ?></td>
            <td><?= !empty($record['remark'])?$record['remark']:'-' ?></td>
            </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
        
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td class=" bold"><?=four_decimal($total);?></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
        </tr> 

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
