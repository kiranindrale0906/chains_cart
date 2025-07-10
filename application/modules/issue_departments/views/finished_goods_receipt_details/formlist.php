<h5 class="heading">GPC Out </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Lot No</th>
      <th>Tone</th>
      <th>Product Name</th>
      <th>Design Code</th>
      <th>Description</th>
      <th>Quantity</th>
      <th>GPC Out</th>
      <th>Balance GPC Out</th>
      <th>Gross Weight</th>
      <th>Out GPC Out</th>
      <th>Purity</th>
      <th>Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($processes as $index => $process) {
        $this->load->view('finished_goods_receipt_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
  </tbody>
</table>