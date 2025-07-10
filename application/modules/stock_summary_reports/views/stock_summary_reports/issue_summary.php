<tr>
  <td colspan="7" class="p-3"></td>
</tr>
<tbody>
  <tr>
    <td class="blue medium bg-light" colspan="7"><h6 class="heading blue m-0">ISSUE SUMMARY</h6></td>
  </tr>
</tbody>
<tbody>
  <?php 
    $this->load->view('table_row', array('heading' => 'Copper', 'name' => 'copper', 'class'=>'', 'type'=>'', 'column_type'=>'issue_summary', 'in_out_weights'=>'no','product_name'=>'process')); 
    $this->load->view('table_row', array('heading' => 'Stone Vatav Returned', 'name' => 'stone_vatav', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'process'));           
    $this->load->view('table_row', array('heading' => 'Stone Issue', 'name' => 'stone_issue', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'process'));           
    $this->load->view('table_row', array('heading' => 'Issue GPC Out', 'name' => 'issue_department_gpc_out', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));
    $this->load->view('table_row', array('heading' => 'Issue QC Out', 'name' => 'issue_department_qc_out', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));
    $this->load->view('table_row', array('heading' => 'Issue Domestic Internal', 'name' => 'issue_department_domestic_internal', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));
    $this->load->view('table_row', array('heading' => 'Issue Hallmark Out', 'name' => 'issue_department_hallmark_out', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));
    $this->load->view('table_row', array('heading' => 'Issue Export Internal', 'name' => 'issue_department_export_internal', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));
    $this->load->view('table_row', array('heading' => 'Issue Packing Slip', 'name' => 'issue_department_packing_slip', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));

    $this->load->view('table_row', array('heading' => 'Extra Packing Slip', 'name' => 'extra_packing_slip', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));
    
    $this->load->view('table_row', array('heading' => 'Issue Hu ID', 'name' => 'issue_department_hu_id', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));
    $this->load->view('table_row', array('heading' => 'Issue Finish Goods', 'name' => 'issue_department_finish_good', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));

    $this->load->view('table_row', array('heading' => 'Issue Melting Wastage', 'name' => 'issue_department_melting_wastage', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));

    $this->load->view('table_row', array('heading' => 'Issue Daily Drawer Wastage', 'name' => 'issue_department_daily_drawer_wastage', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));

    $this->load->view('table_row', array('heading' => 'Issue Refine Loss', 'name' => 'issue_department_refine_loss', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));

    $this->load->view('table_row', array('heading' => 'Issue HCL Loss', 'name' => 'issue_hcl_loss', 'class'=>'','type'=>'',
                                         'column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));

    $this->load->view('table_row', array('heading' => 'Issue Tounch Loss Fine', 
                                         'name' => 'issue_tounch_loss_fine', 'class'=>'','type'=>'',
                                         'column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'process'));

    $this->load->view('table_row', array('heading' => 'Issue Ghiss', 'name' => 'issue_ghiss', 'class'=>'','type'=>'',
                                         'column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'process'));

    $this->load->view('table_row', array('heading' => 'Loss Issue', 'name' => 'issue_loss', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'process'));
    $this->load->view('table_row', array('heading' => 'Loss Melting', 'name' => 'issue_loss_melting', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'process'));

//    $this->load->view('table_row', array('heading' => 'Melting Wastage Refine Loss', 'name' => 'issue_melting_wastage_refine_loss', 'class'=>'','type'=>'','column_type'=>'repair_out'));

    $this->load->view('table_row', array('heading' => 'Issue Daily Drawer', 'name' => 'issue_daily_drawer', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'process'));

    $this->load->view('table_row', array('heading' => 'Refresh RND Issue', 'name' => 'refresh_rnd_issue', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'process'));

    $this->load->view('table_row', array('heading' => 'Issue GPC Powder', 'name' => 'issue_gpc_powder', 'class'=>'','type'=>'', 'column_type'=>'issue_summary','in_out_weights'=>'no','product_name'=>'issue_department'));

    // $this->load->view('table_row', array('heading' => 'Daily Drawer Chain Receipt', 'name' => 'daily_drawer_issue_receipt', 
    //                                      'class'=>'','type'=>'',
    //                                      'column_name'=>array('','daily_drawer_in_weight','daily_drawer_in_weight','','','')));
    
    $this->load->view('table_row', array('heading' => 'FE Out', 'name' => 'issue_fe', 'class'=>'','type'=>'','column_type'=>'issue_summary','in_out_weights'=>'no'));
    
    $this->load->view('table_row', array('heading' => 'Liquor Out', 'name' => 'issue_liquor', 'class'=>'','type'=>'',
                                         'column_type'=>'issue_summary','in_out_weights'=>'no'));
    
    if (HOST == 'dailydrawer-argold.ascratech.com'
        || HOST == 'admin-argold.ascratech.com'
        || HOST == 'argold.ascratech.com') {
      $this->load->view('table_row', array('heading' => 'Daily Drawer AG PL Out', 'name' => 'daily_drawer_ag_pl_out' ,'class'=>'toggle_row','type'=>'total','in_out_weights'=>'no')); 
      //$this->load->view('table_row', array('heading' => 'Hollow Choco PL Out', 'name' => 'hollow_choco_chain_daily_drawer_pl_out' ,'class'=>'toggle_content','type'=>'')); 
      //$this->load->view('table_row', array('heading' => 'Imp Italy AG Out', 'name' => 'imp_italy_chain_daily_drawer_ag_out' ,'class'=>'toggle_content','type'=>'')); 
      //$this->load->view('table_row', array('heading' => 'Machine Chain AG Out', 'name' => 'machine_chain_daily_drawer_ag_out' ,'class'=>'toggle_content','type'=>'')); 
      //$this->load->view('table_row', array('heading' => 'Choco Chain AG Out', 'name' => 'choco_chain_daily_drawer_ag_out' ,'class'=>'toggle_content','type'=>'')); 
      //$this->load->view('table_row', array('heading' => 'Rope Chain AG Out', 'name' => 'rope_chain_daily_drawer_ag_out' ,'class'=>'toggle_content','type'=>'')); 
      //$this->load->view('table_row', array('heading' => 'Roundbox Chain AG Out', 'name' => 'roundbox_chain_daily_drawer_ag_out' ,'class'=>'toggle_content','type'=>'')); 
      //$this->load->view('table_row', array('heading' => 'Indo Tally AG Out', 'name' => 'indo_tally_chain_daily_drawer_ag_out' ,'class'=>'toggle_content','type'=>'')); 
      //$this->load->view('table_row', array('heading' => 'Indo Tally PL Out', 'name' => 'indo_tally_chain_daily_drawer_pl_out' ,'class'=>'toggle_content','type'=>'')); 
      //$this->load->view('table_row', array('heading' => 'Sisma Chain AG Out', 'name' => 'sisma_chain_daily_drawer_ag_out' ,'class'=>'toggle_content','type'=>'')); 
    }


    //$this->load->view('table_row', array('heading' => 'Copper Out', 'name' => 'issue_copper', 'class'=>'','type'=>''));
    //$this->load->view('table_row', array('heading' => 'Solder', 'name' => 'solder_out', 'class'=>'','type'=>''));
    $this->load->view('table_row', array('heading' => 'Total', 'name' => 'total_issued', 'class'=>'bold','type'=>'total','in_out_weights'=>'no')); 
  ?>
