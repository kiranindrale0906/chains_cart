<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>GPC Out Report</h6>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Product Name</th>
      <th>Design Name</th>
      <th>Purity</th>
      <th>OUT Weight</th>
      <th>Micro Coating</th>
      <th>GPC Powder</th>
      <th>KCN</th>
      
	  </tr>
	</thead>
	<tbody>
    <?php
      $total = 0;
      $total_gpc_powder=$total_micro= 0;
      $total_kcn = 0;
      if(!empty($record['gpc_out_data'])){
        foreach ($record['gpc_out_data'] as $index => $record) {
          $total += $record['out_weight'];
          $total_gpc_powder += $record['gpc_powder'];
          $total_kcn += $record['kcn'];
          $total_micro+= $record['micro_coating'];
          ?>
         <tr>
            <td><?= !empty($record['product_name'])?$record['product_name']:'-' ?></td>
            <td><?= !empty($record['melting_lot_category_four'])?$record['melting_lot_category_four']:'-' ?></td>
            <td><?= !empty($record['in_lot_purity'])?$record['in_lot_purity']:'-' ?></td>
            <td><?= !empty($record['out_weight'])?four_decimal($record['out_weight']):'-' ?></td>
            <td><?= !empty($record['micro_coating'])?four_decimal($record['micro_coating']):'-' ?></td>
            <td><?= !empty($record['gpc_powder'])?four_decimal($record['gpc_powder']):'-' ?></td>
            <td><?= !empty($record['kcn'])?four_decimal($record['kcn']):'-' ?></td>
            </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
        
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td class=" bold"><?=four_decimal($total);?></td>
          <td  class=" bold"><?=four_decimal($total_micro);?></td>
          <td  class=" bold"><?=four_decimal($total_gpc_powder);?></td>
          <td  class=" bold"><?=four_decimal($total_kcn);?></td>
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