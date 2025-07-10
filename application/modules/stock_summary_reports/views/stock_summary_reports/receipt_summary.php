
      
    
    <?php 
      $this->load->view('table_row', array('heading' => 'Metal Summary', 'name' => 'metal_summary', 'class'=>'','type'=>'','column_type'=>'receipt_summary','in_out_weights'=>'yes')); 
      
      $this->load->view('table_row', array('heading' => 'Internal Summary', 'name' => 'internal_receipt_summary', 'class'=>'','type'=>'','column_type'=>'internal_summary','in_out_weights'=>'yes')); 

      $this->load->view('table_row', array('heading' => 'Halmark Receipt Summary', 'name' => 'hallmark_receipt_summary', 'class'=>'','type'=>'','column_type'=>'hallmark_summary','in_out_weights'=>'yes')); 

      $this->load->view('table_row', array('heading' => 'Finished Goods Receipt', 'name' => 'finished_goods_receipt', 'class'=>'','type'=>'','column_type'=>'finished_goods_receipt','in_out_weights'=>'yes')); 
      $this->load->view('table_row', array('heading' => 'Chain Receipt', 'name' => 'chain_receipt_summary', 
                                           'class'=>'','type'=>'','column_type'=>'chain','in_out_weights'=>'yes'));
      
      $this->load->view('table_row', array('heading' => 'Rhodium Receipt', 'name' => 'rhodium_receipt', 
                                           'class'=>'','type'=>'','column_type'=>'chain','in_out_weights'=>'yes'));
      

      $this->load->view('table_row', array('heading' => 'Daily Drawer Receipt', 
                                           'name' => 'daily_drawer_receipt_summary', 'class'=>'','type'=>'','column_type'=>'daily_drawer_in_weight','in_out_weights'=>'yes'));
      $this->load->view('table_row', array('heading' => 'Pending Ghiss Receipt', 
                                           'name' => 'pending_ghiss_receipt', 'class'=>'','type'=>'','column_type'=>'pending_ghiss_receipt','in_out_weights'=>'yes'));
      $this->load->view('table_row', array('heading' => 'Stone Vatav Receipt', 
                                           'name' => 'stone_vatav_receipt', 'class'=>'','type'=>'','column_type'=>'receipt_summary','in_out_weights'=>'yes'));
      $this->load->view('table_row', array('heading' => 'Stone Receipt', 
                                           'name' => 'stone_receipt', 'class'=>'','type'=>'','column_type'=>'stone_receipt','in_out_weights'=>'yes'));
      $this->load->view('table_row', array('heading' => 'Hallmark In', 
                                           'name' => 'hallmark_in', 'class'=>'','type'=>'','column_type'=>'','in_out_weights'=>'yes'));
    ?>

    <tbody class="toggle_div">
      <?php
        $this->load->view('table_row', array('heading' => 'Refresh Summary', 'name' => 'refresh_receipt_summary' , 'class'=>'toggle_row','type'=>'total','in_out_weights'=>'yes')); 
        $this->load->view('table_row', array('heading' => 'Refresh Receipt', 'name' => 'refresh_metal_receipt',    'class'=>'toggle_content','type'=>'','column_type'=>'chain','in_out_weights'=>'yes'));
        $this->load->view('table_row', array('heading' => 'RND Receipt', 'name' => 'rnd_receipt_in_summary',       'class'=>'toggle_content','type'=>'','column_type'=>'chain','in_out_weights'=>'yes'));
      ?>
    </tbody>
    <tbody class="toggle_div">
      <?php  
      $this->load->view('table_row', array('heading' => 'Alloy Receipt', 'name' => 'alloy_receipt_summary', 'class'=>'toggle_row','type'=>'total','column_type'=>'alloy_receipt','in_out_weights'=>'yes'));
      $this->load->view('table_row', array('heading' => 'Alloy In', 'name' => 'alloy_receipt_in_summary', 'class'=>'toggle_content','type'=>'','column_type'=>'alloy_receipt_in_summary','in_out_weights'=>'yes'));
      $this->load->view('table_row', array('heading' => 'Alloy Issue', 'name' => 'alloy_receipt_out_summary', 'class'=>'toggle_content','type'=>'','column_type'=>'receipt_summary','in_out_weights'=>'yes'));
      $this->load->view('table_row', array('heading' => 'Alloy Out', 'name' => 'alloy_receipt_out_weight_summary', 'class'=>'toggle_content','type'=>'','column_type'=>'alloy_receipt_out_weight_summary','in_out_weights'=>'yes'));
      
      $this->load->view('table_row', array('heading' => 'Alloy Vodatar', 'name' => 'alloy_vodatar', 'class'=>'','type'=>'','column_type'=>'receipt_summary','in_out_weights'=>'yes'));
     
      $this->load->view('table_row', array('heading' => 'GPC Vodatar', 'name' => 'gpc_vodatar', 'class'=>'','type'=>'','column_type'=>'gpc_vodatar','in_out_weights'=>'yes'));
      
      $this->load->view('table_row', array('heading' => 'Copper Receipt', 'name' => 'copper_receipt_in_summary', 'class'=>'','type'=>'','column_type'=>'copper_receipt_in_summary','in_out_weights'=>'yes'));
      
      $this->load->view('table_row', array('heading' => 'FE', 'name' => 'fe', 'class'=>'','type'=>'','column_type'=>'fe','in_out_weights'=>'yes')); 
      //$this->load->view('table_row', array('heading' => 'Copper', 'name' => 'copper', 'class'=>'','type'=>'')); 
      $this->load->view('table_row', array('heading' => 'Solder', 'name' => 'solder', 'class'=>'','type'=>'','column_type'=>'solder','in_out_weights'=>'yes')); 

      $this->load->view('table_row', array('heading' => 'Liquor In', 'name' => 'liquor_in', 'class'=>'','type'=>'','column_type'=>'liquor','in_out_weights'=>'yes')); 

      $this->load->view('table_row', array('heading' => 'Stone Receipt', 'name' => 'stone_in', 'class'=>'','type'=>'','column_type'=>'stone_in','in_out_weights'=>'yes'));
    
      //$this->load->view('table_row', array('heading' => 'RB Copper', 'name' => 'rb_copper')); 
      //$this->load->view('table_row', array('heading' => 'Lot Loss', 'name' => 'lot_loss')); 
      //$this->load->view('table_row', array('heading' => 'Lot Loss Difference', 'name' => 'lot_loss_difference')); 
      $this->load->view('table_row', array('heading' => 'Total', 'name' => 'total_received', 'class'=>'bold bg-light','type'=>'total','in_out_weights'=>'yes')); 
    ?>