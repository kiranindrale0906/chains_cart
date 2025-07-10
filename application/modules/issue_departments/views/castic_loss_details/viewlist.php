<div class="table-responsive">
  <table class="table table-sm table-default">
    <thead>
      <tr>
        <th></th>
        <th>Parent Lot Name</th>
        <th>Product Name</th>
        <th>Department Name</th>
        <th>Loss</th>
        <th>Loss Gross</th>
        <th>Loss Fine</th> 
        <th>Issue Loss</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    if(!empty($processes)){
     $loss=$loss_gross=$loss_fine=$issue_loss=0;
      foreach ($processes as $index => $process) {
        $loss+=$process['loss'];
        $issue_loss+=$process['issue_loss'];
        $loss_gross+=four_decimal(($process['loss'] * $process['out_lot_purity']) / 100);
        $loss_fine+=four_decimal((($process['loss'] * $process['out_lot_purity']) / 100)* $process['out_lot_purity'] / 100);?>
      <tr>
        <td><?=$index+1?></td>
        <td><?= $process['parent_lot_name'] ?></td>
        <td><?= $process['product_name'] ?></td>
        <td><?= $process['department_name'] ?></td>
        <td><?= $process['loss'] ?></td>
        <td class="gross_weight"><?php echo four_decimal(($process['loss'] * $process['out_lot_purity']) / 100);?></td>
        <td class="fine"><?php echo four_decimal((($process['loss'] * $process['out_lot_purity']) / 100)* $process['out_lot_purity'] / 100); ?></td>

        <td><?= $process['issue_loss'] ?></td>
        <td><a href=<?= base_url().'processes/processes/view/'.$process['id'] ?>>View</a></td>
      </tr>
    <?php }} ?>
     <tr class="bg_gray bold">
      <td>Total</td>
      <td></td>
      <td></td>
      <td></td>
      <td><?= $loss?></td>
      <td><?= $loss_gross ?></td>
      <td><?= $loss_fine ?></td>
      <td><?= $issue_loss ?></td>
      <td></td>
    </tr>
    </tbody>
  </table>
</div>

