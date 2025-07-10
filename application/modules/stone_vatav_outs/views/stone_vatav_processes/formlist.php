<h5 class="heading">Stone Vatav Processes </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue stone_vatav_select_all')); ?></th>
      <th>Product Name</th>
      <th>Process Name</th>
      <th>Department Name</th>
      <th>Melting</th>
      <th>Lot No</th>
      <th>Stone Vatav</th>
      <th>Stone Vatav Fine</th>
      <th>Created At</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sum_stone_vatav=$sum_balance_stone_vatav=0;
    if(!empty($processes)){
      
      foreach ($processes as $index => $process) {
        $sum_stone_vatav+=$process['stone_vatav'];
        $sum_balance_stone_vatav+=$process['stone_vatav'] * ($process['in_lot_purity'] / 100);
        $this->load->view('stone_vatav_processes/subform',
                          array('index'=> $index, 'process' => $process));
      }?>
    <tr class="bg_gray bold">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?=four_decimal($sum_stone_vatav);?></td>
      <td><?=four_decimal($sum_balance_stone_vatav);?></td>
      <td></td>
   </tr>
    <?php }?>
  </tbody>
</table>