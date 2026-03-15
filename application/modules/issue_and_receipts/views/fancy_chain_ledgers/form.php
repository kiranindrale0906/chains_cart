	<div class="row">
    <?php
      load_field('dropdown', array('field' => 'in_lot_purity',
                                   'option' => @$purities)); 
    ?> 
     </div>
    <?php load_buttons('button', array('name' =>'Clear','class'=>'btn-xs btn_blue clear_btn')) ?>

<?php $this->load->view('issue_and_receipts/ledgers/form'); ?>