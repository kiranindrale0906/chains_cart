<div class="boxrow mb-2">
  <div class="float-left">
    <?php 
      $page_details = @getTableSettings();
      $href = ADMIN_PATH.'parent_lot_loss/parent_lot_loss_view?';
    ?>
    <h6 class="heading blue bold text-uppercase mb-0">
      <?= @$page_details['page_title']; ?>
    </h6>
  </div>
</div>
<div class="row">
  <?php
    load_field('dropdown', array('field' => 'process_name',
                                 'option' => @$process_name,
                                 'col' => 'col-sm-4',
                                 'name' => 'parent_lot_process_name',
                                 'value' => !empty($product_name) ? $product_name : ''));
  ?>
  
  <div class="col-sm-4 align-self-center"> 
    <?php $detail = ($with_detail=='yes')?'no':'yes'?>
    <a href="<?= ADMIN_PATH.'parent_lot_loss/parent_lot_loss?product_name='.$product_name.'&detail='.$detail?>">
      <?php if(!empty($with_detail)) echo ($with_detail=='yes')?"Without Details":"With Details" ?>
    </a>
    <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs btn_blue clear_btn')) ?>      
   </div>
</div>

<table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <?php if($with_detail=='yes') echo '<th>ID</th>'?> 
      <th class="text-left">Parent Lot No</th>
      <?php if($with_detail=='yes') { ?>
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
      <th class="text-right">(K = I1+J) <br />Total Loss</th>
        <th class="text-right">(L1 = C-D2-H-K) <br />Dhadi Loss</th>

        <th class="text-right">(L2 = C-D2-H-K) <br />Final Balance</th>

        <th class="text-right">(M1) <br />Chain Balance</th>
        <th class="text-right">(M2) <br />AG Balance</th>
        <th class="text-right">(M = M1+M2) <br />Total Balance</th>

        <!-- <th class="text-right">HCL Wastage Gross</th> -->

        <!-- <th class="text-right">Chain Out Purity</th> -->

        <th class="text-right">(N1) <br />HCL Department HCL Loss</th>
        <th class="text-right">(O1) <br />HCL Melting Process HCL Loss</th>
        <th class="text-right">(P1) <br />HCL Ghiss Process HCL Loss</th>
        <th class="text-right">(Q1 = N1+O1+P1) <br />Total HCL Gross</th>

        <th class="text-right">(N2) <br />HCL Department HCL Loss Fine</th>
        <th class="text-right">(O2) <br />HCL Melting Process HCL Loss Fine</th>
        <th class="text-right">(P2) <br />HCL Ghiss Process HCL Loss Fine</th>
        <th class="text-right">(Q2 = N2+O2+P2) <br />Total HCL Loss Fine</th>

        <th class="text-right">(R) <br />Castic Loss Fine</th>
        <th class="text-right">(S) <br />Chain Tounch Loss Fine</th>
        <th class="text-right">(T) <br />HCL Tounch Loss Fine</th>
      <?php } ?>
        <th class="text-right">(U = Q2+R+S+T) <br />Total Loss Fine</th>
      <?php if($with_detail=='yes') { ?>
        <th>Parent Lot No</th>
        <th class="text-right">(FE1) FE In</th>
        <th class="text-right">(FE2a + FE2b + FE2c + FE2d) FE Out</th>
        <th class="text-right">(FE = FE1-FE2) FE Balance</th>
        <th class="text-right">(HCLW1 + HCLW2) HCL Wastage Balance</th>
        <th class="text-right">(HCLW3 + HCLW4) Rope Ghiss Balance</th>
        <th></th>
        <th class="text-right">(HCLLOSSBAL1 + HCLLOSSBAL2 + HCLLOSSBAL3) Balance HCL Loss</th>
        <th class="text-right">Balance Tounch Fine Loss</th>
        <th class="text-right">Balance Castic Loss</th>
      <?php } ?>
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

        // $balance_total =  $hcl_wastage = $tounch_weight = 0;
        // $loss_gross = $loss_fine = $hcl_out_weight =  $loss_fine_total = 0;
        // $hcl_process_hcl_loss_gross = $out_weight_hcl_loss_gross = $out_weight_hcl_loss_fine = 0;
        // $tounch_fine_loss = $total_hcl_loss_gross = $hcl_process_hcl_loss_fine = 
        // $tounch_castic_dept_loss = 0;
        // $out_weight_fine=0; 
        
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

            //$hcl_wastage += @$lot_loss_record['hcl_wastage']['weight'];

           // $out_weight_fine += @$lot_loss_record['out_weight']['out_weight_fine'];                                 

           // $out_weight_hcl_loss_gross+=four_decimal(@$lot_loss_record['out_weight']['hcl_loss_gross']);
           // $hcl_process_hcl_loss_gross+=four_decimal(@$lot_loss_record['hcl_process']['hcl_loss_gross']);
           // $total_hcl_loss_gross+=four_decimal(@$lot_loss_record['out_weight']['hcl_loss_gross']
           //                       +@$lot_loss_record['hcl_process']['hcl_loss_gross']);

            

           //  $loss_fine_total +=@$lot_loss_record['out_weight']['hcl_loss_fine']
           //                       +@$lot_loss_record['hcl_process']['hcl_loss_fine']
           //                       +@$lot_loss_record['tounch_fine_loss']['weight']
           //                       +@$lot_loss_record['hcl_melting_tounch_fine_loss']['weight'];

            $parent_lot_id = @$lot_loss_record['parent_lots']['parent_lot_id'];
            $product_name = str_replace(' ', '_', $product_name);
          ?>
          <tr>
            <?php if($with_detail=='yes') echo '<td>'.$parent_lot_id.'</td>'?>
            <td class="text-left"><?= @$lot_loss_record['parent_lots']['parent_lot_name'] ?></td>
            <?php if($with_detail=='yes') { ?>
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
            <td><!-- K = I + J -->
              <?= four_decimal(@$lot_loss_record['loss_weight']['weight']

                               + @$lot_loss_record['hcl_ghiss']['weight']) ?>
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

              <td><!-- M1 -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=balance_gross'?> >
                  <?= four_decimal(@$lot_loss_record['chain_balance']['weight']) ?>
                </a>
              </td>

              <td><!-- M2 -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=ag_balance_gross'?> >
                  <?= four_decimal(@$lot_loss_record['rope_chain_ag_balance']['weight']) ?>
                </a>
              </td>

              <td><!-- M -->
                <?= four_decimal(@$lot_loss_record['chain_balance']['weight']
                                 + @$lot_loss_record['rope_chain_ag_balance']['weight']) ?>
              </td>

              <!-- <td><a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=hcl_wastage'?> ><?= four_decimal(@$lot_loss_record['hcl_wastage']['weight']) ?></a></td>
               -->

              <td><!-- N1 -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=out_weight&type=hcl_loss_gross'?> >
                  <?= four_decimal(@$lot_loss_record['out_weight']['hcl_loss_gross']) ?>
                </a>
              </td>

              <td><!-- O1 -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=hcl_process&type=hcl_loss_gross'?> >
                  <?= four_decimal(@$lot_loss_record['hcl_process']['hcl_loss_gross']) ?>
                </a>
              </td>

              <td><!-- P1 -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=hcl_ghiss_process&type=hcl_loss_gross'?> >
                  <?= four_decimal(@$lot_loss_record['hcl_ghiss_process']['hcl_loss_gross']) ?>
                </a>
              </td>

              <td><!-- Q1 -->
                <?= four_decimal(@$lot_loss_record['out_weight']['hcl_loss_gross']
                                 + @$lot_loss_record['hcl_process']['hcl_loss_gross']
                                 + @$lot_loss_record['hcl_ghiss_process']['hcl_loss_gross']) ?>
              </td>

              <td><!-- N2 -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=out_weight&type=hcl_loss_fine'?> >
                  <?= four_decimal(@$lot_loss_record['out_weight']['hcl_loss_fine']) ?>
                </a>
              </td>

              <td><!-- O2 -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=hcl_process&type=hcl_loss_fine'?> >
                  <?= four_decimal(@$lot_loss_record['hcl_process']['hcl_loss_fine']) ?>
                </a>
              </td>

              <td><!-- P2 -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=hcl_ghiss_process&type=hcl_loss_fine'?> >
                  <?= four_decimal(@$lot_loss_record['hcl_ghiss_process']['hcl_loss_fine']) ?>
                </a>
              </td>

              <td><!-- Q2 -->
                <?= four_decimal(@$lot_loss_record['out_weight']['hcl_loss_fine']
                                 + @$lot_loss_record['hcl_process']['hcl_loss_fine']
                                 + @$lot_loss_record['hcl_ghiss_process']['hcl_loss_fine']) ?>
              </td>

              <td><!-- R -->
                <a href = <?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=castic_loss_fine'?> >
                  <?= four_decimal(@$lot_loss_record['castic_loss_weight']['weight_fine']) ?>
                </a>
              </td>

              <td><!-- S -->
                <a href = <?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=tounch_fine_loss'?> >
                  <?= four_decimal(@$lot_loss_record['tounch_fine_loss']['weight']) ?>
                </a>
              </td>

              <td><!-- T -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=hcl_melting_tounch_fine_loss'?> >
                  <?= four_decimal(@$lot_loss_record['hcl_melting_tounch_fine_loss']['weight']) ?>
                </a>
              </td>
            <?php } ?>
              <td><!-- U = Q2 + R + S  + T -->
                <?= four_decimal(@$lot_loss_record['out_weight']['hcl_loss_fine']
                                   +@$lot_loss_record['hcl_process']['hcl_loss_fine']
                                   +@$lot_loss_record['hcl_ghiss_process']['hcl_loss_fine']
                                   +@$lot_loss_record['castic_loss_weight']['weight_fine']
                                   +@$lot_loss_record['tounch_fine_loss']['weight']
                                   +@$lot_loss_record['hcl_melting_tounch_fine_loss']['weight']) ?>
              </td> 
            <?php if($with_detail=='yes') { ?>
              <td><?= @$lot_loss_record['parent_lots']['parent_lot_name'] ?></td>
              <td><!-- (FE1) Fe in -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=fe_in'?> >
                  <?= four_decimal(@$lot_loss_record['fe_in_au_fe_department']['weight']) ?>
                </a>
              </td>
              <td><!-- (FE2a + FE2b + FE2c + FE2d) Fe out -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=fe_out'?> >
                  <?= $fe_out=four_decimal(@$lot_loss_record['fe_out_department']['weight']
                                    +@$lot_loss_record['fe_out_hcl_melting_department']['weight']
                                    +@$lot_loss_record['fe_out_rope_ghiss_melting_department']['weight']
                                    +@$lot_loss_record['fe_out_au_fe_department']['weight']
                                  ) ?>
                </a>
              </td>
              <td><!-- (FE1- FE2) Fe Balance -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=fe_out'?> >
                  <?= four_decimal(@$lot_loss_record['fe_in_au_fe_department']['weight']-$fe_out) ?>
                </a>
              </td>
              <td><!-- (HCLW1) (HCLW2) HCL Wastage Balance -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=fe_out'?> >
                  <?= four_decimal(@$lot_loss_record['hcl_wastage_balance']['weight']) 
                      + four_decimal(@$lot_loss_record['hcl_wastage_melting_process_balance']['weight']); ?>
                </a>
              </td>

              <td> <!-- (HCLW3) (HCLW4) Rope Ghiss Balance -->
                <a href=<?=$href.'lot_id='.$parent_lot_id.'&product_name='.$product_name.'&column_name=fe_out'?> >
                  <?= four_decimal(@$lot_loss_record['rope_ghiss_balance']['weight']) 
                      + four_decimal(@$lot_loss_record['rope_ghiss_melting_process_balance']['weight']); ?>
                </a>
              </td>
              <td>
                <?php 
                  if (   round(@$lot_loss_record['out_weight']['balance_hcl_loss'],4) != 0 
                       || round(@$lot_loss_record['tounch_fine_loss']['balance_tounch_loss_fine'],4) != 0
                       || round(@$lot_loss_record['hcl_melting_tounch_fine_loss']['balance_tounch_loss_fine'],4) != 0
                       || round(@$lot_loss_record['castic_loss_weight']['balance_loss'],4) != 0) {
                    $issue_url = base_url().'issue_departments/issue_departments';
                    $issue_url = $issue_url.'?issue_castic_loss=1&issue_hcl_loss=1&issue_tounch_fine_loss=1&archive_records=1';
                    $issue_url = $issue_url.'&parent_lot_id='.$parent_lot_id.'&product_name='.str_replace('_', ' ', $product_name);
                    load_buttons('anchor',array('name'=>'Issue and Hide',
                                                'layout' => 'application',
                                                'class'=>'btn-xs bold blue ',
                                                'href'=> $issue_url));
                  }
                ?>
              </td>
              <td class="text-right"><!-- (HCLLOSSBAL1 + HCLLOSSBAL2 + HCLLOSSBAL3) -->
                <?= four_decimal(@$lot_loss_record['out_weight']['balance_hcl_loss']
                                + @$lot_loss_record['hcl_process']['balance_hcl_loss']
                                + @$lot_loss_record['hcl_ghiss_process']['balance_hcl_loss']); ?>
              </td>
              <td class="text-right"><!-- (TLFBAL1 + TFLBAL2) -->
                <?= four_decimal(@$lot_loss_record['tounch_fine_loss']['balance_tounch_loss_fine']
                                + @$lot_loss_record['hcl_melting_tounch_fine_loss']['balance_tounch_loss_fine']); ?>
              </td>
              <td class="text-right"><!-- (LOSSBAL) -->
                <?= four_decimal(@$lot_loss_record['castic_loss_weight']['balance_loss']); ?>
              </td>
            <?php } ?>
          </tr> 
        <?php }?>

        <?php if($with_detail=='yes') { ?>
          <tr class="bg_gray bold">
            <td></td>
            <td></td>
          
            <td></td>
            <td><?=four_decimal($in_weight)?></td> <!-- A -->
            <td><?=four_decimal($hook)?></td> <!-- B -->
            <td><?=four_decimal($in_weight + $hook)?></td> <!-- C -->

            <td><?=four_decimal($out_weight)?></td> <!-- D -->

            <td><?=four_decimal($hcl_melting_out_weight)?></td>  <!-- E -->
            <td><?=four_decimal($au_fe_melting_wastage)?></td> <!-- F -->
            <td><?=four_decimal($bull_block_wastage)?></td> <!-- G -->
            <td><?=four_decimal($hcl_melting_out_weight
                                + $au_fe_melting_wastage
                                + $bull_block_wastage) ?></td>  <!-- H -->

            <td><?=four_decimal($loss_weight)?></td> <!-- I1 -->
            <td><?=four_decimal($castic_loss_weight)?></td> <!-- I2 -->
            <td><?=four_decimal($total_out_weight)?></td> <!-- D2 -->
            <td><?=four_decimal($hcl_ghiss)?></td> <!-- J -->
          <td><?=four_decimal($loss_weight
                              //+ $castic_loss_weight
                              + $hcl_ghiss)?></td>  <!-- K -->
            <td><?=four_decimal($total_dhadi_loss)?></td>  <!-- L1 -->
            <td><?=four_decimal($total_final_balance)?></td> <!-- L2 -->

            <td><?=four_decimal($chain_balance)?></td> <!-- M1 -->
            <td><?=four_decimal($ag_balance)?></td> <!-- M2 -->
            <td><?=four_decimal($chain_balance + $ag_balance)?></td> <!-- M -->

            <!-- <td><?=four_decimal(@$balance_total)?></td> -->
            <td></td>
            <td></td>
            <td><?=four_decimal(@$total_hcl_loss_gross)?></td> <!-- P1 -->
            <td></td>
            <td></td>
            <td><?=four_decimal(@$total_hcl_loss_fine)?></td> <!-- P2 -->

            <td><?=four_decimal(@$castic_loss_fine)?></td>  <!-- Q -->  
            <td><?=four_decimal(@$tounch_loss_fine)?></td>  <!-- R -->
            <td><?=four_decimal(@$hcl_melting_tounch_fine_loss)?></td>  <!-- S -->
            <td><?=four_decimal($total_hcl_loss_fine
                                + @$castic_loss_fine
                                + @$tounch_loss_fine
                                + @$hcl_melting_tounch_fine_loss)?></td>  <!-- T -->
            <td><?=four_decimal(@$total_fe_in)?></td>
            <td><?=four_decimal(@$total_fe_out)?></td>
            <td><?=four_decimal(@$total_fe_balance)?></td>
            <td><?=four_decimal(@$total_hcl_wastage)?></td>
            <td><?=four_decimal(@$total_rope_ghiss)?></td>
            <td></td>
          </tr>
        <?php } ?>
        </tr>
      <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
</table>