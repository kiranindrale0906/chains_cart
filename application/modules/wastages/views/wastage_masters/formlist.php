<div>
<?php //pd(validation_errors(),0); ?>
  <h6 class="bold float-left mb-0">Wastage Details</h6>
  <?= getJsButton('Add More', 'javascript:void(0)', 'btn_blue float-right mb-1', '', 'add_form_wastage()'); ?>
</div>
<div class="table-responsive">
  <table class="table table-sm">
    <thead class="bg_gray">
      <tr>
          <th>Chain </th> 
      <th>Category</th>
      <th>Tone</th>
      <th>Purity</th>
      <th>Machine Size</th>
      <th>Design</th>
      <th>Wastage</th>
      <th>Factory Purity</th>
      <th>Sequence</th>
                                   
      </tr>
    </thead>
    <tbody id="table_wastage">
      <?php
      $total_lot_weight = 0; 
      if(!empty($wastage_details)){
        foreach($wastage_details as $index => $value) {
          $this->load->view('wastage_masters/subform', array('index' =>$index,'value'=>$value)); 
        }
      }else{?><?php 
        $this->load->view('wastage_masters/subform', array('index' =>1));
      }?>
    </tbody>
  </table>
</div> 
<hr/>
<script>
  <?php $order_form_html = $this->load->view('wastage_masters/subform',
                                                 array('index' => 'index_count'),TRUE);?>
  var order_form_html = <?= json_encode(array('html' => $order_form_html)); ?>;
  var fields_index_order = 1;
  
  function add_form_wastage() {
    fields_index_order += 1;
    var html_str = order_form_html.html.replace(/\index_count/g, fields_index_order);
    $('#table_wastage').append(html_str);
    return false;
  }
  function delete_wastage_master(index){
    $(".table_wastage_"+index).remove();
  }

</script>
