<?php 
  $page_data = getTableSettings();
  $this->load->view('layouts/application/list/table_title');
  if(isset($page_data['custom_table_header']) && $page_data['custom_table_header'] == true){
    $this->load->view($this->router->module."/".$this->router->class.'/table_header');
  }
  $table_data = getTableSettings();
  $is_reload = isset($page_data['is_reload_form'])?$page_data['is_reload_form']:0;
?>
 <input type="hidden" id="is_reload_form" value="<?php echo $is_reload;?>">
<?php $module = $this->router->module;
  if (!isset($blank_content) || $blank_content==FALSE): ?>
      <div class="boxrow mb-2">
        <div class="float-right">
        <?php
          $page_details = getTableSettings();
          if (empty($type))
          $type = 'index';
          
        ?>
        <div class="float-right">
          <?php 
            if ($master_name != '') : 
                $base_url = base_url(); 
                $this->_module = $this->router->fetch_module();
                $create_url = $base_url.$this->_module.'/'.$this->router->class."/create"; 
                if (!empty($page_details['create_id']))
                  $create_url .= '/'.@$_GET[$page_details['create_id']];
                  $query_string = $_SERVER['QUERY_STRING']; 
                if (!empty($query_string)) 
                  $query_string = "?".$query_string;
                  $export_url = $base_url.$master_name."/index?export=1".'&&format='.@$page_details['export_format'];
                if (!empty($page_details['export_title'])) {
                   load_buttons('anchor', array(
                    'name'=> $page_details['export_title'],
                    'data-title'=> $page_details['export_title'],
                    'class'=>'btn-sm btn_blue ajax', 
                    'data-toggle'=>'modal', 
                    'href'=>$export_url,
                    'modal-size'=>'lg'
                    ));
                 } ?>
                <?php if (!empty($page_details['import_title'])) {
                   load_buttons('anchor', array(
                    'name'=> $page_details['import_title'],
                    'data-title'=> $page_details['import_title'],
                    'class'=>'btn-sm btn_blue ajax', 
                    'data-toggle'=>'modal', 
                    'href'=>$base_url.$master_name."/create?import=1",'
                    modal-size'=>'lg'
                    ));
                 } ?>
                <?php 
                if ($page_details['add_title'] != ''):
                  if (!empty($page_details['add_method'])) {
                    load_buttons('anchor', array(
                    'name'=> $page_details['add_title'],
                    'data-title'=> $page_details['add_title'],
                    'class'=>'btn-sm btn_blue ajax', 
                    'data-toggle'=>'modal', 
                    'href'=>ADMIN_PATH.$this->router->module.'/'.$this->router->class.'/'.'create',
                    'modal-size'=>'lg'
                    ));
                  } else {
                    load_buttons('anchor', array(
                    'name'=> $page_details['add_title'],
                    'data-title'=> $page_details['add_title'],
                    'class'=>'btn-sm btn_blue', 
                    'href'=>ADMIN_PATH.$this->router->module.'/'.$this->router->class.'/'.'create',
                    'modal-size'=>'lg'
                    ));
                  } 
                endif; ?>
        </div>
        <?php endif; ?>
        <?php if ($master_name == 'account') : ?>
          <div class="float-right-right mb-10">
            <?php if ($master_name != '') : ?>
                <a href="<?= base_url($master_name) ?>/import" type="button"
                   class="btn btn-sm btn-primary">Import</a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
        <?php if(!empty($searched_html) && !isset($_GET['added']) && (isset($_SESSION['is_sp']) && $_SESSION['is_sp'] == 0)):
              $new_head = json_encode($heading);//serialize($heading);
              //pr($new_head);
              $isDashboard = substr_count($_SERVER['QUERY_STRING'], "&dashboard_id=".@$_GET["dashboard_id"]);
              $isDefault = substr_count($_SERVER['QUERY_STRING'], "&is_default");
              if($isDashboard>=1 && !$isDefault){
                $dashboard_id = @$_GET["dashboard_id"];
                $new_query = str_replace("&dashboard_id=".@$_GET["dashboard_id"],"",$_SERVER['QUERY_STRING']);
                $new_query = str_replace("&is_default","",$new_query);
                unset($_GET['dashboard_id']);
                load_buttons('anchor', array(
                  'name'=>'Update My Dashboard',
                  'data-title'=>'Update My Dashboard Card Title',
                  'class'=>'btn-md btn_green ajax mr-2',
                  'id'=>'my_dashboard_data',
                  'data-toggle'=>'modal', 
                  'modal-size'=>'md',
                  'href'=>ADMIN_PATH.'dashboards/dashboards/edit/'.@$dashboard_id,'value'=>$this->router->module.'|'.$this->router->class.'|'.$new_query.'|'.json_encode($_GET).'|'.$new_head.'|'.$table_data['search_url']
                ));
              }
              else{
                $new_query = $_SERVER['QUERY_STRING'];
                if($isDashboard>=1){
                  $new_query = str_replace("&dashboard_id=".@$_GET["dashboard_id"],"",$_SERVER['QUERY_STRING']);
                }
                if($isDefault)
                  $new_query = str_replace("&is_default","",$new_query);

                unset($_GET['dashboard_id']);
                unset($_GET['is_default']);
                load_buttons('anchor', array(
                  'name'=>'Save To My Dashboard',
                  'data-title'=>'My Dashboard Card Title',
                  'class'=>'btn-md btn_blue ajax mr-2',
                  'id'=>'my_dashboard_data',
                  'data-toggle'=>'modal', 
                  'modal-size'=>'md',
                  'href'=>ADMIN_PATH.'dashboards/dashboards/create','value'=>$this->router->module.'|'.$this->router->class.'|'.$new_query.'|'.json_encode($_GET).'|'.$new_head.'|'.$table_data['search_url']
                ));
              }
            endif;
          ?>
        </div>
      </div>
      <?php $this->load->view('layouts/application/list/table_setting'); ?>
        <?= @$searched_html ?>
        <div class="table-responsive tablefixedheader">
          <?php $this->load->view('layouts/application/list/table'); ?>
        </div>
      <?php
        if ($filter_columns != '') :
          $this->load->view('layouts/application/list/pagination');
        endif;
      ?>
  <?php else: ?>
    <?php $this->load->view($controller . '/index', array('controller' => $controller, 'action' => $action)) ?>
  <?php endif; ?>
<?= @$filter_html ?>
