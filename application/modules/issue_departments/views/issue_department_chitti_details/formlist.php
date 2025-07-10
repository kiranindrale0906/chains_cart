<h5 class="heading">Chitties </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Product Name</th>
      <th>Gross Weight</th>
      <th>Purity</th>
      <th>Fine</th>
      <th>Wastage Purity</th>
      <th>Wastage Fine</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($processes as $index => $process) {
        $this->load->view('issue_department_chitti_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
  </tbody>
</table>