
<style>
@media print {    
  .no-print, .no-print * {
    display: none !important;
  }
  .heading,.ajax_post {
    display: none !important;
  }
}
</style>
<?php if(empty($_GET['print_page'])){ ?>
<div class="row no-print">
  <?php
    load_field('text', array('field' => 'out_weight'));
    load_field('dropdown', array('field' => 'next_department_karigar','option'=>process_wise_karigar_name('KA Chain', '', 'Hook')));
    $this->load->view('processes/process_factory_order_details/order_category_details');
    //load_field('text', array('field' => 'factory_order_weight', 'class'=>'factory_order_weight', 'readonly'=>'readonly'));
   // }     
  ?>

</div> 

<a href="<?=base_url()."processes/process_fields/create/".$record['process_id']."?field_name=out_weight&&product_name=".$record['product_name']."&&process_name=".$record['process_name']."&&department_name=".$record['process_name']."&&process_details_fields=null&&process_factory_order_detail=1&&print_page=1"?>" class="no-print">Print</a>
<?php }?>
<?php
    $this->load->view('process_factory_order_details/formlist');
?>
<style type="text/css">

  @page { 
    margin: 0mm; 
    size: 4cm 6cm ;
    size: landscape;
  }
</style>

