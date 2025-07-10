<h5 class="heading blue text-center text-uppercase">Reset Password</h5>  
<p><?php echo $this->session->flashdata('loginerror');?></p>       
<form method="post" 
      class="form-horizontal fields-group-md form_radius_none" 
      enctype="multipart/form-data"
      action="<?= ADMIN_PATH.'users/reset_password/update/1'; ?>">
  <div class="row">
    <?php load_field('password',array('field' => 'password')) ?>
    <?php load_field('password',array('field' => 'confirm_password', 'name' => 'confirm_password')) ?>   
    <?php load_field('hidden',array('field' => 'reset_token')) ?> 
  </div>
  <hr/>
  <?php load_buttons('button', array(
                    'name'=>'Submit',
                    'class'=>'btn btn-md btn_blue d-block mx-auto'
                  )); ?>
</form>
