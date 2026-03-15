<form method="post" class="form-horizontal form-group-md form_radius_none" enctype="multipart/form-data" 
      action="<?= get_form_action($controller, $action, $record) ?>">
  <section>
    <div class="row">
      <div class="col-lg-6">
        <?php load_card(array('url'=>'',
                          'view'=>'communications/configurations/email_configuration',
                          'title'=>'Email Configuration',
                          'button'=>''));?>
        <?php load_card(array('url'=>'',
                              'view'=>'communications/configurations/push_notification_configuration',
                              'title'=>'Push Notification Configuration',
                              'button'=>''));?>
      </div>
      <div class="col-lg-6">
        <?php load_card(array('url'=>'',
                              'view'=>'communications/configurations/web_push_notification_configuration',
                              'title'=>'Web Push Notification Configuration',
                              'button'=>''));?>
        <?php load_card(array('url'=>'',
                              'view'=>'communications/configurations/sms_configuration',
                              'class'=>'mt-3',
                              'title'=>'SMS Configuration (Twillio SMS)',
                              'button'=>''));?>
      </div>
    </div>
  </section>
  <hr>
  <div class='boxrow'>
   <?php load_buttons('submit',array('class'=> 'btn btn-primary float-right','name'=>'Submit')); ?>   
  </div>
</form>