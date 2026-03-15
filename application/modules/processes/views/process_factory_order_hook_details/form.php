<div class="row">
<?php   
   load_field('text', array('field' => 'customer_out'));
   // if(!empty($customer_names)){
   //  load_field('dropdown', array('field' => 'customer_name','option'=>$customer_names));
   // }else{
    load_field('text', array('field' => 'customer_name'));
   // }
   load_field('text', array('field' => 'quantity'));
   load_field('text', array('field' => 'factory_order_weight','name'=>"factory_order_weight",'readonly'=>'readonly'));
   load_field('text', array('field' => 'total_qty','name'=>"total_qty",'readonly'=>'readonly'));
   load_field('dropdown', array('field' => 'next_department_name','option'=>array(array('id'=>'Yes','name'=>'Yes'),array('id'=>'No','name'=>'No','selected'=>'selected','label'=>'Hold Process'))));
   $this->load->view('processes/process_factory_order_details/order_category_details');
?>
</div>
<h6 class="bold float-left mb-0">Pending Order Details</h6>
<br>
<div class="table-responsive">
  <table class="table table-sm table-default fixedTable_js table-bordered table-striped">
    <thead> 
        <tr> 
          <th>Select</th>
          <th>Order Date</th>
          <th>Due Date</th>
          <th>Customer Name</th>
          <th>Description</th>
          <th>Market Design Name</th>
          <th>Total Weight</th>
          <th>Size</th>
          <th>Total Qty</th>
          <th>Status</th>
          </tr>
    </thead>
    <tbody class="">
    <?php 
    $index=1;
    if(!empty($factory_order_details)){?>
      <?php foreach ($factory_order_details as $factory_order_detail_index => $factory_order_detail) { 
        if($factory_order_detail['single_order']==0){ 
        $sizes=explode(',',$factory_order_detail['size']);
        $qtys=explode(',',$factory_order_detail['qty']);
          ?>
          <tr>      
              <td>
                <?php load_field('hidden', array('field' => 'customer_name',
                                   'class' => 'customer_name',
                                   'value' => $factory_order_detail['customer_name'] ,
                                   'index' => $factory_order_detail_index,
                                   'controller' => 'factory_order_details')); ?>
    
                <?php load_field('checkbox', array('field' => 'order_ids',
                                                   'class' => 'market_order_detail_id order_ids',
                                                   'index' => $factory_order_detail_index,
                                                   'option' => array(
                                                                array('chk_id' => $factory_order_detail_index,
                                                                      'value' => $factory_order_detail['ids'],
                                                                      'label' => '',
                                                                      'checked' => (!empty($processes_out_wastage_details[$factory_order_detail_index]['order_id']) 
                                                                                    ? 'checked' : ''))),
                                                   'controller' => 'factory_order_details'));?>
              </td>      
              <td><?=date('d-m-Y',strtotime($factory_order_detail['created_at'])) ?></td>
              <td><?=date('d-m-Y',strtotime($factory_order_detail['due_date'])) ?></td>
              <td class="customer_name"><?=$factory_order_detail['customer_name'] ?></td>
              <td><?=$factory_order_detail['description'] ?></td>
              <td><?=$factory_order_detail['market_design_name'] ?></td>
              <td class="total_weight"><?=$factory_order_detail['total_weight'] ?></td>
              <td>
                <table>
                  <tr>
                    <?php foreach ($sizes as $size_index => $size_value) { ?>
                      <td><?=$size_value?></td>
                    <?php } ?>
                  </tr>
                  <tr>
                    <?php 
                    $total_qty=0;
                    foreach ($qtys as $qty_index => $qty_value) {
                      $total_qty+=$qty_value;
                     ?>
                      <td><?=$qty_value?></td>
                    <?php } ?>
                  </tr>
                </table>
              </td>
              <td class="total_qty"><?=$total_qty?></td>
              <td><?=$factory_order_detail['status'] ?></td>
            </tr>
      <?php  } } ?> 
 <?php  }else{ ?>
  <tr><td>Record Not Found!</td></tr>
  <?php } ?>
    </tbody>
  </table></div>
<br><h6 class="bold float-left mb-0">Single Pending Order Details</h6>
<br>
<div class="table-responsive">
  <table class="table table-sm table-default fixedTable_js table-bordered table-striped">
    <thead> 
        <tr> 
          <th>Select</th>
          <th>Order Date</th>
          <th>Due Date</th>
          <th>Customer Name</th>
          <th>Description</th>
          <th>Market Design Name</th>
          <th>Total Weight</th>
          <th>Size</th>
          <th>Total Qty</th>
          <th>Status</th>
          </tr>
    </thead>
    <tbody class="">
    <?php 
    $index=1;
    if(!empty($factory_order_details)){?>
      <?php foreach ($factory_order_details as $factory_order_detail_index => $factory_order_detail) {
      if($factory_order_detail['single_order']==1){ 
        $sizes=explode(',',$factory_order_detail['size']);
        $qtys=explode(',',$factory_order_detail['qty']);
          ?>
          <tr>      
              <td>
                <?php load_field('hidden', array('field' => 'customer_name',
                                   'class' => 'customer_name',
                                   'value' => $factory_order_detail['customer_name'] ,
                                   'index' => $factory_order_detail_index,
                                   'controller' => 'factory_order_details')); ?>
    
                <?php load_field('checkbox', array('field' => 'order_ids',
                                                   'class' => 'market_order_detail_id order_ids',
                                                   'index' => $factory_order_detail_index,
                                                   'option' => array(
                                                                array('chk_id' => $factory_order_detail_index,
                                                                      'value' => $factory_order_detail['ids'],
                                                                      'label' => '',
                                                                      'checked' => (!empty($processes_out_wastage_details[$factory_order_detail_index]['order_id']) 
                                                                                    ? 'checked' : ''))),
                                                   'controller' => 'factory_order_details'));?>
              </td>      
              <td><?=date('d-m-Y',strtotime($factory_order_detail['created_at'])) ?></td>
              <td><?=date('d-m-Y',strtotime($factory_order_detail['due_date'])) ?></td>
              <td class="customer_name"><?=$factory_order_detail['customer_name'] ?></td>
              <td><?=$factory_order_detail['description'] ?></td>
              <td><?=$factory_order_detail['market_design_name'] ?></td>
              <td class="total_weight"><?=$factory_order_detail['total_weight'] ?></td>
              <td>
                <table>
                  <tr>
                    <?php foreach ($sizes as $size_index => $size_value) { ?>
                      <td><?=$size_value?></td>
                    <?php } ?>
                  </tr>
                  <tr>
                    <?php 
                    $total_qty=0;
                    foreach ($qtys as $qty_index => $qty_value) {
                      $total_qty+=$qty_value;
                     ?>
                      <td><?=$qty_value?></td>
                    <?php } ?>
                  </tr>
                </table>
              </td>
              <td class="total_qty"><?=$total_qty?></td>
              <td><?=$factory_order_detail['status'] ?></td>
            </tr>
      <?php  }}  ?> 
 <?php  }else{ ?>
  <tr><td>Record Not Found!</td></tr>
  <?php } ?>
    </tbody>
  </table></div>
<br>
<br>