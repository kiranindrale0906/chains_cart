<?php
if (!empty($orders[0])){
  $record = $orders[0];
}

$qty_array = [18, 20, 22, 24];
$custom_qty_array =  ['custom_1', 'custom_2'];
$order_qty_array = array_merge($qty_array, $custom_qty_array);
$qty_col_count = 0;
foreach($order_qty_array as $qty) {
  if($record[$qty.'_production_qty'] != 0) {
    $qty_col_count++;
  }
}

?>
<div class="row">
  <div class="col-sm-3">
    <table class="table table-bordered table-sm text-center">
      <tr>
        <td>Order ID</td>
        <td>ORD-<?php echo $record['id']; ?></td>
      </tr>
    </table>
  </div>
  <div class="col-sm-3 offset-sm-1">
    <table class="table table-bordered table-sm text-center">
      <tr>
        <td>Order Date</td>
        <td><?php echo date('d/m/Y', strtotime($record['created_at'])); ?></td>
      </tr>
    </table>
  </div>
  <div class="col-sm-3 offset-sm-1">
    <table class="table table-bordered table-sm text-center">
      <tr>
        <td>Due Date</td>
        <td><?php echo date('d/m/Y', strtotime($record['created_at']. ' + 7 days')); ?></td>
      </tr>
    </table>
  </div>
</div>
<div class="row">
  <div class="col">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th rowspan="2" class="align-middle">MELTING</th>
          <th rowspan="2" class="align-middle">CHAIN NAME</th>
          <th rowspan="2" class="align-middle">TONE</th>
          <th rowspan="2" class="align-middle">FANCY CHAIN</th>
          <th colspan="<?php echo $qty_col_count; ?>">SIZE DETAILS</th>
          <th rowspan="2" class="align-middle">TOTAL CHAINS</th>
        </tr>
        <tr>
          <?php foreach($qty_array as $qty) {
            if($record[$qty.'_production_qty'] != 0) {
              echo '<th>'.$qty.'" Quantity</th>';
            }
          }
          foreach($custom_qty_array as $i => $qty) {
            if($record[$qty.'_production_qty'] != 0) {
              echo '<th>'.$record[$qty.'_order_length'].'" Quantity (Custom '.($i+1).' length)</th>';
            }
          }
          ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['settings']['melting']; ?></td>
          <td><?php echo $record['settings']['chain_name']; ?></td>
          <td><?php echo $record['tone']; ?></td>
          <td><?php echo $record['fancy_chain']; ?></td>
          <?php foreach($order_qty_array as $qty) {
            if($record[$qty.'_production_qty'] != 0) {
              echo '<td>'.$record[$qty.'_production_qty'].'</td>';
            }
          }
          ?>
          <td><?php echo $record['total_production_qty'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>


<div class="row">
  <div class="col-sm-6">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th colspan="3">STRIP</TH>
        </TR>
        <tr>
          <th>Width</th>
          <th>Thickness</th>
          <th>Weight</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo round($record['strip_required']['width'], 2) ?></td>
          <td><?php echo round($record['strip_required']['thickness'], 2) ?></td>
          <td><?php echo round($record['strip_required']['wt'], 2); ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-6">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th colspan="2">LANGARI</th>
        </tr>
        <tr>
          <th>Size</th>
          <th>Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['langri_required']['size'] ?></td>
          <td><?php echo round($record['langri_required']['wt'], 2); ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th colspan="3">HOOK REQUIRED</th>
        </tr>
        <tr>
          <th>Size</th>
          <th>Qty</th>
          <th>Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['hook_required']['size'] ?></td>
          <td><?php echo $record['hook_required']['qty'] ?></td>
          <td><?php echo round($record['hook_required']['wt'], 2); ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-6">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th colspan="3">LOCK REQUIRED</th>
        </tr>
        <tr>
          <th>Size</th>
          <th>Qty</th>
          <th>Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['lock_required']['size'] ?></td>
          <td><?php echo $record['lock_required']['qty'] ?></td>
          <td><?php echo round($record['lock_required']['wt'], 2); ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<button class="btn btn-primary btn-sm d-print-none" id="btn_print" onclick="window.print()" data-title="Print this page"><i class="fas fa-print"></i> Print</button>

<script type="text/javascript">
  window.onload = function() {
    document.title = 'Round Box Chain Order Details - Order ID <?php echo $record['id']; ?> & Melting lot id <?php echo $record['melting_lot_id']; ?> ';
    window.print()
  }
</script>