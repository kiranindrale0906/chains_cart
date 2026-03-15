<div class="row">
<div class="col-sm-6">
<h6 class='blue text-uppercase bold mb-3'>Chain Making</h6>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Karigar</th>
	    <th>Purity</th>
	    <th>Balance</th>
	  </tr>
	</thead>
	<tbody>
    <?php
      $total = 0;
      if(!empty($chain_making)){
        foreach ($chain_making as $index => $record) {
          $total += $record['balance'];
          ?>
         <tr>
            <td><?= !empty($record['karigar'])?$record['karigar']:'-' ?></td>
            <td><?= four_decimal($record['in_lot_purity']) ?></td>
            <td><?= four_decimal($record['balance']) ?></td>
          </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td class=" bold"></td>

          <td class=" bold"><?=four_decimal($total);?></td>
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