<h5 class="heading"><?php echo 'BASIC'; ?></h5>
<div class="row">
  <div class="col-md-4">
    <div class="col-md-12">
      <label class="medium mr-4">Sr No: </label>
      <span><?= $record['srno'].' <a href="'.base_url().'processes/process_srnos/edit/'.$record['id'].'">Edit</a>';?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Product Name: </label>
      <span><?= $record['product_name']?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Process Name: </label>
      <span><?= $record['process_name']?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Department Name: </label>
      <span>
        <?= $record['department_name']; 
          if ($record['product_name']=='Pending Ghiss Receipt' )
            echo '<br><a href="'.base_url().'processes/process_departments/edit/'.$record['id'].'">Edit</a>';
        ?>
      </span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Description: </label>
      <span><?= $record['description'].' <a href="'.base_url().'processes/process_descriptions/edit/'.$record['id'].'">Edit</a>';?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Row Id: </label>
      <span><?= $record['row_id']?></span>
    </div>
  </div>
  <div class="col-md-4">
    <?php if(!empty($record['parent_lot_id']) && $record['parent_lot_id']!=0) { ?>
      <div class="col-md-12">
        <label class="medium mr-4">Parent Lot Id: </label>
        <span><?= $record['parent_lot_id']?></span>
      </div>
    <?php } ?>
    <?php if(!empty($record['parent_lot_name'])) { ?>
      <div class="col-md-12">
        <label class="medium mr-4">Parent Lot Name: </label>
        <span><?= $record['parent_lot_name']?></span>
      </div>
    <?php } ?>
    <?php if(!empty($record['melting_lot_id']) && $record['melting_lot_id']!=0) { ?>
      <div class="col-md-12">
        <label class="medium mr-4">Melting Lot Id: </label>
        <span><a href="<?= ADMIN_PATH.'melting_lots/melting_lots/view/'.$record['melting_lot_id']?>"><?= $record['melting_lot_id']?></a></span>
      </div>
    <?php } ?>
    <?php if(!empty($record['lot_no'])) { ?>
      <div class="col-md-12">
        <label class="medium mr-4">Lot No: </label>
        <span><?= $record['lot_no']?></span>
      </div>
    <?php } ?>
    <div class="col-md-12">
      <label class="medium mr-4">Karigar: </label>
      <span><?= $record['karigar']. ' <a href="'.base_url().'processes/process_karigars/edit/'.$record['id'].'">Edit</a>';?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Worker: </label>
      <span><?= $record['worker']. ' <a href="'.base_url().'processes/process_workers/edit/'.$record['id'].'">Edit</a>';?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Customer Name: </label>
      <span><?= $record['customer_name']. ' <a href="'.base_url().'processes/process_customers/edit/'.$record['id'].'">Edit</a>';?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Status: </label>
      <span>
        <?= $record['status'];
          if(empty($process_details) && $record['status']== 'Complete' && !in_array($record['id'], $next_process_parent_ids)){
            echo  load_buttons('anchor', array('name'=>'Mark As Pending',
                                             'class'=>'btn-xs blue process_status ',
                                             'data-title'=>"View",
                                             'data-id'=>$record['id'],
                                             'layout' => 'application',
                                             'href'=>'javascript:void(0)')); 
          }
          if(empty($process_details) && $record['status']== 'Pending' && !in_array($record['id'], $next_process_parent_ids)){
            echo  load_buttons('anchor', array('name'=>'Mark As Complete',
                                               'class'=>'btn-xs blue process_status ',
                                               'data-title'=>"View",
                                               'data-id'=>$record['id'],
                                               'layout' => 'application',
                                               'href'=>'javascript:void(0)')); 
          }
        ?>
      </span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="col-md-12">
      <label class="medium mr-4">Melting Lot Chain Name: </label>
      <span><?= $record['melting_lot_chain_name'].' <a href="'.base_url().'processes/process_chain_names/edit/'.$record['id'].'">Edit</a>';?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Melting Lot Category One: </label>
      <span>
        <?= $record['melting_lot_category_one']; ?>
        <?php if ($record['department_name']=='GPC' || $record['department_name']=='GPC Or Rodium' || $record['product_name']=='KA Chain' || 
              $record['product_name']=='KA Chain Refresh' || $record['product_name']=='Fancy Chain'|| $record['product_name']=='Round Box Chain' || HOST=="ARC")
          echo '<a href="'.base_url().'processes/process_category_one/edit/'.$record['id'].'">Edit</a>';?>
       
      </span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Melting Lot Category Two: </label>
      <span>
          <?= $record['melting_lot_category_two'].' <a href="'.base_url().'processes/process_category_two/edit/'.$record['id'].'">Edit</a>';?>
      </span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Melting Lot Category Three: </label>
      <span>
          <?= $record['melting_lot_category_three'];?>
      </span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Machine Size: </label>
      <span><?= $record['machine_size'].' <a href="'.base_url().'processes/process_machine_sizes/edit/'.$record['id'].'">Edit</a>';?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Design Code: </label>
      <span><?= $record['design_code'].' <a href="'.base_url().'processes/process_design_codes/edit/'.$record['id'].'">Edit</a>';?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Machine: </label>
      <span><?= $record['machine_no'].' <a href="'.base_url().'processes/process_machine_no/edit/'.$record['id'].'">Edit</a>';?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Created At: </label>
      <span><?= (!empty($record['created_at'])) ? date("d-m-Y  H:i:s", strtotime($record['created_at'])) : '00-00-0000 00:00:00'?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Created By: </label>
      <span><?= $record['created_user']?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Updated At: </label>
      <span><?= (!empty($record['updated_at'])) ? date("d-m-Y H:i:s", strtotime($record['updated_at'])) : '00-00-0000 00:00:00'?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Updated By: </label>
      <span><?= $record['updated_user']?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Completed At: </label>
      <span><?= (!empty($record['completed_at'])) ? date("d-m-Y H:i:s", strtotime($record['completed_at'])) : '00-00-0000 00:00:00'?></span>
    </div>
  </div>
  <?php /*$x=0;
    foreach ($columns as $i => $column) { 
      if($x%6==0) {
  ?>
  <div class="col-md-4">
  <?php } ?>
  <?php //if($column == 'srno' || $column == 'product_name' || $column == 'process_name' || $column == 'department_name' || $column == 'description') { ?>
    <div class="col-md-12">
      <label class="medium mr-4"><?php echo strtoupper(str_replace('_', ' ', $column)); ?>: </label>
      <span>
        <?php echo $record[$column];
        ?>
      </span>
    </div>
  <?php //} ?>
  <?php if($x%6==5) echo '</div>'; 
      $x++;
    } */
  ?> 
</div>
<hr class="mt0">
