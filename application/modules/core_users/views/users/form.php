<form method="post" class="form-horizontal fields-group-sm form_radius_none" enctype="multipart/form-data"
  action="<?= get_form_action($controller, $action, $record) ?>">
  <?php if ($action == 'edit' || $action == 'update'): ?>
    <?php load_field('hidden', array('field' => 'id')) ?>
  <?php endif; ?>     
  <div class="row"> 
    <?php load_field('text', array('field' => 'name'/*, 'horizontal'=>true*/)) ?>
    <?php load_field('text', array('field' => 'mobile_no')) ?>
    <?php load_field('text', array('field' => 'email_id')) ?>
    <?php if ($action == 'create' || $action == 'store'): ?>
      <?php load_field('password', array('field' => 'password')) ?>
      <?php load_field('password', array('field' => 'confirm_password', 'name' => 'confirm_password')) ?>
    <?php endif;?>
  </div>
  <div>
     <?php  load_field('plain/checkbox',
                  array('field'=>'do_not_check_ip',
                        'check_inline'=>true,
                        'option'=> array(
                                    array('label_for' => 'Do Not Check IP',
                                          'label'=> 'Do Not Check IP',
                                          'value' =>'1'))));?>
  </div>
  <hr>
  <h5>Roles <span class="red">*</span></h5>   
  <?php foreach($user_role_options as $user_role):?>
    <div class="row">    
      <?php load_field('checkbox', 
                        array('name' => 'users_user_roles[user_role_id][]',
                              'controller' => 'users_user_roles',
                              'field' => 'users_user_roles',
                              'value' => (isset($users_user_role_ids) 
                                          && in_array($user_role['id'], $users_user_role_ids)) ? $user_role['id'] : '',
                              'option' => array( array('label' => $user_role['name'],
                                                       'value' => $user_role['id'],
                                                       'checked' => ((isset($users_user_role_ids) 
                                                  && in_array($user_role['id'], $users_user_role_ids))) ? 'checked' : '',)))) ?>
    </div>
  <?php endforeach; ?>


<!--
<?php  load_field('radio', 
                  array('field' => 'name',
                        'check_inline_box'=>true,                        
                        'option'=> array(array('value' => 'Image',
                                               'label' => 'Image',
                                               'checked' => 'checked'),
                                         array('value' => 'Video',
                                               'label' => 'Video')))); 
?>

 <div class="truncate_js" show="200">
  <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
</div>


<div class="truncate_js" show="200">
  <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
</div>

<div class="truncate_js" show="200">
  <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
</div> -->
  <?php load_buttons('submit', array('controller' => $controller,
                                     'name' => 'SAVE',
                                     'class' => 'btn_blue')) ?>
</form>