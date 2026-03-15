<div class="table-responsive">
  <table class="table table-sm table-default">
    <thead>
      <tr>
        <th></th>
        <th>Lot No</th>
        <th>Design Code</th>
        <th class="text-right">Chitti Out</th>
        <th class="text-right">Purity(%)</th>
        <th class="text-right">Fine</th>
        <th class="text-right">Action</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    if(!empty($processes)){
     foreach ($processes as $index => $process) { ?>
      <tr>
        <td><?=$index+1?></td>
        <td><?= $process['lot_no'] ?></td>
        <td><?= $process['design_code'] ?></td>
        <td class="text-right"><?=four_decimal($process['chitti_out'])?></td>
        <td class="text-right"><?=four_decimal($process['out_lot_purity'])?></td>
        <td class="text-right"><?= four_decimal(($process['chitti_out'] * $process['out_lot_purity']) / 100); ?></td>
        <td class="text-right"><a href=<?= base_url().'processes/processes/view/'.$process['id'] ?>>View</a></td>
      </tr>
    <?php }} ?>
    </tbody>
  </table>
</div>

