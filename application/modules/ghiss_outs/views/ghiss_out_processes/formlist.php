<h5 class="heading">Ghiss Out Processes </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue ghiss_out_select_all')); ?></th>
      <th>Chain Name</th>
      <th>Process Name</th>
      <th>Department Name</th>
      <th>Lot No</th>
      <th>Design Code</th>
      <th>Ghiss</th>
      <th>Ghiss Fine</th>
      <th>Created At</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sum_ghiss_out=$sum_balance_ghiss_out=0;
    if(!empty($processes)){
      
      foreach ($processes as $index => $process) {
        $sum_ghiss_out+=$process['balance_ghiss'];
        $sum_balance_ghiss_out+=$process['balance_ghiss'] * ($process['wastage_purity'] / 100) * ($process['wastage_lot_purity'] / 100);
        $this->load->view('ghiss_out_processes/subform',
                          array('index'=> $index, 'process' => $process));
      }?>
    <tr class="bg_gray bold">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?=four_decimal($sum_ghiss_out);?></td>
      <td><?=four_decimal($sum_balance_ghiss_out);?></td>
      <td></td>
   </tr>
    <?php }?>
  </tbody>
</table>