<form method="post" class="form-horizontal fields-group-sm" enctype="multipart/form-data" id="project_template" action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif;
      if(isset($_GET['chain_order_id'])){
        load_field('hidden', array('field' => 'chain_order_id', 'value' => $_GET['chain_order_id']));
      }else{
        load_field('hidden', array('field' => 'chain_order_id', 'value' => $record['chain_order_id']));
      }
      load_field('dropdown', array('field' => 'process_name','option'=>@$process,'class'=>'process_name'));
      if (isset($process_name) && in_array($process_name, array('Rope Chain', 
                                                                ))) {
        load_field('dropdown', array('field' => 'parent_lot_id',
                                     'option'=>@$parent_lots, 'col' => 'col-md-6 melting_parent_lots'));
      }

      
    ?>
  </div>
  <div class="row">
    <?php
      if(  isset($process_name) 
         && ( $process_name == 'Rope Chain' 
             )) {
        load_field('dropdown', array('field' => 'category_one', 'id' => 'category_one',
                                     'col'=>'col-md-6 category_one'));
        
      } 
      if(isset($process_name) &&
              ($process_name == 'Rope Chain') ) {
          load_field('dropdown', array('field' => 'category_two','id' => 'category_two',
                               'col'=>'col-md-6 category_two'));
      }

      if(isset($process_name) && ($process_name == 'Rope Chain') ) {
          load_field('dropdown', array('field' => 'category_three','id' => 'category_three',
                             'col'=>'col-md-6 category_three'));
          load_field('dropdown', array('field' => 'category_four','id' => 'category_four',
                           'col'=>'col-md-6 category_four'));
          load_field('dropdown', array('field' => 'category_five','id' => 'category_five',
                           'col'=>'col-md-6 category_five'));
      }
     
    ?>
  </div>
  <div class="row">
    <?php
       load_field('dropdown', array('field' => 'lot_purity', 'id' => 'lot_purity',
                                     'class' => 'lot_purity','option'=>$melting_lots_lot_purity));

        load_field('text', array('field' => 'description', 'col'=>'col-md-6 desc_text'));
          load_field('dropdown', array('field' => 'hook_kdm_purity',
                                       'id' => 'hook_kdm_purity',
                                       'option' => @$hook_kdm_purity,
                                       'col' => 'col-md-6 hook_kdm_purity'));
     
    ?>
  </div>
  <?= $this->load->view('melting_lots/sub_melting_lot_details/form.php'); ?>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>

<script type="text/javascript">
  var category_one = <?= json_encode(get_category_one()) ?>;
  var host = '<?php echo HOST; ?>';
  var category_two = <?= json_encode(get_category_two()) ?>;
  var category_three = <?= json_encode(get_category_three()) ?>;
  var category_four = <?= json_encode(get_category_four()) ?>;
  var category_five = <?= json_encode(get_category_five()) ?>;
  var tone = <?= json_encode(get_melting_lots_tone()) ?>;
  var order_ids = <?php echo json_encode(@$order_ids); ?>;
  var selected_parent_lot_id = '<?php echo @$_GET['parent_lot_id']; ?>';
  
</script>

