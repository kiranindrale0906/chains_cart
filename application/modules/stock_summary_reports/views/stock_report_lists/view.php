
      <?php
        $total_gross = 0;
        $total_fine = 0;
        $count = 0;
        if(!empty($process_data)){
          foreach ($process_data as $index => $process_data) {
            $total_gross += $process_data['balance_gross'];
            $total_fine += $process_data['balance_fine'];
            $process_name = isset($process_data['process_name'])?$process_data['process_name']:'-';
            $lot_no = isset($process_data['lot_no'])?$process_data['lot_no']:'-';
            $parent_lot_name = isset($process_data['parent_lot_name'])?$process_data['parent_lot_name']:'-';
            $design_code = isset($process_data['melting_lot_category_four'])?$process_data['melting_lot_category_four']:'-';
            $department_name = isset($process_data['department_name'])?$process_data['department_name']:'-';
            $out_lot_purity = isset($process_data['out_lot_purity'])?$process_data['out_lot_purity']:'-';
            $karigar = isset($process_data['karigar'])?$process_data['karigar']:'-';
            $process_data['master_process'] = $class;
            $id = isset($process_data['id'])?$process_data['id']:'';
            ?>
           <tr style="background-color:#F0F0F0"
                class="
                <?php echo isset($class)?$class.'_hide':'';?> <?php echo $class.'_show_'.$count;?> 
                <?php echo @$hide_class.' '.@$process.'_hide_all';?> table-row get_third_layer_department_data "
                data-class="<?php  echo $class.'_show_'.$count; ?>"
                data-values='<?php echo json_encode($process_data);?>' 
                data-clicked = '0'
                data-request = '0'
                data-list = '<?php echo $process;?>'
                data-hide = "<?php echo $class.'_hide_class_'.$count;;?>">
              <b><td ><?php if(isset($icon_hide) && $icon_hide == 0){?><i class="fas fa-angle-double-right" style="color: #216cea;">&nbsp; </i><?php }?></td></b>
              <td ><?= $lot_no ?></td>
              <td ><?= $parent_lot_name ?></td>
              <td ><?= $design_code ?></td>
              <td ><?= isset($process_data['product_name'])?$process_data['product_name']:'-'; ?></td>
              <td ><?= $process_name ?></td>
              <td ><?= $department_name;?></td>
              <td ><?= $out_lot_purity; ?></td>
              <td ><?= $karigar; ?></td>
              <td style="text-align: right;"> <?php if(!empty($id)){?>
                  <a target="_blank" href="<?php echo base_url().'processes/processes/view/'.$id?>"><?php }?><?= four_decimal($process_data['balance_gross']) ?><?php if(!empty($id)){?></a><?php }?></td>
              <td style="text-align: right;"><?= four_decimal($process_data['balance_fine']) ?></td>
              <td><?php 
              if(!empty($id) && !in_array($id,$process_ids)){?><a target="_blank" href="<?php echo base_url().'processes/process_verifications/create?process_id='.$id?>">verify</a><?php }?></td>
            </tr>
          
          <?php $count++;}
          if(isset($hide_class)){
            $color = 'background-color:#28a745';
          }else{
            $color = 'background-color:yellow';
          }

          ?>
          <tr style="<?=$color?>" class="bg_gray <?php echo $class.'_hide';?> <?php echo @$hide_class.' '.@$process.'_hide_all';?>">
            <td class=" bold">Total</td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold"></td>
            <td class=" bold" style="text-align: right;"><?=four_decimal($total_gross);?></td>
            <td class=" bold" style="text-align: right;"><?=four_decimal($total_fine);?></td>
            <td class=" bold"></td>
          </tr> 

       <?php }else{ ?>
          <tr class="<?php echo @$hide_class.' '.@$process.'_hide_all';?>  <?php echo isset($class)?$class.'_hide':'';?>">
            <td>No Record Found.</td>
          </tr>
        <?php }
      ?>
  </span>    
 