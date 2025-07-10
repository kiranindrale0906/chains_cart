<?php 
  $total = array();
  if(isset($records)){
  foreach ($records as $melting_lot_id => $record) { 
    $process = @$record[$department_name];
    foreach ($department_columns as $index => $department_column) { 
        $field_name = $department_column[1];
        $display_total = @$department_column[3]; 
        
        if (isset($process[$field_name])):
          $value = $process[$field_name];/*'<input type="<?=$field_type?>" name="fname">';*/
          if ($display_total=='total'):
            if (!isset($total[$field_name])) $total[$field_name] = 0;  
            $total[$field_name] += $value;
          endif;  
        endif;  
    } 
  }
}
?>
  <div class="table-row table-footer">
    <?php 
    foreach ($department_columns as $index => $department_column) { 
      $class='';
      $field_type = $department_column[2];
      $field_total = $department_column[3];
      if ($field_type=='text_with_add_more'){
        $class='total_width';
      }
      ?>
       
      <div class='table-cell'>
      <?php if ($field_total=='total'){?>
        <span><?php $field_name = $department_column[1]; ?>
        <?=@number_format($total[$field_name],4)?></span>      
     <?php }
      ?>
      </div>
      
    <?php } ?>
  </div>