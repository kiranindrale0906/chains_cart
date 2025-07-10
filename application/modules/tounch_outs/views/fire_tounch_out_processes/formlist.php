<h5 class="heading">Tounch Out Processes </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue fire_tounch_out_select_all')); ?></th>
      <th>Chain Name</th>
      <th>Process Name</th>
      <th>Department Name</th>
      <th>Lot No</th>
      <th>Design Code</th>
      <th>Fire Tounch Out</th>
      <th>Balance Fire Tounch Out</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sum_fire_tounch_out=$sum_balance_fire_tounch_out=0;
    if(!empty($processes)){
      foreach ($processes as $index => $process) {
        $sum_fire_tounch_out+=$process['fire_tounch_out'];
        $sum_balance_fire_tounch_out+=$process['balance_fire_tounch_out'];

        $this->load->view('fire_tounch_out_processes/subform',
                          array('index'=> $index, 'process' => $process));
      }
    ?>
  <tr class="bg_gray bold">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><?=four_decimal($sum_fire_tounch_out);?></td>
    <td><?=four_decimal($sum_balance_fire_tounch_out);?></td>
  </tr>
  <?php }?>
  </tbody>
</table>