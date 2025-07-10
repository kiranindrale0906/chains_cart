<hr>
<h5 class="heading">Ghiss Ledger details </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th class="text-right">Date</th>
      <th class="text-right">Department Name</th>
      <th class="text-right">Lot Purity</th>
      <th class="text-right">In Weight</th>
      <th class="text-right">Out Weight</th>
      <th class="text-right">Melting Wastage</th>
      <th class="text-right">Balance</th>
      <th class="text-right">Tounch</th>
      <th class="text-right">Tounch Purity</th>
      <th class="text-right">Fire Tounch</th>
      <th class="text-right">Fire Tounch Purity</th>
      <th class="text-right">Wastage</th>
      <th class="text-right">Loss</th>
      <th class="text-right">Loss Fine</th>
      <th class="text-right">Tounch Loss Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sum_in_weight=$sum_out_weight=$sum_balance=$sum_wastage=$sum_dd_wastage=$sum_tounch=$sum_loss=$sum_fire_tounch=$sum_tounch_loss_fine=$sum_loss_fine=0;
    if(!empty($processes)){
      
      foreach ($processes as $index => $process) {
        $sum_in_weight+=$process['in_weight'];
        $sum_out_weight+=$process['out_weight'];
        $sum_balance+=$process['balance'];
        $sum_wastage+=$process['melting_wastage'];
        $sum_dd_wastage+=$process['daily_drawer_wastage'];
        $sum_tounch+=$process['tounch_in'];
        $sum_fire_tounch+=$process['fire_tounch_in'];
        $sum_loss+=$process['loss'];
        $sum_loss_fine+=($process['loss']*$process['in_lot_purity']/100);
        $sum_tounch_loss_fine+=$process['tounch_loss_fine'];
        
        $this->load->view('issue_and_receipts/department_wise_ghiss_ledgers/subform',
                          array('index'=> $index, 'process' => $process));
      }?>
    <tr class="bg_gray bold">
      <td class="text-right"></td>
      <td class="text-right"></td>
      <td class="text-right"></td>
      <td class="text-right"><?=four_decimal($sum_in_weight);?></td>
      <td class="text-right"><?=four_decimal($sum_out_weight);?></td>
      <td class="text-right"><?=four_decimal($sum_wastage);?></td>
      <td class="text-right"><?=four_decimal($sum_balance);?></td>
      <td class="text-right"><?=four_decimal($sum_tounch);?></td>
      <td class="text-right"></td>
      <td class="text-right"><?=four_decimal($sum_fire_tounch);?></td>
      <td class="text-right"></td>
      <td class="text-right"><?=four_decimal($sum_dd_wastage);?></td>
      <td class="text-right"><?=four_decimal($sum_loss);?></td>
      <td class="text-right"><?=four_decimal($sum_loss_fine);?></td>
      <td class="text-right"><?=four_decimal($sum_tounch_loss_fine);?></td>
   </tr>
    <?php }?>
  </tbody>
</table>