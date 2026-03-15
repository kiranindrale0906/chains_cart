<h5 class="heading">GPC Out </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue select_all')); ?></th>
      <th>Lot No</th>
      <th>Tone</th>
      <th>Product Name</th>
      <?php if(HOST=="Hallmark"){?>
      <th>Job Card</th>
      <th>Factory Issue Department</th>
      <?php }else{?>
      <th>Design Code</th>
      <?php }?>
      <th>Description</th>
      <th>Quantity</th>
      <th>Gross Weight</th>
      <th>Balance Gross Weight</th>
      <th>Purity</th>
      <th>Fine</th>
      <?php if(HOST=="Domestic"){?>
      <th>Rate per Gram</th>
      <?php }?>
      
    </tr>
  </thead>
  <tbody>
 
  <?php
      foreach ($processes as $index => $process) {
        $this->load->view('issue_department_details/subform',array('index'=> $index, 'process' => $process));
      }
    ?>
  </tbody>
</table>
