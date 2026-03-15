<h5>Factory Order Details</h5>
<div class="table-responsive">
  <table class="table table-sm table-default fixedTable_js table-bordered table-striped">
    <thead> 
        <tr> 
          <th>Order Date</th>
          <th>Due Date</th>
          <th>Customer Name</th>
          <th>Description</th>
          <th>Market Design Name</th>
          <th>Total Weight</th>
          <th>Size</th>
          <th>Status</th>
          </tr>
    </thead>
    <tbody class="">
    <?php 
    $index=1;
    $total_gross_weight=0;
    if(!empty($factory_order_details)){?>
      <?php foreach ($factory_order_details as $factory_order_detail_index => $factory_order_detail) { 
        if($factory_order_detail['single_order']==0){
        $sizes=explode(',',$factory_order_detail['size']);
        $total_gross_weight+=$factory_order_detail['total_weight'];
        $qtys=explode(',',$factory_order_detail['qty']);
          ?>
          <tr>          
              <td><?=date('d-m-Y',strtotime($factory_order_detail['created_at'])) ?></td>
              <td><?=date('d-m-Y',strtotime($factory_order_detail['due_date'])) ?></td>
              <td><?=$factory_order_detail['customer_name'] ?></td>
              <td><?=$factory_order_detail['description'] ?></td>
              <td><?=$factory_order_detail['market_design_name'] ?></td>
              <td><?=$factory_order_detail['total_weight'] ?></td>
              <td>
                <table>
                  <tr>
                    <?php foreach ($sizes as $size_index => $size_value) { ?>
                     
                     <td><?=$size_value?></td>
                    <?php } ?>
                  </tr>
                  <tr>
                    <?php foreach ($qtys as $qty_index => $qty_value) { ?>
                      
                    <td><?=$qty_value?></td>
                    <?php } ?>
                  </tr>
                </table>
              </td>
              <td><?=$factory_order_detail['status'] ?></td>
            </tr>
      <?php  }}  ?> 
      <tr class="blue bold">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?=$total_gross_weight; ?></td>
        <td></td>
        <td></td>
      </tr>
 <?php  }else{ ?>
  <tr><td>Record Not Found!</td></tr>
  <?php } ?>
    </tbody>
  </table></div>
  <h5>Single Factory Order Details</h5>
<div class="table-responsive">
  <table class="table table-sm table-default fixedTable_js table-bordered table-striped">
    <thead> 
        <tr> 
          <th>Order Date</th>
          <th>Due Date</th>
          <th>Customer Name</th>
          <th>Description</th>
          <th>Market Design Name</th>
          <th>Total Weight</th>
          <th>Size</th>
          <th>Status</th>
          </tr>
    </thead>
    <tbody class="">
    <?php 
    $index=1;
    $total_gross_weight=0;
    if(!empty($factory_order_details)){?>
      <?php foreach ($factory_order_details as $factory_order_detail_index => $factory_order_detail) {
      if($factory_order_detail['single_order']==1){
        $sizes=explode(',',$factory_order_detail['size']);
        $total_gross_weight+=$factory_order_detail['total_weight'];
        $qtys=explode(',',$factory_order_detail['qty']);
          ?>
          <tr>          
              <td><?=date('d-m-Y',strtotime($factory_order_detail['created_at'])) ?></td>
              <td><?=date('d-m-Y',strtotime($factory_order_detail['due_date'])) ?></td>
              <td><?=$factory_order_detail['customer_name'] ?></td>
              <td><?=$factory_order_detail['description'] ?></td>
              <td><?=$factory_order_detail['market_design_name'] ?></td>
              <td><?=$factory_order_detail['total_weight'] ?></td>
              <td>
                <table>
                  <tr>
                    <?php foreach ($sizes as $size_index => $size_value) { ?>
                     
                     <td><?=$size_value?></td>
                    <?php } ?>
                  </tr>
                  <tr>
                    <?php foreach ($qtys as $qty_index => $qty_value) { ?>
                      
                    <td><?=$qty_value?></td>
                    <?php } ?>
                  </tr>
                </table>
              </td>
              <td><?=$factory_order_detail['status'] ?></td>
            </tr>
      <?php  }}  ?> 
      <tr class="blue bold">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><?=$total_gross_weight; ?></td>
        <td></td>
        <td></td>
      </tr>
 <?php  }else{ ?>
  <tr><td>Record Not Found!</td></tr>
  <?php } ?>
    </tbody>
  </table></div>


  <h5>Bunch Order Details</h5>
