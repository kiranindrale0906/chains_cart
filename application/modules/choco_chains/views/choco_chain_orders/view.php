<?php 
$qty_array = [8, 16, 18, 20, 22, 24, 26];
$order_qty_array = array_merge($qty_array, ['custom_1', 'custom_2']);
?>
<h5 class="heading">Choco Chain Order Details</h5>
<div class="row">
  <div class="col">
      <a class="btn btn-outline-primary btn-sm float-right ajax ml-1" data-toggle="modal" data-target="#ajax_modal" data-title="Edit Choco Chain Bom" href="<?php echo base_url().'choco_chains/choco_chain_orders/edit/'.$record['id'] ?>">Quick Edit</a>
    <h6>
      Order ID: ORD-<?php echo $record['id']; ?><br>
      Type: <?php echo $record['settings']['type']; ?><br>
      Chain: <?php echo $record['settings']['chain']; ?><br>
      Melting: <?php echo $record['settings']['melting']; ?><br>
      Tone: <?php echo $record['tone']; ?><br>
      Order Status: <?php echo $record['status']; ?>
    </h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <?php foreach($qty_array as $qty) {
            echo '<th class="text-right">'.$qty.'" Quantity</th>';
          } ?>
          <th class="text-right"><?php echo $record['custom_1_length']; ?>" Quantity (Custom length 1)</th>
          <th class="text-right"><?php echo $record['custom_2_length']; ?>" Quantity (Custom length 2)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php foreach($order_qty_array as $qty) {
            echo '<td class="text-right">'.$record[$qty.'_order_qty'].'</td>';
          } ?>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col">
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <th class="text-right">Total Inches</th>
          <th class="text-right">Total Chains</th>
          <th class="text-right">Total Chain Weight</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-right"><?php echo $record['total_inches'] ?></td>
          <td class="text-right"><?php echo $record['total_chains'] ?></td>
          <td class="text-right"><?php echo $record['total_chain_wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <h6>Die 1 Required</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <th>Code</th>
          <th class="text-right">Pieces</th>
          <th class="text-right">Weight</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['die_1']['code'] ?></td>
          <td class="text-right"><?php echo $record['die_1']['pcs'] ?></td>
          <td class="text-right"><?php echo $record['die_1']['wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-6">
    <h6>Die 2 Required</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <th>Code</th>
          <th class="text-right">Pieces</th>
          <th class="text-right">Weight</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['die_2']['code'] ?></td>
          <td class="text-right"><?php echo $record['die_2']['pcs'] ?></td>
          <td class="text-right"><?php echo $record['die_2']['wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-sm-3">
    <h6>Strip 1 Required</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <th class="text-right">Width</th>
          <th class="text-right">Thickness</th>
          <th class="text-right">Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-right"><?php echo $record['strip_1_required']['width'] ?></td>
          <td class="text-right"><?php echo $record['strip_1_required']['thickness'] ?></td>
          <td class="text-right"><?php echo $record['strip_1_required']['wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-3">
    <h6>Strip 2 Required</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <th class="text-right">Width</th>
          <th class="text-right">Thickness</th>
          <th class="text-right">Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-right"><?php echo $record['strip_2_required']['width'] ?></td>
          <td class="text-right"><?php echo $record['strip_2_required']['thickness'] ?></td>
          <td class="text-right"><?php echo $record['strip_2_required']['wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-3">
    <h6>Langari 1 Required</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <th>Size</th>
          <th class="text-right">Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['langari_1_required']['size'] ?></td>
          <td class="text-right"><?php echo $record['langari_1_required']['wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-3">
    <h6>Langari 2 Required</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <th>Size</th>
          <th class="text-right">Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['langari_2_required']['size'] ?></td>
          <td class="text-right"><?php echo $record['langari_2_required']['wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <h6>Hook Required</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
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
  <div class="col-sm-6">
    <h6>Lock Required</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
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
</div>
<div class="row">
  <div class="col-sm-4">
    <h6>KDM Required</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <th class="text-right">GMS</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-right"><?php echo $record['kdm_per_inch'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-8">
    <h6>Pipe Required</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <th>Type/Size</th>
          <th class="text-right">Pieces</th>
          <th class="text-right">Weight per piece</th>
          <th class="text-right">Total weight</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['pipe_required']['type_size'] ?></td>
          <td class="text-right"><?php echo $record['pipe_required']['pcs'] ?></td>
          <td class="text-right"><?php echo $record['pipe_required']['wt_per_pc'] ?></td>
          <td class="text-right"><?php echo $record['pipe_required']['total_wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <h6>Melting Lot Details</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <th>Lot No</th>
          <th class="text-right">Lot Purity</th>
          <th class="text-right">Gross Weight</th>
          <th>Created At</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          if(!empty($record['melting_lots'])) {
            foreach ($record['melting_lots'] as $melting_lot) { ?> 
              <tr>
                <td><?php echo $melting_lot['lot_no'] ?></td>
                <td class="text-right"><?php echo $melting_lot['lot_purity'] ?></td>
                <td class="text-right"><?php echo $melting_lot['gross_weight'] ?></td>
                <td><?php echo $melting_lot['created_at'] ?></td>
              </tr>
          <?php }} else { ?>
            <tr><td colspan="4">No records found.</td></tr>
          <?php } ?>
      </tbody>
    </table>
  </div>
</div>