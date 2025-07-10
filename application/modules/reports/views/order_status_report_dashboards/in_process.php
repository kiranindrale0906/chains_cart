<!-- <div class="row">
<?php 
  // load_field('date',array('field' => 'from_date', 'col'=>'col-sm-3', 
  //                                 'id' => 'order_status_report_from_date', 'class' => 'order_status_report_filter datepicker_js',"onchange" => "change_order_status_report(this)"));
  // load_field('date',array('field' => 'to_date', 'col'=>'col-sm-3', 
  //                                 'id' => 'order_status_report_to_date', 'class' => 'order_status_report_filter datepicker_js',"onchange" => "change_order_status_report(this)"));
  // load_field('dropdown', array('field' => 'customer_name','id' => 'order_status_report_customer_name','option'=>$customer_list,"onchange" => "change_order_status_report(this)"));
  // load_field('dropdown', array('field' => 'next_process','id' => 'order_status_report_next_process','option'=>$next_process_list,"onchange" => "change_order_status_report(this)"));
?>
</div>
<?php
  if(!empty($order_status_records)){
    foreach ($order_status_records as $record_index => $order_status_lists) {

      $total_weight = 0;

      echo '<h4>'.$record_index.'</h4>
            <table class="table table-sm table-default table-hover">
              <thead>
                <tr>
                  <th>Sales Order</th>
                  <th>Customer Name</th>
                  <th>Purity</th>
                  <th>Weight</th>
                  <th>Quantity</th>
                  <th>Generate Lot</th>
                  <th>Lot Weight</th>
                  <th>Lot Quantity</th>
                  <th>ARC Process Name</th>
                  <th>Product Name</th>
                  <th>Department</th>
                  <th>Melting Lot No</th>
                  <th>Invest Date</th>
                  <th>Order Status</th>
                  <th>Generate Lot Status</th>
                </tr>
              </thead>
              <tbody>';
        foreach ($order_status_lists as $list_index => $order_status_list) {
          $total_weight += $order_status_list['generate_lot_weight'];
          echo '<tr>
                  <td>'.$order_status_list['sales_order_no'].'</td>
                  <td>'.$order_status_list['customer_name'].'</td>
                  <td>'.four_decimal($order_status_list['in_lot_purity']).'</td>
                  <td>'.four_decimal($order_status_list['in_weight']).'</td>
                  <td>'.intval($order_status_list['quantity']).'</td>
                  <td>'.$order_status_list['generate_lot_no'].'</td>
                  <td>'.four_decimal($order_status_list['generate_lot_weight']).'</td>
                  <td>'.$order_status_list['generate_lot_quantity'].'</td>
                  <td>'.$order_status_list['generate_lot_process'].'</td>
                  <td>'.$order_status_list['product_name'].'</td>
                  <td>'.@$order_status_list['department_name'].'</td>
                  <td>'.@$order_status_list['lot_no'].'</td>
                  <td>'.@$order_status_list['investment_date'].'</td>
                  <td>'.@$order_status_list['order_status'].'</td>
                  <td>'.@$order_status_list['generate_lot_status'].'</td>
                </tr>';
        }
      echo    '</tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th>'.four_decimal($total_weight).'</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
            <br>';
    }
  }
?> -->


<?php
  if(!empty($order_status_records)){
    echo '<table class="table table-sm table-default table-hover">
            <thead>
              <tr>
                <th>Generate Lot</th>
                <th>Customer Name</th>
                <th>Purity</th>
                <th>Order Weight</th>
                <th>Melting Lot</th>
                <th>Process Name</th>
                <th>Department Name</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>';

    foreach ($order_status_records as $record_index => $order_status_lists) {

      echo '<tr>
              <td>'.$order_status_lists['generate_lot'].'</td>
              <td>'.$order_status_lists['customer_name'].'</td>
              <td>'.$order_status_lists['purity'].'</td>
              <td>'.$order_status_lists['in_weight'].'</td>
              <td>'.$order_status_lists['melting_lot'].'</td>
              <td>'.$order_status_lists['process_name'].'</td>
              <td>'.$order_status_lists['department_name'].'</td>
              <td>'.$order_status_lists['status'].'</td>
            </tr>';
    }
    echo    '</tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
            <br>';
  }
?>