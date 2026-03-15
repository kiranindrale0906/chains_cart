<h5 class="heading">GPC Out </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Lot No</th>
      <th>Tone</th>
      <th>Product Name</th>
      <th>Hallmark Out</th>
      <th>Issue Hallmark Out</th>
      <th>Hallmark Quantity</th>
      <th>Purity</th>
      <th>Fine</th>
      </tr>
  </thead>
  <tbody>
    <?php
    $out_weight=$balance_hallmark_out=$wastage_fine=0;
      foreach ($processes as $index => $process) {
        $out_weight+=$process['hallmark_out'];
        $balance_hallmark_out+=$process['balance_hallmark_out'];
        $this->load->view('hallmark_out_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
    <tr class="bg_gray bold">
      <td>Total</td>
      <td></td>
      <td></td>
      <td><?= $out_weight?></td>
      <td><?= $balance_hallmark_out?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>

  </tbody>
</table>