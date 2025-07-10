
<form method="post" class="form-horizontal form-group-md form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action(@$controller, @$action, @$record) ?>">
  <?php load_field('hidden', array('field' => 'id')) ?>
  <input type="hidden" name="import" value="import">
  <div class="row">
    <?php load_field('file', array('field' => 'import_files')) ?>
    <div class="col-md-4">
      <?php load_buttons('anchor',
                   array('href' => ADMIN_PATH."assets/export_sample/machine_chain_factory_order_master_sample.csv",
                         'name' => 'Download Sample',
                         'class' => 'blue')) ?>
    </div>
  </div>
  <?php load_buttons('submit', array('controller' => $controller,
                                     'name'=>'Upload',
                                     'class'=>'btn btn-sm btn_green float-left')); ?>

  <div class="row">
    <?php load_field('plain/import_error', array()); ?>
  </div>

</form>