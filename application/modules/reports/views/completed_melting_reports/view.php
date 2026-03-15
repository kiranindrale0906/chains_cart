<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Complete Melting Report</h6>
  <div class="table-responsive m-t-10">
    <a href="<?= base_url().'reports/completed_melting_reports'?>" class="btn btn-xs btn_green">Completed Melting Report</a>
    <a href="<?= base_url().'reports/melting_lot_time_reports'?>" class="btn btn-xs btn_green">In Process Melting Report</a>
  </div>
   <div class="table-responsive m-t-10">
    
        <?php  load_field('dropdown', array('field' => 'product_name',
                                       'class' => '',
                                       'col' => 'col-md-4',
                                       'option' => $product_names));?>
  </div> 
  <div class="table-responsive m-t-10">
  <?php
      $total = 0;
      $total_weight = 0;
      if(!empty($record['completed_melting_data'])){
        foreach ($record['completed_melting_data'] as $index_product_name => $value_product_name) {
      ?>
    <h5><?=$index_product_name?></h5>
    <table class="table table-sm fixedthead table-default">
      <thead>
      <tr>
        <th>Lot No</th>
        <th>Melting Date</th>
        <th>Product Name</th>
        <th>Melting Weight</th>
        <th>Completed Dep Date</th>
        <th>Completed Department(Current Balance Dep)</th>
        <th>Current Dep Weight</th>
        <th>Out Put %</th>
        <th>Complete Time</th>
    
      </tr>
    </thead>
    <tbody>
    <?php
//pd($value_product_name);
    $total = 0;
      $total_weight = 0;
      foreach ($value_product_name as $index_melting_date => $melting_date_detail) {
      ?>
      <tr class="bg_gray"><td><b><?=$index_melting_date?></b></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
      <tr>
      <?php foreach ($melting_date_detail as $index => $melting_date_data) {
           $class="";
          if($melting_date_data['is_out_off_time']==1){
            $class="red";
          }
            $total += $melting_date_data['gpc_out'];
        ?>
          <tr class=<?=$class?>>
            <td><?= !empty($melting_date_data['lot_no'])?$melting_date_data['lot_no']:'-' ?></td>
            <td><?= !empty($melting_date_data['melting_date'])?$melting_date_data['melting_date']:'-' ?></td>
            <td><?= !empty($melting_date_data['product_name'])?$melting_date_data['product_name']:'-' ?></td>
            <td><?= !empty($melting_date_data['melting_weight'])?$melting_date_data['melting_weight']:'-' ?></td>
            <td><?= !empty($melting_date_data['completed_at'])?$melting_date_data['completed_at']:'-' ?></td>
            <td><?= !empty($melting_date_data['department_name'])?$melting_date_data['department_name']:'-' ?></td>
            <td><?= !empty($melting_date_data['gpc_out'])?$melting_date_data['gpc_out']:'-' ?></td>
            <td><?= !empty($melting_date_data['out_put'])?$melting_date_data['out_put']:'-' ?></td>
            <td><?= !empty($melting_date_data['diff_melting_date_with_complted_date'])?$melting_date_data['diff_melting_date_with_complted_date']:'-' ?></td></tr>
  <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"><?=$total?></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
        </tr> 
        </tr>
          <?php }?>
        <tr class="">
          <td class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"><?//=$total?></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
        </tr> 
  </tbody>
  </table>
<?php }} ?>
</div>
</div>
</div>
