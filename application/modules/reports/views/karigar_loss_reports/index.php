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
    <?php load_field('date',array('field' => 'start_date','class' => 'datepicker_js', 'col'=>'col-sm-4','value'=>!empty($start_date)?date('d M Y',strtotime($start_date)):''));?>
    <?php load_field('date',array('field' => 'end_date','class' => 'datepicker_js', 'col'=>'col-sm-4','value'=>!empty($end_date)?date('d M Y',strtotime($end_date)):''));?>  
  </div>
    <div class="row">
      <?php load_field('dropdown',array('field' => 'karigar_name', 'col'=>'col-sm-4','option'=>$karigar))?>
      <div class="col-sm-4 align-self-center">
        <?php load_buttons('button', array('name' =>'Search','class'=>'btn-xs btn_blue karigar_loss_search_date mr-2')) ?> 
        <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs btn_blue clear_btn')) ?>      
      </div>
    </div>
  </form>
<?php } ?>
<table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <th>Karigar Name</th>      
      <th class="text-right ">Date</th>
      <th class="text-right ">Lot No</th>
      <th class="text-right ">Out Weight</th>
      <th class="text-right ">karigar Loss</th>
    </tr>
  </thead>
  
  <tbody>
    <?php
      if(!empty($loss_records)){
        $loss_total=$out_weight_total=0;
        foreach ($loss_records as $index => $loss_record) {
          $out_weight_total+=$loss_record['out_weight'];
          $loss_total+=$loss_record['loss'];
          ?>
         <tr>
            <td><?= $loss_record['karigar']?></td>
            <td class="text-right "><?= date('d-m-Y',strtotime($loss_record['date'])) ?></td>
            <td class="text-right "><?= ($loss_record['lot_no']) ?></td>
            <td class="text-right "><?= four_decimal($loss_record['out_weight']) ?></td>
            <td class="text-right "><?= four_decimal($loss_record['loss']) ?></td>
          </tr> 
        <?php }?>
         <tr class="bg_gray">
            <td></td>
            <td></td>
            <td class="text-right bold"></td>
            <td class="text-right bold"><b><span><?= four_decimal($out_weight_total) ?></span></b></td>
            <td class="text-right bold"><b><span><?= four_decimal($loss_total) ?></span></b></td>
         </tr>

     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
</table>