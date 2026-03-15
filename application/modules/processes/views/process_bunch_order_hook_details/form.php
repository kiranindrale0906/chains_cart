<div class="row">
<?php   
   load_field('text', array('field' => 'bounch_out'));
   if(!empty($customer_names)){
    load_field('dropdown', array('field' => 'customer_name','option'=>$customer_names));
   }else{
    load_field('text', array('field' => 'customer_name'));
   }
   
   $this->load->view('processes/process_factory_order_details/order_category_details');
?>
</div>
<h6 class="bold float-left mb-0">Bunch Order Details</h6>
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
          <th>Bunch Weight</th>
          <th>Bunch Length</th>
          <th>Per Inch Weight</th>
          <th>Estimate Bunch Weight</th>
          <th>Status</th>
          </tr>
    </thead>
    <tbody class="">
    <?php 
    $index=1;
    if(!empty($bunch_order_details)){?>
      <?php foreach ($bunch_order_details as $bunch_order_detail_index => $bunch_order_detail) {
      if($bunch_order_detail['single_order']==0){ 
         ?>
          <tr>      
              <td>
                <?php load_field('checkbox', array('field' => 'order_ids',
                                                   'class' => 'order_ids',
                                                   'index' => $bunch_order_detail_index.'-'.$bunch_order_detail['id'],
                                                   'option' => array(
                                                                array('chk_id' => $bunch_order_detail_index.'-'.$bunch_order_detail['id'],
                                                                      'value' => $bunch_order_detail['id'],
                                                                      'label' => '',
                                                                      'checked' => (!empty($processes_out_wastage_details[$bunch_order_detail_index]['order_id']) 
                                                                                    ? 'checked' : ''))),
                                                   'controller' => 'bunch_order_details'));?>
              </td>      
              <td><?=date('d-m-Y',strtotime($bunch_order_detail['created_at'])) ?></td>
              <td><?=date('d-m-Y',strtotime($bunch_order_detail['due_date'])) ?></td>
              <td><?=$bunch_order_detail['customer_name'] ?></td>
              <td><?=$bunch_order_detail['description'] ?></td>
              <td><?=$bunch_order_detail['market_design_name'] ?></td>
              <td><?=$bunch_order_detail['bunch_weight'] ?></td>
              <td><?=$bunch_order_detail['bunch_length'] ?></td>
              <td><?=$bunch_order_detail['per_inch_weight'] ?></td>
              <td><?=$bunch_order_detail['estimate_bunch_weight'] ?></td>
              <td><?=$bunch_order_detail['status'] ?></td>
            </tr>
      <?php  }}  ?> 
 <?php  }else{ ?>
  <tr><td>Record Not Found!</td></tr>
  <?php } ?>
    </tbody>
  </table></div>
<br>
<h6 class="bold float-left mb-0">Single Bunch Order Details</h6>
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
          <th>Bunch Weight</th>
          <th>Bunch Length</th>
          <th>Per Inch Weight</th>
          <th>Estimate Bunch Weight</th>
          <th>Status</th>
          </tr>
    </thead>
    <tbody class="">
    <?php 
    $index=1;
    if(!empty($bunch_order_details)){?>
      <?php foreach ($bunch_order_details as $bunch_order_detail_index => $bunch_order_detail) { 
        if($bunch_order_detail['single_order']==1){
         ?>
          <tr>      
              <td>
                <?php load_field('checkbox', array('field' => 'order_ids',
                                                   'class' => 'order_ids',
                                                   'index' => $bunch_order_detail_index.'-'.$bunch_order_detail['id'],
                                                   'option' => array(
                                                                array('chk_id' => $bunch_order_detail_index.'-'.$bunch_order_detail['id'],
                                                                      'value' => $bunch_order_detail['id'],
                                                                      'label' => '',
                                                                      'checked' => (!empty($processes_out_wastage_details[$bunch_order_detail_index]['order_id']) 
                                                                                    ? 'checked' : ''))),
                                                   'controller' => 'bunch_order_details'));?>
              </td>      
              <td><?=date('d-m-Y',strtotime($bunch_order_detail['created_at'])) ?></td>
              <td><?=date('d-m-Y',strtotime($bunch_order_detail['due_date'])) ?></td>
              <td><?=$bunch_order_detail['customer_name'] ?></td>
              <td><?=$bunch_order_detail['description'] ?></td>
              <td><?=$bunch_order_detail['market_design_name'] ?></td>
              <td><?=$bunch_order_detail['bunch_weight'] ?></td>
              <td><?=$bunch_order_detail['bunch_length'] ?></td>
              <td><?=$bunch_order_detail['per_inch_weight'] ?></td>
              <td><?=$bunch_order_detail['estimate_bunch_weight'] ?></td>
              <td><?=$bunch_order_detail['status'] ?></td>
            </tr>
      <?php  }}  ?> 
 <?php  }else{ ?>
  <tr><td>Record Not Found!</td></tr>
  <?php } ?>
    </tbody>
  </table></div>
<br>
<br>