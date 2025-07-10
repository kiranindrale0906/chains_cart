<tbody>
<?php 
  $href = ADMIN_PATH.'issue_and_receipts/rnd_ledgers/create?';
  if(!empty($rnd_records)){
   ?>
<?php
  $sum_in_weight=$sum_out_weight=$sum_balance=$sum_balance_fine=$balance=$balance_fine=0;

  if(!empty($rnd_records)){
  foreach ($rnd_records as $purity_index => $purity_wise_datas) {
  ?>
    <tr>
      <?php
        $count=0;
        $w = 'D3';
          $sum_in_weight+=($purity_wise_datas['receipt']);
          $sum_out_weight+=(@$purity_wise_datas['issue']);
          $balance=$purity_wise_datas['receipt']-@$purity_wise_datas['issue'];
          $balance_fine=($purity_wise_datas['receipt']-@$purity_wise_datas['issue'])*$purity_index/100;
          $sum_balance+=$balance;
          $sum_balance_fine+=$balance_fine;
          ?>
          <tr>
              <td><a href=<?=$href.'purity='.$purity_index?> ><?=($count==0)?$purity_index:''?></a></td>
             
              <td class="text-right"><?=isset($purity_wise_datas['receipt'])?$purity_wise_datas['receipt']:0 ?></td>
              <td class="text-right"><?=isset($purity_wise_datas['issue'])?$purity_wise_datas['issue']:0?></td>
              <td class="text-right"><?=isset($balance)?four_decimal($balance):0?></td>
              <td class="text-right"><?=isset($balance_fine)?four_decimal($balance_fine):0?></td>
              
          </tr>
      <?php   $count++; ?>
    </tr>
    <?php }?>
  <tr class="bg_gray bold">
    <td>Total</td>
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