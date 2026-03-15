<form method="post"  class="form-horizontal form-group-md form_radius_none"  enctype="multipart/form-data"
      action="<?= get_form_action($controller, $action, $record) ?>">
    <?php load_field('hidden', array('field' => 'template_id')) ?>
    <?php load_field('text',array('field' => 'emailto')) ?>
    <hr>
    <div class='boxrow'>
       <?php load_buttons('submit',array('class'=> 'btn btn-primary float-right','name'=>'Send Email')); ?>
    </div>          
</form>       
<div class='row mt-3'>
<?php load_card(array('url'=>'',
                      'view'=>'communications/preview_emails/view',
                      'col'=>'col-lg-12',
                      'title'=>'Email Preview',
                      'button'=>'')); ?>
</div>