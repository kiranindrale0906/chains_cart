<h5 class="heading">Fire Tounch Loss</h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Product Name</th>
      <th>process Name</th>
      <th>Balance Loss</th>
      <th>Purity</th>
      <th>Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $total_loss=$total_balance=$total_fine=$total_tounch_loss_fine=0;
      foreach ($processes as $index => $process) {
        $total_loss+=$process['loss'];
        $total_balance+=$process['balance_refine_loss'];
        // $total_tounch_loss_fine+=$process['tounch_loss_fine'];
        $total_fine+=four_decimal($process['balance_refine_loss_fine']);
        
        $this->load->view('fire_tounch_loss_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
    <tr class="bg_gray bold">
    <td>Total</td>
    <td></td>
    <td></td>
    <td><?=$total_balance?></td>
    <td></td>
    <td><?=$total_fine?></td>
    </tr>
  </tbody>
</table>
