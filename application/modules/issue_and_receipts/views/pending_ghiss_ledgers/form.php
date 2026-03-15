<div class="row">                         
    <?php
      load_field('dropdown', array('field' => 'department_name',
                                   'option' => @$departments,
                                   'class' => 'pending_ghiss_out_ledger_processes_department_name')); 
    ?>                              
  </div>
<?php $this->load->view('issue_and_receipts/ledgers/form'); ?>