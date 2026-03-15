<h6 class='blue text-uppercase bold mb-3'>Chain Dashboard</h6>
<div class='row'>
</div>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Design Code</th>
	    <th>Balance</th>
	    <th>Balance Gross</th>
	    <th>Balance Fine</th>
	  </tr>
	</thead>
	<tbody>
    <?php
      if(!empty($records)){
        foreach ($records as $index => $record) {
          ?>
         <tr>
            <td><?= $record['design_code']?></td>
            <td><?= four_decimal($record['balance']) ?></td>
            <td><?= four_decimal($record['balance_gross']) ?></td>
            <td><?= four_decimal($record['balance_fine']) ?></td>
          </tr> 
        <?php }?>
     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
	</table>
</div>
