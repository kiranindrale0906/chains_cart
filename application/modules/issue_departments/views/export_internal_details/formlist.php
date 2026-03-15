<h5 class="heading">Export Internal</h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue check_all')); ?></th>
      <th>Lot No</th>
      <th>Product Name</th>
      <th>Department Name</th>
      <th>Quantity</th>
      <th>Gross Weight</th>
      <th>Balance</th>
      <th>Purity</th>
      <th>Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $total_gross=$total_fine=$total_balance=0;
      foreach ($processes as $index => $process) {
        $total_gross+=$process['rejected'];
        $total_balance+=$process['balance_rejected'];
        $total_fine+=(($process['balance_rejected'] * $process['out_lot_purity']) / 100);
        $this->load->view('export_internal_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
    <tr class="bg_gray bold">
    <td>Total</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><?=$total_gross?></td>
    <td><?=$total_balance?></td>
    <td></td>
    <td><?=$total_fine?></td>
    </tr>
  </tbody>
</table>