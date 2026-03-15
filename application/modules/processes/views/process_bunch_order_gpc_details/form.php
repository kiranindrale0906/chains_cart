<div class="row">
<?php   
   load_field('text', array('field' => 'gpc_out'));
   // if(!empty($customer_names)){
   //  load_field('dropdown', array('field' => 'customer_name','option'=>$customer_names));
   // }else{
   //  load_field('text', array('field' => 'customer_name'));
   // }
   
   $this->load->view('processes/process_factory_order_details/order_category_details');
?>
</div>
<!--<h6 class="bold float-left mb-0">Pending Order Details</h6>
<br>
 <div class="table-responsive">
  <table class="table table-bordered table-sm border-bottom-color">
    <thead class="bg_gray ">
      <tr>
        <th></th>
        <th>Customer Name</th>
        <th>Due Date</th>
        <th>Wt in 18 inch</th>
        <th>Wt in 24 inch</th> 
        <th>Wt per inch</th>
        <th class="text-center">Bunch Weight</th>
        <th class="text-center">Bunch Length</th>
        <th >Estimat WT</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        // if(!empty($process_bunch_order_details)){
        //   foreach($process_bunch_order_details as $index => $process_bunch_order_detail) { ?>
            <tr>
              <td>
                <?php //load_field('checkbox', array('field' => 'bunch_order_detail_id',
                //                                    'class' => 'bunch_order_detail_id',
                //                                    'index' => $index,
                //                                    'value' => 0,
                //                                    'option' => array(
                //                                                 array('chk_id' => $index,
                //                                                       'value' => $process_bunch_order_detail['bunch_order_detail_id'],
                //                                                       'label' => '',
                //                                                       'checked' => '')),
                //                                    'controller' => //'process_bunch_order_details'));?>
              </td>

              <td><?php// echo $process_bunch_order_detail['customer_name'];?></td>
              <td><?php// echo $process_bunch_order_detail['due_date']; ?></td>
              <td><?php// echo $process_bunch_order_detail['wt_in_18_inch'];?></td>
              <td><?php// echo $process_bunch_order_detail['wt_in_24_inch'];?></td>

              <td>
                <?php 
                  // $wt_per_inch=0;
                  // if ($process_bunch_order_detail['wt_in_18_inch'] != 0)
                  //   $wt_per_inch = $process_bunch_order_detail['wt_in_18_inch'] / 18;
                  // elseif ($process_bunch_order_detail['wt_in_24_inch'] != 0)
                  //   $wt_per_inch = $process_bunch_order_detail['wt_in_24_inch'] / 24;
                  
                  // echo four_decimal($wt_per_inch);
                ?>
              </td>
              <td><?php // echo $process_bunch_order_detail['bunch_weight'];?></td>
              <td><?php // echo $process_bunch_order_detail['bunch_length'];?></td>
              <td><?php // echo $process_bunch_order_detail['estimate_bunch_weight'];?></td>
              </tr>
            <?php 
          //}
        //}
      ?>
    </tbody>
  </table>
</div>  -->
<br>
<br>