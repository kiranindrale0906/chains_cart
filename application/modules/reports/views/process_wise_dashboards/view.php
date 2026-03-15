<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Process Wise Dashboard Listing Report</h6>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
    <thead>
    <tr>
      <th>Date</th>
      <th>Products Name</th>
      <th>Category</th>
      <th>Sub Category</th>
      <th>Process Name</th>
      <th>Department Name</th>
      <th>Lot No </th>
      <th>Balance</th>
      <th>Balance Fine</th>
      <th>Melting Wastage</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $total_balance_fine = 0;
      $total_balance_gross = 0;
      if(!empty($process_wise_dashboard_listing)){
        foreach ($process_wise_dashboard_listing as $index => $record) {

          if($_GET['type']=='daily_drawer_92' || $_GET['type']=='daily_drawer_75' || ($_GET['type']=='lock_process' && $record['product_name']!='Lock Process')){
            $record['balance_gross']=(!empty($record['in_weight'])?$record['in_weight']:'0')-(!empty($record['out_weight'])?$record['out_weight']:'0')+(!empty($record['balance'])?$record['balance']:'0') ;
            $record['balance_fine']=(!empty($record['balance_gross'])?($record['balance_gross']*$record['hook_kdm_purity']/100):0);
          }
          if($record['balance_gross']!=0){
          $total_balance_fine += $record['balance_fine'];
          $total_balance_gross += $record['balance_gross'];
      ?>
         <tr>
            <td><?= !empty($record['updated_at'])?date('d-m-Y',strtotime($record['updated_at'])):'-' ?></td>
            <td><?= !empty($record['product_name'])?$record['product_name']:'-' ?></td>
            <td><?= !empty($record['melting_lot_category_one'])?$record['melting_lot_category_one']:'-' ?></td>
            <td><?= !empty($record['melting_lot_category_two'])?$record['melting_lot_category_two']:'-' ?></td>
            <td><?= !empty($record['process_name'])?$record['process_name']:'-' ?></td>
            <td><?= !empty($record['department_name'])?$record['department_name']:'-' ?></td>
            <td><?= !empty($record['lot_no'])?$record['lot_no']:'-' ?></td>
            <td><?= !empty($record['balance_gross'])? four_decimal($record['balance_gross']):'-' ?></td>
            <td><?= !empty($record['balance_fine'])? four_decimal($record['balance_fine']):'-'?></td>
            <td><?= !empty($record['melting_wastage'])?$record['melting_wastage']:'-'?></td>
          </tr>
        
        <?php }}?>
        <tr class="bg_gray bold">
          <td >Total</td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ><?=four_decimal($total_balance_gross);?></td>
          <td ><?=four_decimal($total_balance_fine);?></td>
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