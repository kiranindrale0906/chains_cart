<?php 
$qty_array = [8, 16, 18, 20, 22, 24, 26];
$order_qty_array = array_merge($qty_array, ['custom_1', 'custom_2']);
?>
<h5 class="heading">Rope Chain Order Details</h5>
<div class="row">
  <div class="col">
      <a class="btn btn-outline-primary btn-sm float-right ajax ml-1" data-toggle="modal" data-target="#ajax_modal" data-title="Edit Rope Chain Bom" href="<?php echo base_url().'rope_chains/rope_chain_orders/edit/'.$record['id'] ?>">Quick Edit</a>
    <h6>
      Order ID: ORD-<?php echo $record['id']; ?><br>
      Melting: <?php echo $record['settings']['melting']; ?><br>
      Chain code: <?php echo $record['settings']['chain_code']; ?><br>
      Varient: <?php echo $record['settings']['varient']; ?><br>
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
  <div class="col-sm-6">
    <h6>Cap Required</h6>
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
          <td><?php echo $record['cap_required']['size'] ?></td>
          <td class="text-right"><?php echo $record['cap_required']['qty'] ?></td>
          <td class="text-right"><?php echo $record['cap_required']['wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<div class="row">
  <div class="col-sm-4">
    <h6>Strip Required</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <th>Size</th>
          <th class="text-right">Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['strip_required']['size'] ?></td>
          <td class="text-right"><?php echo $record['strip_required']['wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-4">
    <h6>Langari Required</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <th>Size</th>
          <th class="text-right">Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['langari_required']['size'] ?></td>
          <td class="text-right"><?php echo $record['langari_required']['wt'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-4">
    <h6>Iron Required</h6>
    <table class="table table-bordered table-sm table-default">
      <thead>
        <tr>
          <th>Size</th>
          <th class="text-right" class="text-right">Wt</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $record['iron_required']['size'] ?></td>
          <td class="text-right" class="text-right"><?php echo $record['iron_required']['wt'] ?></td>
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
          if(!empty($record['melting_lots'])){
            foreach ($record['melting_lots'] as $melting_lot){ ?> 
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