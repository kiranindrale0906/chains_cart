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
          <th rowspan="2" class="align-middle">TYPE</th>
          <th rowspan="2" class="align-middle">CHAIN</th>
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
          <td><?php echo $record['settings']['type']; ?></td>
          <td><?php echo $record['settings']['chain']; ?></td>
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
          <th colspan="8">Die 1</th>
        </tr>
        <tr>
          <th rowspan="2">Code</th>
          <th rowspan="2">Pieces</th>
          <th rowspan="2">Weight</th>
          <th colspan="3">Strip 1</th>
          <th colspan="2">Langari 1</th>
        </tr>
        <tr>
          <th>Width</th>
          <th>Thickness</th>
          <th>Wt</th>
          <th>Size</th>
          <th>Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['die_1']['code'] ?></td>
          <td><?php echo $record['die_1']['pcs'] ?></td>
          <td><?php echo $record['die_1']['wt'] ?></td>
          <td><?php echo $record['strip_1_required']['width'] ?></td>
          <td><?php echo $record['strip_1_required']['thickness'] ?></td>
          <td><?php echo $record['strip_1_required']['wt'] ?></td>
          <td><?php echo $record['langari_1_required']['size'] ?></td>
          <td><?php echo $record['langari_1_required']['wt'] ?></td>
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
          <th colspan="8">Die 2</th>
        </tr>
        <tr>
          <th rowspan="2">Code</th>
          <th rowspan="2">Pieces</th>
          <th rowspan="2">Weight</th>
          <th colspan="3">Strip 2</th>
          <th colspan="2">Langari 2</th>
        </tr>
        <tr>
          <th>Width</th>
          <th>Thickness</th>
          <th>Wt</th>
          <th>Size</th>
          <th>Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['die_2']['code'] ?></td>
          <td><?php echo $record['die_2']['pcs'] ?></td>
          <td><?php echo $record['die_2']['wt'] ?></td>
          <td><?php echo $record['strip_2_required']['width'] ?></td>
          <td><?php echo $record['strip_2_required']['thickness'] ?></td>
          <td><?php echo $record['strip_2_required']['wt'] ?></td>
          <td><?php echo $record['langari_2_required']['size'] ?></td>
          <td><?php echo $record['langari_2_required']['wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="col-sm-3">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th colspan="3">Hook required</th>
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
  <div class="col-sm-3">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th colspan="3">Lock required</th>
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
  <div class="col-sm-2">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th>KDM Required</th>
        </tr>
        <tr>
          <th>GMS</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['kdm_required'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-4">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th colspan="3">Solid Wire Required</th>
        </tr>
        <tr>
          <th>Shape</th>
          <th>Size</th>
          <th>Weight</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['solid_wire']['shape'] ?></td>
          <td><?php echo $record['solid_wire']['size'] ?></td>
          <td><?php echo $record['solid_wire']['wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<?php
for($i=1;$i<=4;$i++) {
  if($record['link_'.$i]['wt_with_iron'] > 0) { ?>
    <div class="row">
      <div class="col-sm-12">
        <table class="table table-bordered table-sm text-center">
          <thead>
            <tr>
              <th colspan="11">Link <?php echo $i; ?> Required</th>
            </tr>
            <tr>
              <th>Wire size</th>
              <th>Pieces</th>
              <th>Weight per link</th>
              <th>Weight with iron</th>
              <th>Salai</th>
              <th>Size</th>
              <th>Tape</th>
              <th>Press</th>
              <th>Wire type</th>
              <th>Remark</th>
              <th>Finish</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $record['link_'.$i]['wire_size'] ?></td>
              <td><?php echo $record['link_'.$i]['pcs'] ?></td>
              <td><?php echo $record['link_'.$i]['wt_per_link'] ?></td>
              <td><?php echo $record['link_'.$i]['wt_with_iron'] ?></td>
              <td><?php echo $record['link_'.$i]['salai'] ?></td>
              <td><?php echo $record['link_'.$i]['size'] ?></td>
              <td><?php echo $record['link_'.$i]['tape'] ?></td>
              <td><?php echo $record['link_'.$i]['press'] ?></td>
              <td><?php echo $record['link_'.$i]['wire_type'] ?></td>
              <td><?php echo $record['link_'.$i]['remark'] ?></td>
              <td><?php echo $record['link_'.$i]['finish'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  <?php }
} ?>

<div class="row">
  <div class="col-sm-6">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th colspan="2">AG Iron Wire and strip</th>
        </tr>
        <tr>
          <th>Total AG Iron Wire Required</th>
          <th>Total AG Strip Required</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['total_ag_iron_wire_required']; ?></td>
          <td><?php echo $record['total_ag_strip_required']; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-6">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th colspan="2">Langari 3 Required</th>
        </tr>
        <tr>
          <th>Size</th>
          <th>Weight</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['langari_3_required']['size']; ?></td>
          <td><?php echo $record['langari_3_required']['wt']; ?></td>
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
          <th colspan="5">Pipe 1 Required</th>
        </tr>
        <tr>
          <th>Type/Size</th>
          <th>Finish</th>
          <th>Pieces</th>
          <th>Weight per piece</th>
          <th>Total weight</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['pipe_1_required']['type_size'] ?></td>
          <td><?php echo $record['pipe_1_required']['finish'] ?></td>
          <td><?php echo $record['pipe_1_required']['pcs'] ?></td>
          <td><?php echo $record['pipe_1_required']['wt_per_pc'] ?></td>
          <td><?php echo $record['pipe_1_required']['total_wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-6">
    <table class="table table-bordered table-sm text-center">
      <thead>
        <tr>
          <th colspan="5">Pipe 2 Required</th>
        </tr>
        <tr>
          <th>Type/Size</th>
          <th>Finish</th>
          <th>Pieces</th>
          <th>Weight per piece</th>
          <th>Total weight</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['pipe_2_required']['type_size'] ?></td>
          <td><?php echo $record['pipe_2_required']['finish'] ?></td>
          <td><?php echo $record['pipe_2_required']['pcs'] ?></td>
          <td><?php echo $record['pipe_2_required']['wt_per_pc'] ?></td>
          <td><?php echo $record['pipe_2_required']['total_wt'] ?></td>
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