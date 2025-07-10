<h5 class="heading">GPC Out </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue check_all')); ?></th>
      <th>Lot No</th>
      <th>Tone</th>
      <th>Product Name</th>
      <th>Department Name</th>
      <th>Design Code</th>
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
        $total_gross+=$process['gpc_out'];
        $total_balance+=$process['balance_gpc_out'];
        $total_fine+=(($process['gpc_out'] * $process['out_lot_purity']) / 100);
        $this->load->view('finish_good_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
    <tr class="bg_gray bold">
    <td>Total</td>
    <td></td>
    <td></td>
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