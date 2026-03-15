<div class="row">
      <?php load_field('dropdown',array('field' => 'alloy_name', 'col'=>'col-sm-4','option'=>$alloy_names))?> 
    </div>
    <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs btn_blue clear_btn')) ?>
<?php $this->load->view('issue_and_receipts/ledgers/form'); ?>