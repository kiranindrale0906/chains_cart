<?php
if (!empty($orders[0])){
  $record = $orders[0];
}
$qty_array = [8, 16, 18, 20, 22, 24, 26];
$custom_qty_array =  ['custom_1', 'custom_2'];
$order_qty_array = array_merge($qty_array, $custom_qty_array);
$qty_col_count = 0;
foreach($order_qty_array as $qty) {
  if($record[$qty.'_production_qty'] != 0) {
    $qty_col_count++;
  }
} ?>
<div class="row">
  <div class="col-sm-3">
    <table class="table table-bordered table-sm text-center">
      <tr>
        <td>Parent Order ID</td>
        <td><?php echo $record['parent_order_id']; ?></td>
      </tr>
    </table>
  </div>
</div>
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
          <th rowspan="2" class="align-middle">CODE</th>
          <th rowspan="2" class="align-middle">VARIENT</th>
          <th rowspan="2" class="align-middle">MELTING</th>
          <th rowspan="2" class="align-middle">TONE</th>
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
              echo '<th>'.$record[$qty.'_length'].'" Quantity (Custom length '.($i+1).')</th>';
            }
          }
          ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['settings']['code']; ?></td>
          <td><?php echo $record['settings']['varient']; ?></td>
          <td><?php echo $record['settings']['melting']; ?></td>
          <td><?php echo $record['tone']; ?></td>
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
  <div class="col">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th class="text-right">Total Chains</th>
          <th class="text-right">Total Inches</th>
          <th class="text-right">Total end length</th>
          <th class="text-right">Total center length</th>
          <th class="text-right">Total cap length</th>
          <th class="text-right">Total unit length</th>
          <th class="text-right">Total no of units</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-right"><?php echo $record['total_chains'] ?></td>
          <td class="text-right"><?php echo $record['total_inches'] ?></td>
          <td class="text-right"><?php echo $record['total_end_length'] ?></td>
          <td class="text-right"><?php echo $record['total_center_length'] ?></td>
          <td class="text-right"><?php echo $record['total_cap_length'] ?></td>
          <td class="text-right"><?php echo $record['total_unit_length'] ?></td>
          <td class="text-right"><?php echo $record['total_no_of_units'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<?php for($i = 1; $i <= 6; $i++) { ?>
  <?php if($record['wire_'.$i]['kadi_wt'] != 0) { ?>
    <div class="row">
      <div class="col-sm-12">
        <table class="table table-bordered table-sm text-center">
          <thead>
            <tr>
              <th colspan="10">Wire <?php echo $i; ?> details</th>
            </tr>
            <tr>
              <th>Size</th>
              <th>Shape</th>
              <th>Type</th>
              <th>Finish</th>
              <th class="text-right">Salai height</th>
              <th class="text-right">Salai width</th>
              <th class="text-right">Tape</th>
              <th>Salai shape</th>
              <th>Remark</th>
              <th class="text-right">Kadi wt</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $record['wire_'.$i]['size'] ?></td>
              <td><?php echo $record['wire_'.$i]['shape'] ?></td>
              <td><?php echo $record['wire_'.$i]['type'] ?></td>
              <td><?php echo $record['wire_'.$i]['finish'] ?></td>
              <td class="text-right"><?php echo $record['wire_'.$i]['salai_height'] ?></td>
              <td class="text-right"><?php echo $record['wire_'.$i]['salai_width'] ?></td>
              <td class="text-right"><?php echo $record['wire_'.$i]['tape'] ?></td>
              <td><?php echo $record['wire_'.$i]['salai_shape'] ?></td>
              <td><?php echo $record['wire_'.$i]['remark'] ?></td>
              <td class="text-right"><?php echo $record['wire_'.$i]['kadi_wt'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  <?php } ?>
<?php } ?>
<?php foreach(['ag', 'pl'] as $type) { ?>
  <div class="row">
    <div class="col-sm-4">
      <table class="table table-bordered table-sm text-center">
        <thead>
          <tr>
            <th colspan="">TOTAL <?php echo strtoupper($type); ?> WIRE REQUIRED</th>
          </tr>
          <tr>
            <th class="text-right">TOTAL <?php echo strtoupper($type); ?> WIRE REQUIRED</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-right"><?php echo $record['total_'.$type.'_wire_required'] ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-sm-4">
      <table class="table table-bordered table-sm text-center">
        <thead>
          <tr>
            <th colspan="2"><?php echo strtoupper($type); ?> STRIP REQUIRED</th>
          </tr>
          <tr>
            <th class="text-right">SIZE</th>
            <th class="text-right">WEIGHT</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-right"><?php echo $record['total_'.$type.'_strip_required']['size'] ?></td>
            <td class="text-right"><?php echo $record['total_'.$type.'_strip_required']['weight'] ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-sm-4">
      <table class="table table-bordered table-sm text-center">
        <thead>
          <tr>
            <th colspan="2">TOTAL <?php echo strtoupper($type); ?> LANGARI REQUIRED</th>
          </tr>
          <tr>
            <th class="text-right">SIZE</th>
            <th class="text-right">WEIGHT</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-right"><?php echo $record['total_'.$type.'_langari_required']['size'] ?></td>
            <td class="text-right"><?php echo $record['total_'.$type.'_langari_required']['weight'] ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
<?php } ?>
<div class="row">
  <div class="col-sm-4">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th colspan="3">Hook Required</th>
        </tr>
        <tr>
          <th>Size</th>
          <th class="text-right">Qty</th>
          <th class="text-right">Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['hook_required']['size'] ?></td>
          <td class="text-right"><?php echo $record['hook_required']['qty'] ?></td>
          <td class="text-right"><?php echo $record['hook_required']['wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-4">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th colspan="3">Lock Required</th>
        </tr>
        <tr>
          <th>Size</th>
          <th class="text-right">Qty</th>
          <th class="text-right">Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['lock_required']['size'] ?></td>
          <td class="text-right"><?php echo $record['lock_required']['qty'] ?></td>
          <td class="text-right"><?php echo $record['lock_required']['wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-4">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th>KDM Required</th>
        </tr>
        <tr>
          <th class="text-right">GMS</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-right"><?php echo $record['kdm_required'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<button class="btn btn-primary btn-sm d-print-none" id="btn_print" onclick="window.print()" data-title="Print this page"><i class="fas fa-print"></i> Print</button>

<script type="text/javascript">
  window.onload = function() {
    document.title = 'Imp Italy chain order details - Order ID <?php echo $record['id']; ?> & Melting lot id <?php echo $record['melting_lot_id']; ?> ';
    window.print()
  }
</script>