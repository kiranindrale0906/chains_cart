<h5 class="heading"><?php echo 'LINKS'; ?></h5>
<div class="row">
  <div class="col-md-12">
    <div class="col-md-12">
      <label class="medium mr-4">Previous Process: </label>
    </div>
    <?php if(!empty($prev_process_details)) { ?>
      <div class="col-md-12">
        <table class="table table-sm">
          <thead class="bg_gray">
            <tr>
              <th>PROCESS NAME</th>
              <th>DEPARTMENT NAME</th>
              <th class="text-right">OUT-WEIGHT</th>
              <th class="text-right">FACTORY-OUT</th>
              <th class="text-right">CUSTOMER-OUT</th>
              <th class="text-right">RECUTTING-OUT</th>
              <th class="text-right">GPC-OUT</th>
              <th class="text-right">OUT PURITY</th>
              <th class="text-right">OUT LOT PURITY</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php $process_detail_out_weight = (isset($prev_process_out_weight_details['out_weight'])) ? $prev_process_out_weight_details['out_weight'] : 0?>
              <td><?= $prev_process_details['process_name']?></td>
              <td><?= $prev_process_details['department_name']?></td>
              <td class="text-right"><?= ($process_detail_id['parent_process_detail_id']==0) ? $prev_process_details['out_weight'] : $process_detail_out_weight ?></td>
              <td class="text-right"><?= $prev_process_details['factory_out']?></td>
              <td class="text-right"><?= $prev_process_details['customer_out']?></td>
              <td class="text-right"><?= $prev_process_details['recutting_out']?></td>
              <td class="text-right"><?= $prev_process_details['gpc_out']?></td>
              <td class="text-right"><?= $prev_process_details['out_purity']?></td>
              <td class="text-right"><?= $prev_process_details['out_lot_purity']?></td>
              <td><?= '<a href="'.base_url().'processes/processes/view/'.$prev_process_details['id'].'">VIEW</a>'?></td>
            </tr>
          </tbody>
        </table>
      </div>
    <?php } ?>
    <?php 
    if(!empty($indo_in_weights)||!empty($process_group_in_weights)) { 
      
      ?>
      <table class="table table-sm">
        <thead class="bg_gray">
          <tr>
            <th class="text-right">Out Weight</th>
            <th class="text-right">Process Out Weight</th>
            <th class="text-right">Out Purity</th>
            <th class="text-right">Out Lot Purity</th>
            <th>Lot No.</th>
            <th>Created At</th>
            <th>Process</th>
          </tr>
        </thead>
        <tbody>
          <?php $total_out_weight =$total_process_out_weight= 0;
          if(!empty($indo_in_weights)) {
            foreach($indo_in_weights as $key => $value) { 
              $total_out_weight += $value['out_weight'];
              $total_process_out_weight += $value['process_out_weight'];
              if(empty($process_group_in_weights)){
          ?>
            <tr>
              <td class="text-right"><?= $value['out_weight']?></td>
              <td class="text-right"><?= $value['process_out_weight']?></td>
              <td class="text-right"><?= $value['out_purity']?></td>
              <td class="text-right"><?= $value['out_lot_purity']?></td>
              <td><?= $value['lot_no']?></td>
              <td><?= date("d-m-Y H:i:s",strtotime($value['created_at']))?></td>
              <td><a href="<?= ADMIN_PATH.'processes/processes/view/'.$value['id']?>">View</a></td>
            </tr>
          <?php } } }?>
          <?php if(!empty($process_group_in_weights)) {
            foreach($process_group_in_weights as $key => $value) { 
              $total_out_weight += $value['out_weight'];
              $total_process_out_weight += $value['process_out_weight'];
          ?>
            <tr>
              <td class="text-right"><?= $value['out_weight']?></td>
              <td class="text-right"><?= $value['process_out_weight']?></td>
              <td class="text-right"><?= $value['out_purity']?></td>
              <td class="text-right"><?= $value['out_lot_purity']?></td>
              <td><?= $value['lot_no']?></td>
              <td><?= date("d-m-Y H:i:s",strtotime($value['process_created']))?></td>
              <td><a href="<?= ADMIN_PATH.'processes/processes/view/'.$value['process_id']?>">View</a></td>
            </tr>
          <?php } } ?>
        </tbody>
        <tfoot class="bg_light_gray bold">
          <tr>
            <td class="text-right"><?= four_decimal($total_out_weight)?></td>
            <td class="text-right"><?= four_decimal($total_process_out_weight)?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tfoot>
      </table>
    <?php } ?>
    <?php if(!empty($process_out_wastage_in_weights)) { ?>
      <table class="table table-sm">
        <thead class="bg_gray">
          <tr>
            <th class="text-right">Out Weight</th>
            <th class="text-right">Process Out Weight</th>
            <th class="text-right">Wastage Purity</th>
            <th class="text-right">Wastage Lot Purity</th>
            <th>Field Name</th>
            <th>Lot No.</th>
            <th>Created At</th>
            <th>Process</th>
          </tr>
        </thead>
        <tbody>
          <?php $total_out_weight =$total_process_out_weight = $total_wastage_purity = $total_wastage_lot_purity = $count = 0;
          foreach($process_out_wastage_in_weights as $key => $value) { 
            $total_out_weight += $value['out_weight'];
            $total_process_out_weight += $value['process_out_weight'];
            $total_wastage_purity += $value['wastage_purity'];
            $total_wastage_lot_purity += $value['wastage_lot_purity'];
          ?>
            <tr>
              <td class="text-right"><?= $value['out_weight']?></td>
              <td class="text-right"><?= $value['process_out_weight']?></td>
              <td class="text-right"><?= $value['wastage_purity']?></td>
              <td class="text-right"><?= $value['wastage_lot_purity']?></td>
              <td><?= $value['field_name']?></td>
              <td><?= $value['lot_no']?></td>
              <td><?= date("d-m-Y H:i:s",strtotime($value['created_at']))?></td>
              <td><a href="<?= ADMIN_PATH.'processes/processes/view/'.$value['process_id']?>">View</a></td>
            </tr>
          <?php $count++;} ?>
        </tbody>
        <tfoot class="bg_light_gray bold">
          <tr>
            <td class="text-right"><?= four_decimal($total_out_weight)?></td>
            <td class="text-right"><?= four_decimal($total_process_out_weight)?></td>
            <td class="text-right"><?= four_decimal($total_wastage_purity/$count)?></td>
            <td class="text-right"><?= four_decimal($total_wastage_lot_purity/$count)?></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tfoot>
      </table>
    <?php } ?>
  </div>
  <div class="col-md-12">
    <div class="col-md-12">
      <label class="medium mr-4">Next Process: </label>
    </div>
    <?php if(!empty($next_process_details)) { ?>
      <div class="col-md-12">
        <table class="table table-sm">
          <thead class="bg_gray">
            <tr>
              <th>PROCESS NAME</th>
              <th>DEPARTMENT NAME</th>
              <th class="text-right">IN-WEIGHT</th>
              <th class="text-right">IN PURITY</th>
              <th class="text-right">IN LOT PURITY</th>
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody>
            <?php $total_in_weight_next_process = 0;
            foreach($next_process_details as $key => $value) { 
              $total_in_weight_next_process += $value['in_weight'];
            ?>
              <tr>
                <td><?= $value['process_name']?></td>
                <td><?= $value['department_name']?></td>
                <td class="text-right"><?= $value['in_weight']?></td>
                <td class="text-right"><?= $value['in_purity']?></td>
                <td class="text-right"><?= $value['in_lot_purity']?></td>
                <td><?= '<a href="'.base_url().'processes/processes/view/'.$value['id'].'">VIEW</a>'?></td>
              </tr>
            <?php } ?>
          </tbody>
          <tfoot class="bg_light_gray bold">
            <tr>
              <td></td>
              <td></td>
              <td class="text-right"><?= four_decimal($total_in_weight_next_process)?></td>              
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tfoot>
        </table>
      </div>
    <?php } ?>
  </div>
</div>
<hr class="mt0">
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
</div>-->
