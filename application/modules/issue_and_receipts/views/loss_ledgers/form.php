
<h6> <a class="ml-3 " href='<?= base_url() ?>issue_and_receipts/combine_loss_ledgers'>All Combine Record</a>
  <a class="ml-3 " href='<?= base_url() ?>reports/department_loss_reports'>Department Loss Record</a>
  </h6>
<div class="row">
  <?php load_field('dropdown',array('field' => 'department_name', 'col'=>'col-sm-4','option'=>$department_name))?> 
</div>
    <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs btn_blue clear_btn')) ?>
<?php $this->load->view('issue_and_receipts/ledgers/form');?>