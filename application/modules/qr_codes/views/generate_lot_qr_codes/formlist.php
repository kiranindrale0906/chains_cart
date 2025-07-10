<h5 class="heading">Generate Lots</h5>
<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr>
      <th>Item Code</th>
      <th>Gross Weight</th>
      <th>Length</th>
      <th>Disptch Weight</th>
      <th>Net Weight</th>
      <th>Less</th>
      <th>Total Less</th>
      <th>Stone Weight</th>
      <th>Other Stone</th>
     <th>Image</th> 
   </tr>
  </thead>
  <tbody>
    <?php
      foreach ($generate_lot_tagging_details as $index => $order) {
          $this->load->view('generate_lot_qr_codes/subform',
                          array('index'=> $index, 'order' => $order));
        }?>
  </tbody>
</table>
