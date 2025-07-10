<form method="post" class="form-horizontal fields-group-sm form_radius_none" 
      enctype="multipart/form-data" 
      action=<?= get_form_action($controller,$action, @$record) ?>>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
      load_field('dropdown', array('field' => 'in_purity' ,
                                   'option'=> @$purities));
      load_field('text', array('field' => 'in_weight',
                               'class' => 'daily_drawer_in_weight',
                               'readonly'=>'readonly'));

      // if(!empty($sections)) {
      //   foreach ($sections as $index => $section) {
      //     load_field('checkbox', array('field' => 'daily_drawer_sections',
      //                                  'name' => 'daily_drawer_sections',
      //                                  'class' => 'daily_drawer_sections',
      //                                  'col' => 'col-md-3',
      //                                  'checked' => ((isset($section_names)&& !empty($section_names)
      //                                                 && in_array($section['name'],$section_names))) ? 'checked' : '',)); 
      //   }
      // } 
        
    ?>  


    <?php
      if(!empty($sections)) {
        foreach ($sections as $index => $section) {
          load_field('checkbox', array('field' => 'daily_drawer_sections',
                                       'name' => 'daily_drawer_sections',
                                       'class' => 'daily_drawer_sections',
                                       'col' => 'col-md-3',
                                       'option' => array(array('label' => $section['name'],
                                                               'value' => $section['name'],
                                                               'checked' => ((isset($section_names) 
                                                                              && !empty($section_names)
                                                                              && @in_array($section['name'], 
                                                                                          $section_names))) ? 'checked' : '',)))); 
        }
      } 
    ?>      
  </div> 
    <?php load_buttons('anchor', array('name' =>'SEARCH', 
                                      'class' =>'btn_blue daily_drawer_processes_search',
                                      'col' => 'col-md-3',)); ?>  
  <br>                                            
  <br>                                            
  
  <?php
    if (!empty($processes)) {
      $this->load->view('daily_drawer_processes/formlist');
    }
  ?>

  <?php load_buttons('submit', array('name'=>'SAVE', 'class'=>'btn_blue')); ?>
</form>