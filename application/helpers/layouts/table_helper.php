<?php 
function TABLE_APPLICATION_CSS($type='application'){
  $css =  array(
    CORE_PATH().'plugins/bootstrap-4.3.1/css/bootstrap.min.css',
    CORE_PATH().'plugins/bootstrap-select-1.13.10/dist/css/bootstrap-select.css',

    CORE_PATH().'plugins/toastr-2.1.3/toastr.min.css',

    CORE_PATH().'plugins/perfect-scrollbar-0.6.10/perfect-scrollbar.css',

    CORE_PATH().'plugins/fontawesome-pro-5.6.1-web/css/all.css',

    CORE_PATH().'plugins/slim/slim.min.css',
    CORE_PATH().'plugins/jquery-ui-1.12.1/jquery-ui.min.css',   
   
    CORE_PATH().'css/base.css',
    CORE_PATH().'css/style.css',
    TABLE_PATH().'css/style.css'
  );
  return $css;
}

function TABLE_APPLICATION_JS($type='application'){
  return array(
    CORE_PATH().'plugins/js/jquery-3.3.1.min.js',
    CORE_PATH().'plugins/jquery-ui-1.12.1/jquery-ui.min.js',
    CORE_PATH().'plugins/bootstrap-4.3.1/js/popper.min.js',
    CORE_PATH().'plugins/bootstrap-4.3.1/js/bootstrap.min.js',

    CORE_PATH().'plugins/bootstrap-select-1.13.10/dist/js/bootstrap-select.min.js',
    CORE_PATH().'js/config/selectpicker.js',
   
    CORE_PATH().'plugins/js/moment.min.js',

    CORE_PATH().'plugins/slim/slim.kickstart.min.js',
    CORE_PATH().'js/core/slimcropper.js',


    CORE_PATH().'plugins/jquery.scrollbar-0.2.11/jquery.scrollbar.min.js',
    CORE_PATH().'js/config/scrollbar.js',

    CORE_PATH().'js/core/sidebar.js',


    THEME_PATH().'js/autofocus_field/autofocus_field.js',

    CORE_PATH().'js/core/filter.js',
    CORE_PATH().'js/core/ajax_library.js',
    CORE_PATH().'js/core/tablefilter.js',   

    CORE_PATH().'plugins/toastr-2.1.3/toastr.min.js',
    CORE_PATH().'js/config/toastr.js',

    CORE_PATH().'js/config/modal.js',

    THEME_PATH().'js/calculator/calculator.js',
    THEME_PATH().'js/hcl_process/hcl_process.js',
    THEME_PATH().'js/hcl_ghiss_process/hcl_ghiss_process.js',
    THEME_PATH().'js/daily_drawers/daily_drawer.js',

    THEME_PATH().'js/custom.js',
    TABLE_PATH().'js/processes/processes.js',
    THEME_PATH().'js/search/search.js',
    THEME_PATH().'js/dashboards/chain_dashboards.js',
    THEME_PATH().'js/dashboards/karigar_balance_dashboards.js',
    CORE_PATH().'plugins/printThis/printThis.js',
    THEME_PATH().'js/barcode/barcode.js',
    // THEME_PATH().'js/autofocus_field/autofocus_field.js',
    
    CORE_PATH().'js/core/modal.js',
    TABLE_PATH().'js/base.js',

  );
}

?>
