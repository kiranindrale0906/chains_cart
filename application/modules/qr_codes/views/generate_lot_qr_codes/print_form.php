<h5 class="heading">Tagging</h5>
<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action('qr_codes/generate_lot_qr_codes','store?print='.$_GET['print'], @$record) ?>>

<table class="table table-sm table_blue" id="tblAddRow">
  <thead>
    <tr><th><?php
     load_field('hidden', array('field' => 'print','name' => 'print','value' => $_GET['print']));
     load_buttons('anchor', array('name'=>'Select All', 'class'=>'blue qr_code_detail_select_all')); ?></th>
      <th>Lot No</th>
      <th>Created Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(!empty($tagging_qr_code_details)){
        $sum_weight=$sum_quantity=0;
        foreach ($tagging_qr_code_details as $tagging_qr_code_detail_index => $value) {
        //$sum_weight+=$value['lot_weight'];
        //$sum_quantity+=$value['lot_qty'];?>
        <tr class="order_<?= $value['id']?>">
          <td>
            <?php load_field('checkbox', array('field' => 'generate_lot_qr_code_detail_id',
                                               'class' => 'qr_code_detail_id',
                                               'index' => $tagging_qr_code_detail_index,
                                               'option' => array(
                                                            array('chk_id' => $tagging_qr_code_detail_index,
                                                                  'value' => $value['lot_no'],
                                                                  'label' => '',
                                                                  'checked' => (!empty($generate_lotes_out_wastage_details[$tagging_qr_code_detail_index]['id']) 
                                                                                ? 'checked' : ''))),
                                               'controller' => 'generate_lot_qr_code_details'));?>
          </td> 
          <td><?php echo $value['lot_no'];?></td>
          <td><?php echo $value['created_at'];?></td>
      </tr>
        <?php }?>
      <tr class="bg_blue bold">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
     </tr>
     <?php }?>
  </tbody>
</table>
 <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>
