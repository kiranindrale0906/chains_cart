<?php 
if($show_heading) { ?>
  <div class="boxrow mb-2">
    <div class="float-left">
     <h6 class="heading blue bold text-uppercase mb-0"><?= @getTableSettings()['page_title']; ?></h6>
    </div>
  </div>
<?php } ?>
 <div class="row">
<?php
          load_field('dropdown', array('field' => 'karigar',
                                       'class' => 'karigar',
                                       'col' => 'col-md-4',
                                       'option' => $karigars));
          load_field('dropdown', array('field' => 'purity',
                                       'class' => '',
                                       'col' => 'col-md-4',
                                       'option' => $purity)); 
        
?> </div>  

<div class="table-responsive m-t-20">
  
  <?php 
  if(!empty($karigar_daily_drawers)){
  foreach ($karigar_daily_drawers as $karigar_name_index => $purity_columns) {
    if($karigar_name_index==$karigar){
   ?>
  	<br><h6 class="bold"><?=$karigar?></h6>
  	<table class="table table-sm fixedthead table-default">
			<?php 
		    $this->load->view('reports/karigar_ledgers/karigar_daily_drawer_tbody',
                          array('purity_columns' => @$purity_columns,'karigar'=>$karigar));
		  ?>
  	</table>
	<?php }}}?>