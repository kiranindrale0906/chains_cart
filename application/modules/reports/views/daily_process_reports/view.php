<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Daily Process Listing Report</h6>
  <form class="fields-group-sm">
    <div class="row">
      <?php load_field('dropdown',array('field' => 'category_one', 'col'=>'col-sm-4','option'=>$category_one));?> 
      <?php load_field('dropdown',array('field' => 'department_name', 'col'=>'col-sm-4','option'=>$department_name));?> 
      <?php load_field('hidden',array('field' => 'day','val'));?> 
      <?php load_field('hidden',array('field' => 'type'));?> 
      <?php load_field('dropdown',array('field' => 'in_purity', 'col'=>'col-sm-4','option'=>$purity))?>
    </div>
  </form>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
    <thead>
    <tr>
      <th></th>
      <th>Process id</th>
      <th>Lot No</th>
      <th>Category Name</th>
      <th>Sub Category Name</th>
      <th>Purity</th>
      <th>In Weight</th>
      <th>Out Weight</th>
      <th>Tone</th>
      <th>Product Name</th>
      <th>Department Name</th>
      <th>Balance</th>
      <th>Balance Fine</th>
      <th>Time</th>
      <th>Hold Day</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $total_balance_fine = 0;
      $total_balance_gross = 0;
      $i = 1;
      if(!empty($daily_process_listing)){

        foreach ($daily_process_listing as $index => $record) {
          $total_balance_fine += $record['balance_fine'];
          $total_balance_gross += $record['balance_gross'];
      ?>
         <tr>
            <td><?=$i?></td>
            <td><?= !empty($record['id'])?$record['id']:'-' ?></td>
            <td><?= !empty($record['lot_no'])?$record['lot_no']:'-' ?></td>
            <td><?= !empty($record['category_one'])?$record['category_one']:'-' ?></td>
            <td><?= !empty($record['category_two'])?$record['category_two']:'-' ?></td>
            <td><?= !empty($record['in_lot_purity'])?$record['in_lot_purity']:'-' ?></td>
            <td><?= !empty($record['in_weight'])?$record['in_weight']:'-' ?></td>
            <td><?= !empty($record['out_weight'])?$record['out_weight']:'-' ?></td>
            <td><?= !empty($record['tone'])?$record['tone']:'-' ?></td>
            <td><?= !empty($record['product_name'])?$record['product_name']:'-' ?></td>
            <td><?= !empty($record['department_name'])?$record['department_name']:'-' ?></td>
            <td><?= !empty($record['balance_gross'])? four_decimal($record['balance_gross']):'-' ?></td>
            <td><?= !empty($record['balance_fine'])? four_decimal($record['balance_fine']):'-'?></td>
            <td><?= !empty($record['created_at'])?$record['created_at']:'-'?></td>
            <td><?= !empty($record['hold_day'])?$record['hold_day']:'-' ?></td>
          </tr>
        
        <?php $i++; }?>
        <tr class="bg_gray bold">
          <td >Total</td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ></td>
          <td ><?=four_decimal($total_balance_gross);?></td>
          <td ><?=four_decimal($total_balance_fine);?></td>
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