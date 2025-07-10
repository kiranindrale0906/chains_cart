<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Design wise Order Detail Report</h6>
<form class="fields-group-sm">
  <div class="row">
    <?php load_field('text',array('field' => 'item_code','readonly'=>'readonly', 'name' => 'item_code', 'col'=>'col-sm-2'));?>
    <?php load_field('dropdown',array('field' => 'customer_name', 'name' => 'customer_name', 'col'=>'col-sm-2','option' => $customer_name));?>
    <?php load_field('dropdown',array('field' => 'purity', 'name' => 'purity', 'col'=>'col-sm-2','option' => $purities));?>
    <?php load_field('date', array('field' => 'from_date', 'name' => 'from_date', 'class' => 'datepicker_js', 'col'=>'col-sm-2'));?>
    <?php load_field('date', array('field' => 'to_date', 'name' => 'to_date','class' => 'datepicker_js', 'col'=>'col-sm-2'));?>  
    <div class="col-sm-3 align-self-center">
      <?php load_buttons('submit', array('name' =>'Search','class'=>'btn-xs btn_blue mr-2')) ?> 
      <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs clear_btn btn_blue')) ?>
    </div>
  </div>
</form>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Design Code</th>
	    <th>Factory Bom Code</th>
      <th>Order Date</th>
      <th>Order No</th>
      <th>Generate Lot No</th>
      <th>Generate Lot Status</th>
      <th>Customer Name</th>
      <th>Colour</th>
      <th>Order Purity</th>
      <th>Order Wt</th>
      <th>Order Qty</th>
      <th>Dispatch Wt</th>
      <th>Dispatch Qty</th>
      <th>Dispatch Date</th>
      <th>Image </th>

	  </tr>
	</thead>
	<tbody>
    <?php
      $total = 0;
      $total_fine = 0;
      if(!empty($record['design_wise_order_reports'])){
        foreach ($record['design_wise_order_reports'] as $index => $record) {
          $total += $record['weight'];
          $total_fine += $record['quantity'];
	$image_path = 'https://argold-catalog.8848digital.com/';
          ?>
         <tr>
            <td><?= !empty($record['item_code'])?$record['item_code']:'-' ?></td>
            <td><?= !empty($record['bom_factory_code'])?$record['bom_factory_code']:'-' ?></td>
            <td><?= !empty($record['order_date'])?$record['order_date']:'-' ?></td>
            <td><?= !empty($record['order_no'])?$record['order_no']:'-' ?></td>
            <td><?= !empty($record['lot_no'])?$record['lot_no']:'-' ?></td>
            <td><?= !empty($record['status'])?$record['status']:'-' ?></td>
            <td><?= !empty($record['customer_name'])?$record['customer_name']:'-' ?></td>
            <td><?= !empty($record['colour'])?$record['colour']:'-' ?></td>

            <td><?= !empty($record['order_purity'])?$record['order_purity']:'-' ?></td>
            <td><?= !empty($record['weight'])?$record['weight']:'-' ?></td>
            <td><?= !empty($record['quantity'])?$record['quantity']:'-' ?></td>
            <td><?= !empty($record['dispatch_wt'])?$record['dispatch_wt']:'-' ?></td>
            <td><?= !empty($record['dispatch_qty'])?$record['dispatch_qty']:'-' ?></td>
            <td><?= !empty($record['dispatch_date'])?$record['dispatch_date']:'-' ?></td>
            <td><a href="<?= $image_path.$record['image'] ?>" target="_blank">
      <img src="<?= $image_path.$record['image'] ?>" width=70 height=70/>
    </a></td>
          </tr>
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
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
