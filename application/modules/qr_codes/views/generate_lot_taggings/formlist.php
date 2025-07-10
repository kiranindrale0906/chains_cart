<h5 class="heading">Generate Lots</h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue generate_out_select_all')); ?></th>
      <th>Item Code</th>
      <th>Bom Factory Code</th>
      <th>Order Type</th>
      <th>Customer Name</th>
      <th>Size</th>
      <th>Weight</th>
      <th>Gross Weight</th>
      <th>Quantity</th>
      <th>Rem Balance Quantity</th>
      <th>Order Quantity</th>
      <th>Image</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(!empty($order_details)){
      
      foreach ($order_details as $index => $order) {?>
        <tr class="bg_gray bold"><td><?php echo $index; ?></td>
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
        <?php 
        $sum_weight=$sum_total_weight=$sum_quantity=$sum_order_balance_weight=0;
        foreach ($order as $order_index => $value) {
        $sum_weight+=$value['weight'];
//        $sum_order_balance_weight+=(($value['weight']/$value['balance_quantity'])*$value['rem_balance_quantity']);
        $sum_quantity+=$value['previous_bal_qty'];
        // $sum_total_weight+=($value['weight']*$value['quantity']);
        $sum_total_weight+=($value['weight']);
          $this->load->view('generate_lot_taggings/subform',
                          array('index'=> $order_index, 'order' => $value));
        }?>
        <tr class="bg_blue bold">
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
     <?php  } }?>
  </tbody>
</table>
