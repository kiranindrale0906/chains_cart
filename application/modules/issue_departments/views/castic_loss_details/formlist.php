<h5 class="heading">HCL Loss</h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Parent Lot Name</th>
      <th>Product Name</th>
      <th>Department Name</th>
      <th>Loss</th>
      <th>Loss Gross</th>
      <th>Purity</th>
      <th>Loss Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $loss=$loss_gross=$loss_fine=0;
      foreach ($processes as $index => $process) {
        $loss+=$process['loss'];
        $loss_gross+=four_decimal(($process['loss'] * $process['out_lot_purity']) / 100);
        $loss_fine+=four_decimal((($process['loss'] * $process['out_lot_purity']) / 100)* $process['out_lot_purity'] / 100);
        $this->load->view('castic_loss_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
     <tr class="bg_gray bold">
      <td>Total</td>
      <td></td>
      <td></td>
      <td></td>
      <td><?= $loss?></td>
      <td><?= $loss_gross ?></td>
      <td></td>
      <td><?= $loss_fine ?></td>
    </tr>
  </tbody>
</table>