<h5 class="heading blue text-center text-uppercase">Register</h5>  
<form id="register" method="post" class="form-horizontal fields-group-sm" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <div class="row">
    <?php echo validation_errors(); ?>
    <?php if ($action == 'edit' || $action == 'update'): ?>
      <?php load_field('hidden', array('field' => 'id')) ?>
    <?php endif; ?>
    <?php load_field('text', array('field' => 'name')) ?>
    <?php load_field('text', array('field' => 'email_id')) ?>
    <?php load_field('text', array('field' => 'mobile_no')) ?>
    <?php load_field('password', array('field' => 'encrypted_password')) ?>
    <?php load_field('password', array('field' => 'confirm_password', 'name' => 'confirm_password')) ?>
    <div class="col-12">
      <?php load_buttons('link', array(
                        'name'=>'Login',
                        'class'=>'btn btn-sm link blue medium float-right',
                        'href'=>ADMIN_PATH.'users/login/create'
      )); ?>
    </div>
  </div>
  <?php load_buttons('button', array(
                    'name'=>'Submit',
                    'class'=>'btn btn-md btn_blue d-block mx-auto'
                  )); ?>
</form>

