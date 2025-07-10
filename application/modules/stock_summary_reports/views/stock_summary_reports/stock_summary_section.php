<?php $type= ($section_name=='WASTAGE MELTING') ? '' : 'total';?>
<tbody>
  <tr>
    <th class="bg-light" scope="row" colspan='6'><?= $section_name ?></td>
  </tr>
</tbody>

<?php 
  foreach ($section_rows as $product_name) { 
    $product_total_row_name = str_replace_space_dash_dot($row_prefix.$product_name, '_');
    $product_total_row_data = $$product_total_row_name;
    if ($product_total_row_data['balance'] != 0 || $product_total_row_data['balance_gross'] != 0 || $product_total_row_data['balance_fine'] != 0) { ?>
      <tbody class="<?= (isset($rows[$product_total_row_name])) ? 'toggle_div' : '' ?>">
        <?php 
          $this->load->view('table_row', array('heading' => $product_name, 'name' => $product_total_row_name, 
                                               'class'=>(isset($rows[$product_total_row_name])) ? 'toggle_row' : '','section_name' => $section_name, 
                                               'type'=>$type, 'column_type'=>'stock_summary', 'in_out_weights'=>'no', 'product_name'=>$product_name)); 
            if (isset($rows[$product_total_row_name])) {
              foreach ($rows[$product_total_row_name] as $process_row_name) {
                if (!isset($$process_row_name)) continue;
                $process_row_data = $$process_row_name;
                if ($process_row_data['balance'] != 0 || $process_row_data['balance_gross'] != 0 || $process_row_data['balance_fine'] != 0)
                  $this->load->view('table_row', array('heading' => str_replace($product_total_row_name, '', $process_row_name), 'name' => $process_row_name, 
                                                       'class'=>'toggle_content','section_name' => $section_name,
                                                       'type'=>'', 'column_type'=> 'stock_summary', 'in_out_weights'=>'no','product_name'=>$product_name));   
              }
          } 
        ?>
      </tbody>
    <?php }  
  } 
?>