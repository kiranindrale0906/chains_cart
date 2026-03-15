<div class="boxrow mb-2">
  <div class="float-left">
    <h6 class="heading blue bold text-uppercase mb-0"><?= @getTableSettings()['page_title']; ?></h6>
  </div>
</div>
<form class="fields-group-sm">
  <div class="row">
    <?php load_field('dropdown',array('field' => 'process', 'name' => 'process', 'col'=>'col-sm-3','option' => $processes));?>
    <?php load_field('date', array('field' => 'from_date', 'name' => 'from_date', 'class' => 'datepicker_js', 'col'=>'col-sm-3', 'value' => date('d M Y',strtotime($from_date))));?>
    <?php load_field('date', array('field' => 'to_date', 'name' => 'to_date','class' => 'datepicker_js', 'col'=>'col-sm-3', 'value' => date('d M Y',strtotime($to_date))));?>
    <div class="col-sm-3 align-self-center">
      <?php load_buttons('submit', array('name' =>'Search','class'=>'btn-xs btn_blue mr-2')) ?>
      <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs clear_btn btn_blue')) ?>
    </div>
  </div>
</form>

<?php if(isset($report_data) && ! empty($report_data)) {
  $headers        = $report_data['_headers'];
  $department_cnt = $report_data['_department_cnt'];
  unset($report_data['_headers'], $report_data['_department_cnt']);
  ?>
  <table class="table table-bordered table-sm table-responsive">
    <thead class="bg_gray">
      <tr>
        <?php foreach ($headers['main'] as $header) { ?>
          <th rowspan="3"><?php echo $header; ?></th>
        <?php } ?>
        <th colspan="<?php echo $department_cnt; ?>" class="text-center">Out Weight</th>
        <th rowspan="3">GPC out quantity</th>
        <th colspan="10" class="text-center">CHAIN READY PIECES QUANTTITY</th>
      </tr>
      <tr>
        <?php foreach ($headers['departments'] as $process_name => $departments) { ?>
          <th colspan="<?php echo count($departments) ?>" class="text-center"><?php echo $process_name; ?></th>
        <?php } ?>
        <?php foreach ($headers['quantities'] as $quantity) { ?>
          <th rowspan="2" class="text-center"><?php echo $quantity; ?> inchs</th>
        <?php } ?>
        <th rowspan="2">Total</th>
      </tr>
      <tr>
        <?php foreach ($headers['departments'] as $process_name => $departments) {
          foreach ($departments as $department) { ?>
            <th><?php echo $department; ?></th>
          <?php } ?>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($report_data as $row_index => $field_group) {
        $process_department_cnt = 0;
       ?>
        <tr>
          <td class="text-right"><?php echo ($row_index+1); ?></td>
          <?php foreach ($field_group['bom_data'] as $bom_data) { ?>
            <td><?php echo $bom_data ?></td>
          <?php } ?>
          <?php
          unset($field_group['melting_lot']['id']);
          foreach ($field_group['melting_lot'] as $melting_lot) { ?>
            <td><?php echo $melting_lot; ?></td>
          <?php } ?>
          <?php foreach ($headers['departments'] as $process_name => $departments) {
            foreach ($departments as $department) { ?>
              <td class="text-right"><?php echo isset($field_group['process'][$process_name][$department]) ? $field_group['process'][$process_name][$department] : '---'; ?></td>
            <?php $process_department_cnt++;
            }
          } ?>
          <?php $blank_cell_cnt = $department_cnt - $process_department_cnt;
            echo repeater('<td class="text-right">---</td>', $blank_cell_cnt);
          ?>
          <td class="text-right"><?php echo round($field_group['gpc_qty']); ?></td>
          <?php foreach ($field_group['quantities'] as $length_type => $quantities) {
            $custom_1_length = '';
            $custom_2_length = '';
            if($length_type == 'custom_1_ready_qty' && !empty($field_group['order_data']['custom_1_length'])) {
              $custom_1_length = ' ('.$field_group['order_data']['custom_1_length'].' inch)';
            }
            if($length_type == 'custom_2_ready_qty' && !empty($field_group['order_data']['custom_2_length'])) {
              $custom_2_length = ' ('.$field_group['order_data']['custom_2_length'].' inch)';
            } ?>
            <td><?php echo $quantities.$custom_1_length.$custom_2_length; ?></td>
          <?php } ?>
          <td class="text-right"><?php echo round($field_group['total_ready_qty']); ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } else {
  echo '<h5 class="text-center mt-3">No records found for selected filters.</h5>';
} ?>