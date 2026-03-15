<div class="row">
  <div class="col-md-6 border-right">
    <?php load_field('hidden', array('field' => 'id','value'=>$record['id'],'id'=>'issue_department_id')) ?>
    <div class="form-group container">
      <p><h6>Date : <?=date('d-m-Y',strtotime($record['created_at']))?></h6></p>
      <p><h6>In Purity : <?= $record['in_lot_purity']?></h6></p>
      <p><h6>Total Out Weight : <?= $record['in_weight']?></h6></p>  
    </div>
  </div>
</div>
<hr>
<!-- <div class="col-md-12 border-right">
  <?php 
  load_buttons('anchor', array('href' =>'javascript.void(0)',
                               'class'=>'btn-sm btn_blue float-right m-3 ajax',
                               'name'=>'Print',
                               'id'=>'issue_department_print'));?>
</div> -->
<?php
  $this->load->view('daily_drawer_processes/viewlist'); 
?>


