<!-- <?php ?> -->
<div class="table-responsive">
  <table class="table table-sm table_blue process_fields" id="tblAddRow">
    <thead>
      <tr>
        <th>Date</th>
        <?php
        if(!empty($process_fields_form_fields)){
          foreach ($process_fields_form_fields as $index => $process_fields_form_field) { ?>
            <th><?= $process_fields_form_field['label'] ?></th>
            <?php 
           /* if($record['product_name'] == 'Arc Casting Process' && $record['process_name'] == "Casting" && $record['department_name'] == 'Casting'){
              if(strtolower($process_fields_form_field['label']) == 'generate lots'){
                echo '<th>Category</th>';
                echo '<th>Next Process</th>';
              }
            }*/   
          }
        }
        ?>
        <?php 
          if (   ($record['product_name'] == 'Fancy Chain'        && $record['process_name'] == 'Chain Making Process'  && $record['field_name'] == 'out_weight') 
              || ($record['product_name'] == 'Fancy Chain'        && $record['process_name'] == 'Chain Making Process'  && $record['field_name'] == 'customer_out') 
              || ($record['product_name'] == 'Fancy Chain'        && $record['process_name'] == 'Chain Making Process'  && $record['field_name'] == 'bounch_out') 
              || ($record['product_name'] == 'Ball Chain'        && $record['process_name'] == 'Hook Plain Process'&& $record['department_name'] == 'Hook'  && $record['field_name'] == 'customer_out') 
              /*|| ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Chain Making'  && $record['field_name'] == 'recutting_out')*/ 
                  
              || ($record['product_name'] == 'Hollow Choco Chain' && $record['process_name'] == 'Spring Process'        && $record['field_name'] == 'out_weight')
              || ($record['product_name'] == 'Indo tally Chain'   && $record['process_name'] == 'Spring Process'        && $record['field_name'] == 'out_weight')
              || ($record['product_name'] == 'Sisma Chain'        && $record['process_name'] == 'Sisma Machine Process' && $record['field_name'] == 'out_weight')
              || ($record['product_name'] == 'Sisma Chain'        && $record['process_name'] == 'RND Process'           && (   $record['department_name'] == 'Hand Cutting' || $record['department_name'] == 'Hand Dull'|| $record['department_name'] == 'Buffing'                                  || $record['department_name'] == 'Filing'))
              || ($record['product_name'] == 'ARC'                && $record['process_name'] == 'Final Process'         && $record['department_name'] == 'Magnet Loss')
              || ($record['product_name'] == 'KA Chain'           && $record['process_name'] == 'Factory Process'       && $record['department_name'] == 'Factory')
              || ($record['product_name'] == 'KA Chain'           && $record['process_name'] == 'Hook Process'       && $record['department_name'] == 'Hook')
              || ($record['product_name'] == 'KA Chain'           && $record['process_name'] == 'Factory Hold Process'  && $record['department_name'] == 'Factory Hold')
              || ($record['product_name'] == 'KA Chain'           && $record['process_name'] == 'Start Process'         && $record['department_name'] == 'Tarpatta')
              || ($record['product_name'] == 'KA Chain'           && $record['process_name'] == 'Dhoom Process'         && $record['department_name'] == 'Chain Making')
              || ($record['product_name'] == 'Ball Chain'         && $record['process_name'] == 'Factory Hold I Process' && $record['department_name'] == 'Factory Hold I')
              || ($record['product_name'] == 'Ball Chain'         && $record['process_name'] == 'Factory Hold Plain Process' && $record['department_name'] == 'Factory Hold Plain')

              ||($record['product_name'] == 'Ball Chain'          && $record['process_name'] == 'Factory Hold Two Tone Process' && $record['department_name'] == 'Factory Hold Two Tone')

              || ($record['product_name'] == 'Refresh'            && $record['process_name'] == 'Refresh Hold'          && $record['department_name'] == 'Refresh Hold')
              || ($record['product_name'] == 'Rope Chain'         && $record['department_name'] == 'Hook'               && $record['field_name'] == 'out_weight')
              || ($record['product_name'] == 'Choco Chain'        && $record['department_name'] == 'Chain Making'       && $record['field_name'] == 'out_weight')
              || ($record['product_name'] == 'Imp Italy Chain'        && $record['department_name'] == 'Buffing'       && $record['field_name'] == 'factory_out')
              || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Fancy Hold'       && $record['field_name'] == 'out_weight')
              || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Fancy Hold'       && $record['field_name'] == 'recutting_out')
              || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Fancy Hold'       && $record['field_name'] == 'bounch_out')
              || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Fancy Hold'       && $record['field_name'] == 'hook_in')
              || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Fancy Hold'       && $record['field_name'] == 'hook_out')
              || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Chain Making'       && $record['field_name'] == 'recutting_out')
              || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Chain Making'       && $record['field_name'] == 'bounch_out')
              || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Chain Making'       && $record['field_name'] == 'hook_in')
              || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Chain Making'       && $record['field_name'] == 'hook_out')
            || ($record['product_name'] == 'Fancy 75 Chain'        && $record['department_name'] == 'Chain Making'       && $record['field_name'] == 'bounch_out')
            ) {
          } else { ?>
            <th>Action</th>  
          <?php   
          }
        ?>
      </tr>
    </thead>
    <tbody>
      <?php 
        // print_r($record);
        foreach ($process_fields as $index => $process_field) { ?>
          <tr class="process_<?= $process_field['id'] ?>">
            <td>
              <?= $process_field['created_at']?>
            </td>
            <?php
            if(!empty($process_fields_form_fields)){
              foreach ($process_fields_form_fields as $index => $process_fields_form_field) { ?>
                <td  width="25%">
                  <?php 
                    if ($process_fields_form_field['database_column'] == 'order_detail_id') { 
                      // print_r($all_order_details);
                      if(!empty($all_order_details))
                      foreach($all_order_details as $order_detail) {
                        if ($order_detail['id'] == $process_field[$process_fields_form_field['database_column']]){
                          $lot_no = $order_detail['name'];
                          
                        }
                      }
                      echo ($lot_no) ?? '';
                    } else
                      echo @$process_field[$process_fields_form_field['database_column']]; 
                    
                  ?>
                </td>
                <?php if($record['product_name'] == 'Arc Casting Process' && $record['process_name'] == "Casting" && $record['department_name'] == 'Casting' && strtolower($process_fields_form_field['label']) == 'generate lots') {
                           // echo "<td width='25%'>".$order_detail['category_one']."</td>";
                           // echo "<td width='25%'>".$order_detail['next_process']."</td>";
                } ?>
                
                
              <?php  
              }
               
            } 
            ?>
            <?php 
              if (   ($record['product_name'] == 'Fancy Chain'        && $record['process_name'] == 'Chain Making Process'  && $record['field_name'] == 'out_weight') 
                  || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Fancy Hold'  && $record['field_name'] == 'out_weight') 
                  || ($record['product_name'] == 'Ball Chain'        && $record['process_name'] == 'Hook Plain Process'&& $record['department_name'] == 'Hook'  && $record['field_name'] == 'customer_out') 
              
                  /*|| ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Chain Making'  && $record['field_name'] == 'recutting_out') */
                  || ($record['product_name'] == 'Fancy Chain'        && $record['process_name'] == 'Chain Making Process'  && $record['field_name'] == 'customer_out') 
                  || ($record['product_name'] == 'Fancy Chain'        && $record['process_name'] == 'Chain Making Process'  && $record['field_name'] == 'bounch_out') 
                  || ($record['product_name'] == 'Hollow Choco Chain' && $record['process_name'] == 'Spring Process'        && $record['field_name'] == 'out_weight')
                  || ($record['product_name'] == 'Indo tally Chain'   && $record['process_name'] == 'Spring Process'        && $record['field_name'] == 'out_weight')
                  || ($record['product_name'] == 'Sisma Chain'        && $record['process_name'] == 'Sisma Machine Process' && ($record['field_name'] == 'out_weight'))
                  || ($record['product_name'] == 'Sisma Chain'        && $record['process_name'] == 'RND Process'           && (   $record['department_name'] == 'Hand Cutting'  || $record['department_name'] == 'Hand Dull' || $record['department_name'] == 'Buffing'                              || $record['department_name'] == 'Filing'))
                  || ($record['product_name'] == 'ARC'                && $record['process_name'] == 'Final Process'         && $record['department_name'] == 'Magnet Loss')
                  || ($record['product_name'] == 'KA Chain'           && $record['process_name'] == 'Factory Process'       && $record['department_name'] == 'Factory')
                  || ($record['product_name'] == 'KA Chain'           && $record['process_name'] == 'Hook Process'       && $record['department_name'] == 'Hook')
                  || ($record['product_name'] == 'KA Chain'           && $record['process_name'] == 'Factory Hold Process'  && $record['department_name'] == 'Factory Hold')
                  || ($record['product_name'] == 'KA Chain'           && $record['process_name'] == 'Start Process'         && $record['department_name'] == 'Tarpatta')
                  || ($record['product_name'] == 'KA Chain'           && $record['process_name'] == 'Dhoom Process'         && $record['department_name'] == 'Chain Making')
                  || ($record['product_name'] == 'Ball Chain'         && $record['process_name'] == 'Factory Hold I Process' && $record['department_name'] == 'Factory Hold I')
                  || ($record['product_name'] == 'Ball Chain'         && $record['process_name'] == 'Factory Hold Plain Process' && $record['department_name'] == 'Factory Hold Plain')
                  || ($record['product_name'] == 'Ball Chain'         && $record['process_name'] == 'Factory Hold Two Tone Process' && $record['department_name'] == 'Factory Hold Two Tone')
                  || ($record['product_name'] == 'Imp Italy Chain'        && $record['department_name'] == 'Buffing'       && $record['field_name'] == 'factory_out')
              
                  || ($record['product_name'] == 'KA Chain'        && $record['department_name'] == 'Stripping'       && $record['field_name'] == 'out_weight')
              
                  || ($record['product_name'] == 'KA Chain'        && $record['department_name'] == 'Copper'       && $record['field_name'] == 'out_weight')
              
                  || ($record['product_name'] == 'Refresh'            && $record['process_name'] == 'Refresh Hold'          && $record['department_name'] == 'Refresh Hold')
                  || ($record['split_out_weight'] == 1                && $record['field_name'] == 'out_weight')|| ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Fancy Hold'       && $record['field_name'] == 'recutting_out')
                  || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Fancy Hold'       && $record['field_name'] == 'bounch_out')
                  || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Fancy Hold'       && $record['field_name'] == 'hook_in')
                  || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Fancy Hold'       && $record['field_name'] == 'hook_out')
                  || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Chain Making'       && $record['field_name'] == 'recutting_out')
                  || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Chain Making'       && $record['field_name'] == 'bounch_out')
                  || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Chain Making'       && $record['field_name'] == 'hook_in')
                  || ($record['product_name'] == 'Fancy Chain'        && $record['department_name'] == 'Chain Making'       && $record['field_name'] == 'hook_out')
                  || ($record['product_name'] == 'Fancy 75 Chain'        && $record['department_name'] == 'Chain Making'       && $record['field_name'] == 'bounch_out')
            
                ) {
              } else { ?>
                <td>
                  <?php load_buttons('anchor',array('name' => 'Delete',
                                                    'class' => 'btn btn-sm text-warning ajax',
                                                    'href' => ADMIN_PATH.'processes/process_fields/delete/'.$process_field['id'].'?field_name='.$record['field_name'].'&process_id='.$process_field['process_id']));?>
                </td>   
              <?php   
              }
            ?>
          </tr>
        <?php
        }
      ?>
    </tbody>
  </table>
</div>


