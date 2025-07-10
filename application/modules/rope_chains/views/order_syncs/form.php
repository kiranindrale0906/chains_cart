<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action,@$record) ?>>
  <?php load_field('hidden', array('field'=>'website','value'=>!empty($_GET)?$_GET['website']:"")); ?>
  <?php load_buttons('submit', array('name'=>'Sync', 'class'=>'btn_blue')); ?>
</form>
