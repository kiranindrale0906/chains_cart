<div>
<?php //pd(validation_errors(),0); ?>
  <h6 class="bold float-left mb-0">Custom Market Order Details</h6>
  <?= getJsButton('Add More', 'javascript:void(0)', 'btn_blue float-right mb-1', '', 'add_form_custom_market_order()'); ?>
</div>
<div class="table-responsive">
  <table class="table table-sm">
    <thead class="bg_gray">
      <tr>
          <th>Design Name</th>
          <th>Description</th>
          <th>Inch Size</th>
          <th>Inch Qty</th>
          <th></th>
      </tr>
    </thead>
    <tbody id="table_custom_market_order">
      <?php 
      if(!empty($market_order_details))
      foreach($market_order_details as $index => $value) {
        $this->load->view('rope_chains/market_order_details/custom_subform', array('index' =>$index)); 
      }else{?><?php 
        $this->load->view('rope_chains/market_order_details/custom_subform', array('index' =>1));
      }?>
    </tbody>
  </table>
</div> 
<hr/>
<script>
  <?php $custom_market_order_form_html = $this->load->view('rope_chains/market_order_details/custom_subform',
                                                 array('index' => 'index_count'),TRUE);?>
  var custom_market_order_form_html = <?= json_encode(array('html' => $custom_market_order_form_html)); ?>;
  var fields_index_custom_market_order  = 1;
  
  function add_form_custom_market_order() {
    fields_index_custom_market_order += 1;
    var custom_html_str = custom_market_order_form_html.html.replace(/\index_count/g, fields_index_custom_market_order);
    $('#table_custom_market_order').append(custom_html_str);
    return false;
  }
  function delete_custom_market_order(index){
    $(".table_custom_market_order_"+index).remove();
  }

</script>