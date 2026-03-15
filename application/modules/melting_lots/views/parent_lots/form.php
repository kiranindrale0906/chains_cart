<form method="post" class="form-horizontal fields-group-sm" enctype="multipart/form-data" id="project_template"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
      load_field('dropdown', array('field' => 'process_name','option'=>@$process,'class'=>'process_name'));
      load_field('dropdown', array('field' => 'lot_purity','option'=>@$lot_purity,'class'=>'lot_purity'));
       ?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>

<script type="text/javascript">
  var category_one = <?= json_encode(get_category_one()) ?>; 
  var category_two = <?= json_encode(get_category_two()) ?>;
  var category_three = <?= json_encode(get_category_three()) ?>; 
  var category_four = <?= json_encode(get_category_four()) ?>;  
</script>

