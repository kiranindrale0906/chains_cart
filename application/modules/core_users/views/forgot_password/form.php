<h5 class="heading blue text-center text-uppercase">Forgot Password</h5>  
<p class="medium text-center">Enter your Email and instructions will be sent to you!</p>
<p><?php echo $this->session->flashdata('loginerror');?></p>       
<form method="post" 
      class="form-horizontal fields-group-md form_radius_none" 
      enctype="multipart/form-data"
      action="<?= ADMIN_PATH.'users/forgot_password/store'; ?>">
  <div class="row">
    <?php load_field('text', array('field' => 'email'))?>  
    <div class="col-12">
      <?php load_buttons('link', array(
                        'name'=>'Login',
                        'class'=>'btn btn-sm link blue medium float-right', 
                        'href'=>ADMIN_PATH.'users/login/create'
      )); ?>
    </div>
  </div>
  <hr/>
  <?php load_buttons('button', array(
                    'name'=>'Submit',
                    'class'=>'btn btn-md btn_blue d-block mx-auto'
                  )); ?>
</form>