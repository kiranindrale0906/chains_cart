<?php
  $total_days_in_month = date('t');
  $current_date = date('d');

  function get_expected_productions($monthly_target_data,$product_list,$balance_data, $current_date, $total_days_in_month)
  {
    $target_rolling_count = isset($monthly_target_data[$product_list]['target_rolling']) ?
                              $monthly_target_data[$product_list]['target_rolling'] : 0;
    $total_process_balance = isset($balance_data[$product_list."_product_total"]) ? 
                          $balance_data[$product_list."_product_total"] : 0;
    $rolling_calculations = (($target_rolling_count*$total_process_balance)*$current_date)/$total_days_in_month;
    return $rolling_calculations;
  }

  function get_actual_rollings($product_list, $balance_data, $current_date, $total_days_in_month){
    $balance_gpc_out = isset($balance_data[$product_list."_gpc_out"]) ? $balance_data[$product_list."_gpc_out"] : 0;
    $total_process_balance = isset($balance_data[$product_list."_product_total"]) ? 
                                  $balance_data[$product_list."_product_total"] : 0;
    if($total_process_balance != 0){
      return number_format(($balance_gpc_out/$current_date*$total_days_in_month/$total_process_balance),4);
    }
    else {
      return 0;
    }
  }

?>
<!-- <?php echo form_open_multipart(get_form_action("reports/daily_stock_reports",array(), array()), 
                             'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
<div class="row">
  <?php
    load_field('dropdown',array('field' => 'month', 'col'=>'col-sm-3', 'option' => $month_lists, 'value' => $month));
    load_field('dropdown',array('field' => 'year', 'col'=>'col-sm-3', 'option' => $year_list, "value" => $year));
  ?>
</div> -->
  <!-- <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?> -->
<!-- </form> -->
<div class="boxrow mb-2">
  <div class="float-left">
    <h6 class="heading blue bold text-uppercase mb-0">
      <?= @getTableSettings()['page_title']; ?>
    </h6>
  </div>
</div>
<table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <th></th>
      <?php
        $product_total_row = "";
        $product_total_balance = 0;
        $gpc_out_total_row = "";
        foreach ($product_lists as $index => $product_list) {
          $total_process_balance = isset($balance_data[$product_list."_product_total"]) ? 
                                  $balance_data[$product_list."_product_total"] : 0;
          $product_total_row .= "<th>".$total_process_balance."</th>";
          $product_total_balance += $total_process_balance;

          $balance_gpc_out = isset($balance_data[$product_list."_gpc_out"]) ? $balance_data[$product_list."_gpc_out"] : 0;
          $gpc_out_total_row .= "<th>".$balance_gpc_out."</th>";
          
          echo "<th>".$product_list."</th>";
        }
      ?>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($process_lists as $index => $process_list) {
        $table_columns = "";
        foreach ($product_lists as $index1 => $product_list) {
          $balance = isset($balance_data[$process_list][$product_list]) ? $balance_data[$process_list][$product_list] : 0;
          $table_columns .= "<td>".$balance."</td>";
        }
        $total_process_balance = isset($balance_data[$process_list."_process_total"]) ? 
                                  $balance_data[$process_list."_process_total"] : 0;
        echo "<tr>
                <th>".$process_list."</th>"
                .$table_columns.
                "<th>".$total_process_balance."</th>
              </tr>";
      }
      echo "<tr class='bg_gray'>
              <th>GROSS STOCK</th>
              ".$product_total_row."
              <th>".$product_total_balance."</th>
            </tr>";

      //gpc out
      echo "<tr class='bg_gray'>
              <th>ACTUAL PRODUCTION</th>
              ".$gpc_out_total_row."
              <th></th>
            </tr>";

      echo "<tr height='50px;'><td colspan='".(count($product_lists)+2)."'></tr>";

      //monthly target list
      foreach ($monthly_target_fields as $index => $monthly_target_field) {
        $table_data = "";
        $total = 0;
        foreach ($product_lists as $index => $product_list) {

          $filed_name = strtolower(str_replace(" ", "_", $monthly_target_field));
          $table_cell = isset($monthly_target_data[$product_list][$filed_name]) 
                          ? $monthly_target_data[$product_list][$filed_name] : 0;

          $table_data .= "<td>".$table_cell."</td>";
          $total += $table_cell;
        }
        echo "<tr>
                <th>".$monthly_target_field."</th>
                ".$table_data."
                <th>".$total."</th>
              </tr>";
      }

      $rolling_fields = array("EXPECTED PRODUCTION", "ACTUAL ROLLING");

      foreach ($rolling_fields as $index_1 => $rolling_field) {
        $rolling_table_data  = "";
        $rolling_fields_total = 0;
        foreach ($product_lists as $index => $product_list) {
          $rolling_calculations = 0;
          if($rolling_field == "EXPECTED PRODUCTION"){
            $rolling_calculations = get_expected_productions($monthly_target_data,$product_list,$balance_data, $current_date, $total_days_in_month);
          }
          else if($rolling_field == "ACTUAL ROLLING"){
            $rolling_calculations = get_actual_rollings($product_list, $balance_data, $current_date, $total_days_in_month);
          }
          $rolling_table_data .= "<td>".$rolling_calculations."</td>";
          $rolling_fields_total += $rolling_calculations;
        }
        echo "<tr>
                <th>".$rolling_field."</th>
                ".$rolling_table_data."
                <th>".$rolling_fields_total."</th>
              </tr>";
      }
    ?>
  </tbody>
</table>