<div class="row">                         
    <?php
      load_field('dropdown', array('field' => 'in_purity',
                                   'option' => @$purities,
                                   'class' => 'stone_ledger_processes_in_purity')); 
    ?>
    <?php
      load_field('dropdown', array('field' => 'process_name',
                                   'option' => @$process_name,
                                   'class' => 'stone_ledger_processes_process_name')); 
    ?>                              
  </div>
<?php $this->load->view('issue_and_receipts/ledgers/form'); ?>