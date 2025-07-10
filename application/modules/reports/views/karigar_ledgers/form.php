 <div class="row">
<?php
          load_field('dropdown', array('field' => 'karigar',
                                       'class' => 'karigar',
                                       'col' => 'col-md-4',
                                       'option' => $karigars));
          load_field('dropdown', array('field' => 'purity',
                                       'class' => '',
                                       'col' => 'col-md-4',
                                       'option' => $purity)); 
        
?> </div>  
<?php $this->load->view('issue_and_receipts/ledgers/form');?>