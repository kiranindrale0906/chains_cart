<h5 class="heading">Melting Wastage Refine Out Processes </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue melting_wastage_refine_out_select_all')); ?></th>
      <th>Chain Name</th>
      <th>Process Name</th>
      <th>Department Name</th>
      <th>Lot No</th>
      <th>Design Code</th>
      <th>Melting Wastage</th>
      <th>Melting Wastage Fine</th>
      <th>Created At</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sum_melting_wastage_refine_out=$sum_balance_melting_wastage_refine_out=0;
    if(!empty($processes)){
      
      foreach ($processes as $index => $process) {
        $sum_melting_wastage_refine_out+=$process['balance_melting_wastage'];
        $sum_balance_melting_wastage_refine_out+=$process['balance_melting_wastage'] * ($process['wastage_purity'] / 100) * ($process['wastage_lot_purity'] / 100);
        $this->load->view('melting_wastage_refine_out_processes/subform',
                          array('index'=> $index, 'process' => $process));
      }?>
    <tr class="bg_gray bold">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?=four_decimal($sum_melting_wastage_refine_out);?></td>
      <td><?=four_decimal($sum_balance_melting_wastage_refine_out);?></td>
      <td></td>
   </tr>
    <?php }?>
  </tbody>
</table>