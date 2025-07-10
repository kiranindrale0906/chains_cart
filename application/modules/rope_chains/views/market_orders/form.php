<form method="post" class="form-horizontal fields-group-sm form_radius_none" id="myForm" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">  
  <div class="row">
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>
    <?php load_field('label_with_value', array('field' => 'id'));?>
    <?php load_field('hidden', array('field' => 'product_name','value' => "Rope Chain")); ?>
    <?php if ($this->router->class != 'single_orders') load_field('text', array('field'  => 'customer_name')); ?>
    <?php load_field('dropdown', array('field'  => 'melting',
                                   'option'=>$meltings)); ?>
    <?php load_field('date',array('field' => 'date', 'class' => 'datepicker_js','value'=>date('Y-m-d')))?>
    <?php //load_field('date',array('field' => 'due_date', 'class' => 'datepicker_js'))?>
    <?php load_field('text', array('field'  => 'description','id'  => 'description')); ?>
    <?php //load_field('dropdown', array('field'  => 'status','id'  => 'status','option'=>array(array('id'=>'Pending','name'=>'Pending'),array('id'=>'Ready','name'=>'Ready'),))); ?>
    <?php load_field('hidden', array('field'  => 'single_order')); ?>
  </div> 
  <?php if ($action != 'edit' && $action != 'update'){ ?>                            
  <?php if($controller=="rope_chains/market_orders"){ $this->load->view('rope_chains/market_order_details/subform_list', array('index' =>'1'));} ?>
  <?php $this->load->view('rope_chains/market_order_details/custom_subform_list', array('index' =>'1')); ?>
  <?php $this->load->view('rope_chains/bunch_order_details/subform_list', array('index' =>'1')); ?>
  <?php } ?>
  <?php load_buttons('submit',array('name' => 'Save',
                                    'class' => 'btn-sm btn_blue')) ?>
</form>
<script type="text/javascript">
  document.getElementById("myForm").onkeypress = function(e) {
    var key = e.charCode || e.keyCode || 0;     
    if (key == 13) {
      //alert("No Enter!");
      e.preventDefault();
    }
  } 
</script>