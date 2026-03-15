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
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $balance_melting_wastage=$issue_out_weight=0;
      foreach ($issue_department_details as $index => $issue_department_detail) {
        $issue_out_weight+=$issue_department_detail['out_weight'];
        foreach ($processes as $index => $process) { 
          if ($process['id'] == $issue_department_detail['process_id']) { 
            $balance_melting_wastage+=$process['balance_melting_wastage'];?>
            <tr>
              <td><?=$index+1?></td>
              <td><?= $process['product_name'] ?></td>
              <td><?= $process['department_name'] ?></td>
              <td><?= $process['process_name'] ?></td>
              <td><?= $process['balance_melting_wastage'] + $issue_department_detail['out_weight'] ?></td>
              <td><?= $issue_department_detail['out_weight'] ?></td>
              <td><a href=<?= base_url().'processes/processes/view/'.$process['id'] ?>>View</a></td>
            </tr>        
          <?php 
          } 
        } 
      }
    ?>  
    <tr class="bg_gray bold">
      <td>Total</td>
      <td></td>
      <td></td>
      <td></td>
      <td><?= $issue_out_weight+$balance_melting_wastage?></td>
      <td><?= $issue_out_weight ?></td>
      <td></td>
    </tr>
    </tbody>
  </table>
</div>

