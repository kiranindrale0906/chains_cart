<tbody>
<?php 
  $href = ADMIN_PATH.'daily_drawers/daily_drawer_in_out_views?';
  if(!empty($daily_drawers)){
   ?>
<?php
  $sum_in_weight=$sum_out_weight=$sum_balance=$sum_balance_fine=$balance=$balance_fine=0;

  if(!empty($daily_drawers)){
  foreach ($daily_drawers as $purity_index => $purity_wise_datas) {
  ?>
    <tr>
      <?php
        $count=0;
        $w = 'D3';
         foreach ($purity_wise_datas as $type_index => $type_data) { 
          $sum_in_weight+=($type_data['in']);
          $sum_out_weight+=($type_data['out']);
          $balance=$type_data['in']-$type_data['out'];
          $balance_fine=($type_data['in']-$type_data['out'])*$purity_index/100;
          $sum_balance+=$balance;
          $sum_balance_fine+=$balance_fine;
          ?>
          <tr>
              <td><?=($count==0)?$purity_index:''?></td>
              <td><?php load_buttons('anchor',array('name'=>'Print',
                                      'layout' => 'application',
                                      'class'=>'btn-xs bold blue float-left bar_code_genrate ajax',
                                      'href'=>base_url().'bar_codes'.'/'.'bar_code_dd_summary?barcode='
                                      .$w.
                                      '&column=in_weight&purity='.$purity_index.
                                      '&type='.str_replace(' ', '_', $type_index)));

                          $bar_code_value = "'".$w."-".purities_code($purity_index)."-".get_characters_for_barcode(str_replace(' ', '_', $type_index))."'";
                          $onclick = "scan_bar_code(".$bar_code_value.")";

                          load_buttons('anchor',array('name'=>'Scan',
                                      'onclick' =>$onclick,
                                      'layout' => 'application',
                                      'class'=>'btn-xs bold blue float-left',
                                      'href'=>'javascript:void(0)'));

                      
             ?></td>
              <td ><?=$type_index ?></td>
              <td class="text-right"><a href=<?=$href.'type='.str_replace(' ', '_', $type_index).'&&column=in_weight&&purity='.$purity_index?> ><?=isset($type_data['in'])?four_decimal($type_data['in']):0 ?></a></td>
              <td class="text-right"><a href=<?=$href.'type='.str_replace(' ', '_', $type_index).'&&column=out_weight&&purity='.$purity_index?>><?=isset($type_data['out'])?four_decimal($type_data['out']):0?></a></td>
              <td class="text-right"><a href=<?=$href.'type='.str_replace(' ', '_', $type_index).'&&column=balance&&purity='.$purity_index?> ><?=isset($balance)?four_decimal($balance):0?></a></td>
              <td class="text-right"><?=isset($balance_fine)?four_decimal($balance_fine):0?></td>
              
          </tr>
      <?php   $count++; } ?>
    </tr>
    <?php }?>
  <tr class="bg_gray bold">
    <td>Total</td>
    <td></td>
    <td></td>
    <td class="text-right"><?=four_decimal($sum_in_weight);?></td>
    <td class="text-right"><?=four_decimal($sum_out_weight);?></td>
    <td class="text-right"><?=four_decimal($sum_balance);?></td>
    <td class="text-right"><?=four_decimal($sum_balance_fine);?></td>
  </tr>
<?php }}else{?>
<tr class="bg_gray">
  <td class="bold">Record Not Found</td>
</tr>

<?php }?>
</tbody>	