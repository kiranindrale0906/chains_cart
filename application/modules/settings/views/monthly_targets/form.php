<?php 
  $month_lists = array(
                        array("id" => "JAN", "name" => "JAN"),
                        array("id" => "FEB", "name" => "FEB"),
                        array("id" => "MAR", "name" => "MAR"),
                        array("id" => "APR", "name" => "APR"),
                        array("id" => "MAY", "name" => "MAY"),
                        array("id" => "JUN", "name" => "JUN"),
                        array("id" => "JUL", "name" => "JUL"),
                        array("id" => "AUG", "name" => "AUG"),
                        array("id" => "SEP", "name" => "SEP"),
                        array("id" => "OCT", "name" => "OCT"),
                        array("id" => "NOV", "name" => "NOV"),
                        array("id" => "DEC", "name" => "DEC")
                      );

  $year_list = array(
                      array("id" => "2023", "name" => "2023"),
                      array("id" => "2024", "name" => "2024")
                    );

  $product_lists = array(
                          array("id" => "Arc Chain", "name" => "Arc Chain"),
                          array("id" => "Arc Ornament", "name" => "Arc Ornament"),
                          array("id" => "Arc Turkey", "name" => "Arc Turkey"),
                          array("id" => "Arc Para", "name" => "Arc Para"),
                          array("id" => "Lock Process", "name" => "Lock Process"),
                          array("id" => "Arc Rnd Chain", "name" => "Arc Rnd Chain")
                        );

  echo form_open_multipart(get_form_action($controller,$action, $record), 
                               'method="post" class="form-horizontal fields-group-sm form_radius_none"'); ?>
  <div class="row">
    <?php
      if ($action == 'edit' || $action == 'update'):
        load_field('hidden', array('field' => 'id'));
      endif; 
    ?>
    <?php load_field('dropdown', array('field' => 'month', 'option' => $month_lists));?>
    <?php load_field('dropdown', array('field' => 'year', 'option' => $year_list));?>
    <?php load_field('dropdown', array('field' => 'product_name', 'option' => $product_lists));?>
    <?php load_field('text', array('field' => 'target_production'));?>
    <?php load_field('text', array('field' => 'target_rolling'));?>
    <?php load_field('text', array('field' => 'target_gross_stock'));?>
    <?php load_field('text', array('field' => 'daily_production'));?>
  </div>
  <?php load_buttons('submit', array('name'=>'SAVE',
                                     'class'=>'btn_blue')); ?>
</form>
