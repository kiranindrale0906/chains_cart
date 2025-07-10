  <?= getHttpButton('DELETE', base_url().'issue_departments/issue_departments/delete/'.$record['id'], 'float-right btn-danger ml-5'); ?>
<div class="row">
  <div class="col-md-6 border-right">
    <?php
    
     load_field('hidden', array('field' => 'id','value'=>$record['id'],'id'=>'issue_department_id')) ?>
    <div class="form-group container">
      <p><h6>Date : <?=date('d-m-Y',strtotime($record['created_at']))?></h6></p>
      <p><h6>Account Name : <?= $record['account_id']?></h6></p>
      <p><h6>Description : <?=$record['description']?></h6></p>
      <p><h6>Melting : <?=$record['in_purity']?></h6></p>
      <p><h6>Issue Melting : <?=$record['out_purity']?><h6></p>
      <p><h6>Out Fine : <?=$record['out_fine']?><h6></p>  
    </div>
  </div>
  <div class="col-md-6 border-right">
    <div class="form-group container">
      <p><h6>Product Name : <?=$record['product_name']?></h6></p>
      <p><h6>Issue Type : <?=$record['issue_type']?></h6></p>
      <p><h6>Total Weight : <?=$record['in_weight']?></h6></p>
      <p><h6>Fine : <?=$record['in_fine']?></h6></p>
      <p><h6>Customer Wastage : <?=$record['wastage_percentage']?><h6></p> 
      <p><h6>Chain Name : <?=$record['chain_name']?><h6></p> 
      <p><h6>Packet No : <?=$record['packet_no']?><h6></p> 
      <p><h6>USD Wastage % : <?=$record['usd_wastage_percentage']?><h6></p> 
      <p><h6>INR Wastage % : <?=$record['inr_wastage_percentage']?><h6></p> 
    </div>
  </div>
</div>
<hr>
<div class="col-md-12 border-right">
  <?php 
  // load_buttons('anchor', array('href' =>'javascript.void(0)',
  //                              'class'=>'btn-sm btn_blue float-right m-3 ajax',
  //                              'name'=>'Print',
  //                              'id'=>'issue_department_print'));
  ?>
</div>
<?php
if(!empty($processes)){
  if($record['product_name'] == 'Melting Wastage'){
    $this->load->view('melting_wastage_details/viewlist');
    $this->load->view('process_out_wastage_details/viewlist');
  } elseif($record['product_name'] == 'Daily Drawer Wastage')
      $this->load->view('daily_drawer_wastage_details/viewlist');
    elseif($record['product_name'] == 'Repair Out')
      $this->load->view('repair_out_details/viewlist');
    elseif($record['product_name'] == 'HCL Loss')
      $this->load->view('hcl_loss_details/viewlist');
    elseif($record['product_name'] == 'Tounch Loss Fine')
      $this->load->view('tounch_loss_fine_details/viewlist');
    elseif($record['product_name'] == 'Cutting Ghiss' || $record['product_name'] == 'Ice Cutting Ghiss')
      $this->load->view('cutting_ghiss_details/viewlist');
    elseif($record['product_name'] == 'GPC Out' || $record['product_name'] == 'Finish Good')
      $this->load->view('gpc_details/viewlist');
    elseif($record['product_name'] == 'GPC Repair Out')
      $this->load->view('gpc_repair_out_details/viewlist');
    elseif($record['product_name'] == 'GPC Loss Out')
      $this->load->view('gpc_loss_out_details/viewlist');
    elseif($record['product_name'] == 'Ghiss Melting Loss')
      $this->load->view('ghiss_melting_loss_details/viewlist');
    elseif($record['product_name'] == 'Castic Loss')
      $this->load->view('castic_loss_details/viewlist');
    elseif($record['product_name'] == 'Finished Goods Receipt')
      $this->load->view('finished_goods_receipt_details/viewlist');
    elseif($record['product_name'] == 'Chitti Out')
      $this->load->view('issue_department_chitti_details/viewlist');
    elseif($record['product_name'] == 'Hallmark Out')
      $this->load->view('hallmark_out_details/viewlist');
    else
      $this->load->view('issue_department_details/viewlist');
}
?>


