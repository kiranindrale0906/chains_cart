<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Hand Dull Report</h6>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Product Name</th>
      <th>Process Name</th>
      <th>Lot Purity</th>
      <th>IN</th>
      <th>OUT</th>
      <th>Design Code</th>
      <th>Karigar</th>
      <th>Ghiss</th>
      <th>Loss</th>
      <th>Balance </th>
	    <th>Balance Fine</th>
      <th>Action</th>
	  </tr>
	</thead>
	<tbody>
    <?php
      $total = 0;
      $total_fine = 0;
      if(!empty($record['hand_dull_data'])){
        foreach ($record['hand_dull_data'] as $index => $record) {
          $total += $record['balance'];
          $total_fine += $record['balance_fine'];
          ?>
         <tr>
            <td><?= !empty($record['product_name'])?$record['product_name']:'-' ?></td>
            <td><?= !empty($record['process_name'])?$record['process_name']:'-' ?></td>
            <td><?= !empty($record['in_lot_purity'])?$record['in_lot_purity']:'-' ?></td>
            <td><?= !empty($record['in_weight'])?$record['in_weight']:'-' ?></td>
            <td><?= !empty($record['out_weight'])?$record['out_weight']:'-' ?></td>
            <td><?= !empty($record['design_code'])?$record['design_code']:'-' ?></td>
            <td><?= !empty($record['karigar'])?$record['karigar']:'-' ?></td>
            <td><?= !empty($record['ghiss'])?$record['ghiss']:'-' ?></td>
            <td><?= !empty($record['loss'])?$record['loss']:'-' ?></td>
            <td><?= four_decimal($record['balance']) ?></td>
            <td><?= four_decimal($record['balance_fine']) ?></td>
            <td><a href="<?= base_url().'bar_codes/bar_codes/view/1?barcode_value='.(isset($record['id'])?$record['id']:''); ?>">EDIT</a></td>
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
          <td class=" bold"><?=four_decimal($total);?></td>
          <td class=" bold"><?=four_decimal($total_fine);?></td>
          <td class=" bold"></td>
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