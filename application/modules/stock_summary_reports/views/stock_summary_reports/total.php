
<tr>
  <th colspan=7></th>
</tr>
<tr>  
  <th colspan=7>Balance Summary</th>
</tr>

<?php
  /*$this->load->view('table_row', array('heading' => 'Receipt Opening', 'name' => 'summary_receipt_opening', 'class' => '','type'=>'total'));*/ 
  /*$this->load->view('table_row', array('heading' => 'Receipt In', 'name' => 'summary_receipt_in'));         
  $this->load->view('table_row', array('heading' => 'Total Receipt', 'name' => 'summary_total_receipt', 'class' => 'bold','type'=>'total')); 

  $this->load->view('table_row', array('heading' => 'Receipt Balance', 'name' => 'summary_receipt_balance', 'class' => '','type'=>'total')); 
  $this->load->view('table_row', array('heading' => 'Stock Summary', 'name' => 'summary_stock')); 
  $this->load->view('table_row', array('heading' => 'Issue Summary', 'name' => 'total_issued')); 
  $this->load->view('table_row', array('heading' => 'Total Stock / Issue', 'name' => 'summary_total_stock', 'class' => 'bold','type'=>'total')); 
  $this->load->view('table_row', array('heading' => 'Adjustment Record', 'name' => 'adjustment_summary','type'=>'total')); */
  $this->load->view('table_row', array('heading' => 'Balance', 'name' => 'summary','type'=>'total'));
?>