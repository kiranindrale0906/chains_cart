<?php $href = ADMIN_PATH.'parent_lot_loss/parent_lot_loss_view?';?>
<table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <th>Chain In Purity</th>
      <th class="text-right">(A) <br />In Weight</th>
      <th class="text-right">(B) <br />Daily Drawer Gross</th>
      <th class="text-right">(C = A+B) <br />Total Gold</th>
      <th class="text-right">(D1) <br />Out Weight</th>

      <th class="text-right">(E) <br />HCL Melting Out weight</th>
      <th class="text-right">(F) <br />AU FE Melting Wastage</th>
      <th class="text-right">(G) <br />Bull Block Weight</th>
      <th class="text-right">(H = E+F+G) <br />Total Wastage</th>

      <th class="text-right">(I1) <br />Loss Weight Gross</th>
      <th class="text-right">(I2) <br />Castic Loss Weight Gross</th>
      <th class="text-right">(D2 = D1 - I2) <br />Total Out Weight</th>
      <th class="text-right">(J) <br />Rope Ghiss Gross</th>
      <th class="text-right">(L1 = C-D2-H-K) <br />Dhadi Loss</th>
      <th class="text-right">(L2 = C-D2-H-K) <br />Final Balance</th>
      <th class="text-right">Total Loss Fine</th>
    </tr>
  </thead>
  <tbody class='text-right'>
    <?php 
      if(!empty($lot_loss_records)){
        $in_weight = $hook = $out_weight = 0;
        $hcl_melting_out_weight = $bull_block_wastage = $au_fe_melting_wastage = 0;
        $loss_weight = $castic_loss_weight = $hcl_ghiss = 0;
        $total_dhadi_loss = 0; $total_final_balance = 0;
        $chain_balance = $ag_balance = 0;
        $total_hcl_ghiss_hcl_loss_gross = 0;
        $total_hcl_ghiss_hcl_loss_fine = 0;
        $total_out_weight = 0;
        $total_hcl_loss_gross = $total_hcl_loss_fine = 0;
        $castic_loss_fine = $tounch_loss_fine = $hcl_melting_tounch_fine_loss =$total_fe_in =$total_fe_out=$total_hcl_wastage =$total_rope_ghiss=$total_fe_balance = 0;
        
        foreach ($lot_loss_records as $parent_lot_id => $lot_loss_record) {
          $in_weight += @$lot_loss_record['in_weight']['weight'];
          $hook += @$lot_loss_record['hook']['weight'];

          $out_weight += @$lot_loss_record['out_weight']['out_weight'];

          $hcl_melting_out_weight += @$lot_loss_record['hcl_melting_out_weight']['weight'];
          $au_fe_melting_wastage += @$lot_loss_record['au_fe_melting_wastage']['melting_wastage'];
          $bull_block_wastage += @$lot_loss_record['bull_block_wastage']['weight'];

          $loss_weight += @$lot_loss_record['loss_weight']['weight'];
          $castic_loss_weight += @$lot_loss_record['castic_loss_weight']['weight'];
          $total_out_weight += @$lot_loss_record['out_weight']['out_weight']-@$lot_loss_record['castic_loss_weight']['weight'];
          $hcl_ghiss += @$lot_loss_record['hcl_ghiss']['weight'];

          $chain_balance += @$lot_loss_record['chain_balance']['weight'];
          $ag_balance += @$lot_loss_record['rope_chain_ag_balance']['weight']; 
          $total_hcl_wastage += @$lot_loss_record['hcl_wastage_balance']['weight']; 
          $total_rope_ghiss += @$lot_loss_record['rope_ghiss_balance']['weight']; 
          $ag_balance += @$lot_loss_record['rope_chain_ag_balance']['weight']; 

          $total_hcl_loss_gross += @$lot_loss_record['out_weight']['hcl_loss_gross'] + @$lot_loss_record['hcl_process']['hcl_loss_gross'];
          $total_hcl_loss_fine += @$lot_loss_record['out_weight']['hcl_loss_fine'] + @$lot_loss_record['hcl_process']['hcl_loss_fine'];

          $total_hcl_ghiss_hcl_loss_gross += @$lot_loss_record['out_weight']['hcl_loss_gross'] + @$lot_loss_record['hcl_ghiss_process']['hcl_loss_gross'];
          $total_hcl_ghiss_hcl_loss_fine += @$lot_loss_record['out_weight']['hcl_loss_fine'] + @$lot_loss_record['hcl_ghiss_process']['hcl_loss_fine'];

          $castic_loss_fine += four_decimal(@$lot_loss_record['castic_loss_weight']['weight_fine']);
          $tounch_loss_fine += four_decimal(@$lot_loss_record['tounch_fine_loss']['weight']);
          $hcl_melting_tounch_fine_loss += four_decimal(@$lot_loss_record['hcl_melting_tounch_fine_loss']['weight']);
          $total_fe_in += four_decimal(@$lot_loss_record['fe_in_au_fe_department']['weight']);
          $total_fe_out += four_decimal(@$lot_loss_record['fe_out_department']['weight']
                                  +@$lot_loss_record['fe_out_hcl_melting_department']['weight']
                                  +@$lot_loss_record['fe_out_rope_ghiss_melting_department']['weight']
                                  +@$lot_loss_record['fe_out_au_fe_department']['weight']);
          $total_fe_balance += four_decimal(@$lot_loss_record['fe_in_au_fe_department']['weight']-(@$lot_loss_record['fe_out_department']['weight']
                                  +@$lot_loss_record['fe_out_hcl_melting_department']['weight']
                                  +@$lot_loss_record['fe_out_rope_ghiss_melting_department']['weight']
                                  +@$lot_loss_record['fe_out_au_fe_department']['weight']));
          $parent_lot_id = @$lot_loss_record['parent_lots']['parent_lot_id'];
          $product_name = str_replace(' ', '_', $product_name);
    ?>
      <tr>
        <td><?= four_decimal(@$lot_loss_record['in_weight']['in_lot_purity']) ?></td>
        <td><!-- A -->
          <a href = <?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=in_weight'?> >
            <?= four_decimal(@$lot_loss_record['in_weight']['weight']) ?>
          </a>
        </td>
        <td><!-- B -->
          <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=hook'?> >
            <?= four_decimal(@$lot_loss_record['hook']['weight']) ?>
          </a>
        </td>
        <td><!-- C = A + B -->
          <?= four_decimal(@$lot_loss_record['in_weight']['weight'] 
                           + @$lot_loss_record['hook']['weight']) ?>
        </td>
        <td><!-- D1 -->
          <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=out_weight&type=out_weight'?> >
            <?= four_decimal(@$lot_loss_record['out_weight']['out_weight']) ?>
          </a>
        </td>
        <td><!-- E -->
          <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=hcl_melting_out_weight'?> >
            <?= four_decimal(@$lot_loss_record['hcl_melting_out_weight']['weight']) ?>
          </a>
        </td>
        <td><!-- F -->
          <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=au_fe_melting_wastage'?> >
            <?= four_decimal(@$lot_loss_record['au_fe_melting_wastage']['melting_wastage']) ?>
          </a>
        </td>
        <td><!-- G -->
          <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=bull_block_wastage'?> >
            <?= four_decimal(@$lot_loss_record['bull_block_wastage']['weight']) ?>
          </a>
        </td>
        <td><!-- H = E + F + G -->
          <?= four_decimal(@$lot_loss_record['hcl_melting_out_weight']['weight']
                           + @$lot_loss_record['au_fe_melting_wastage']['melting_wastage']
                           + @$lot_loss_record['bull_block_wastage']['weight']) ?>
        </td>
        <td><!-- I1 -->
          <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=loss_weight'?> >
            <?= four_decimal(@$lot_loss_record['loss_weight']['weight']) ?>
          </a>
        </td>
        <td><!-- I2 -->
          <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=castic_loss_weight'?> >
            <?= four_decimal(@$lot_loss_record['castic_loss_weight']['weight']) ?>
          </a>
        </td>
        <td><!-- D2 -->
          <?= four_decimal(@$lot_loss_record['out_weight']['out_weight']
                           -@$lot_loss_record['castic_loss_weight']['weight']) ?>
        </td>
        <td><!-- J -->
          <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=hcl_ghiss'?> >
            <?= four_decimal(@$lot_loss_record['hcl_ghiss']['weight']) ?>
          </a>
        </td>
        <?php 
          $dhadi_loss = @$lot_loss_record['in_weight']['weight'] 
                         + @$lot_loss_record['hook']['weight']

                         - (@$lot_loss_record['out_weight']['out_weight']
                           - @$lot_loss_record['castic_loss_weight']['weight'])

                         - ( @$lot_loss_record['hcl_melting_out_weight']['weight']
                             + @$lot_loss_record['au_fe_melting_wastage']['melting_wastage']
                             + @$lot_loss_record['bull_block_wastage']['weight'])

                         - (@$lot_loss_record['loss_weight']['weight']
                            + @$lot_loss_record['hcl_ghiss']['weight']);
            if (@$lot_loss_record['hcl_melting_out_weight']['weight'] == 0): 
              $total_final_balance += $dhadi_loss; 
        ?>
          <td>0</td>
        <?php endif; ?>
        <td><!-- L = C - D2 - H - K -->
          <?= four_decimal($dhadi_loss); ?>
        </td>
        <?php if (@$lot_loss_record['hcl_melting_out_weight']['weight'] != 0): 
          $total_dhadi_loss += $dhadi_loss;
        ?>
          <td>0</td>
        <?php endif; ?>
        <td><!-- U = Q2 + R + S  + T -->
          <?= four_decimal(@$lot_loss_record['out_weight']['hcl_loss_fine']
                             +@$lot_loss_record['hcl_process']['hcl_loss_fine']
                             +@$lot_loss_record['hcl_ghiss_process']['hcl_loss_fine']
                             +@$lot_loss_record['castic_loss_weight']['weight_fine']
                             +@$lot_loss_record['tounch_fine_loss']['weight']
                             +@$lot_loss_record['hcl_melting_tounch_fine_loss']['weight']) ?>
        </td> 
      </tr>
    <?php } ?>    
    <?php }else{ ?>
      <tr>
        <td>No Record Found.</td>
      </tr>
    <?php } ?>
  </tbody>
</table>