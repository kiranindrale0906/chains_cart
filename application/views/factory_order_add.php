div id="container" class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="text-center">Add Factory Orders</h2>
            <br><br>
            <?php $id=!empty($record['id'])?"/".$record['id']:''?>
          <form method="post" action="<?php echo site_url('factory_orders/'.$action.$id); ?>" name="data_register">
            <label for="Customer Name">Customer Name</label><br>
              <input type="text" class="form-control" name="factory_orders[customer_name]" value="<?=!empty($record['customer_name'])?$record['customer_name']:""?>">
              <?php  if(form_error('factory_orders[customer_name]'))
                { 
                  echo "<span style='color:red'>".form_error('factory_orders[customer_name]')."</span>";
                } 
                ?>
            <br><br>
            <label for="Melting">Melting</label><br>
              <select name="factory_orders[melting]" > 
                 <?php foreach($meltings as $index => $value){ ?>
                    <option value="<?=!empty($record['melting'])?$record['melting']:$value['id']?>"><?php echo $value['name']; ?></option> 
                  <?php } ?>
              </select>
              <?php  if(form_error('factory_orders[melting]'))
                { 
                  echo "<span style='color:red'>".form_error('factory_orders[melting]')."</span>";
                } 
                ?>
              <br><br>
            <label for="Sex">Date</label><br>
               <input type="date" name="factory_orders[date]" value="<?=!empty($record['date'])?date('Y-m-d',strtotime($record['date'])):date('Y-m-d'); ?>" />&nbsp;
                <?php  if(form_error('factory_orders[date]'))
                { 
                  echo "<span style='color:red'>".form_error('factory_orders[date]')."</span>";
                } 
                ?>
            <br><br>
            <label for="Email">Due Date</label><br>
               <input type="date" name="factory_orders[due_date]" value="<?=!empty($record['due_date'])?date('Y-m-d',strtotime($record['due_date'])):date('Y-m-d'); ?>" />&nbsp;
               <?php  if(form_error('factory_orders[due_date]'))
                { 
                  echo "<span style='color:red'>".form_error('factory_orders[due_date]')."</span>";
                } 
                ?>

            <br><br>
              
    <div>
      <h6 class="bold float-left mb-0">FACTORY ORDERS DETAILS</h6>
      </div>
        <div class="float-right"> 
        <a class='btn btn-danger' onclick="add_form_ka_chain_factory_order(<?=count(@$factory_order_details)?>)">Add More</a>
        </div>
    <div class="table-responsive">
      <table class="table table-sm">
        <thead class="bg_gray">
          <tr>
              <th>Market Design Name</th>
              <th>14 Inch Qty</th>
              <th>15 Inch Qty</th>
              <th>16 Inch Qty</th>
              <th>18 Inch Qty</th>
              <th>20 Inch Qty</th>
              <th>22 Inch Qty</th>
              <th>24 Inch Qty</th>
              <th>26 Inch Qty</th>
              <th>28 Inch Qty</th>
              <th>30 Inch Qty</th>
          </tr>
        </thead>
        <tbody id="table_ka_chain_factory_order">
          <?php 
          if(!empty($factory_order_details)){
          foreach($factory_order_details as $index => $value) {
            $this->load->view('factory_order_detail_subform', array('index' =>$index,'factory_order_detail'=>$value)); 
          }}?>
        </tbody>
      </table>
    </div> 
</div>
<button type="submit" class="btn btn-primary pull-right">Submit</button>
<br><br>
</form>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>

  <?php $ka_chain_factory_order_form_html = $this->load->view('factory_order_detail_subform',array('index' => 'index_count'),TRUE);?>
  
  var ka_chain_factory_order_form_html = <?= json_encode(array('html' => $ka_chain_factory_order_form_html)); ?>;
  var fields_index_ka_chain_factory_order = 1;
  
  function add_form_ka_chain_factory_order($index) {
    fields_index_ka_chain_factory_order += $index;
    var html_str = ka_chain_factory_order_form_html.html.replace(/\index_count/g, fields_index_ka_chain_factory_order);
    $('#table_ka_chain_factory_order').append(html_str);
    return false;
  }
  function delete_ka_chain_factory_order(index){
    $(".table_ka_chain_factory_order_"+index).remove();
  }

function on_change_market_design_name(index){
    var url = window.location.href;
    var new_url = url.substr(url.lastIndexOf('/') +1);
    var new_url = url.split(new_url)[0];
    url=new_url+"factory_order_master_list";
    
  $('input[name="factory_order_details['+index+'][market_design_name]"]').autocomplete({
    source: function( request, response ) {
      // Fetch data
      $.ajax({
        url: url,
        type: 'post',
        dataType: "json",
        data: {
          search: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    select: function (event, ui) {
      $('input[name="factory_order_details['+index+'][market_design_name]"]').val(ui.item.label); // display the selected text
      return false;
    }
  });
}
</script>
<style type="text/css">
  .ui-helper-hidden-accessible { display:none; }
</style>