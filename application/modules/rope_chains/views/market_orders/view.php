<div class="row">
  <div class="col text-left mb-3">
    <h6 class="heading blue bold text-uppercase mb-0">Market Order</h6>
  </div>
  <div class="col text-left mb-3">
    <?= getHttpButton('Create Custom Bunch Order Details', base_url().'rope_chains/bunch_order_details/create?market_order_id='.$record['id'], 'float-right btn-success ml-5');?>
    <?= getHttpButton('Create Custom Market Order Details', base_url().'rope_chains/custom_market_order_details/create?market_order_id='.$record['id'], 'float-right btn-success ml-5');?>
    <?php if($record['market_order_status']=="rejected"){
        echo getHttpButton('Market Order Accept', base_url().'rope_chains/market_order_archives/update/'.$record['id'].'?from=view&status=accepted', 'float-right btn-success ml-5');
        }elseif($record['market_order_status']=="accepted"){
        echo getHttpButton('Market Order Rejected', base_url().'rope_chains/market_order_archives/update/'.$record['id'].'?from=view&status=rejected', 'float-right btn-danger ml-5');
        }else{
          echo getHttpButton('Market Order Rejected', base_url().'rope_chains/market_order_archives/update/'.$record['id'].'?from=view&status=rejected', 'float-right btn-danger ml-5');
         echo getHttpButton('Market Order Accept', base_url().'rope_chains/market_order_archives/update/'.$record['id'].'?from=view&status=accepted', 'float-right btn-success ml-5');
        }
      ?>
  </div>
</div>
<div class="row"> 
    <?php if(empty($_GET['single_order'])){ load_field('label_with_value', array('field' => 'customer_name'));} ?> 
    <?php load_field('label_with_value', array('field' => 'melting')) ?> 
    <?php load_field('label_with_value', array('field' => 'date','value'=>date('d-m-Y',strtotime($record['date'])))) ?> 
    <?php load_field('label_with_value', array('field' => 'due_date','value'=>date('d-m-Y',strtotime($record['due_date'])))) ?> 
    <?php load_field('label_with_value', array('field' => 'description')) ?> 
    <?php load_field('label_with_value', array('field' => 'market_order_status')) ?> 
</div>

