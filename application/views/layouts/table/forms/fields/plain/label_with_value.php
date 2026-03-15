<?php 
  $data_variable_name = (isset($data['controller'])) ? $data['controller'] : 'record';
  $data = get_field_data($data, $this->router, @$$data_variable_name); 
?>

<div class="<?= $data['col']; ?>">
  <div class="form-group form_group_sm <?=@$data['form_group_class'] ?>">
    <label class="label medium mb-0 <?= @$data['label_class'] ?>">
      <?= $data['label'] ?>
    </label>
    <?php if(isset($data['horizontal']) && $data['horizontal']!=''){?>
      <div class="<?=@$data['field_grid'] ?>">
    <?php }?>   
    <p class="col-form-label p-0">
      <?= empty($data['value']) ? "-" : $data['value']; ?>
    </p>
    <?php if(isset($data['horizontal']) && $data['horizontal']!=''){?>
      </div>
    <?php }?> 
  </div>
</div>