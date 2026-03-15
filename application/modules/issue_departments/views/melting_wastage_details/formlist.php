<h5 class="heading">Melting Wastages </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Department Name</th>
      <th>Product</th>
      <th>Process</th>
      <th>Quantity</th>
      <th>In Purity</th>
      <th>Melting Wastage</th>
      <th>Balance Melting Wastage</th>
      <th>Out Melting Wastage</th>
      <th>Gross Weight</th>
      <th>Purity</th>
      <th>Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $out_weight=$balance_gpc_out=0;
      foreach ($processes as $index => $process) {
        $out_weight+=$process['melting_wastage'];
        $balance_gpc_out+=$process['balance_melting_wastage'];
        if(four_decimal($process['balance_melting_wastage'])!=0){
        $this->load->view('melting_wastage_details/subform',array('index'=> $index, 'process' => $process));
        }
      }
    ?>
    <tr class="bg_gray bold">
      <td>Total</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?= $out_weight?></td>
      <td><?= $balance_gpc_out?></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>