<div class="table-responsive">
  <table class="table table-sm table-default fixedTable_js table-bordered table-striped">
    <thead> 
        <tr> 
          <th>Order Date</th>
          <th>Due Date</th>
          <th>Customer Name</th>
          <th>Description</th>
          <th>Market Design Name</th>
          <th>Bunch Weight</th>
          <th>Bunch Length</th>
          <th>Per Inch Weight</th>
          <th>Estimate Bunch Weight</th>
          <th>Status</th>
          </tr>
    </thead>
    <tbody class="">
    <?php 
    $index=1;
    if(!empty($bunch_order_details)){?>
      <?php foreach ($bunch_order_details as $bunch_order_detail_index => $bunch_order_detail) { 
        if($bunch_order_detail['single_order']==0){ 
         ?>
          <tr>           
              <td><?=date('d-m-Y',strtotime($bunch_order_detail['created_at'])) ?></td>
              <td><?=date('d-m-Y',strtotime($bunch_order_detail['due_date'])) ?></td>
              <td><?=$bunch_order_detail['customer_name'] ?></td>
              <td><?=$bunch_order_detail['description'] ?></td>
              <td><?=$bunch_order_detail['market_design_name'] ?></td>
              <td><?=$bunch_order_detail['bunch_weight'] ?></td>
              <td><?=$bunch_order_detail['bunch_length'] ?></td>
              <td><?=$bunch_order_detail['per_inch_weight'] ?></td>
              <td><?=$bunch_order_detail['estimate_bunch_weight'] ?></td>
              <td><?=$bunch_order_detail['status'] ?></td>
            </tr>
      <?php  }}  ?> 
 <?php  }else{ ?>
  <tr><td>Record Not Found!</td></tr>
  <?php } ?>
    </tbody>
  </table></div>

    <h5>Single Bunch Order Details</h5>
<div class="table-responsive">
  <table class="table table-sm table-default fixedTable_js table-bordered table-striped">
    <thead> 
        <tr> 
          <th>Order Date</th>
          <th>Due Date</th>
          <th>Customer Name</th>
          <th>Description</th>
          <th>Market Design Name</th>
          <th>Bunch Weight</th>
          <th>Bunch Length</th>
          <th>Per Inch Weight</th>
          <th>Estimate Bunch Weight</th>
          <th>Status</th>
          </tr>
    </thead>
    <tbody class="">
    <?php 
    $index=1;
    if(!empty($bunch_order_details)){?>
      <?php foreach ($bunch_order_details as $bunch_order_detail_index => $bunch_order_detail) {
        if($bunch_order_detail['single_order']==1){ 
         ?>
          <tr>           
              <td><?=date('d-m-Y',strtotime($bunch_order_detail['created_at'])) ?></td>
              <td><?=date('d-m-Y',strtotime($bunch_order_detail['due_date'])) ?></td>
              <td><?=$bunch_order_detail['customer_name'] ?></td>
              <td><?=$bunch_order_detail['description'] ?></td>
              <td><?=$bunch_order_detail['market_design_name'] ?></td>
              <td><?=$bunch_order_detail['bunch_weight'] ?></td>
              <td><?=$bunch_order_detail['bunch_length'] ?></td>
              <td><?=$bunch_order_detail['per_inch_weight'] ?></td>
              <td><?=$bunch_order_detail['estimate_bunch_weight'] ?></td>
              <td><?=$bunch_order_detail['status'] ?></td>
            </tr>
      <?php  }}  ?> 
 <?php  }else{ ?>
  <tr><td>Record Not Found!</td></tr>
  <?php } ?>
    </tbody>
  </table></div>
   