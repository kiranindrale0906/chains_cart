<?php 
//if($show_form) { ?>
  <div class="boxrow mb-2">
    <div class="float-left">
      <h6 class="heading blue bold text-uppercase mb-0">
        <?= @getTableSettings()['page_title']; ?>
      </h6>
    </div>
  </div>
  <form class="fields-group-sm">
    <div class="row">
      <?php load_field('date',array('field' => 'from_date', 'col'=>'col-sm-3', 
                                  'id' => 'stone_vatav_ledgers_from_date', 'class' => 'stone_vatav_ledgers_filter datepicker_js'));?>
      <?php load_field('date',array('field' => 'to_date', 'col'=>'col-sm-3', 
                                  'id' => 'stone_vatav_ledgers_to_date', 'class' => 'stone_vatav_ledgers_filter datepicker_js'));?>
      <?php load_field('dropdown',array('field' => 'in_lot_purity', 'col'=>'col-sm-4','option'=>$in_lot_purity))?> 
      <?php load_field('dropdown',array('field' => 'process_name', 'col'=>'col-sm-4','option'=>$process_name))?> 
      <?php load_field('dropdown',array('field' => 'karigar', 'col'=>'col-sm-4','option'=>$karigar))?> 
      
    </div>
  </form>
<?php //} ?>
<table class="table table-sm table-default table-hover">
  <thead>
    <tr>
      <th>Date</th>      
      <th>Lot No</th>
      <th class="text-right ">Stone In</th>
      <th class="text-right ">Stone Out</th>
      <th class="text-right ">Stone Count</th>
      <th class="text-right ">Stone Vatav</th>
      <th class="text-right ">Stone Vatav Fine</th>
      <th class="text-right ">Loss</th>
      <th class="text-right ">Fine Loss</th>
      <th class="text-right ">Out Weight</th>
      <th class="text-right ">Ghiss</th>
    </tr>
  </thead>
  
  <tbody>
    <?php
      if(!empty($stone_vatav_records)){
        $stone_vatav_total=$stone_vatav_total_fine=0;
        $stone_vatav_in=0;
        $stone_vatav_out=0;
        $stone_count=0;
        $loss=0;
        $out_weight=0;
        $ghiss=0;
        $fine_loss=0;
        foreach ($stone_vatav_records as $index => $stone_vatav_record) {
          $stone_vatav_total+=$stone_vatav_record['stone_in']-$stone_vatav_record['stone_out'];
          $stone_vatav_total_fine+=(($stone_vatav_record['stone_in']-$stone_vatav_record['stone_out'])*$stone_vatav_record['in_lot_purity']/100);
          $stone_vatav_in+=$stone_vatav_record['stone_in'];
          $stone_vatav_out+=$stone_vatav_record['stone_out'];
          $stone_count+=$stone_vatav_record['stone_count'];
          $loss+=$stone_vatav_record['loss'];
          $fine_loss+=($stone_vatav_record['loss']*$stone_vatav_record['in_lot_purity']/100);
          $out_weight+=$stone_vatav_record['out_weight'];
          $ghiss+=$stone_vatav_record['ghiss'];
          ?>
         <tr>
            <td><?= date('d-m-y',strtotime($stone_vatav_record['completed_at']))?></td>
            <td ><?= $stone_vatav_record['lot_no'] ?></td>
            <td class="text-right "><?= four_decimal($stone_vatav_record['stone_in']) ?></td>
            <td class="text-right "><?= four_decimal($stone_vatav_record['stone_out']) ?></td>
            <td class="text-right "><?= four_decimal($stone_vatav_record['stone_count']) ?></td>
            <td class="text-right "><?= four_decimal($stone_vatav_record['stone_in']-$stone_vatav_record['stone_out']) ?></td>
            <td class="text-right "><?= four_decimal(($stone_vatav_record['stone_in']-$stone_vatav_record['stone_out'])*$stone_vatav_record['in_lot_purity']/100) ?></td>
            <td class="text-right "><?= four_decimal($stone_vatav_record['loss']) ?></td>
            <td class="text-right "><?= four_decimal($stone_vatav_record['loss']*$stone_vatav_record['in_lot_purity']/100) ?></td>
            <td class="text-right "><?= four_decimal($stone_vatav_record['out_weight']) ?></td>
            <td class="text-right "><?= four_decimal($stone_vatav_record['ghiss']) ?></td>
          </tr> 
        <?php }?>
         <tr class="bg_gray">
            <td></td>
            <td></td>
            <td class="text-right bold"><?= four_decimal($stone_vatav_in) ?></td>
            <td class="text-right bold"><?= four_decimal($stone_vatav_out) ?></td>
            <td class="text-right bold"><?= four_decimal($stone_count) ?></td>
            <td class="text-right bold"><b><span><?= four_decimal($stone_vatav_total) ?></span></b></td>
            <td class="text-right bold"><b><span><?= four_decimal($stone_vatav_total_fine) ?></span></b></td>
            <td class="text-right bold"><?= four_decimal($loss) ?></td>
            <td class="text-right bold"><?= four_decimal($fine_loss) ?></td>
            <td class="text-right bold"><?= four_decimal($out_weight) ?></td>
            <td class="text-right bold"><?= four_decimal($ghiss) ?></td>
         </tr>

     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
</table>