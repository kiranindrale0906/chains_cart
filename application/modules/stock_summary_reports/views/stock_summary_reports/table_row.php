<?php
  if (isset($$name))
    $row = $$name;
  else
    $row = [];
  //$product_name = (strpos($heading,'_' ) !== false) ? '' : $heading;
  $product_name = (isset($product_name) && !empty($product_name)) ? $product_name : '';
  $section_name = (isset($section_name) && !empty($section_name)) ? $section_name : '';
  
  //$query = 'Select product_name,process_name,department_name,in_weight,in_purity,in_lot_purity,balance,balance_gross,balance_fine,id as url from processes where product_name="'.$product_name.'" and process_name="'.ltrim(ucwords(str_replace("_", " ", $heading))).'" and balance!=0';
  if (   (isset($row['in_weight']) && $row['in_weight'] !=0) 
      || (isset($row['out_weight']) && $row['out_weight'] !=0) 
      || (isset($row['balance_gross']) && $row['balance_gross'] !=0)
      || (isset($row['balance_fine']) && $row['balance_fine'] !=0)) { ?>
    <tr class="<?= @$class; ?>">
      <td><?= str_replace('Karigar Daily Drawer', '', ucwords(str_replace('_', ' ', $heading))); ?></td>

      <td class="text-right">
     <?php if($in_out_weights=='yes')$this->load->view('value_link', array('row_name' => $name,'product_name'=>$product_name, 
                                                    'process_name'=>ltrim(ucwords(str_replace("_", " ", $heading))), 'column' => 'in_weight','type'=>$type,'column_type'=>@$column_type)); ?>
      </td>
      <td class="text-right">
        <?php if($in_out_weights=='yes')$this->load->view('value_link', array('row_name' => $name, 'product_name'=>$product_name,'process_name'=>ltrim(ucwords(str_replace("_", " ", $heading))),'column' => 'out_weight','type'=>$type,'column_type'=>@$column_type)); ?>
      </td>
      <td class="text-right">
        <?php $this->load->view('value_link', array('row_name' => $name, 'section_name'=>$section_name, 'product_name'=>$product_name, 
                                                    'process_name'=>ltrim(ucwords(str_replace("_", " ", $heading))), 'column' => 'balance','type'=>$type,
                                                    'column_type'=>@$column_type)); ?>
      </td>
      <td class="text-right">
        <?php $this->load->view('value_link', array('row_name' => $name, 'section_name'=>$section_name, 'product_name'=>$product_name, 
                                                    'process_name'=>ltrim(ucwords(str_replace("_", " ", $heading))),'column' => 'balance_gross','type'=>$type,
                                                    'column_type'=>@$column_type)); ?>
      </td>
      <td class="text-right">
        <?php $this->load->view('value_link', array('row_name' => $name, 'section_name'=>$section_name, 'product_name'=>$product_name, 
                                                    'process_name'=>ltrim(ucwords(str_replace("_", " ", $heading))),'column' => 'balance_fine','type'=>$type,
                                                    'column_type'=>@$column_type)); ?>
      </td>
    </tr>

    <?php if ($name=='adjustment_summary') { ?>
      <tr>
        <td class="text-left">
          <a href="<?=base_url()?>stock_summary_reports/adjustment_records/edit/1">Edit adjustment record</a>
        </td>
      </tr>
    <?php }
  }
?>