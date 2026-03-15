<?php

if ($filter_columns != '' && $table_data != '') : ?>
  <tbody>
    <?php if ( ! empty($table_data) && $table_data != '') : ?>

      <?php foreach ($table_data as $index => $value): ?>
        <?php 
          $class_outside='';
          if(isset($value['is_outside']) && $value['is_outside']=='Yes'){
            $class_outside='blue';
          }
        ?>
        <?php 
          if (@$value['reply_status']=='Pending') 
            $css_style = 'background-color:#E8F101; font-weight:bold';
        ?>
        <tr class='<?=$class_outside?>'>
          <?php if ($checkbox_option): ?>
            <td>
              <div class="col-md-2 demo-checkbox">
                <input name="<?= $table_name.'[]' ?>" id="<?= $value['id'] ?>" type="checkbox" value="<?= $value['id'] ?>" class="with-gap radio-col-blue">
                <label for="<?= $value['id'] ?>">
                </label>
              </div>
            </td>
          <?php endif; ?>
          <?php $i=0; 
          foreach ($tablehead as $key => $colum) {
           ?>
            <?php if ($key == 'action') { ?>
            <td class="action_btn text-nowrap">                    
              <?= getActions($value, $table_name, $url, $select_url, $filter_details); ?>
            </td>
            <?php } 
            elseif ($key == 'parameter') { ?>
                <td><?= getExplodeParameters(@$value[$key], $key); ?></td>
            <?php 
            }elseif(isset($colum[8]) && !empty($colum[8]) && $colum[8] == 'image' && $colum[8] != 1){
                $image_name = $value[$key];
                //$id = $value['id'];
            ?>
              <td><?= getImageData(@$value[$key],@$colum[9].$image_name, $colum[10]); ?></td>
            <?php 
            }elseif((isset($colum[9]) && !empty($colum[9]) && $colum[9] == 'daterange' && $colum[9] != 1)){
              if($value[$key] == "0000-00-00" || $value[$key] == ""){
                $date = '00/00/0000';
              }else{
                $date =  date("m/d/Y", strtotime($value[$key]));
              };?>
              <td><?php  if($date == '00/00/0000'){echo '';}else{echo $date;}?></td>
              <?php 
            }elseif((isset($colum[12]) && !empty($colum[12]))){ { ?>
              <td class="<?php if(isset($colum[12]) && isset($_GET['is_highlight']) && $_GET['is_highlight'] == $colum[12]) echo 'highlited_field';?>">
                <span><?=  getColumnData(@$value[$key], $key, @$value['id']); ?></span>
              </td>
            <?php } ?>
            <?php 
            }else { ?>
              <td class="<?php if(isset($colum[1]) && isset($_GET['is_highlight']) && $_GET['is_highlight'] == $colum[1]) echo 'highlited_field';?>">
                <span><?=  getColumnData(@$value[$key], $key, @$value['id']); ?></span>
              </td>
            <?php } ?>

              <?php $i++;
          } ?>
      
        </tr>
      <?php endforeach; ?>
      <?php $this->load->view('layouts/application/list/tbody_footer');?>
      <?php else: ?>
      <tr>
          <td colspan="12">No Record Found.</td>
      </tr>
    <?php endif; ?>
  </tbody>
<?php 
  else: ?>
  <tbody>
    <tr>
      <td colspan="12">Please Select At least One Column.</td>
    </tr>
  </tbody>
<?php 
endif; ?> 

