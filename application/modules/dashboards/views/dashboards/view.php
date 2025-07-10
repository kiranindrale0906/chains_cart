<h6 class='blue text-uppercase bold mb-3'>Dashboard</h6>
<div class='row'>
<?php load_card(array('view'=>'layouts/application/dashboard/card',
											'card_style'=>'bg_pink bdr_pink white',
                      'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                      'card_title'=>'Metal Balance',
                      'card_count'=>isset($metal_balance)?$metal_balance:0,
                      'url'=>ADMIN_PATH.'stock_summary_reports/stock_summary_list?row=metal_summary&type_of=balance&end_date='.date("Y-m-d", strtotime("+1 day")),
                     
                      'col'=>'col-lg-3 col-md-6',
                      ));?>

<?php load_card(array('view'=>'layouts/application/dashboard/card',
											'card_style'=>'bg_yellow bdr_yellow white',
                      'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                      'card_title'=>'Refresh Balance',
                      'card_count'=>isset($refresh_balance)?$refresh_balance:0,
                      'url'=>ADMIN_PATH.'stock_summary_reports/stock_summary_list?row=refresh_summary&type_of=balance&end_date='.date("Y-m-d", strtotime("+1 day")),
                     
                      'col'=>'col-lg-3 col-md-6',
                      ));?>
</div>                      
<div class='row'>
<?php load_card(array('view'=>'layouts/application/dashboard/card',
											'card_style'=>'bg_maroon bdr_maroon white',
                      'card_icon'=>THEME_PATH.'images/icons/new_order.png',
                      'card_title'=>'GPC out',
                      'card_count'=>isset($gpc_out)?$gpc_out:0,
                      'url'=>ADMIN_PATH.'stock_summary_reports/stock_summary_list?row=gpc_out&type_of=balance&end_date='.date("Y-m-d", strtotime("+1 day")),
                     
                      'col'=>'col-lg-3 col-md-6',
                      ));?>
</div>

<div class='row'>
<?php load_card(array('view'=>'layouts/application/dashboard/card',
											'card_style'=>'bg_blueviolet bdr_blueviolet white',
											'card_icon'=>THEME_PATH.'images/icons/new_order.png',
											'card_title'=>'Melting Wastage Balance',
											'card_count'=>isset($metal_wastage_balance)?$metal_wastage_balance:0,
											'url'=>ADMIN_PATH.'stock_summary_reports/stock_summary_list?row=melting_wastage&type_of=balance&end_date='.date("Y-m-d", strtotime("+1 day")),
											'col'=>'col-lg-3 col-md-6',
											));?>

<?php load_card(array('view'=>'layouts/application/dashboard/card',
											'card_style'=>'bg_red bdr_red white',
											'card_icon'=>THEME_PATH.'images/icons/new_order.png',
											'card_title'=>'HCL Wastage Balance',
											'card_count'=>isset($hcl_wastage)?$hcl_wastage:0,
											'url'=>ADMIN_PATH.'stock_summary_reports/stock_summary_list?row=hcl_wastage&type_of=balance&end_date='.date("Y-m-d", strtotime("+1 day")),
											'col'=>'col-lg-3 col-md-6',
											));?>

<?php load_card(array('view'=>'layouts/application/dashboard/card',
											'card_style'=>'bg_cyan bdr_cyan white',
											'card_icon'=>THEME_PATH.'images/icons/new_order.png',
											'card_title'=>'Daily Drawer Wastage Balance',
											'card_count'=>isset($daily_drawer_wastage)?$daily_drawer_wastage:0,
											'url'=>ADMIN_PATH.'stock_summary_reports/stock_summary_list?row=daily_drawer_wastage&type_of=balance&end_date='.date("Y-m-d", strtotime("+1 day")),
											'col'=>'col-lg-3 col-md-6',
											));?>
</div>
<div class='row'>
<?php load_card(array('view'=>'layouts/application/dashboard/card',
											'card_style'=>'bg_dark_gray bdr_dark_gray white',
											'card_icon'=>THEME_PATH.'images/icons/new_order.png',
											'card_title'=>'Touch Balance',
											'card_count'=>isset($tounch)?$tounch:0,
											'url'=>ADMIN_PATH.'stock_summary_reports/stock_summary_list?row=tounch_in&type_of=balance&end_date='.date("Y-m-d", strtotime("+1 day")),
											'col'=>'col-lg-3 col-md-6',
											));?>
<?php load_card(array('view'=>'layouts/application/dashboard/card',
											'card_style'=>'bg_orange bdr_orange white',
											'card_icon'=>THEME_PATH.'images/icons/new_order.png',
											'card_title'=>'Ghiss Balance',
											'card_count'=>isset($ghiss)?$ghiss:0,
											'url'=>ADMIN_PATH.'stock_summary_reports/stock_summary_list?row=ghiss&type_of=balance&end_date='.date("Y-m-d", strtotime("+1 day")),
											'col'=>'col-lg-3 col-md-6',
											));?>
<?php load_card(array('view'=>'layouts/application/dashboard/card',
											'card_style'=>'bg_green bdr_green white',
											'card_icon'=>THEME_PATH.'images/icons/new_order.png',
											'card_title'=>'Loss',
											'card_count'=>isset($loss)?$loss:0,
											'url'=>ADMIN_PATH.'stock_summary_reports/stock_summary_list?row=loss&type_of=balance&end_date='.date("Y-m-d", strtotime("+1 day")),
											'col'=>'col-lg-3 col-md-6',
											));?>
</div>

