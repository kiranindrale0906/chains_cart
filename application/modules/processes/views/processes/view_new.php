<h4 class="heading">Process Details</h4>
<span><a href="?old=1" class="ml-5">Old</a></span>
<?= getHttpButton('COMPUTE', base_url().'processes/process_compute/update/'.$record['id'], 'float-right btn-info ml-5'); ?>
<?= getHttpButton('DELETE', base_url().'processes/processes/delete/'.$record['id'], 'float-right btn-danger ml-5'); ?>
<?php if($record['archive'] == 0 && $record['balance'] == 0) {  
        echo getHttpButton('HIDE', base_url().'processes/process_archives/update/'.$record['id'].'?from=view', 'float-right btn-info ml-5');
      } /*elseif($record['archive'] == 1) {
        echo getHttpButton('SHOW', base_url().'processes/process_archives/update/'.$record['id'].'?from=view', 'float-right btn-info ml-5');
      }*/
?>
<?= getHttpButton('ISSUE', base_url().'processes/process_json_codes/edit/'.$record['id'], 'float-right btn-success ml-5'); ?>
<div class="clear"></div>
<?php 
  /*foreach ($record_groups as $title => $columns) {
    $this->data['columns'] = $columns;
    $this->data['title'] = $title;*/
  ?>
  
<?php $this->load->view('processes/processes/basic_info',$data);?>
  <?php $this->load->view('processes/processes/links',$data);?>
  <?php $this->load->view('processes/processes/in_out_weights',$data);?>
  <?php $this->load->view('processes/processes/in_out_purities',$data);?>
   <?php if(!empty($melting_lot_process_details)) { 
        $this->load->view('processes/processes/melting_lot_process_details',$data);
    }?>
  <?php $this->load->view('processes/processes/wastages',$data);?>
  <?php if((!empty($out_process_details)) || (!empty($hook_process_details)) || (!empty($wastage_process_details)))
    $this->load->view('processes/processes/process_details',$data);
  ?>
  <?php if(!empty($wastage_detail_names)) $this->load->view('processes/processes/wastage_details',$data);?>
  <?php if(!empty($issue_detail_names)) $this->load->view('processes/processes/issue_details',$data);?>
  <?php
  // if(!empty($record['accept_packing_list'])) $this->load->view('processes/processes/packing_slip_details',$data);?>
 <?php //} ?>
