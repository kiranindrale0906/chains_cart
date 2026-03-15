<style>
table, th, td {
  border:1px solid black;
  border-collapse: collapse;
  text-align: center;
  font-size:12px;
}
@media print {    
    .no-print, .no-print * {
      display: none !important;
    }
    thead {display: table-header-group;}
    @page {size: landscape}
  }
</style>
<div class="row ">
  <a  onclick="window.print()" class='btn btn-sm btn_blue float-center m-3 no-print'>Print</a>
</div>


  <table style='width:100%;margin-bottom:50px;'>
    <thead>
      <tr class="text-uppercase" >
        <th class='text-center'>Order No</th>
        <th class='text-center'>Customer Name</th>
        <th class='text-center'>Bom Factory Code</th>
        <th class='text-center'>Design Code</th>
        <th class='text-center'>Item Code</th>
        <th class='text-center'>Purity</th>
        <th class='text-center'>Ord. Date</th>
        <th class='text-center'>Del. Date</th>
        <th class='text-center'>Length</th>
        <th class='text-center'>Gr. Wt</th>
        <th class='text-center'>Net. Wt</th>
        <th class='text-center'>Ord Qty</th>
        <th class='text-center'>Pending Qty</th>
        <th class='text-center'>Disp. Qty</th>
      </tr>
    </thead>
    <?php 
//pd($generate_lot_qr_code_details);
 $weight=$dispatch_qty=$order_qty=$pending_qty=$net_weight=0;
 foreach($generate_lot_qr_code_details as $key => $value) {
 $weight+=$value['weight'];
 $order_qty+=$value['order_qty'];
 $pending_qty+=$value['pending_qty'];
 $dispatch_qty+=$value['dispatch_qty'];
 $net_weight+=$value['net_weight'];
?>
    <tbody class="bold text-uppercase">
       <td class='text-center'><?=$value['order_no']?></td>
       <td class='text-center'><?=$value['customer_name']?></td>
       <td class='text-center'><?=$value['bom_factory_code']?></td>
       <td class='text-center'><?=$value['design_code']?></td>
       <td class='text-center'><?=$value['item_code']?></td>
       <td class='text-center'><?=$value['purity']?></td>
       <td class='text-center'><?=$value['order_date']?></td>
       <td class='text-center'><?=$value['due_date']?></td>
       <td class='text-center'><?=$value['length']?></td>
       <td class='text-center'><?=$value['weight']?></td>
       <td class='text-center'><?=$value['net_weight']?></td>
       <td class='text-center'><?=$value['order_qty']?></td>
       <td class='text-center'><?=$value['pending_qty']?></td>
       <td class='text-center'><?=$value['dispatch_qty']?></td>
    </tbody>

 <?php     } ?>
   <tr class=" bold">
      <td>Total</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td><?=four_decimal($weight)?></td>
      <td><?=four_decimal($net_weight)?></td>
      <td><?=$order_qty?></td>
      <td><?=$pending_qty?></td>
      <td><?=$dispatch_qty?></td>
   </tr>
    </table>
  
