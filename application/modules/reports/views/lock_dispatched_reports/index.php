<div class="boxrow mb-2">
  <div class="float-left">
    <h6 class="heading blue bold text-uppercase mb-0"><?= @getTableSettings()['page_title']; ?></h6>
  </div>
</div>
<form class="fields-group-sm">
  <div class="row">
    <?php load_field('dropdown',array('field' => 'lock_no', 'name' => 'lock_no', 'col'=>'col-sm-2','option' => $lock_nos));?>
    <?php load_field('dropdown',array('field' => 'in_lot_purity', 'name' => 'in_lot_purity', 'col'=>'col-sm-2','option' => $in_lot_purity));?>
    <?php load_field('dropdown',array('field' => 'city', 'name' => 'city', 'col'=>'col-sm-2','option' => $city));?>
    <?php load_field('date', array('field' => 'from_date', 'name' => 'from_date', 'class' => 'datepicker_js', 'col'=>'col-sm-2'));?>
    <?php load_field('date', array('field' => 'to_date', 'name' => 'to_date','class' => 'datepicker_js', 'col'=>'col-sm-2'));?>  
    <div class="col-sm-3 align-self-center">
      <?php load_buttons('submit', array('name' =>'Search','class'=>'btn-xs btn_blue mr-2')) ?> 
      <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs clear_btn btn_blue')) ?>
    </div>
  </div>
</form>
<table class="table table-bordered table-sm">
  <thead class="bg_gray">
    <tr>
        <th>Date</th>
        <th>Purity</th>
        <th>Tone</th>
        <th>Out Weight</th>
        <th>City</th>
        <th>Lock No</th>
        <th>No. Of Pcs</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $out_weight=$lock_no=$no_of_pc=0;
     foreach ($lock_dispactched_records as $index=> $lock_dispactched_record) { 
      $out_weight+=$lock_dispactched_record['out_weight'];
      $lock_no+=$lock_dispactched_record['lock_no'];
      $no_of_pc+=$lock_dispactched_record['no_of_pc'];
      ?>
      <tr>
        <td><?=$lock_dispactched_record['completed_at']?></td>
        <td><?=$lock_dispactched_record['in_lot_purity']?></td>
        <td><?=$lock_dispactched_record['tone']?></td>
        <td><?=$lock_dispactched_record['out_weight']?></td>
        <td><?=$lock_dispactched_record['city']?></td>
        <td><?=$lock_dispactched_record['lock_no']?></td>
        <td><?=$lock_dispactched_record['no_of_pc']?></td>
      </tr>
    <?php } ?>
      <tr class="bold bg_gray">
        <td>Total</td>
        <td></td>
        <td></td>
        <td><?=$out_weight?></td>
        <td></td>
        <td><?=$lock_no?></td>
        <td><?=$no_of_pc?></td>
      </tr>
  </tbody>
</table>
