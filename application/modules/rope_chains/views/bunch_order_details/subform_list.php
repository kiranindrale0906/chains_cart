<div>
<?php //pd(validation_errors(),0); ?>
  <h6 class="bold float-left mb-0">BUNCH ORDERS DETAILS</h6>
  <?= getJsButton('Add More', 'javascript:void(0)', 'btn_blue float-right mb-1', '', 'add_form_bunch_order()'); ?>
</div>
<div class="table-responsive">
  <table class="table table-sm">
    <thead class="bg_gray">
      <tr>
          <th>Design Name</th>
          <th>Description</th>
          <th>Bunch Weight</th>
          <th>Bunch Length</th>
          <th>Per Inch Weight</th>
          <th>Estimate Bunch Weight</th>
          <th></th>
      </tr>
    </thead>
    <tbody id="table_bunch_order">
      <?php 
      if(!empty($bunch_order_details))
      foreach($bunch_order_details as $index => $value) {
        $this->load->view('rope_chains/bunch_order_details/subform', array('index' =>$index)); 
      }else{?><?php 
        $this->load->view('rope_chains/bunch_order_details/subform', array('index' =>1)); 
    
        }?>
    </tbody>
  </table>
</div> 
<hr/>
<script>
  <?php $bunch_order_form_html = $this->load->view('rope_chains/bunch_order_details/subform',
                                                 array('index' => 'index_count'),TRUE);?>
  var bunch_order_form_html = <?= json_encode(array('html' => $bunch_order_form_html)); ?>;
  var fields_index_bunch_order = 1;
  
  function add_form_bunch_order() {
    fields_index_bunch_order += 1;
    var html_str = bunch_order_form_html.html.replace(/\index_count/g, fields_index_bunch_order);
    $('#table_bunch_order').append(html_str);
    return false;
  }
  function delete_bunch_order(index){
    $(".table_bunch_order_"+index).remove();
  }

</script>