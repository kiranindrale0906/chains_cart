<h5 class="heading"><?php echo 'IN-OUT WEIGHTS'; ?></h5>
<div class="row">
  <!-- In weight section -->
  <div class="col-md-4">
    <?php foreach ($in_fields as $in_field) { 
      if($record[$in_field]!=0) { 
    ?>
      <div class="col-md-12">
        <label class="medium mr-4"><?=ucfirst(str_replace('_', ' ', $in_field))?>: </label>
        <span><?= $record[$in_field]?></span>
      </div>
    <?php } } ?>
  </div>
  <!-- Out weight section -->
  <div class="col-md-4">
    <?php //pd($out_fields); 
    foreach ($out_fields as $out_field) { 
      if($record[$out_field]!=0) { 
    ?>
      <div class="col-md-12">
        <label class="medium mr-4"><?=ucfirst(str_replace('_', ' ', $out_field))?>: </label>
        <span><?= $record[$out_field].' <a href="'.base_url().'processes/process_out_weights/edit/'.$record['id'].'">Edit</a>';?></span>
      </div>
    <?php }else{ 
	if($out_field=="out_weight"){
    ?>
      <div class="col-md-12">
        <label class="medium mr-4"><?=ucfirst(str_replace('_', ' ', $out_field))?>: </label>
        <span><?= $record[$out_field].' <a href="'.base_url().'processes/process_out_weights/edit/'.$record['id'].'">Edit</a>';?></span>
      </div>
    <?php } } }?>
  </div>
  <!-- Balance weight section -->
  <div class="col-md-4">
    <div class="col-md-12">
      <label class="medium mr-4">Balance: </label>
      <span><?= $record['balance']?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Balance Gross: </label>
      <span><?= $record['balance_gross']?></span>
    </div>
    <div class="col-md-12">
      <label class="medium mr-4">Balance Fine: </label>
      <span><?= $record['balance_fine']?></span>
    </div>
  </div>
</div>
<!--<?php 
  $left_column_html  = '';
  $right_column_html = '';
?>
<div class="row">
  <?php foreach ($columns as $i => $column) { 
    $html = '';
    ob_start();
  ?>
  <div class="col-md-12">
    <label class="medium mr-4"><?php echo strtoupper(str_replace('_', ' ', $column)); ?>: </label>
    <span>
      <?php if(! in_array($column, ['previous_process', 'next_processes', 'process_information'])) {
        echo $record[$column];
      } ?>
    </span>
  </div>
  <?php 
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
    } 
  } ?>
  <div class="col-md-6"><?php echo $left_column_html; ?></div>
  <div class="col-md-6"><?php echo $right_column_html; ?></div>
</div>-->
<hr class="mt0">
