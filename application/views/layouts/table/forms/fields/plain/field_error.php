<?php 
  if (isset($data['data'])) $data = $data['data'];
  if(!empty(form_error($data['name']))): ?>
  <div class="col-md-3"></div>
  <div class="clear red font12 col-md-9" id="<?= $data['name'] ?>_error">
    Error<?php //echo form_error($data['data']['name']); ?>
  </div>
<?php endif ?>