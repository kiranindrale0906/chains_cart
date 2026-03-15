
<div class="row">
<div class="col-sm-12">
<h6 class='blue text-uppercase bold mb-3'>Rejected Quantity Report</h6>
<form class="fields-group-sm" method="GET" enctype="multipart/form-data" 
    action="<?=ADMIN_PATH."reports/huid_quantity_reports/index"?>">
  <div class="row">
    <?php load_field('date',array('field' => 'from_date', 'col'=>'col-sm-3', 
                                  'id' => 'huid_quantity_from_date', 'class' => 'huid_quantity_filter datepicker_js'));?>
    <?php load_field('date',array('field' => 'to_date', 'col'=>'col-sm-3', 
                                  'id' => 'huid_quantity_to_date', 'class' => 'huid_quantity_filter datepicker_js'));?>
    <?php load_field('dropdown',array('field' => 'account','option'=>$accounts, 'col'=>'col-sm-3', 
                                  'id' => 'balance_quantity_account', 'class' => 'balance_quantity_filter'));?>
    
    </div>

  <div class="row">
    <div class="col-sm-3">
      <div class="form-group ">
        <?php load_buttons('submit',array('class'=> 'btn-sm btn_blue float-left', 'name'=>'Submit')); ?> 
      </div>
    </div>
  </div>

</form>
  <div class="table-responsive m-t-10">
  <table class="table table-sm fixedthead table-default">
	  <thead>
	  <tr>
	    <th>Date</th>
      <th>Lot No</th>
      <th>Job Card No</th>
      <th>Party Name</th>
      <th>Weight</th>
      <th>Factory Out</th>
      <th>HUID Quantity</th>
      </tr>
	</thead>
	<tbody>
    <?php
      $total_out_weight =$total_quantity =$total_out_quantity=$total_factory_out = 0;
      if(!empty($record['huid_quantity_data'])){
        foreach ($record['huid_quantity_data'] as $index => $record) {
          $total_out_weight += $record['out_weight'];
          $total_out_quantity += $record['out_quantity'];
          $total_factory_out += $record['factory_out'];
          ?>
         <tr>
            <td><?= !empty($record['date'])?date('d-m-Y',strtotime($record['date'])):'-' ?></td>
            <td><?= !empty($record['lot_no'])?$record['lot_no']:'-' ?></td>
            <td><?= !empty($record['job_card_no'])?$record['job_card_no']:'-' ?></td>
            <td><?= !empty($record['account'])?$record['account']:'-' ?></td>
            <td><?= !empty($record['out_weight'])?$record['out_weight']:'-' ?></td>
            <td><?= !empty($record['factory_out'])?$record['factory_out']:'-' ?></td>
            <td><?= ($record['out_quantity']) ?></td>
             </tr>
        
        <?php }?>
        <tr class="bg_gray">
          <td class=" bold">Total</td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"></td>
          <td  class=" bold"><?=four_decimal($total_out_weight);?></td>
          <td  class=" bold"><?=four_decimal($total_factory_out);?></td>
          <td class=" bold"><?=($total_out_quantity);?></td>
        </tr> 

     <?php }else{ ?>
        <tr>
          <td>No Record Found.</td>
        </tr>
      <?php }
    ?>
  </tbody>
	</table>
</div>
</div>
</div>