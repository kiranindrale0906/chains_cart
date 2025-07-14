<?php if (isset($room) && !empty($room)) { ?>
  <div class="row"> 
    <div class="col-md-12">
      <h6 class="pl-3">
        Select Room: 
        <?php 

        
        foreach ($room_names as $room) { 
          if($room['name']=='Melting Room'){
            $url='departments/melting';
          }else{
            $url='processes/processes';
          }
          if($this->router->class == 'melting' && $this->router->module == 'departments' || $room_name=='Melting Room'){
            if($room['name'] == $room_name){
          ?>
            <a class="ml-5 <?= ($room['name'] == $room_name) ? 'bold black underline' : '' ?>"
             href='<?= base_url().$url ?>?room=1&room_name=<?= $room['name'] ?>'>
          <?= $room['name'].' ('.$room['balance'].')' ?></a>  
          <?php }}else{?>  
           <a class="ml-5 <?= ($room['name'] == $room_name) ? 'bold black underline' : '' ?>"
             href='<?= base_url().$url ?>?room=1&room_name=<?= $room['name'] ?>'>
          <?= $room['name'].' ('.$room['balance'].')' ?></a>    
        <?php } }?>
      </h6>
    </div>
  </div>
<?php } else { ?>
  <div class="row ml-1"> 
    <?php load_field('text', array('field' => 'lot_no','name' => 'lot_no','layout' => 'application','col'=>'col-md-2','value'=>!empty($_GET['lot_no'])?$_GET['lot_no']:'')); ?>
    <?php load_field('text', array('field' => 'parent_lot_no','name' => 'parent_lot_no','layout' => 'application','col'=>'col-md-2','value'=>!empty($_GET['parent_lot_no'])?$_GET['parent_lot_no']:'')); ?>
    <?php load_field('text', array('field' => 'karigar','name' => 'karigar','layout' => 'application','col'=>'col-md-2','value'=>!empty($_GET['karigar'])?$_GET['karigar']:'')); ?>
   <?php load_field('text', array('field' => 'worker','name' => 'worker','layout' => 'application','col'=>'col-md-2','value'=>!empty($_GET['worker'])?$_GET['worker']:'')); ?>
   <?php load_field('text', array('field' => 'in_lot_purity','name' => 'in_lot_purity','layout' => 'application','col'=>'col-md-2','value'=>!empty($_GET['in_lot_purity'])?$_GET['in_lot_purity']:'')); ?>

   <?php load_field('date', array('field' => 'created_at','name' => 'created_at','layout' => 'application','col'=>'col-md-2','class' => 'selector','value'=>!empty($_GET['created_at'])?$_GET['created_at']:'')); ?>
    
    <?php load_field('hidden', array('field' => 'archive','name' => 'archive','layout' => 'application','col'=>'col-md-2','value'=>isset($_GET['archive'])?$_GET['archive']:'')); ?>
    <?php load_buttons('button',array('name'=>'Search',
                                        'layout' => 'application',
                                        'class'=>'save-delete-btn bold blue float-left ',
                                        'onclick'=>'search_parent_and_lot_no()')); ?>
    <?php load_buttons('button', array('name' =>'Clear','class'=>'save-delete-btn blue clear_btn')) ?>

  </div>

   
<?php } ?>

<?php if (isset($room_department_names)) { ?>
  <div class="row"> 
    <div class="col-md-12">
      <h6 class="pl-3">
        Select Department: 
        <?php 
        foreach ($room_department_names as $room_department) { 
          ?>
            <a class="ml-5 <?= ($room_department['department_name']==$department_name && $room_department['process_name']==$process_name && $room_department['product_name']==$product_name) ? 'bold black underline' : '' ?>"
               href='<?= base_url() ?>processes/processes?room=1&room_name=<?= $room_name ?>&room_product_name=<?= $room_department['product_name'] ?>&room_process_name=<?= $room_department['process_name'] ?>&room_department_name=<?= $room_department['department_name'] ?>'>
              <?= $room_department['product_name'].' - '.$room_department['department_name'].' ('.$room_department['balance'].')'?>
           </a>    
        <?php }?>
      </h6>
    </div>
  </div>
  <?php } ?>

