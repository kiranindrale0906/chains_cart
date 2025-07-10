<div class="row">
<?php 
?>
</div>
<div class="col-md-12">
  <table class="table table-sm table-default table-hover">
    <thead>
      <tr>
        <th>Sr No</th>
        <th>Sales Order</th>
        <th>Lot No</th>
        <th>Customer Name</th>
        <th>Purity</th>
        <th>Lot Weight</th>
        <th>Order Date</th>
        <th>Due Date</th>
        <th>Process</th>
        <th>Order Status</th>
        <th>Remark</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $total_weight = 0;
      foreach ($pending_orders as $index => $pending_order) {
      $total_weight += $pending_order['lot_weight'];
        echo '<tr>
                <td>'.++$index.'</td>
                <td>'.$pending_order['order_no'].'</td>
                <td>'.$pending_order['lot_no'].'</td>
                <td>'.$pending_order['customer_name'].'</td>
                <td>'.$pending_order['purity'].'</td>
                <td>'.$pending_order['lot_weight'].'</td>
                <td>'.$pending_order['order_date'].'</td>
                <td>'.$pending_order['due_date'].'</td>
                <td>'.$pending_order['process_name'].'</td>
                <td>'.$pending_order['status'].'</td>
                <td>'.$pending_order['remark'].'</td>
              </tr>';
      }
    ?>
    </tbody>
    <tfoot>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th><?php echo four_decimal($total_weight);?></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </tfoot>
  </table>
</div>
