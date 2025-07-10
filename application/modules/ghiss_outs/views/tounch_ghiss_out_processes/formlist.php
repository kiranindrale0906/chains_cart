<h5 class="heading">Tounch Ghiss Out Processes </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue tounch_ghiss_out_select_all')); ?></th>
      <th>Chain Name</th>
      <th>Process Name</th>
      <th>Department Name</th>
      <th>Lot No</th>
      <th>Design Code</th>
      <th>Tounch Ghiss</th>
      <th>Tounch Ghiss Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sum_tounch_ghiss_out=$sum_balance_tounch_ghiss_out=0;
    if(!empty($processes)){
      
      foreach ($processes as $index => $process) {
        $sum_tounch_ghiss_out+=$process['balance_tounch_ghiss'];
        $sum_balance_tounch_ghiss_out+=$process['balance_tounch_ghiss'] * ($process['in_purity'] / 100) * ($process['in_lot_purity'] / 100);
        $this->load->view('tounch_ghiss_out_processes/subform',
                          array('index'=> $index, 'process' => $process));
      }?>
    <tr class="bg_gray bold">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?=four_decimal($sum_tounch_ghiss_out);?></td>
      <td><?=four_decimal($sum_balance_tounch_ghiss_out);?></td>
   </tr>
    <?php }?>
  </tbody>
</table>