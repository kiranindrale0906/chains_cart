<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Parent Lot Name Wise Report</h6>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Product Name</th>
      <th>Parent Lot Name</th>
      <th>Balance </th>
	  
	  </tr>
	</thead>
	<tbody>
    <?php
      $total = 0;
      $total_fine = 0;
      if(!empty($record['parent_lot_wise_data'])){
        foreach ($record['parent_lot_wise_data'] as $index => $record) {
          $total += $record['balance'];
         
          ?>
         <tr>
            <td><?= !empty($record['product_name'])?$record['product_name']:'-' ?></td>
            <td><?= !empty($record['parent_lot_name'])?$record['parent_lot_name']:'-' ?></td>
            <td><a href="<?php echo base_url().'stock_summary_reports/stock_report_department_wise_balance?'.http_build_query(array('like[parent_lot_name]'=>$record['parent_lot_name']));?>"><?= four_decimal($record['balance']) ?></a></td>
           
        
          </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td  class=" bold"></td>
          
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