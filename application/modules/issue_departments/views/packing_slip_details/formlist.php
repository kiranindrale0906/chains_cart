<h5 class="heading">Packing Slip</h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue check_all')); ?></th>
      <th>Packing No</th>
      <th>Date</th>
      <th>Gross Weight</th>
      <th>Net weight</th>
      <th>Purity</th>
      <th>Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $total_gross=$total_fine=$total_balance=0;
      foreach ($processes as $index => $process) {
        $total_gross+=$process['gross_weight'];
        $total_balance+=$process['gross_weight'];
        $total_fine+=(($process['gross_weight'] * $process['purity']) / 100);
        $this->load->view('packing_slip_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
    <tr class="bg_gray bold">
    <td>Total</td>
    <td></td>
    <td></td>
    <td><?=$total_gross?></td>
    <td><?=$total_balance?></td>
    <td></td>
    <td><?=$total_fine?></td>
    </tr>
  </tbody>
</table>