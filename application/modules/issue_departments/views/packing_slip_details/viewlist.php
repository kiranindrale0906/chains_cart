<div class="table-responsive">
  <table class="table table-sm table-default">
    <thead>
      <tr>
        <th></th>
        <th>Packing Slip No</th>
        <th>Gross Weight</th>
        <th>Net Weight</th>
        <th>Purity</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    if(!empty($issue_department_details))
      $out_weight=0;
      foreach ($issue_department_details as $index => $issue_department_detail) {
        $out_weight+=$issue_department_detail['out_weight'];
        foreach ($processes as $index => $process) { 
          if ($process['id'] == $issue_department_detail['process_id']) { ?>
            <tr>
              <td><?=$index+1?></td>
              <td><?= $process['process_id'] ?></td>
              <td><?= $process['gross_weight'] ?></td>
              <td><?= $process['net_weight'] ?></td>
              <td><?= $issue_department_detail['purity'] ?></td>
             </tr>        
          <?php 
          } 
        } 
      }
    ?>  
    <tr class="bg_gray bold">
      <td>Total</td>
      <td></td>
      <td class="text-right"><?= $out_weight ?></td>
      <td class="text-right"><?= $out_weight ?></td>
      <td></td>
    </tr>
    </tbody>
  </table>
</div>

