<div class="table-responsive">
  <table class="table table-sm table-default">
    <thead>
      <tr>
        <th></th>
        <th>Product Name</th>
        <th>Lot No</th>
        <th class="text-right">Ghiss</th>
        <th class="text-right">Purity(%)</th>
        <th class="text-right">Fine</th>
        <th class="text-right">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    if(!empty($processes)){
    $ghiss=$ghiss_fine=0;
      foreach ($processes as $index => $process) {
        $ghiss+=$process['issue_ghiss'];
        $ghiss_fine+=four_decimal((($process['issue_ghiss'] * $process['out_lot_purity']) / 100));
        ?>
        <tr>
        <td><?=$index+1?></td>
        <td><?= $process['product_name'] ?></td>
        <td><?= $process['lot_no'] ?></td>
        <td class="text-right"><?=four_decimal($process['issue_ghiss'])?></td>
        <td class="text-right"><?=four_decimal($process['out_lot_purity'])?></td>
        <td class="text-right"><?= four_decimal(($process['issue_ghiss'] * $process['out_lot_purity']) / 100); ?></td>
        <td class="text-right"><a href=<?= base_url().'processes/processes/view/'.$process['id'] ?>>View</a></td>
      </tr>
    <?php }} ?>
    <tr class="bg_gray bold">
      <td>Total</td>
      <td></td>
      <td></td>
      <td class="text-right"><?= $ghiss?></td>
      <td></td>
      <td class="text-right"><?= $ghiss_fine ?></td>
      <td></td>
    </tr>
    </tbody>
  </table>
</div>

