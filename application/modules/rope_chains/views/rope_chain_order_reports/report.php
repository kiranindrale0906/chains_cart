<?php if(isset($view_type) && $view_type == 'melting_lots') { ?>
<h6 class="heading blue bold text-uppercase mb-0">Rope chain order details</h6>
<?php } else { ?>
<h5 class="heading blue bold text-uppercase">Rope chain order report</h5>
<?php } ?>
<?php 
if($orders){
  $qty_array = [8, 16, 18, 20, 22, 24, 26];
  $columns = array_merge($qty_array , ['custom_1', 'custom_2', 'total']);
  foreach($orders as $order){ ?>
    <div class="row">
      <div class="col-sm-12">
        <h6 class="heading">Order ID: ORD-<?php echo $order['id']; ?></h6>
          <p class="m0"> MELTING : <?php echo $order['melting']; ?> </p>
          <p class="m0"> CHAIN CODE : <?php echo $order['chain_code']; ?> </p>
          <p class="m0"> VARIENT : <?php echo $order['varient']; ?> </p>
          <p class="m0"> STATUS : <?php echo $order['status']; ?>
            <?php if($order['status'] == 'OPEN') { ?>
              <a class="btn btn-sm btn-primary ajax_post" href="<?php echo ADMIN_PATH; ?>/rope_chains/rope_chain_orders/update/<?php echo $order['id']; ?>" data-ajax='<?php echo json_encode(array('rope_chain_orders[id]' => $order['id'], 'rope_chain_orders[status]' => 'CLOSED', 'submittype' => 'json')) ?>'>Close</a>
            <?php } ?>
          </p>
      </div>
      <div class="col-sm-12">
        <table class="table table-bordered table-sm table-default">
          <thead>
            <tr>
              <th></th>
              <?php foreach($qty_array as $qty) {
                echo '<th class="text-right">'.$qty.'"</th>';
              } ?>
              <th class="text-right"><?php echo $order['custom_1_length'] ?>" (Custom length 1)</th>
              <th class="text-right"><?php echo $order['custom_2_length'] ?>" (Custom length 2)</th>
              <th class="text-right">Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Order Quantity</td>
              <?php foreach ($columns as $column){
                ?> <td class="text-right"><?php echo $order[$column.'_order_qty']; ?></td> <?php
              }?>
            </tr>
            <tr>
              <td>Production Quantity</td>
              <?php foreach ($columns as $column){
                ?> <td class="text-right"><?php echo floor($order[$column.'_production_qty']); ?></td> <?php
              }?>
            </tr>
            <tr>
              <td>Ready Quantity</td>
              <?php foreach ($columns as $column){
                ?> <td class="text-right"><?php echo $order[$column.'_ready_qty']; ?></td> <?php
              }?>
            </tr>
            <tr>
              <td>Balance Quantity</td>
              <?php foreach ($columns as $column){
                ?> <td class="text-right"><?php echo $order[$column.'_balance_qty']; ?></td> <?php
              }?>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <hr>
  <?php }
} else { ?>
  <div class="row">
    <div class="col"><h5> No orders found</h5></div>
  </div>
<?php } ?>