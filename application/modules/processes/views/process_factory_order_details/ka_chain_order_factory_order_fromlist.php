<h5 class="heading">Factory Order In Process Details</h5>
<div class="table-responsive">
  <table class="table table-bordered table-sm border-bottom-color">
    <thead class="bg_gray ">
    <tr>
      <th>Customer Name</th>
      <th>Due Date</th>
      <th>Wt in 18 inch</th>
      <th>Wt in 24 inch</th>
      <th>Wt per inch</th>
      <th>14 inch Qty </th>
      <th>15 inch Qty </th>
      <th>16 inch Qty</th>
      <th>17 inch Qty</th>
      <th>18 inch Qty</th>
      <th>19 inch Qty</th>
      <th>20 inch Qty</th>
      <th>21 inch Qty</th>
      <th>22 inch Qty</th>
      <th>23 inch Qty</th>
      <th>24 inch Qty</th>
      <th>25 inch Qty</th>
      <th>26 inch Qty</th>
      <th>27 inch Qty</th>
      <th>28 inch Qty</th>
      <th>29 inch Qty</th>
      <th>30 inch Qty</th>
      <th>31 inch Qty</th>
      <th>32 inch Qty</th>
      <th>33 inch Qty</th>
      <th>34 inch Qty</th>
      <th>35 inch Qty</th>
      <th>36 inch Qty</th>
      <th>Total WT</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $total=0;
      foreach ($ka_chain_order_factory_order_details as $index => $ka_chain_order_factory_order_detail) {
        if(!empty($record['in_lot_purity'])){
          if ($record['in_lot_purity'] > 90) {
           $in_lot_purity=92;
          }else{
           $in_lot_purity=75;
          }
        }
        if($in_lot_purity==$ka_chain_order_factory_order_detail['melting']){
            $this->load->view('process_factory_order_details/ka_chain_order_factory_order_subform', array('index'=> $index, 'ka_chain_order_factory_order' => $ka_chain_order_factory_order_detail, 'total'=>$total));
        }
      }
    ?>
  </tbody>
</table>
</div>