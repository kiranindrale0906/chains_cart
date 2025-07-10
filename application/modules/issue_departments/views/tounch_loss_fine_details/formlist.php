<h5 class="heading">Tounch Fine Loss</h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Product Name</th>
      <th>Department Name</th>
      <th>Balance Tounch Fine Loss</th>
      <th>Tounch Purity</th>
      <th>Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
    
      foreach ($processes as $index => $process) {
        $this->load->view('tounch_loss_fine_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
  </tbody>
</table>