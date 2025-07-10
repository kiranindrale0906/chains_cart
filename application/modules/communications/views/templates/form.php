<form method="post" class="form-horizontal form-group-md form_radius_none" enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
  <?php load_field('hidden', array('field' => 'id')) ?>
  <section>
    <div class="text-center"><h3>Settings</h3></div>
    <div class="row">
      <?php if($action =='edit'){ ?>
        <?php load_field('dropdown',array('field'=>'communication_type',
                                              'option' =>  communication_types()))  ?>
        <?php load_field('dropdown',array('field'=>'user_type',
                                              'option' =>  user_types()))  ?>
      <?php } ?>
      <?php load_field('text', array('field' => 'template_code', 'col' => 'col-md-12',)) ?>
      <?php load_field('text', array('field' => 'name', 'col' => 'col-md-12')) ?> 
      <?php load_field('textarea', array('field' => 'sampledata', 'col'=>'col-12',
                                           'customclass'=>'custom_ckeditor_js'))?>
      <?php load_field('textarea', array('field' => 'emailcomment', 'col'=>'col-12',
                                             'customclass'=>'custom_ckeditor_js'))?>
    </div>                                    
  </section>
  <hr>

  <section>
    <div class="text-center"><h3>Email</h3></div>
    <div class="row">
      <?php load_field('text', array('field' => 'fromemail', 'col' => 'col-md-12')) ?>
      <?php load_field('text', array('field' => 'fromname', 'col' => 'col-md-12')) ?> 
      <?php load_field('text', array('field' => 'cc', 'col' => 'col-md-12')) ?>
      <?php load_field('text', array('field' => 'bcc', 'col' => 'col-md-12')) ?>
      <?php load_field('text', array('field' => 'emailto', 'col' => 'col-md-12')) ?>
      <?php load_field('text', array('field' => 'emailsubject', 'col' => 'col-md-12')) ?>
      <?php load_field('textarea', array('field' => 'emailbody','col'=>'col-12',
                                             'customclass'=>'custom_ckeditor_js' ))?>
    </div>
  </section>
  <hr>
  <section>
    <div class="text-center"><h3>Push Notification</h3></div>
    <div class="row">
      <?php load_field('text',array('field' => 'pushto', 'col' => 'col-md-12')) ?> 
      <?php load_field('textarea',array('field' => 'pushtext','col'=>'col-12',
                                             'customclass'=>'custom_ckeditor_js'))?>
      <?php load_field('text',array('field' => 'pushurl','col' => 'col-md-12')) ?>
      <?php load_field('text',array('field' => 'pushimage','col' => 'col-md-12')) ?>
    </div>
  </section>
  <section>
    <div class="text-center"><h3>Web Push Notification</h3></div>
    <div class="row">
      <?php load_field('text',array('field' => 'webpushto', 'col' => 'col-md-12')) ?> 
      <?php load_field('textarea',array('field' => 'webpushtext','col'=>'col-12',
                                             'customclass'=>'custom_ckeditor_js'))?>
      <?php load_field('text',array('field' => 'webpushurl','col' => 'col-md-12')) ?>
      <?php load_field('text',array('field' => 'webpushimage','col' => 'col-md-12')) ?>
    </div>
  </section>
  <hr>
  <section>
    <div class="text-center"><h3>SMS</h3></div>
    <div class="row">
      <?php load_field('text',array('field' => 'smsto','col' => 'col-md-12')) ?>
      <?php load_field('textarea',array('field' => 'smstext','col'=>'col-12',
                                            'customclass'=>'custom_ckeditor_js'))?>                                   
    </div>
  </section> 
  <hr>
  <div class='boxrow'>
   <?php load_buttons('submit',array('class'=> 'btn btn-primary float-right','name'=>'Submit')); ?>   
  </div>
</form>