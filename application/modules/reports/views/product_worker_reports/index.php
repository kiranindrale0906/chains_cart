<?php 
if($show_form) { ?>
  <div class="boxrow mb-2">
    <div class="float-left">
      <h6 class="heading blue bold text-uppercase mb-0">
        <?= @getTableSettings()['page_title']; ?>
      </h6>
    </div>
  </div>
  <form class="fields-group-sm">
  <div class="row">
    <?php load_field('date', array('field' => 'from_date', 'name' => 'from_date', 'class' => 'datepicker_js', 'col'=>'col-sm-3', 'value'=>!empty($from_date)?date('d M Y',strtotime($from_date)):''));?>
    <?php load_field('date', array('field' => 'to_date', 'name' => 'to_date','class' => 'datepicker_js', 'col'=>'col-sm-3','value'=>!empty($to_date)?date('d M Y',strtotime($to_date)):''));?>
    <div class="col-sm-3 align-self-center">
      <?php load_buttons('submit', array('name' =>'Search','class'=>'btn-xs btn_blue mr-2')) ?>
      <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs clear_btn btn_blue')) ?>
    </div>
  </div>
  </form>
<?php } ?>
<table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <th>Department Name</th>
      <th class='text-right'>Out Weight  </th>
      <th class='text-right'>Karigar Count</th>
      <th class='text-right'>Average</th>
    </tr>
  </thead>
  
  <tbody >
  <?php
  $out_weight=0;
  if(!empty($records)){
      foreach ($records as $index => $record) {
        $out_weight+=$record['total_out_weight'];
       ?>
      <tr>
      <td class=''><?=$record['department_name']?></td>
      <td class='text-right'><?=four_decimal($record['total_out_weight'])?></td>
      <td class='text-right'><?=$record['worker_count']?></td>
      <td class='text-right'><?=$record['average']?></td>
      </tr>
   <?php }?>
   <tr class="bg_gray">
            <td class=" bold">Total</td>
            <td class=" bold text-right"><?=four_decimal($out_weight)?></td>
            <td class=" bold text-right"></td>
            <td class=" bold text-right"></td>
          </tr> 
  <?php }else{?>
    <tr><td>No Record Found.</td></tr>
    <?php }?>
  </tbody>
</table>