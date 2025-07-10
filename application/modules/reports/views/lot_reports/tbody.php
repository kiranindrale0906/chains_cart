<?php 
  $difference = $lot_report['in']['weight'.$type] 
                - $lot_report['chain']['balance_weight'.$type] 
                + $lot_report['chain']['fe_weight'.$type]
                + $lot_report['chain']['solder_in_weight'.$type]
                + $lot_report['chain']['alloy_weight_weight'.$type]
                - $lot_report['chain']['copper_out_weight'.$type]
                - $lot_report['chain']['solder_wastage_weight'.$type]
                + $lot_report['chain']['hook_weight'.$type]
                - $lot_report['chain']['in_melting_wastage_weight'.$type]
                - $lot_report['chain']['melting_wastage_weight'.$type]
                - $lot_report['chain']['daily_drawer_wastage_weight'.$type]
                - $lot_report['chain']['next_department_wastage_weight'.$type]
                - $lot_report['chain']['daily_drawer_in_weight'.$type]
                - $lot_report['chain']['daily_drawer_out_weight'.$type]
                - $lot_report['chain']['tounch_in_weight'.$type]
                - $lot_report['chain']['ghiss_weight'.$type]
                - $lot_report['chain']['loss_weight'.$type]
                - $lot_report['chain']['refine_loss_weight'.$type]
                - $lot_report['chain']['tounch_loss_fine_weight'.$type]
                - $lot_report['chain']['hcl_loss_weight'.$type]
                - @$lot_report['hcl_melting_strip_cutting_hcl_loss']['weight'.$type]
                - $lot_report['chain']['hcl_wastage_weight'.$type]
                - $lot_report['chain']['hcl_ghiss_weight'.$type]
                - $lot_report['chain']['gpc_out_weight'.$type]
                - $lot_report['out']['weight'.$type]
                - $lot_report['chain']['ka_hook_out_weight'.$type]
                + $lot_report['chain']['micro_coating_weight'.$type];
  if (!$group_by_department) $difference += @$lot_report['indo_tally_strip_cutting_hcl_loss']['weight'.$type];
  if (number_format((float) $difference, 6, '.', '') != 0): ?>

    <tr>
      <td class='text-left'><?= (isset($lot_report['in'])) ? @$lot_report['in']['lot_no'] : '' ?></td>
      <td class='text-left'><a href="<?= ADMIN_PATH.'processes/processes/view/'.@$lot_report['chain']['row_id']?>"><?= @$lot_report['chain']['row_id'] ?></a></td>
      <td><?= (isset($lot_report['in'])) ? four_decimal($lot_report['in']['weight'.$type]) : 0 ?></td>
      <td><?= four_decimal($lot_report['chain']['balance_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['fe_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['solder_in_weight'.$type]
                           + $lot_report['chain']['alloy_weight_weight'.$type]
                           - $lot_report['chain']['copper_out_weight'.$type]
                           - $lot_report['chain']['solder_wastage_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['hook_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['in_melting_wastage_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['melting_wastage_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['daily_drawer_wastage_weight'.$type]
                          - $lot_report['chain']['next_department_wastage_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['daily_drawer_in_weight'.$type]
                           + $lot_report['chain']['daily_drawer_out_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['tounch_in_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['ghiss_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['loss_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['refine_loss_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['tounch_loss_fine_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['hcl_loss_weight'.$type]) ?></td>
      <td><?= four_decimal(@$lot_report['indo_tally_strip_cutting_hcl_loss']['weight'.$type]
                           ) ?></td>
      <td><?= four_decimal($lot_report['chain']['hcl_wastage_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['hcl_ghiss_weight'.$type]) ?></td>
      <td><?= four_decimal($lot_report['chain']['gpc_out_weight'.$type]
                            + $lot_report['out']['weight'.$type]
                            + $lot_report['chain']['ka_hook_out_weight'.$type]
                           ) ?></td>
      <td><?= four_decimal($lot_report['chain']['micro_coating_weight'.$type]) ?></td>
      <td><?= number_format((float)($difference), 8, '.', '') ?></td>
    </tr> 
  <?php endif; ?>  