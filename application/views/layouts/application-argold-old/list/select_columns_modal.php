<?php
  $masters             = array();
  $add_col_master_name = $this->router->class;
  $select_columns_url  = getTableSettings($add_col_master_name, @$type, @$type_id);
  $add_colmns          = array();
  if ($add_col_master_name == "timesheets" || $add_col_master_name == "due_timesheets" || $add_col_master_name == "expenses" || $add_col_master_name == "due_expenses" || $add_col_master_name == "invoice_professionals_expense" || $add_col_master_name == "invoice_customers_expense" || $add_col_master_name == "invoice_customers_timesheet" || $add_col_master_name == "invoice_professionals_timesheet" || $add_col_master_name == "pending_customer_expense_invoices" || $add_col_master_name == "pending_customer_timesheet_invoices" || $add_col_master_name == "pending_expense_invoices" || $add_col_master_name == "pending_timesheet_invoices" || $add_col_master_name == "work_requests" || $add_col_master_name == "work_applications" || $add_col_master_name == "professional_references" || $add_col_master_name == "work_reapply_requests" || $add_col_master_name == "professional_work_status") {
    $flag = true;
        if(isset($table_columns)):
        foreach ($table_columns as $key => $value) {
          $add_colmns[$value[7]][$key] = $value[0];
        }
        endif;
  } else {
    $flag = false;
        if(isset($table_columns)):
    foreach ($table_columns as $key => $value) {
      if (is_array($select_columns_url['table']))
        $add_colmns[ucfirst($select_columns_url['table'][0])][$key] = $value[0];
      else
        $add_colmns[ucfirst($select_columns_url['table'])][$key] = $value[0];
    }
        endif;
  }
  if (isset($filter_columns) && $filter_columns != '') {
    $selected_filter_columns = array_column($filter_columns, 0);
  }
    
    $current_url = base_url(uri_string());
   
    $link_params = !empty($_SERVER['QUERY_STRING'])?'?'.$_SERVER['QUERY_STRING']:'';

    $link_params = str_replace("&selected_column=1&ordered_columns=1","",$link_params);
    $link_params = str_replace("?selected_column=1&ordered_columns=1","",$link_params);
    $new_url = !empty($link_params) ? $link_params.'&selected_column=1&ordered_columns=0' : '?selected_column=1&ordered_columns=0';
    $paramCount = substr_count($new_url, "selected_column=1&ordered_columns=1");
    if($paramCount>1){
      $new_url = str_replace("&selected_column=1&ordered_columns=1","",$new_url);
    }
    $paramCount = substr_count($new_url, "selected_column=1&ordered_columns=0");
    if($paramCount>1){
      $new_url = str_replace("?selected_column=1&ordered_columns=0","",$new_url);
      $new_url = str_replace("&selected_column=1&ordered_columns=0","",$new_url);
    }
?>

<div class="modal fade" id="select_columns_model" role="dialog">
  <div class="modal-dialog modal-xl">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg_blue white">
        <h5 class="modal-title">SELECT COLUMN(S):</h5>
        <button class="btn btn-lg btn_blue btn_icon" data-dismiss="modal"><i class="fal fa-times font20"></i></button>
      </div>
       <div class="modal-body">
          <?= form_open(@$current_url.@$param['search_url'].$new_url,'id=add_column_form_id','name=add_column_form');?>
              <div <?php if (!@isset($masters[$select_columns_url['table']]) && $add_col_master_name != 'requested' && $add_col_master_name != 'viewed' && $add_col_master_name != 'shared' && $add_col_master_name != 'filters' && $add_col_master_name != 'customer' && $add_col_master_name != 'shared_wr' && $add_col_master_name != 'contact_us' && $add_col_master_name != 'email_log' && $add_col_master_name != 'unsubscribes') { ?> style="max-height: 500px;overflow-y: auto;" <?php } ?>>

                  <table style="width: 100%;">
                      <tbody>
                      <?php if ($filter_columns != '') { ?>
                          <tr>
                              <th colspan="6" style="padding: 2px"><input type="checkbox"
                                                                          class="selectDeselect" <?php if (sizeof($table_columns) == sizeof($filter_columns)) { ?> checked <?php } ?> />
                                  Select/Deselect
                              </th>
                              <th colspan="6"></th>
                          </tr>
                          <?php foreach ($add_colmns as $table => $columns) { ?>
                              <?php if ($flag) { ?>
                                  <tr>
                                      <th colspan="12"><?= $table ?>:</th>
                                  </tr>
                              <?php } ?>
                              <?php $cnt = 0;
                              foreach ($columns as $i => $column) {
                                  $cnt++; ?>
                                  <?php if ($cnt % 2 == 1) { ?>
                                      <tr>
                                  <?php } ?>
                                  <td colspan="6"><input type="checkbox" class="add_column_checkbox"
                                                         name="selected_columns[<?php echo $i; ?>]"
                                                         id="selected_columns[<?php echo $i; ?>]" <?= (isset($selected_filter_columns) && in_array($column, $selected_filter_columns)) ? 'checked' : '' ?>
                                                         value="<?php echo $i; ?>"
                                                         style="padding: 5px; vertical-align: bottom; position: relative; top: -1px; margin: 3px;"><span
                                              class="checkbox_name"
                                              style="padding: 5px;"><?php echo $column; ?></span></td>
                                  <?php if ($cnt % 2 == 0 || sizeof($columns) == $cnt) { ?>
                                      </tr>
                                  <?php } ?>
                              <?php } ?>
                          <?php } ?>
                      <?php } else { ?>
                          <tr>
                              <th colspan="6"><input type="checkbox" class="selectDeselect"/> Select/Deselect</th>
                              <th colspan="6"></th>
                          </tr>
                          <?php foreach ($add_colmns as $table => $columns) { ?>
                              <?php if ($flag) { ?>
                                  <tr>
                                      <th colspan="12"><?= $table ?></th>
                                  </tr>
                              <?php } ?>
                              <?php $cnt = 0;
                              foreach ($columns as $i => $column) {
                                  $cnt++; ?>
                                  <?php if ($cnt % 2 == 1) { ?>
                                      <tr>
                                  <?php } ?>
                                  <td colspan="6"><input type="checkbox" class="add_column_checkbox"
                                                         name="selected_columns[<?php echo $i; ?>]"
                                                         id="selected_columns[<?php echo $i; ?>]"
                                                         value="<?php echo $i; ?>"
                                                         style="padding: 5px; vertical-align: bottom; position: relative; top: -1px; margin: 3px;"><span
                                              class="checkbox_name"
                                              style="padding: 5px;"><?php echo $column; ?></span></td>
                                  <?php if ($cnt % 2 == 0 || sizeof($columns) == $cnt) { ?>
                                      </tr>
                                  <?php } ?>
                              <?php } ?>
                          <?php } ?>
                      <?php } ?>
                      </tbody>
                  </table>
              </div>
              <hr>
              <div>
                  <input type="submit" class="btn btn-primary pull-right" value="Submit"/>
              </div>
          <?= form_close();?>
      </div>     
    </div>

  </div>
</div>
