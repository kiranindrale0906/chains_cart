<?php 
$room=$model_name=$class_name='';
  if(($this->router->module=='processes' && $this->router->class=='processes') || ($this->router->module=='departments' && $this->router->class=='melting')){
    if(!empty($process['product_name'])){
      $model_name=get_product_controller_name_on_product_name($process['product_name'],$process['process_name']);
      $class_name=get_process_name($process['process_name']);
      $room='?room=1';
    }
  }else{
    $model_name=$this->router->module;
    $class_name=$this->router->class;
  } 
?>

<form method="POST" class="fields-group-sm"
      action="<?=ADMIN_PATH.$model_name.'/'.$class_name.'/update/'.@$process['id'].$room ?>">
<?php if (!empty($process)) { ?>
  <?php 
  $class_outside='';
  if($process['is_outside']=='Yes'){
    $class_outside='blue';
  }

  // echo $class_outside;
  ?>    
  <div class="table-row <?=$class_outside?>">

    <?php load_field('hidden', array('field' => 'updated_at', 'name' => 'updated_at', 
                                     'class' => 'updated_at_'.$process['id'],
                                     'value' => strtotime($process['updated_at']), 'layout' => 'application')); ?>
    <?php load_field('hidden', array('field' => 'id', 'value' => $process['id'], 
                                     'layout' => 'application')); ?>
    <?php load_field('hidden', array('field' => 'product_name', 'value' => $process['product_name'], 
                                     'layout' => 'application')); ?>
    <?php load_field('hidden', array('field' => 'process_name', 'value' => $process['process_name'], 
                                     'layout' => 'application')); ?>
    <?php load_field('hidden', array('field' => 'department_name', 'value' => $process['department_name'],'layout' => 'application')); ?>
  
    <?php 
      foreach ($department_columns as $index => $department_column) { 


        $field_name = $department_column[1];
        $field_name_array[] = $department_column[1]; 
        
        if ($field_name == 'karigar' and !empty($process['karigar']) and $process['status']!='Pending') 
          $field_type = 'label_with_value';
        else
          $field_type = $department_column[2];

        
        $options = @$department_column[4];
        if ($field_type == 'text_with_add_more') {
          if (isset($department_column[5]) && !empty($department_column[5])) {
            $process_details_fields = $department_column[5];
          } else {
            $process_details_fields = array(array('label' => strtoupper($field_name), 
                                                  'field_type' => 'text', 'database_column' => $field_name));                                    
          }
        }
           
        if (isset($process[$field_name])):
          $value = $process[$field_name];
        else:
          $value = '';
        endif; ?>
        <?php
          if ($field_name !='action') { ?>
            <div class='table-cell <?= $field_name.'_'.$process['id'] ?>'>
              <?php if($field_name == 'bar_code'){
          
               
                load_buttons('anchor',array('name'=>'Print',
                                        'layout' => 'application',
                                        'class'=>'btn-xs bold blue float-left bar_code_genrate ajax',
                                        'href'=>base_url().'bar_codes'.'/'
                                              .'bar_codes?barcode_code='.$process['id']
                                              .'&product_name='.$process["product_name"]
                                              .'&process_name='.$process["process_name"]
                                              .'&lot_no='.$process['lot_no']
                                              .'&lot_purity='.$process['in_lot_purity']
                                              .'&design_code='.$process['design_code']));
                
                load_buttons('anchor',array('name'=>'Scan',
                                        'layout' => 'application',
                                        'class'=>'btn-xs bold blue float-left ',
                                        'onclick'=>'scan_bar_code('.$process["id"].')',
                                        'href'=>'javascript:void(1)'));

              }?>
              <?php if ($field_type=='text' && !empty($process) && @$process['status']=='Pending') {
                if($field_name == 'tounch_in'){
                 $class="tounch_add_".$process['id'];
                 $input_class="input_with_add tounch_in";
                }
                else {
                  $class="";
                  $input_class="input_with_add ";
                }
                ?>
                <?php load_field('plain/text', array('field' => $field_name,
                                                      'class'=>$input_class,
                                                      'id'=>$process['id'],
                                                     'value' => ($value==0) ? '' : four_decimal($value), 
                                                     'layout' => 'table')); 
                ?>
              <?php } else if ($field_type=='text_with_add_more' && !empty($process) && $process['status']=='Pending'){?>
                <?php 
                if($field_name == 'tounch_in'){
                     $class="tounch_add_".$process['id'];
                     $input_class="tounch_in";
                    }
                else {
                  $class="";
                  $input_class="";
                }
                if(is_numeric($value)){
                  load_field('plain/text', array('field' => $field_name, 
                                                     'value' => ($value==0) ? '' : four_decimal($value), 
                                                     'class' => 'input_with_add '.$field_name.'_'.$process['id'].' '.$input_class, 
                                                      'id'=>$process['id'],
                                                     'layout' => 'table',
                                                     'readonly'=>'readonly'));
                }else{
                  load_field('plain/text', array('field' => $field_name, 
                                                     'value' =>$value, 
                                                     'class' => 'input_with_add '.$field_name.'_'.$process['id'].' '.$input_class, 
                                                      'id'=>$process['id'],
                                                     'layout' => 'table',
                                                     'readonly'=>'readonly'));
                }
                 ?>
                <span class="float-right pl-1">
                  <?php
                    if(!empty($process['job_card_no']) && $field_name=="job_card_no"){

                    }else{
                    load_buttons('anchor', array('name'=>'Add',
                                                 'class'=>'add-btn underline blue ajax',
                                                 'data-toggle'=>'modal',
                                                 'modal-size'=>'lg',
                                                 'data-title'=>"Add ".$field_name."",
                                                 'layout' => 'application',
                                                 'href'=>base_url().'processes/process_fields/create/'.$process['id'].'?field_name='.$field_name.'&&product_name='.$process['product_name'].'&&process_name='.$process['process_name'].'&&department_name='.$process['department_name'].'&&process_details_fields='.json_encode(@$process_details_fields)));
                 }                            
                  ?> 
                </span>

                
              <?php } else if ($field_type=='text_with_add_more_with_process_factory_order_detail'){
                if($field_name == 'tounch_in'){
                 $class="tounch_add_".$process['id'];
                 $input_class="tounch_in";
                }
                else {
                  $class="";
                  $input_class="";
                }
              
              load_field('plain/text', array('field' => $field_name, 
                                                     'value' => ($value==0) ? '' : four_decimal($value), 
                                                     'class' => 'input_with_add '.$field_name.'_'.$process['id'].' '.$input_class, 
                                                      'id'=>$process['id'],
                                                     'layout' => 'table',
                                                     'readonly'=>'readonly')); ?>
                <span class="float-right pl-1">
                 <?php 
                  if(!empty($process['job_card_no']) && $field_name=="job_card_no"){

                  }else{
                  load_buttons('anchor', array('name'=>'Add',
                                                 'class'=>'btn-xs p-0 underline blue ajax',
                                                 'data-toggle'=>'modal',
                                                 'modal-size'=>'lg',
                                                 'data-title'=>"Add ".$field_name."",
                                                 'layout' => 'application',
                                                 'href'=>base_url().'processes/process_fields/create/'.$process['id'].'?field_name='.$field_name.'&&product_name='.$process['product_name'].'&&process_name='.$process['process_name'].'&&department_name='.$process['department_name'].'&&process_details_fields='.json_encode(@$process_details_fields).'&&process_factory_order_detail=1'));
                }
                  ?>
                </span>
                

              <?php }else if ($field_type=='label_with_value' && !empty($process) 
                               && ($field_name=='in_lot_purity' || $field_name=='out_lot_purity'
                                   || $field_name=='in_purity' || $field_name=='out_purity')){
              ?>
                <?php load_field('plain/only_value', array('field' => $field_name, 
                                                           'value' => four_decimal($value),
                                                           'layout' => 'table',
                                                           'readonly'=>'readonly')); ?>

              <?php } else if ($field_type=='label_with_value' && !empty($process) 
                               && ($field_name=='karigar')){
			
              ?><b>
                <?php load_field('plain/only_value', array('field' => $field_name, 
                                                           'value' => $value,
                                                           'layout' => 'table',
                                                           'readonly'=>'readonly')); ?>
            </b><?php }else if ($field_type=='label_with_value' && !empty($process) 
                               && ($field_name=='machine_size')){
              ?>
                <?php load_field('plain/only_value', array('field' => $field_name, 
                                                           'value' => trim($value),
                                                           'layout' => 'table',
                                                           'readonly'=>'readonly')); ?>
            <?php } else if ($field_type=='label_with_value' && !empty($process) 
                               && ($field_name=='description')){
              ?>
                <?php load_field('plain/only_value', array('field' => $field_name, 
                                                           'value' => trim($value),
                                                           'layout' => 'table',
                                                           'readonly'=>'readonly',
                                                           'col' => '')); ?>
                                                           

              <?php } else if ($field_type=='label_with_text' && !empty($process)){

                if($field_name == 'parent_lot_name' || $field_name == 'design_code'){?><b><?php }?>
                <?php  load_field('plain/only_value', array('field' => $field_name, 
                                                           'value' => $value,
                                                           'layout' => 'table',
                                                           'readonly'=>'readonly',
                                                           'col' => '')); 
                if($field_name == 'parent_lot_name' || $field_name == 'design_code'){?></b><?php }?>

              <?php } else if (   $field_name=='machine_no' 
                               && !(empty($process['machine_no']))) { ?>
                <?php load_field('plain/only_value', array('field' => $field_name, 
                                                           'value' => $value,
                                                           'layout' => 'table',
                                                           'readonly'=>'readonly',
                                                           'col' => '')); ?>
              <?php } else if (   $field_name=='remark' 
                               && !(empty($process['remark']))) { ?>
                <?php load_field('plain/only_value', array('field' => $field_name, 
                                                           'value' => $value,
                                                           'layout' => 'table',
                                                           'readonly'=>'readonly',
                                                           'col' => '')); ?>
              <?php } else if (   $field_name=='worker' 
                               && !(empty($process['worker']))) { ?>
                <?php load_field('plain/only_value', array('field' => $field_name, 
                                                           'value' => $value,
                                                           'layout' => 'table',
                                                           'readonly'=>'readonly',
                                                           'col' => '')); ?>
              <?php } else if ($field_type=='dynamic_dropdown' && !empty($process) && @$process['status']=='Pending'){ ?>
                <?php load_field('plain/dynamic_dropdown', array('field' => $field_name, 
                                                       'process' => @$process,
                                                       'layout' => 'table')); ?>                                  
              <?php } else if ($field_type=='dropdown' && !empty($process) && @$process['status']=='Pending'){ ?>
                <?php load_field('plain/dropdown', array('field' => $field_name,
                                                         'value' => @$process[$field_name],
                                                         'layout' => 'table',
                                                         'option' => $options)); ?>
              <?php } else if ($field_type=='karigar_dropdown' 
                               && !empty($process) 
                               && @$process['status']=='Pending'){ ?>
                <?php load_field('plain/dropdown', array('field' => $field_name,
                                                         'layout' => 'table',
                                                         'value' => $value,
                                                         'option' => chain_wise_karigar_name($process))); ?>
              <?php } else if ($field_name=='created_at') { ?>
                <label id="<?=$field_name?>"><?= $value ?></label>
              <?php } else if ($field_name=='created_by' || $field_name=='updated_by') { ?>
                <label id="<?=$field_name?>"><?= isset($users[$value]) ? $users[$value]['name'] : '' ?></label>
                <?php if ($field_name=='updated_by' && HOST=='ARF') { ?>
                  <input type="checkbox" name='temporary_check' />
                <?php } ?>
              <?php } else if ($field_name=='strip_cutting_process_id') { ?>
                <label id="<?=$field_name?>"><?= ($value > 0) ? 'Yes' : '' ?></label>  
              <?php } else if ($field_name=='id') { ?>
                <label id="<?=$field_name?>"><?= @$sr_no ?></label>  
              <?php } else if ($field_name=='is_outside' && $field_type=='redio_button') { ?>
                <label id="<?=$field_name?>">
                  <?php 
                  if(!empty($process['id'])) {
                   if($process['is_outside']=='No'){
                       load_buttons('anchor', array('name'=>'Yes',
                                               'class'=>'btn-xs blue process_outside',
                                               'data-title'=>"View",
                                               'data-id'=>$process['id'],
                                               'layout' => 'application',
                                               'href'=>'javascript:void(0)')); 
                      }else{
                       load_buttons('anchor', array('name'=>'No',
                                               'class'=>'btn-xs blue process_outside',
                                               'data-title'=>"View",
                                               'data-id'=>$process['id'],
                                               'layout' => 'application',
                                               'href'=>'javascript:void(0)')); 
                      }
                  }
                  ?>
                </label>  
              <?php } elseif ($field_name=='tounch_no') { ?>
                <label id="<?=$field_name?>"><?= ($value !=0) ? round($value) : '-' ?></label>
              <?php } elseif ($field_type=='dropdown') { ?>
                <label id="<?=$field_name?>"><?= $value ?></label>
              <?php } else { ?>
                <label id="<?=$field_name?>"><?= ($value !=0) ? four_decimal($value) : '-' ?></label>
              <?php /*if($field_name == 'hook_in' || $field_name == 'hook_out') echo "</a>";*/} 
                if ($field_name=='in_weight') {
                  if(!empty($process['id'])){  
                    load_buttons('anchor', array('name'=>'View',
                                                'target' =>'_blank',
                                                 'class'=>'btn-xs blue',
                                                 'data-title'=>"View",
                                                 'layout' => 'application',
                                                 'href'=>base_url().'processes/processes/view/'.$process['id'])); 
                  }
                }
                else if($field_name=='account'){
                  if(!empty($process['account']) && $process['product_name']!="Arc Casting Process"){

                    // && ($process['process_name']=="Melting" || $process['process_name']=="Casting")

                    $url = base_url().'arc_orders/order_melting_lot_reject_quantities/index/'.str_replace('/', '_', $process['account']);

                    load_buttons('anchor', array('name'=>'View',
                                                'target' =>'_blank',
                                                 'class'=>'btn-xs blue',
                                                 'data-title'=>"View",
                                                 'layout' => 'application', 
                                                 'href'=> $url));
                  }
                }
              ?> 
            </div>
          <?php } else { 

        ?>
        <div class="table-cell action_div" style="width:120px;">
          <?php 
          
          if ($process['status'] == 'Pending') { 
           
            ?>
            <button class="btn btn-xs btn_green ajax_post" type="submit">Save</button> 
      
            <?php 
            if ($this->router->class != 'processes' && $this->router->class != 'melting' ) { 
          
              $url = ADMIN_PATH.$this->router->module.'/'.$this->router->class.'/delete/'.$process['id'];
              echo getAjaxPost('Delete', $url, array(), $class='btn btn-xs btn_red close_btn'); 
              if(in_array('hook_in',$field_name_array) || in_array('hook_in',$field_name_array)){
            

                echo "<a target='_blank' class='blue float-right' href='".base_url('daily_drawer_issue_departments/daily_drawer_issue_departments/create?karigar='.(!empty($process['karigar'])?$process['karigar']:'').'&chain_name='.(!empty($process['product_name'])?$process['product_name']:''))."'>Receive DD</a>"; 
                }
              }

            ?>


          <?php } 
          if ($process['product_name'] == 'Office Outside' && $process['department_name'] == 'Stamping'){
                echo "<a target='_blank' class='orange float-right' href='".base_url('daily_drawers/daily_drawer_issue_departments/create?type='.$process['process_name'])."'>Issue DD</a>";        
                }    
              
          $class="tounch_add_".$process['id'];

          
            load_buttons('anchor',array('name'=>'Print',
                                'layout' => 'application',
                                'class'=>'btn-xs hide_all bold blue float-left bar_code_genrate ajax '.$class,
                                'style'=>'display:none',
                                'href'=>base_url().'bar_codes'.'/'
                                      .'bar_codes?barcode_code=T'.$process['id']
                                      .'&product_name='.$process["product_name"]
                                      .'&process_name='.$process["process_name"]
                                      .'&lot_no='.$process['lot_no']
                                      .'&lot_purity='.$process['in_lot_purity']
                                      .'&design_code='.$process['design_code']));

            load_buttons('anchor',array('name'=>'Scan',
                                'layout' => 'application',
                                'class'=>'btn-xs bold blue float-left hide_all '.$class,
                                'href'=>base_url().'bar_codes/bar_codes/view/1?barcode_value='.$process['id']));
            

            
             
          ?>
            <span class="float-right pl-1">

              <?php
                if (   $process['archive'] == 0 
                    && $process['balance'] == 0  
                    && $process['status'] == 'Complete') {  
                   // && ($process['department_name'] == @$last_department_name)|| in_array($process['department_name'], array('GPC','GPC Or Rodium')) || HOST == 'ARF' 

                  load_buttons('anchor', array('name'=>'Hide Row',
                                               'class'=>'save-delete-btn blue process_archive',
                                               'data-title'=>"View",
                                               'data-id'=>$process['id'],
                                               'layout' => 'application',
                                               'href'=>'javascript:void(0)')); 
                
                }
              ?> 
            </span>
        </div>
        <?php }
      } 
    ?>
  </div>
<?php } else { ?>
<div class="table-row <?=@$class_outside?>">
  <span class="float-right pl-1">
  </span>
</div>
<?php } ?>

</form>