<?php  
  if(!empty($sum)){

    ?>  
    <tr class='bg_gray'>
      <?php
      $sub_total_sum = 0;
      $head_set = 0;
      foreach ($tablehead as $head_key => $head_value) {
        if(isset($head_value[11]) AND $head_value[11] == 'sum'){
          if(count($sum) > 1){
            $add[$head_key] = 0;
            foreach($sum as $sum_values){
              $add[$head_key] += $sum_values[$head_key];
            }

            $sum[0][$head_key] = $add[$head_key];
          }
          
          foreach ($sum[0] as $sum_key => $sum_value)
            if($head_key == $sum_key)
              if($this->router->class=='ka_chain_factory_pending_orders'){
                echo '<td><b><span>'.($sum_value).'</span></b></td>';
              }else{
                echo '<td><b><span>'.four_decimal($sum_value).'</span></b></td>';
              }
        }else{
          echo '<td><span></span></td>'; $head_set++;
        }
        $sub_total_sum = 0;
      }
      ?>
    </tr>
 
 <?php }?> 


