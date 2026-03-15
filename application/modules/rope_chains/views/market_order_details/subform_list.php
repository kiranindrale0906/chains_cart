<div>
<?php //pd(validation_errors(),0); ?>
  <h6 class="bold float-left mb-0">Market Order Details</h6>
  <?= getJsButton('Add More', 'javascript:void(0)', 'btn_blue float-right mb-1', '', 'add_form_market_order()'); ?>
</div>
<div class="table-responsive">
  <table class="table table-sm">
    <thead class="bg_gray">
      <tr>
          <th style="width:200px;">Design Name</th>
          <th>Description</th>
          <th>14 Inch Qty</th>
          <th>15 Inch Qty</th>
          <th>16 Inch Qty</th>
          <th>17 Inch Qty</th>
          <th>18 Inch Qty</th>
          <th>19 Inch Qty</th>
          <th>20 Inch Qty</th>
          <th>21 Inch Qty</th>
          <th>22 Inch Qty</th>
          <th>23 Inch Qty</th>
          <th>24 Inch Qty</th>
          <th>25 Inch Qty</th>
          <th>26 Inch Qty</th>
          <th>27 Inch Qty</th>
          <th>28 Inch Qty</th>
          <th>29 Inch Qty</th>
          <th>30 Inch Qty</th>
          <th>31 Inch Qty</th>
          <th>32 Inch Qty</th>
          <th>33 Inch Qty</th>
          <th>34 Inch Qty</th>
          <th>35 Inch Qty</th>
          <th>1 Inch Qty</th>
          <th></th>
      </tr>
    </thead>
    <tbody id="table_market_order">
      <?php 
      if(!empty($market_order_details))
      foreach($market_order_details as $index => $value) {
        $this->load->view('rope_chains/market_order_details/subform', array('index' =>$index)); 
      }else{?><?php 
        $this->load->view('rope_chains/market_order_details/subform', array('index' =>1)); 
    
        }?>
    </tbody>
  </table>
</div> 
<hr/>
<script>
  <?php $market_order_form_html = $this->load->view('rope_chains/market_order_details/subform',
                                                 array('index' => 'index_count'),TRUE);?>
  var market_order_form_html = <?= json_encode(array('html' => $market_order_form_html)); ?>;
  var fields_index_market_order = 1;
  
  function add_form_market_order() {
    fields_index_market_order += 1;
    var html_str = market_order_form_html.html.replace(/\index_count/g, fields_index_market_order);
    $('#table_market_order').append(html_str);
    return false;
  }
  function delete_market_order(index){
    $(".table_market_order_"+index).remove();
  }

</script>