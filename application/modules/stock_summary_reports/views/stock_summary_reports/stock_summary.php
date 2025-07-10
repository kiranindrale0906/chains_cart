<tr>
  <td colspan="7" class="p-3"></td>
</tr>
<tr>
  <td class="blue medium bg-light" colspan="7"><h6 class="heading blue m-0">STOCK SUMMARY</h6></td>
</tr>
</tbody>

<tbody>
  <tr>
    <th class="bg-light" scope="row" colspan='6'>RECEIPTS AND VATAV</td>
  </tr>
</tbody>
<tbody>
  <?php
    
    $this->load->view('table_row', array('heading' => 'Chain Receipt Summary', 'name' => 'stock_chain_receipt_summary', 'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','product_name'=>'')); 
    $this->load->view('table_row', array('heading' => 'Finished Goods Receipt', 'name' => 'stock_finished_goods_receipt', 'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','product_name'=>''));           
    $this->load->view('table_row', array('heading' => 'GPC Powder', 'name' => 'total_gpc_powder', 'class'=>'', 'type'=>'', 'column_type'=>'stock_summary','in_out_weights'=>'no','product_name'=>'')); 
//    $this->load->view('table_row', array('heading' => 'Internal Rejected', 'name' => 'total_internal_rejected', 'class'=>'', 'type'=>'', 'column_type'=>'stock_summary','in_out_weights'=>'no','product_name'=>'')); 
    $this->load->view('table_row', array('heading' => 'Liquor', 'name' => 'liquor_stock', 'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','product_name'=>'')); 
    $this->load->view('table_row', array('heading' => 'Stone', 'name' => 'stone_stock', 'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','product_name'=>'')); 
    $this->load->view('table_row', array('heading' => 'Metal', 'name' => 'stock_metal_summery', 'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','product_name'=>'')); 
    $this->load->view('table_row', array('heading' => 'Rodium', 'name' => 'stock_rhodium_summary', 'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','product_name'=>'')); 
    $this->load->view('table_row', array('heading' => 'RND', 'name' => 'rnd_stock_summary', 'class'=>'','type'=>'total','column_type'=>'stock_summary','in_out_weights'=>'no','product_name'=>''));   
    $this->load->view('table_row', array('heading' => 'Packing Slip', 'name' => 'stock_packing_slip', 'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','product_name'=>''));    
    $this->load->view('table_row', array('heading' => 'After Packing Slip', 'name' => 'stock_after_packing_slip', 'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','product_name'=>''));    
    ?>
</tbody>
  
<?php 
  $chains[] = 'Office Outside'; 
  $chains[] = 'Office Outside Pipe and Para'; 
  $chains[] = 'GPC Out';
  $chains[] = 'Refresh GPC Out';
  $chains[] = 'Internal Rejected';
  $this->load->view('stock_summary_section', array('section_name' => 'CHAINS', 'section_rows' => $chains, 'row_prefix' => ''));

  $this->load->view('stock_summary_section', array('section_name' => 'KARIGAR OFFICE OUTSIDE BALANCE', 'section_rows' => $rows['karigar_daily_drawer']));

  $wastages[] = 'melting_wastage';
  $wastages[] = 'fire_tounch_in';
  $wastages[] = 'tounch_in';
  $wastages[] = 'loss';
  $wastages[] = 'ghiss_loss';
  $this->load->view('stock_summary_section', array('section_name' => 'WASTAGES', 'section_rows' => $wastages, 'row_prefix' => 'wastage_')); 
  $this->load->view('stock_summary_section', array('section_name' => 'WASTAGE MELTING', 'section_rows' => $wastage_meltings, 'row_prefix' => '')); 
?>

<tbody>
  <tr>
    <th class="bg-light" scope="row" colspan='6'>GROSS AND FINE LOSS <a style="font-weight: 300;" href="/processes/process_compute/create">Transfer TLF</a></td>
  </tr>
</tbody>
<tbody>
  <?php $this->load->view('table_row', array('heading' => 'GPC Tounch Department Loss', 'name' => 'gpc_tounch_department_loss','class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','section_name' => 'GROSS AND FINE LOSS')); ?>
  <?php $this->load->view('table_row', array('heading' => 'Wastage Tounch Department Loss', 'name' => 'wastage_tounch_department_loss', 
                                             'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','section_name' => 'GROSS AND FINE LOSS')); ?>
  <?php $this->load->view('table_row', array('heading' => 'Other Tounch Department Loss', 'name' => 'other_tounch_department_loss', 
                                             'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','section_name' => 'GROSS AND FINE LOSS')); ?>
  
  <?php $this->load->view('table_row', array('heading' => 'Walnut Gross Loss', 'name' => 'wastage_walnut_hcl_gross_loss', 
                                             'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','section_name' => 'GROSS AND FINE LOSS')); ?>
  
  <?php $this->load->view('table_row', array('heading' => 'HCL Gross Loss', 'name' => 'wastage_hcl_gross_loss', 
                                             'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','section_name' => 'GROSS AND FINE LOSS')); ?> 
  
  <?php $this->load->view('table_row', array('heading' => 'Fire Tounch Loss', 'name' => 'wastage_refine_loss', 
                                             'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','section_name' => 'GROSS AND FINE LOSS')); ?>
                                             
  <?php $this->load->view('table_row', array('heading' => 'Fire Tounch Gross Loss', 'name' => 'wastage_fire_tounch_gross_loss', 
                                             'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','section_name' => 'GROSS AND FINE LOSS')); ?>
                                                                                         
  <?php $this->load->view('table_row', array('heading' => 'Melting Wastage Fine Diff', 'name' => 'stock_melting_wastage_fine_difference', 
                                             'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','section_name' => 'GROSS AND FINE LOSS')); ?>
</tbody>
<tbody>
  <tr>
    <th class="bg-light" scope="row" colspan='6'>REFINE LOSS</th>
  </tr>
</tbody>
<tbody>
  <?php $this->load->view('table_row', array('heading' => 'Refine Loss', 'name' => 'melting_wastage_refine_loss', 
                                             'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','section_name' => 'GROSS AND FINE LOSS'));

        $this->load->view('table_row', array('heading' => 'Tounch Loss Fine', 'name' => 'refine_tounch_department_loss','class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','section_name' => 'GROSS AND FINE LOSS')); ?>
</tbody>

<tbody>
  <tr>
    <th class="bg-light" scope="row" colspan='6'>HALLMARK</th>
  </tr>
</tbody>

<tbody>
  <?php $this->load->view('table_row', array('heading' => 'Hallmark Pending', 'name' => 'hallmark_subcontracted', 
                                             'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','section_name' => '')); ?>
</tbody>
<tbody>
  <?php $this->load->view('table_row', array('heading' => 'Hallmark Out', 'name' => 'hallmark_out', 'class'=>'','type'=>'','column_type'=>'stock_summary','in_out_weights'=>'no','product_name'=>'')); ?>
</tbody>  
<tbody>
  <?php $this->load->view('table_row', array('heading' => 'Total', 'name' => 'total_stock_summary', 'class'=>'bold bg-light','type'=>'total','in_out_weights'=>'no')); ?>
</tbody>

