<?php
  function available_urls_before_login(){
    return array('users/login/index', 'users/login/create', 'users/login/store', 'users/login/update',
                 'users/forgot_password/create',
                 'users/reset_password/create',
                 'user_device_token/user_device_token/store',
                 'core_users/email_verification/update/',
                 'users/forgot_password/create', 'users/forgot_password/store','settings/mysqldump/view/1',
                 'issue_and_receipts/alloy_gpc_vodator_ledger/index','api/api_daily_drawer_receipts/store',
                 'issue_and_receipts/loss_report_for_accounts/index','api/api_internal_receipts/store','api/api_rnd_receipts/store','stock_summary_reports/stock_summary_reports/view','api/api_pending_ghiss_receipts/store','api/api_finished_goods_receipts/store',
                 'out_weight_reports/out_weight_reports/create','api/api_stone_receipts/store','api/api_refresh_departments/store', 'issue_departments/api_issue_departments/index', 'issue_departments/api_issue_departments/create', 'stock_summary_reports/telegram/index','api/api_receipt_departments/store',
                 'qr_codes/qr_api/update', 'qr_codes/qr_api/store', 'api/api_factory_orders/store', 'api/api_hallmark_receipt_processes/store','api/api_hallmark_receipts/store','api/api_factory_orders/update','api/api_factory_order_masters/index','settings/truncate_ci_sessions/index', 'qr_codes/design_details/index', 'reports/department_loss_reports/view');
  }

  function available_urls_after_login() {
    return array('users/user_email_verify/create',  'users/user_email_verify/store',  'users/user_email_verify/update', 'users/logout/index',
                 'users/user_mobile_verify/create', 'users/user_mobile_verify/store', 'users/user_mobile_verify/update',
                 'users/reset_password/edit',       'users/reset_password/update',
                 'dashboards/dashboards',
                 'user_device_token/user_device_token/store',
                 'sys/migrations/create', 'sys/migrations/store', 'sys/migrations/index','sys/migrations/view', 'sys/search/index',
                 'bar_codes/bar_codes/index','bar_codes/bar_codes/view','sys/mysql_dump/create','sys/mysql_dump/store',
                 'sys/mysql_dump/view','sys/db_compares/index','sys/db_compares/update',
                 'bar_codes/bar_code_dd_summary/index','bar_codes/bar_code_dd_summary/view','settings/truncate_ci_sessions/index',
                 'settings/mysqldump/view/1','issue_departments/api_issue_departments/create', 'issue_departments/api_issue_departments/index');
  }
?>
