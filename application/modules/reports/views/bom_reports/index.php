<div class="boxrow mb-2">
  <div class="float-left">
    <h6 class="heading blue bold text-uppercase mb-0"><?= @getTableSettings()['page_title']; ?></h6>
  </div>
</div>
<form class="fields-group-sm">
  <div class="row">
    <?php load_field('dropdown',array('field' => 'process', 'name' => 'process', 'col'=>'col-sm-2','option' => $processes));?>
    <?php load_field('dropdown',array('field' => 'melting', 'name' => 'melting', 'col'=>'col-sm-2','option' => $meltings));?>
    <?php load_field('date', array('field' => 'from_date', 'name' => 'from_date', 'class' => 'datepicker_js', 'col'=>'col-sm-2', 'value' => date('d M Y',strtotime($from_date))));?>
    <?php load_field('date', array('field' => 'to_date', 'name' => 'to_date','class' => 'datepicker_js', 'col'=>'col-sm-2', 'value' => date('d M Y',strtotime($to_date))));?>  
    <div class="col-sm-3 align-self-center">
      <?php load_buttons('submit', array('name' =>'Search','class'=>'btn-xs btn_blue mr-2')) ?> 
      <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs clear_btn btn_blue')) ?>
    </div>
  </div>
</form>

<?php if(isset($report_data) && !empty($report_data)) {
  $headers = $report_data['_headers'];
  unset($report_data['_headers']);
  ?>
  <table class="table table-bordered table-sm">
    <thead class="bg_gray">
      <tr>
        <?php foreach ($headers as $header) { ?>
          <th><?php echo $header; ?></th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($report_data as $field_group) { ?>
        <tr>
          <td>AS PER BOM</td>
          <td rowspan="2">ORD-<?php echo $field_group['order_data']['id']; ?></td>
          <td rowspan="2"><?php echo $field_group['melting_lot']['lot_no']; ?></td>
          <td rowspan="2"><?php echo $field_group['melting_lot']['created_at']; ?></td>
          <td rowspan="2" class="text-right"><?php echo $field_group['bom_data']['melting']; ?></td>
          <td rowspan="2"><?php echo $field_group['bom_data']['varient']; ?></td>
          <td rowspan="2" class="text-right"><?php echo $field_group['melting_lot']['gross_weight']; ?></td>
          <td class="text-right"><?php echo round($field_group['as_per_bom_data']['strip'],4); ?></td>
          <td class="text-right"><?php echo $field_group['as_per_bom_data']['chain_wt']; ?></td>
          <td class="text-right"><?php echo $field_group['as_per_bom_data']['gpc_out']; ?></td>
          <td class="text-right"><?php echo $field_group['as_per_bom_data']['gpc_out_qty']; ?></td>
          <td class="text-right"><?php echo $field_group['as_per_bom_data']['throughput']; ?> %</td>
        </tr>
        <tr>
          <td>ACTUAL</td>
          <td class="text-right"><?php echo $field_group['actual_data']['strip']; ?></td>
          <td class="text-right"><?php echo $field_group['actual_data']['chain_wt']; ?></td>
          <td class="text-right"><?php echo $field_group['actual_data']['gpc_out']; ?></td>
          <td class="text-right"><?php echo $field_group['actual_data']['gpc_out_qty']; ?></td>
          <td class="text-right"><?php echo $field_group['actual_data']['throughput']; ?> %</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>  
<?php } else {
  echo '<h5 class="text-center mt-3">No records found for selected filters.</h5>';
} ?>