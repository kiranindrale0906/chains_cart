<div class="boxrow mb-2">
  <div class="float-left">
    <h6 class="heading blue bold text-uppercase mb-0">Length</h6>
  </div>
  <input type="hidden" class="append_json_data">
  <div class="float-right">
    <?php if(isset($_GET['cart']) && $_GET['cart']=='new_cart') {?>
      <?= getAjaxButton('Open Cart',ADMIN_PATH.'lengths/lengths/view/1', 'btn_blue'); ?>
      <a name="Cancel" class="btn btn btn-sm btn_red" href="<?= ADMIN_PATH?>lengths/lengths/index"><i class=""></i>  Cancel</a>
    <?php } else { ?>
      <a name="Show Cart" class="btn btn btn-sm btn_blue" href="<?= ADMIN_PATH?>lengths/length_carts/view/<?=$length_carts['id']?>" target="_blank"><i class=""></i>  Show Cart</a>
      <a name="New Cart" class="btn btn btn-sm btn_blue" href="?cart=new_cart"><i class=""></i>  New Cart</a>
    <?php } ?>
  	<a name="Add Length" class="btn btn btn-sm btn_blue" href="<?= ADMIN_PATH?>lengths/lengths/create"><i class=""></i>  Add Length</a>
  	
  </div>
</div>
<div class="table-responsive tablefixedheader">
  <table class="table table-sm fixedthead table-default">
    <thead>
      <tr>
        <th>Design Code</th>
        <th>Range</th>
        <th class="text-right">Weight</th>
        <th class="text-right">Length</th>
        <th class="text-right">Weight/Length</th>
        <?php for($i=17.75;$i<=24;$i=$i+0.25) {?>
        <th class="text-right"><?= $i?></th>
        <?php } ?>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($lengths)) { 
        foreach ($lengths as $length) {
          $weight_by_length = $length['weight']/$length['length'];
      ?>
      <tr>
        <td><?= $length['design_code']?></td>
        <td><?= $length['range']?></td>
        <td class="text-right"><?= $length['weight']?></td>
        <td class="text-right"><?= $length['length']?></td>
        <td class="text-right"><?= number_format($weight_by_length,2)?></td>
        <?php 
          for($i=17.75;$i<=24;$i=$i+0.25) {
            $weight_by_length_value = number_format($weight_by_length*$i,2);
            $set_color = FALSE;
            foreach ($length_cart_details as $index => $length_cart_detail) { 
              if(($length_cart_detail['design_code'] == $length['design_code']) && ($length_cart_detail['range'] == $length['range']) 
                      && ($length_cart_detail['selected_value'] == $weight_by_length_value)) {
                $set_color = TRUE;
                break;
              } 
            }
        ?>
        <!--<td class="text-right length_add_to_cart"><?= $weight_by_length_value ?></td>-->
        <?php if($set_color && !isset($_GET['cart'])) { ?>
          <td class="text-right length_add_to_cart highlited_field"><?= $weight_by_length_value ?></td>
        <?php } else { ?>
          <td class="text-right length_add_to_cart"><?= $weight_by_length_value ?></td>
        <?php } }?>
          <td class="action_btn text-nowrap">
            <a href="<?= ADMIN_PATH?>lengths/lengths/edit/<?= $length['id']?>" class="btn btn-xs btn_green">edit</a>
            <a href="<?= ADMIN_PATH?>lengths/lengths/delete/<?= $length['id']?>" class="btn btn-xs btn_red">delete</a>
          </td>
      </tr>
      <?php } } else {?>
        <tr>
          <td colspan="5">No data found.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>