<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update' || $action == 'create' || $action == 'store'):
        load_field('hidden', array('field' => 'id'));
      endif;

      load_field('text', array('field' => 'purity'));
      load_field('text', array('field' => 'design_code'));
      if ($action == 'edit' || $action == 'update'){
        $options=array(
          array('id'=>00,'name'=>00),
          array('id'=>50,'name'=>50),
          array('id'=>60,'name'=>60),
          array('id'=>70,'name'=>70),
          array('id'=>75,'name'=>75),
          array('id'=>80,'name'=>80),
          array('id'=>100,'name'=>100)
        );
      }else{
        $options=array(
          array('id'=>00,'name'=>00),
          array('id'=>50,'name'=>50),
          array('id'=>60,'name'=>60),
          array('id'=>70,'name'=>70),
          array('id'=>75,'name'=>75),
          array('id'=>80,'name'=>80),
          array('id'=>100,'name'=>100,'selected'=>'selected')
        );

      }
      load_field('dropdown', array('field' => 'percentage',
                                          'option'=>$options,
                                         'onchange'=>"yellow_change_value_on_select_percentage()")); 
    ?>  
  </div>
 
  <div class="col-md-12">
    <div class="float-right">
        <?= getJsButton('Add More', 'javascript:void(0)', 'btn-sm underline text-blue float-right bold mb-1', '', 'add_yellow_qr_codes()'); ?>
    </div>
    <div class="table-responsive">
      <table border="0" class="table table-sm table-default">
        <th>Item Code</th>
        <th>Gross Weight</th>
        <!-- <th>HU ID</th> -->
        <th>Disptch Weight</th>
        <th>Net Weight</th>
        <th>Less</th>
        <th>Total Less</th>
        <th>KM</th>
        <th>Stone Weight(ST)</th>
        <th>Other Stone(CZ)</th>
        <!-- <th>Stone Count</th> -->
        <tbody id="yellow_qr_code">
        <?php 
        foreach ($yellow_qr_code_details as $index => $yellow_qr_code_detail) {
          $this->load->view('qr_codes/yellow_qr_codes/subform', array('index' =>$index)); 
        }?>
        </tbody>
      </table>
    </div>
    <div class="row">
      <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue'));?>
    </div>
  </div> 
</form>
<script>
  <?php 
  $yellow_qr_code_form_html = $this->load->view('../yellow_qr_codes/subform',
                                                array('index' => 'index_count',
                                                      'image_url'=>''),TRUE);?>
   var yellow_qr_code_form_html = <?= json_encode(array('html' => $yellow_qr_code_form_html)); ?>;
   //var fields_index_img = 1;
   var fields_index = <?= time() ?>;
  function add_yellow_qr_codes() {
    var html_str = yellow_qr_code_form_html.html.replace(/\index_count/g, fields_index);
    $('#yellow_qr_code').append(html_str);
    fields_index += 1;
    $('.selectpicker').selectpicker('refresh');
    return false;
  }
  function delete_yellow_qr_codes(index) {
    //$("input[name*='qr_code_details["+index+"][delete]']").val(1);
    $(".yellow_qr_codes_"+index).remove();
  }
</script>

