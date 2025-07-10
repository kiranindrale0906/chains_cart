<?php echo form_open_multipart(base_url().'settings/same_karigar_imports/store');?>
  <div class="row">
    <?php load_field('file', array('field' => 'import_files','accept'=>"text/xml")); ?>
    <?php load_field('hidden', array('field' => 'import',
                                     'name' => 'import',
                                     'value' => 1)) ?>
  	<?php load_field('plain/import_error', array()); ?>
  </div>
  <?php load_buttons('submit', array('controller' => $controller,'name' => 'Import','class' => 'btn_blue')) ?>
<?php echo form_close();?>