<div class="">
  <h6 class="bold float-left">Standard and Custom Sizes</h6>
  <div class="table-responsive">
    <table class="table table-sm">
      <thead class="bg_gray">
        <tr>
          <?php if($factory_details==1){?>
          <th>Category Name</th>  
          <th>Design Name</th>  
          <th>Wire Size</th>  
          <?php }?>
          <th>Thickness</th>
          <th>Langdi Weight</th> 
          <th>Kdm AU+Fe</th> 
          <th>Kdm Joinning</th> 
          <th>Hook No</th> 
          <th>Hook Quantity</th> 
          <th>Hook Weight</th> 
          <th>Lopster No</th> 
          <th>Lopster Quantity</th> 
          <th>Lopster Weight</th> 
          <th>S No</th> 
          <th>S Quantity</th> 
          <th>S Weight</th> 
          <th>Description</th>  
          <th>Lot No</th>  
          <th>Status</th>  
          <th>Total Weight</th>  
          <th>Size</th>
          <th></th>
          </tr>
      </thead>
      <tbody>
        <?php
        // pd($order_details);
        $sizes="";
        if(!empty($order_details)) {
          $inch_qty=$inch_size=$pending_qty=$in_production_qty=$ready_qty=$total_wt_per_inch_on_stock_used=$total_wt_per_inch=$total_weight=0;
            $wt_per_inch= $wt_per_inch_size=0;
          foreach ($order_details as $index => $order_detail) {
            $langdi_weight = ($order_detail['total_weight'] * ($order_detail['langdi_percentage']/100)) + $order_detail['total_weight']; 
            $kdm_percentage_au_plus_fe = $langdi_weight * ($order_detail['kdm_percentage_au_plus_fe']/100);
            $kdm_percentage_joinning = ($order_detail['total_weight'] * ($order_detail['kdm_percentage_joinning']/100));
            
            $inch_qty+=$order_detail['inch_qty'];
            $inch_size+=$order_detail['inch_size'];
            $total_weight+=$order_detail['total_weight'];
            if ($order_detail['wt_in_18_inch'] != 0)
              $wt_per_inch_size = $order_detail['wt_in_18_inch'] / 18;
            elseif ($order_detail['wt_in_24_inch'] != 0)
              $wt_per_inch_size = $order_detail['wt_in_24_inch'] / 24;
            
            $wt_per_inch=round($wt_per_inch_size,4);
            $total_wt_per_inch+=$order_detail['inch_qty']*$order_detail['inch_size']* $wt_per_inch;
            $total_wt_per_inch_on_stock_used+=($order_detail['inch_qty']-$order_detail['stock_used_qty'])*$order_detail['inch_size']* $wt_per_inch;
                $sizes=explode(',',$order_detail['size']);
                $qtys=explode(',',$order_detail['qty']);
                $id=explode(',',$order_detail['ids']);
            $total_qtys = 0;

            foreach ($qtys as $qty_index => $qty_value) {
                $total_qtys +=  $qty_value;
            }
            $hook_quantity = $total_qtys * $order_detail['hook_quantity'];
            $lopster_quantity = $total_qtys * $order_detail['lopster_quantity'];
            $s_quantity = $total_qtys * $order_detail['s_quantity'];
            
            $hook_weight = ($order_detail['hook_quantity'] > 0) ? ($order_detail['hook_weight']/$order_detail['hook_quantity']) * $hook_quantity : 0 ;
            $lopster_weight = $lopster_quantity*$order_detail['lopster_weight'];
            $s_weight = ($order_detail['s_quantity'] > 0) ? ($order_detail['s_weight']/$order_detail['s_quantity']) * $s_quantity : 0;
            
            ?>
            
            <tr>
              <?php if($factory_details==1){?>
              <td><?php echo $order_detail['category_name']?></td>  
              <td><?php echo $order_detail['design_name']?></td>  
              <td><?php echo $order_detail['wire_size']?></td>  
              <?php }?>
              <td><?=$order_detail['thickness']?></td>
              <td><?=$langdi_weight?></td>
              <td><?=$kdm_percentage_au_plus_fe?></td>
              <td><?=$kdm_percentage_joinning?></td>
              <td><?=$order_detail['hook_no']?></td>
              <td><?=$hook_quantity?></td>
              <td><?=$hook_weight?></td>
              <td><?=$order_detail['lopster_no']?></td>
              <td><?=$lopster_quantity?></td>
              <td><?=$lopster_weight?></td>
              <td><?=$order_detail['s_no']?></td>
              <td><?=$s_quantity?></td>
              <td><?=$s_weight?></td>
              <td><?php echo $order_detail['description'];?></td>
              <td><?php echo $order_detail['lot_no'];?></td>
              <td><?php echo $order_detail['status'];?></td>
              <td><?php echo $order_detail['total_weight'];?></td>
              <td>

                <table>
                  <tr>
                    <?php foreach ($sizes as $size_index => $size_value) { ?>
                     <td><a href="<?=base_url().'rope_chains/custom_market_order_details/edit/'.$id[$size_index].'?market_order_id='.$record['id']?>">
                     <?=$size_value?></a></td>
                    <?php } ?>
                  </tr>
                  <tr>
                    <?php foreach ($qtys as $qty_index => $qty_value) { ?>
                      <td><a href="<?=base_url().'rope_chains/custom_market_order_details/edit/'.$id[$qty_index].'?market_order_id='.$record['id']?>">
                    <?=$qty_value?></a></td>
                    <?php } ?>
                  </tr>
                </table>
              </td>
              <td>
              <?php if(!empty($order_detail['status']) && $order_detail['status']=="Ready"){ ?> 
              <a href="<?=base_url().'rope_chains/custom_market_order_lot_nos/edit/1?market_order_ids='.$order_detail['ids'].'&id = '.$record['id']?>"> 
                    Update Lot No</a>
                <?php } if(!empty($order_detail['status']) && $order_detail['status']!="Ready"){ ?> 
                <a href="<?=base_url().'rope_chains/custom_market_order_details/delete/'.$record['id'].'?market_detail_id='.$order_detail['ids']?>" class="red"> 
                    Delete</a>
                  <?php }?>
              </td>
                
              </tr>
            
      <?php  }?>
      <tr class="bg_gray bold">
              <td>Total</td>
              <?php if($factory_details==1){?>
              <td colspan = 18></td>
              <?php }?>
              <td><?=$total_weight?></td>
              <td colspan = 2></td>
              </tr>
      <?php }else{ ?>
          <tr>
            <td class="text-center" colspan="10">Not Found Payment History</td>
          </tr>
      <?php }?>
      
      </tbody>
    </table>
  </div>
