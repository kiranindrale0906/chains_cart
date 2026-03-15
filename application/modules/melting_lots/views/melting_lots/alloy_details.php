
<?php 
load_buttons('anchor',array('name'=>'Compute Alloy Details','class'=>'float-right blue','href'=>base_url().'melting_lots/melting_lots/update/'.$record['id'].'?from=alloy_details'));?>
<h6 class="heading blue bold text-uppercase mb-0">Alloy Details</h6>
<div class="table-responsive">
  <table class="table table-sm table-default">
    <thead>
      <tr>
        <th>#</th>
        <th>Date</th>
        <th>Alloy Name</th>
        <th>Weight</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    if(!empty($alloy_details)){
      $total = 0;
     foreach ($alloy_details as $index => $alloy_detail) { 
      $total += $alloy_detail['out_weight'];
      ?>
      <tr>
        <td><?=$index+1?></td>
        <td><?=date('d-m-Y',strtotime($alloy_detail['created_at']))?></td>
        <td><?= $alloy_detail['alloy_name']?></td>
        <td><?= $alloy_detail['out_weight']?></td>
      </tr>
    <?php } ?>
      <tr>
        <th>Total</th>
        <td></td>
        <td></td>
        <th><?=$total;?></th>
      </tr>
    <?php  }else{ ?>
      <tr> <td>No Record Found.</td></tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<?php $this->load->view('melting_lots/melting_lots/alloy_setting_list'); ?>
