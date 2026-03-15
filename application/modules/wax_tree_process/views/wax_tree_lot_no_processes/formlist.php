<h5 class="heading">Tounch Ghiss Out Processes </h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th><?php load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue wax_tree_select_all')); ?></th>
      <th>Tree no</th>
      <th>Type</th>
      <th>Item Name</th>
      <th>Melting</th>
      <th>Tree Gross Wt</th>
      <th>Tree Base Wt</th>
      <th>Stone Wt</th>
      <th>Tree Net Wt</th>
      <th>Gold Ratio</th>
      <th>Total Required Gold</th>

    </tr>
  </thead>
  <tbody>
    <?php
    //pd($wax_tree_processes);
    if(!empty($wax_tree_processes)){
      
      foreach ($wax_tree_processes as $index => $process) {
        $this->load->view('wax_tree_process/wax_tree_lot_no_processes/subform',
                          array('index'=> $index, 'process' => $process));
      }?>
    <tr class="bg_gray bold">
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>   </tr>
    <?php }?>
  </tbody>
</table>