<div class="table-responsive">
  <table class="table table-sm table-default">
    <thead>
      <tr>
        <th></th>
        <th>Product</th>
        <th>Department</th>
        <th>Process</th>
        <th>In Weight</th>
        <th>Out Weight</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      foreach ($process_out_wastage_details as $index => $process_out_wastage_detail) {
        foreach ($processes as $index => $process) { 
          if ($process['id'] == $process_out_wastage_detail['process_id']) { ?>
            <tr>
              <td><?=$index+1?></td>
              <td><?= $process['product_name'] ?></td>
              <td><?= $process['department_name'] ?></td>
              <td><?= $process['process_name'] ?></td>
              <td><?= $process['balance_daily_drawer_wastage'] + $process_out_wastage_detail['out_weight'] ?></td>
              <td><?= $process_out_wastage_detail['out_weight'] ?></td>
            </tr>        
          <?php 
          } 
        } 
      }
    ?>  
    </tbody>
  </table>
</div>

