<div class="boxrow mb-2">
  <div class="float-left">
    <?php $page_details = @getTableSettings();
    ?>
    <h6 class="heading blue bold text-uppercase mb-0">
      <?= @$page_details['page_title']; ?>
    </h6>
  </div>
</div>
<table class="table table-sm table-default table-hover">
  <thead>
    <tr >
      <th class='text-left'>Lot No</th>
      <th class='text-left'>Parent Lot Name</th>
      <th class='text-left'>Process Name</th>
      <th class='text-left'>Department Name</th>
      <?php if ($type == 'hcl_loss_gross' || $type == 'hcl_loss_fine'): ?>
        <th class='text-right'>Expected Out Weight</th>
        <th class='text-right'>Out Weight</th>
      <?php endif; ?>
      <th class='text-right'>Weight</th>
    </tr>
  </thead>
  
  <tbody >
    <?php
      if(!empty($lot_loss_records)) {
        $balance_total = $in_weight = 0;
        $expected_out_weight = $out_weight = 0;
        foreach ($lot_loss_records[$column_name] as $parent_lot_id => $lot_loss_record) {
          $in_weight += @$lot_loss_record['weight']; ?>
          <tr>
            <td class='text-left'><?= @$lot_loss_record['lot_no'] ?></td>
            <td class='text-left'><?= @$lot_loss_record['parent_lot_name'] ?></td>
            <td class='text-left'><?= @$lot_loss_record['process_name'] ?></td>
            <td class='text-left'><?= @$lot_loss_record['department_name'] ?></td>
            <?php if ($type == 'hcl_loss_gross' || $type == 'hcl_loss_fine'): 
              $expected_out_weight += @$lot_loss_record['expected_out_weight'];
              $out_weight += @$lot_loss_record['out_weight']; ?>
              <td class='text-right'><?= four_decimal(@$lot_loss_record['expected_out_weight']) ?></td>
              <td class='text-right'><?= four_decimal(@$lot_loss_record['out_weight']) ?></td>
            <?php endif; ?>
            <td class='text-right'><?= four_decimal(@$lot_loss_record['weight']) ?></td>
          </tr> 
        <?php }?>

          <tr class="bg_gray bold">
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <?php if ($type == 'hcl_loss_gross' || $type == 'hcl_loss_fine'): ?>
            <td class='text-right'><?=four_decimal($expected_out_weight)?></td>
            <td class='text-right'><?=four_decimal($out_weight)?></td>
          <?php endif; ?>
          <td class='text-right'><?=four_decimal($in_weight)?></td>

      <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
</table>