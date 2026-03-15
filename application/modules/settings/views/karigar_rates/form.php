<?php //pd($record);  ?>
<?php echo form_open_multipart(get_form_action($controller,$action, $record), 'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
      load_field('hidden', array('field' => 'page_no','name'=>'page_no','value'=>@$page_no));
    ?>
    <?php load_field('dropdown', array('field' => 'product_name', 'option' => $products, 'id' => 'product'));?>
    <?php load_field('dropdown', array('field' => 'process_name', 'option' => $processes, 
                                       'id' => 'process'));?>
    <?php load_field('dropdown', array('field' => 'department_name', 'option' => $departments, 
                                       'id' => 'department'));?>
    <?php load_field('dropdown', array('field' => 'karigar_name', 'option' => $karigars, 
                                       'id' => 'karigar', 'col'=>'col-md-6 k_rate_karigar_name'));?>
    
    <?php load_field('dropdown', array('field' => 'category','option'=> @$category_list,
                                       'id' => 'category', 'col'=>'col-md-6 k_rates_category'));?>
    <?php load_field('dropdown', array('field' => 'wire_size', 'option' => @$wire_size_list,
                                       'id' => 'wire_size', 'col'=>'col-md-6 k_rates_wire_size'));?>
                                   
    <?php load_field('dropdown', array('field' => 'design_code', 'option' => @$design_codes, 
                                       'id' => 'design_code', 'col'=>'col-md-6 k_rates_design_code'));?>

    <?php load_field('dropdown', array('field' => 'purity', 'option' => @$purities, 'id' => 'purities',
                                       'col'=>'col-md-6 k_rates_puirty'));?>
                                                                       
    <?php load_field('dropdown', array('field' => 'code','option' => @$code_list,
                                       'id' => 'code', 'col'=>'col-md-6 k_rates_code'));?>
    <?php load_field('dropdown', array('field' => 'check_field','option' => @$check_fields,
                                       'id' => 'check_field', 'col'=>'col-md-6 k_rates_check_field'));?>
    <?php load_field('text', array('field' => 'rate'));?>
    <?php //load_field('text', array('field' => 'no_of_workers'));?>
  </div>
  <hr>
  <h6 class="bold">No Of Workers Details</h6>
  <div class="col-md-12">
    <div class="float-right">
        <?= getJsButton('Add More', 'javascript:void(0)', 'btn-sm underline text-blue float-right bold mb-1', '', 'add_karigar_rate_workers()'); ?>
    </div>
    <div class="table-responsive">
      <table border="0" class="table table-sm table-default">
        <th>Date</th>
        <th>No Of Worker</th>
        <tbody id="karigar_rate_worker">
        <?php 
        foreach ($karigar_rate_worker_details as $index => $karigar_rate_worker_detail) {
          $this->load->view('settings/karigar_rates/subform', array('index' =>$index)); 
        }?>
        </tbody>
      </table>
    </div>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>

<script>
  var dropdown_data = <?php echo json_encode($dropdown_data); ?>;
  var category_one = <?= json_encode(get_category_one()) ?>;
  var category_two = <?= json_encode(get_category_two()) ?>;
  var category_three = <?= json_encode(get_category_three()) ?>;

</script>
<script>
  <?php 
  $karigar_rate_worker_form_html = $this->load->view('../karigar_rates/subform',
                                                array('index' => 'index_count',
                                                      'image_url'=>''),TRUE);?>
   var karigar_rate_worker_form_html = <?= json_encode(array('html' => $karigar_rate_worker_form_html)); ?>;
   var fields_index_img = 1;
  function add_karigar_rate_workers() {
    if(fields_index_img<4){
    fields_index_img += 1;
      var html_str = karigar_rate_worker_form_html.html.replace(/\index_count/g, fields_index_img);
      $('#karigar_rate_worker').append(html_str);
    }
    return false;
  }
  function delete_karigar_rate_workers(index) {
    $("input[name*='karigar_rate_worker_details["+index+"][delete]']").val(1);
    $(".karigar_rate_workers_"+index).hide();
  }
</script>

