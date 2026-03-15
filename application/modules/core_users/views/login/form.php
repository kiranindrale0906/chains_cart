<h5 class="heading blue text-center text-uppercase">Login</h5>  
<form method="post" 
      class="form-horizontal fields-group-md form_radius_none" 
      enctype="multipart/form-data"
      action="<?= ADMIN_PATH.'users/login/store' ?>">
  <div class="row">
    <?php load_field('text', array('field' => 'email_id'))?>
    <?php load_field('password',array('field' => 'password', 'name' => 'password')) ?>
    <div class="col-6">
      <?php
        if (isset($register) && $register==true) {
          load_buttons('link', array('name'=>'Register',
                                     'class'=>'btn btn-sm link blue medium float-left',
                                     'href'=>ADMIN_PATH.'users/register/create'));
         } 
      ?>
    </div>
    <div class="col-6">
      <?php load_buttons('link', array(
                        'name'=>'Forgot Password',
                        'class'=>'btn btn-sm link blue medium float-right',
                        'href'=>ADMIN_PATH.'users/forgot_password/create'
      )); ?>
    </div>
  </div>
  <?php load_field('submit', array('controller' => $controller)) ?>
</form>

