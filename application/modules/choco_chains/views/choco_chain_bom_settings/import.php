<form method="post" class="form-horizontal form-group-md form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action(@$controller, @$action, @$record) ?>">
  <?php load_field('hidden', array('field' => 'id')) ?>
  <input type="hidden" name="import" value="import">
  <div class="row">
    <?php load_field('file', array('field' => 'import_files')) ?>
    <div class="col-md-4">
      <?php load_buttons('anchor',
                   array('href' => ADMIN_PATH."choco_chains/choco_chain_bom_settings?bom_smaple_export=1",
                         'name' => 'Download Sample',
                         'class' => 'btn-sm btn_blue')) ?>
    </div>
  </div>
  <?php load_buttons('submit', array('controller' => $controller,
                                     'name'=>'Upload',
                                     'class'=>'btn btn-sm btn_green float-left')); ?>

  <div class="row">
    <?php load_field('plain/import_error', array()); ?>
  </div>

</form>