<h5 class="heading">GPC Repair Out </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Lot No</th>
      <th>Tone</th>
      <?php if(HOST=='ARC'){ ?>
      <th>Category Name</th>
      <th>Sub Category Name</th>
      <?php }?>
      <th>Product Name</th>
      <th>Design Code</th>
      <th>Chitti Design Name</th>
      <th>Tounch Purity</th>
      <th>Chain</th>
      <th>Customer Name</th>
      <th>GPC Out</th>
      <th>Balance GPC Out</th>
      <th>GPC Repair Out</th>
      <th>Out GPC Repair Out</th>
      <th>Purity</th>
      <th>Fine</th>
      <th>Wastage</th>
      <th>Chitti Purity</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($processes as $index => $process) {
        $this->load->view('gpc_repair_out_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
  </tbody>
</table>