<?php
  if (isset($records)) { ?>
    <div class="d-flex main_row">
      <?php 
        if ($this->router->class != 'processes' && $this->router->class != 'melting' && $this->router->module != 'departments')
          $process_structures = get_process_structures();
        else
          $process_structures = get_process_structures_for_room($room_name);
        
        if (isset($department_name) && !empty($department_name))
          $process_structures = array($department_name => $process_structures[$department_name]);
        
        foreach ($process_structures as $department_name => $department_columns) { ?>
          <div class="table-css process_table fixedthead_js" id='<?= get_row_id('dept', $department_name); ?>'> 
            <?php $this->load->view('processes/processes/thead', array('department_columns' => @$department_columns,
                                                                       'department_name' => @$department_name));?>
            <?php $this->load->view('processes/processes/tbody', array('department_columns' => $department_columns,
                                                                       'department_name' => @$department_name));?>
          </div>
          <?php 
        }
      ?>

      <div>
        <?php 
          if (   ($this->router->module=='rope_chains' && $this->router->class=='ags')
              || ($this->router->module=='hollow_choco_chains' && $this->router->class=='pls')
              || ($this->router->module=='lotus_chains' && $this->router->class=='pls')
              || ($this->router->module=='roco_choco_chains' && $this->router->class=='pls')
              || ($this->router->module=='nawabi_chains' && $this->router->class=='pls')
              || ($this->router->module=='hollow_chains' && $this->router->class=='ags')
              || ($this->router->module=='indo_tally_chains' && $this->router->class=='ags')
              || ($this->router->module=='indo_tally_chains' && $this->router->class=='pls')
              || ($this->router->module=='imp_italy_chains' && $this->router->class=='ags')) {
            $chain_name=get_product_value($this->router->module);
            $path='processes/process_groups/create?product_name='.$product_name.'&process_name='.$process_name;
            $data_title='Add Flatting Lots';
            load_buttons('anchor', array('href' => base_url().$path,
                                         'class'=>'btn-sm btn_blue float-right m-3 ajax',
                                         'name'=>$data_title,
                                         'data-toggle'=>'modal',
                                         'data-title'=>$data_title,
                                         'data-target'=>'#ajax-modal',
                                         'modal-size'=>'',
                                         'layout' => 'application')); 
          } 
        ?>  
      </div> 
    </div> 
  <?php 
  } 
?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
   <script>
  $( function() {
    $( ".selector" ).datepicker({
      dateFormat: "yy-mm-dd"
    });
  } );
  </script>
<?php //$this->load->view('processes/process_fields');?>
     
      <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f5f7fa;
      margin: 0;
      padding: 0;
      color: #333;
    }

    .container {
      padding: 10px;
    }

    h3 {
      margin-bottom: 10px;
      color: #333;
    }

    .filters {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      min-width: 160px;
    }

    .filters input {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      min-width: 160px;
    }

    .button-group {
       padding: 8px 14px;
      border: none;
      border-radius: 15px;
      background-color: #353738;
      color: white;
      cursor: pointer;
      font-weight: 100;
    }

    .button-group button {
      padding: 8px 14px;
      border: none;
      border-radius: 6px;
      background-color: #353738;
      color: white;
      cursor: pointer;
      font-weight: 500;
    }

    .button-group button:hover {
      background-color: #0056b3;
    }

    .table-css {
      flex: 1;
      display: flex;
      flex-direction: column;
      width: 200%;
      background-color: #fff;
      border-radius: 6px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      /*overflow-x: auto;*/
    }

    .table-row {
      display: grid;
      grid-auto-flow: column;
      grid-template-columns: repeat(auto-fit, minmax(max-content, 1fr));
      min-width: max-content;
      font-size: 10px;
      border-bottom: 1px solid #ccc;
    }
    .table-wrapper {
      overflow-x: auto;
    }
    .table-footer {
  background-color: #82b7a5;
  font-weight: bold;
  color: white;
  margin-top: auto; /* THIS pushes it to bottom inside flex */
}

    .table-header {
      background-color: #82b7a5;
      font-weight: 600;
    }
    .grid-table {
      min-width: max-content;
    }

    .table-cell {
     padding: 8px 12px;
      font-size: 13px;
      width: 100px;
      text-align: center;
      border-right: 1px solid #e0e0e0;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
.table-header-cell {
      padding: 8px 12px;
      font-size: 13px;
      width: 100px;
      text-align: center;
      border-right: 1px solid #e0e0e0;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .table-cell:last-child {
      border-right: none;
    }
    .input-box input,
    .add-btn button {
      margin: 0;
    }
    td {
      padding: 0;
      margin: 0;
    }

    .input_with_add  {
      padding: 2px;
      border-radius: 4px;
      border: 1px solid #ccc;
      width: 90%;
      margin: 0 auto;
    }

    .add-btn {
      margin-top: 5px;
      padding: 2px 30px;
      background-color: #28a745;
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 12px;
      cursor: pointer;
    }
    .save-delete-btn {
      margin-top: 2px;
      padding: 9px 14px;
      background-color: #28a745;
      border: none;
      border-radius: 14px;
      color: white;
      font-size: 12px;
      cursor: pointer;
  }

    .add-btn:hover {
      background-color: #218838;
    }

    a {
      color: #353738;
      text-decoration: none;
      font-size: 13px;
    }

  </style>