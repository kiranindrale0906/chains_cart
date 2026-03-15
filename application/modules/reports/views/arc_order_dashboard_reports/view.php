<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Arc Order Listing Report</h6>
  <form class="fields-group-sm">
    <div class="row">
     <?php load_field('dropdown',array('field' => 'process_name', 'col'=>'col-sm-4','option'=>$process_names));?> 
      <?php load_field('dropdown',array('field' => 'purity', 'col'=>'col-sm-4','option'=>$purities));?>
      <?php load_field('dropdown',array('field' => 'colour', 'col'=>'col-sm-4','option'=>$colours))?>
      <?php load_field('hidden',array('field' => 'type'));?> 
      <?php load_field('dropdown',array('field' => 'customer_name', 'col'=>'col-sm-4','option'=>$customer_names))?>
      <?php load_field('dropdown',array('field' => 'order_no', 'col'=>'col-sm-4','option'=>$order_nos))?>
      <?php ($_GET['type'] != 'order_pending' && $_GET['type'] != 'approval_order')?load_field('dropdown',array('field' => 'status', 'col'=>'col-sm-4','option'=>$statuses)):""?></div>
  </form>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
    <thead>
    <tr>
      <th></th>
      <th>Date</th>
      <th>Lot No</th>
      <th>Purity</th>
      <th>Colour</th>
      <th>Lot Weight</th>
      <th>Lot Quantity</th>
      <th>Process Name</th>
      <th>Remark</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $total_lot_weight = 0;
      $total_lot_qty = 0;
      $i = 1;
      if(!empty($generate_lot_details)){

        foreach ($generate_lot_details as $index => $record) {
          $total_lot_weight +=($_GET['type'] == 'order_pending' || $_GET['type'] == 'approval_order')?$record['weight']:$record['lot_weight'];
          $total_lot_qty += ($_GET['type'] == 'order_pending' || $_GET['type'] == 'approval_order')?$record['quantity']:$record['lot_qty'];
      ?>
         <tr>
            <td><?=$i?></td>
            <td><?=$record['created_at'];?></td>
            <td><?=$record['lot_no'];?></td>
            <td><?=$record['purity'];?></td>
            <td><?=$record['colour'];?></td>
            <td><?=($_GET['type'] == 'order_pending' || $_GET['type'] == 'approval_order')?$record['weight']:$record['lot_weight'];?></td>
            <td><?=($_GET['type'] == 'order_pending' || $_GET['type'] == 'approval_order')?$record['quantity']:$record['lot_qty'];?></td>
            <td><?=$record['process_name'];?></td>
            <td><?=$record['remark'];?></td>
            <td><?=$record['status'];?></td>
            </tr>
        
        <?php $i++; }?>
        <tr class="bg_gray bold">
          <td >Total</td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ><?=four_decimal($total_lot_weight);?></td>
          <td ><?=four_decimal($total_lot_qty);?></td>
          <td ></td>
          <td ></td>
          <td ></td>
        </tr> 
     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
  </table>
</div>
</div>
</div>