</div>
<div class="">
  <h6 class="bold float-left">Bunch Order Details</h6>
  <div class="table-responsive">
    <table class="table table-sm">
      <thead class="bg_gray">
        <tr>
          <?php if($factory_details==1){?>
          <th>Category Name</th>  
          <th>Design Name</th>  
          <th>Line</th>  
          <th>Gauge</th>   
          <?php }?>
          <th>Market Design Name</th>  
          <th>Description</th> 
          <th>Lot No</th> 
          <th>Status</th> 
          <th>Bunch Weight</th> 
          <th>Bunch Length</th>
          <th>Per Inch Weight</th>
          <th>Estimate Bunch Weight</th> 
          <th></th> 
          <th></th> 
          </tr>
      </thead>
      <tbody>
        <?php

        if(!empty($bunch_order_details)) {
          $bunch_weight=$inch_qty=$bunch_length=$per_inch_weight=$estimate_bunch_weight=0;
          foreach ($bunch_order_details as $index => $bunch_order_detail) {

            $bunch_weight+=$bunch_order_detail['bunch_weight'];
            $bunch_length+=$bunch_order_detail['bunch_length'];
            $per_inch_weight+=$bunch_order_detail['per_inch_weight'];
            $estimate_bunch_weight+=$bunch_order_detail['estimate_bunch_weight'];
            ?>
            <tr>
              <?php if($factory_details==1){?>
              <td><?php echo $bunch_order_detail['category_name']?></td>  
              <td><?php echo $bunch_order_detail['design_name']?></td>  
              <td><?php echo $bunch_order_detail['line']?></td>  
              <td><?php echo $bunch_order_detail['gauge']?></td>   
              <?php }?>
              <td><?php echo $bunch_order_detail['market_design_name'];?></td>
              <td><?php echo $bunch_order_detail['description'];?></td>
              <td><?php echo $bunch_order_detail['lot_no'];?></td>
              <td><?php echo $bunch_order_detail['status'];?></td>
              <td><?php echo $bunch_order_detail['bunch_weight'];?></td>
              <td><?php echo $bunch_order_detail['bunch_length'];?></td>
              <td><?php echo $bunch_order_detail['per_inch_weight'];?></td>
              <td><?php echo $bunch_order_detail['estimate_bunch_weight'];?></td>
              <td> <a href="<?=base_url().'rope_chains/bunch_order_details/edit/'.$bunch_order_detail['id'].'?rope_chain_factory_order_id='.$bunch_order_detail['rope_chain_factory_order_id']?>">Edit</a>
              </td>
              <td><?php if(!empty($bunch_order_detail['status']) && $bunch_order_detail['status']!="Ready"){ ?> <a href="<?=base_url().'rope_chains/bunch_order_details/delete/'.$bunch_order_detail['id']?>" class="red">Delete</a><?php }?>
              </td>
              
              </tr>
            
      <?php  }?>
       <tr class="bg_gray bold">
              <td>Total</td>
              <?php if($factory_details==1){?>
              <td></td>  
              <td></td>  
              <td></td>  
              <td></td>  
              <?php }?>
              <td></td>  
              <td></td>  
              <td></td>  
              <td><?=$bunch_weight?></td>
              <td><?=$bunch_length?></td>
              <td><?=$per_inch_weight?></td>
              <td><?=$estimate_bunch_weight?></td>
              <td></td>
              <td></td>
              </tr>
      <?php }else{ ?>
          <tr>
            <td class="text-center" colspan="10">Not Found Payment History</td>
          </tr>
      <?php }?>
      
      </tbody>
    </table>
  </div>
</div>
    <?= getHttpButton('Back', base_url().'rope_chains/market_orders', 'float-right btn-success ml-5'); ?>
</div>
