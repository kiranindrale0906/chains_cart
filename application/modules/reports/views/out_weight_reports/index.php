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
      <?php load_field('date',array('field' => 'date', 'class' => 'datepicker_js', 'col'=>'col-sm-4','value'=>$date))?> 
      <div class="col-sm-4 align-self-center">
        <?php load_buttons('button', array('name' =>'Search','class'=>'btn-xs btn_blue out_weight_search_date mr-2')) ?> 
        <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs btn_blue clear_btn')) ?>      
      </div>
    </div>
  </form>
<?php } ?>
<table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <th>Category Name</th>
      <th class='text-right'>Out Weight  </th>
      <th class='text-right'>Out Weight Gross</th>
      <th class='text-right'>Out Weight Fine</th>
    </tr>
  </thead>
  
  <tbody >
  <?php
  if(!empty($records)){
      $out_weight=$out_weight_gross=$out_weight_fine=0;
      foreach ($records as $index => $record) {
        $out_weight+=$record['out_weight'];
        $out_weight_gross+=$record['out_weight_gross'];
        $out_weight_fine+=$record['out_weight_fine'];
       ?>
      <tr>
      <td><?=$index?></td>
      <td class='text-right'><?=four_decimal($record['out_weight'])?></td>
      <td class='text-right'><?=four_decimal($record['out_weight_gross'])?></td>
      <td class='text-right'><?=four_decimal($record['out_weight_fine'])?></td>
      </tr>
   <?php }?>
   <tr class="bg_gray">
            <td class=" bold">Total</td>
            <td class=" bold text-right"><?=four_decimal($out_weight)?></td>
            <td class=" bold text-right"><?=four_decimal($out_weight_gross)?></td>
            <td class=" bold text-right"><?=four_decimal($out_weight_fine)?></td>
          </tr> 
  <?php }else{?>
    <tr><td>No Record Found.</td></tr>
    <?php }?>
  </tbody>
</table>