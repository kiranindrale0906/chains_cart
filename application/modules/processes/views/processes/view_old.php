<h4 class="heading">Process Details</h4>
<span><a href="<?= ADMIN_PATH.'processes/processes/view/'.$record['id']?>" class="ml-5">New</a></span>
<?= getHttpButton('DELETE', base_url().'processes/processes/delete/'.$record['id'], 'float-right btn-danger ml-5'); ?>
<?php if($record['archive'] == 0 && $record['balance'] == 0) {  
        echo getHttpButton('HIDE', base_url().'processes/process_archives/update/'.$record['id'].'?from=view', 'float-right btn-info ml-5');
      } /*elseif($record['archive'] == 1) {
        echo getHttpButton('SHOW', base_url().'processes/process_archives/update/'.$record['id'].'?from=view', 'float-right btn-info ml-5');
      }*/
?>
<?= getHttpButton('ISSUE', base_url().'processes/process_json_codes/edit/'.$record['id'], 'float-right btn-success ml-5'); ?>
<div class="clear"></div>
<?php
 foreach ($record_groups as $title => $columns) {
  $left_column_html  = '';
  $right_column_html = '';
  ?>
  <h5 class="heading"><?php echo $title; ?></h5>
  <div class="row">
    <?php
      foreach ($columns as $i => $column) {
        $html = '';
        ob_start();
      ?>
      <div class="col-md-12">
        <label class="medium mr-4"><?php echo strtoupper(str_replace('_', ' ', $column)); ?>: </label>
        <span>
        <?php if(! in_array($column, ['previous_process', 'next_processes', 'process_information'])) {
          if ($column=='karigar')
            echo ' <a href="'.base_url().'processes/process_karigars/edit/'.$record['id'].'">Edit</a>';
          if ($column=='worker')
            echo ' <a href="'.base_url().'processes/process_workers/edit/'.$record['id'].'">Edit</a>';
          if ($column=='customer_name')
            echo ' <a href="'.base_url().'processes/process_customers/edit/'.$record['id'].'">Edit</a>';
          if ($column=='srno')
            echo ' <a href="'.base_url().'processes/process_srnos/edit/'.$record['id'].'">Edit</a>';
          if ($column=='hook_in' && $record[$column] != 0)
            echo ' <a href="'.base_url().'processes/process_hooks/edit/'.$record['id'].'">Edit</a>';
          /*if ($column=='hook_kdm_purity' && $record[$column] != 0)
            echo ' <a href="'.base_url().'processes/process_hook_kdm_purities/edit/'.$record['id'].'">Edit</a>';*/
          if ($column=='machine_size')
            echo ' <a href="'.base_url().'processes/process_machine_sizes/edit/'.$record['id'].'">Edit</a>';
          if ($column=='design_code')
            echo ' <a href="'.base_url().'processes/process_design_codes/edit/'.$record['id'].'">Edit</a>';
          if ($column=='max_hcl_loss')
            echo '<br><a href="'.base_url().'processes/process_max_min_hcl_losses/edit/'.$record['id'].'">Max/Min HCL Loss Edit</a>';
           if ($column=='department_name' && $record['product_name']=='Pending Ghiss Receipt' )
            echo '<br><a href="'.base_url().'processes/process_departments/edit/'.$record['id'].'">Edit</a>';
          if($column=='melting_lot_chain_name')
            echo ' <a href="'.base_url().'processes/process_chain_names/edit/'.$record['id'].'">Edit</a>';
          if($column=='status' && empty($process_details) && $record['status']== 'Complete' && !in_array($record['id'], $next_process_parent_ids)){
            echo  load_buttons('anchor', array('name'=>'Mark As Pending',
                                               'class'=>'btn-xs blue process_status ',
                                               'data-title'=>"View",
                                               'data-id'=>$record['id'],
                                               'layout' => 'application',
                                               'href'=>'javascript:void(0)')); 
          }
          if($column=='status' && empty($process_details) && $record['status']== 'Pending' && !in_array($record['id'], $next_process_parent_ids)){
            echo  load_buttons('anchor', array('name'=>'Mark As Complete',
                                               'class'=>'btn-xs blue process_status ',
                                               'data-title'=>"View",
                                               'data-id'=>$record['id'],
                                               'layout' => 'application',
                                               'href'=>'javascript:void(0)')); 
          }
          if ($column=='melting_lot_category_one' && (      $record['department_name']=='GPC' 
                                                         || $record['department_name']=='GPC Or Rodium'
                                                         || $record['product_name']=='KA Chain'
                                                         || $record['product_name']=='KA Chain Refresh'
                                                         || $record['product_name']=='Round Box Chain'
                                                         || $record['product_name']=='Fancy Chain'))
            echo ' <a href="'.base_url().'processes/process_category_one/edit/'.$record['id'].'">Edit</a>';
          if($column=='melting_lot_category_two')
            echo ' <a href="'.base_url().'processes/process_category_two/edit/'.$record['id'].'">Edit</a>';
          if($column=='description')
            echo ' <a href="'.base_url().'processes/process_descriptions/edit/'.$record['id'].'">Edit</a>';
        } ?>
        </span>
      </div>
      <?php
         if ($record['department_name']=='Casting' && $column=='process_information')
            echo '<div class="col-md-12"><a href="'.base_url().'processes/process_informations/create?process_id='.$record['id'].'">Add Process Information</a></div>';
          
       if (in_array($column, get_columns_with_table())) {
        $table_data = '';
        if(isset(${$column.'_data'})) {
          $table_data      = ${$column.'_data'};
          $table_columns   = ${$column.'_columns'};
          $table_headers   = ${$column.'_headers'};
          $table_totals    = isset(${$column.'_totals'}) ? ${$column.'_totals'} : array();
          $alignment_class = '';
        }
        ?>
        <?php if(!empty($table_data)){ ?>
          <div class="col-md-12">
            <table class="table table-sm">
              <thead class="bg_gray">
                <tr>
                   <?php

                      foreach ($table_headers as $i => $table_header) { 
                        if ($table_header=='id') continue;
                    ?>
                    <?php
                      if(!in_array($table_columns[$i], ['id', 'parent_id', 'melting_lot_id', 'issue_department_id', 'process_id'])) {
                        $alignment_class = is_numeric($table_data[0][$table_columns[$i]]) ? 'text-right' : '';
                      }
                    ?>
                    <th class="<?php echo $alignment_class; ?>"><?php echo strtoupper(str_replace('_', ' ', $table_header)); ?></th>
                  <?php } ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($table_data as $data) { ?>
                  <tr>
                    <?php 
                    foreach ($table_columns as $table_column) {
                      if ($table_column=='id' && $column=='out_weight') continue;
                      $alignment_class = is_numeric($data[$table_column]) ? 'text-right' : '';
                      if ($table_column == 'melting_lot_id') {
                        echo '<td><a href="'.base_url().'melting_lots/melting_lots/view/'.$data[$table_column].'">VIEW</a></td>';
                      } else if($table_column == 'issue_department_id') {
                        echo '<td><a href="'.base_url().'issue_departments/issue_departments/view/'.$data[$table_column].'">VIEW</a></td>';
                      } else if(in_array($table_column, ['id', 'parent_id', 'process_id'])) {
                        if ($record['department_name']=='Casting' && $column=='process_information'){
                        echo '<td class="text-right"><a href="'.base_url().'processes/process_informations/edit/'.$data['id'].'?process_id='.$record['id'].'" class="green">Edit</a> &nbsp';
                        echo '<a href="'.base_url().'processes/process_informations/delete/'.$data['id'].'?process_id='.$record['id'].'" class="red">Delete</a></td>';   
                        }else{
                          echo '<td><a href="'.base_url().'processes/processes/view/'.$data[$table_column].'">VIEW</a></td>';
                        }
                      } else
                        echo '<td class="'.$alignment_class.'">'.$data[$table_column].'</td>';
                      
                      if ($column=='out_weight' && $table_column == 'created_at')
                        echo '<td><a href="'.base_url().'processes/process_details/delete/'.$data['id'].'">Delete</a></td>';
                    } ?>
                  </tr>
                <?php } ?>
              </tbody>
              <?php if(!empty($table_totals)){ ?>
                <tfoot class="bg_light_gray bold">
                  <tr>
                    <?php foreach ($table_columns as $table_column) {
                      if(isset($table_totals[$table_column])){
                        echo '<td class="text-right">'.four_decimal($table_totals[$table_column]).'</td>';
                      } else {
                        echo '<td></td>';
                      }
                    } ?>
                  </tr>
                </tfoot>
              <?php } ?>
            </table>
          </div>
        <?php } ?>
      <?php } ?>
    <?php
    $html = ob_get_clean();
    if(in_array($title, get_groups_to_check_for_two_column_view())){
      if (in_array($column, get_columns_to_disply_right())) {
        $right_column_html .= $html;
      } else {
        $left_column_html .= $html;
      }
    } else { 
      if($column=='process_information'){?>
        <div class="col-md-12"><?php echo $html; ?></div>
      <?php }else{?>
        <div class="col-md-4"><?php echo $html; ?></div>
      <?php }
      ?>
    <?php }
  } ?>
    <div class="col-md-6"><?php echo $left_column_html; ?></div>
    <div class="col-md-6"><?php echo $right_column_html; ?></div>
  </div>
  <hr class="mt0">
<?php } ?>