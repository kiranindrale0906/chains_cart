<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
| https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['post_controller_constructor'] = array(
  array(
    'class'    => 'Dashboard_autherization',
    'function' => 'check_dashboard',
    'filename' => 'Dashboard_autherization.php',
    'filepath' => 'hooks',
    'params'   => ""
  ),
  array(
    'class'    => 'Authentication',
    'function' => 'check_authentication',
    'filename' => 'Authentication.php',
    'filepath' => 'hooks',
    'params'   => ""
  ),
  array(
    'class'    => 'Authorization',
    'function' => 'check_url_authorization',
    'filename' => 'Authorization.php',
    'filepath' => 'hooks',
    'params'   => ""
  ),
  array(
    'class'    => 'maintenance_hook',
    'function' => 'go_offline',
    'filename' => 'maintenance_hook.php',
    'filepath' => 'hooks'
  ),
  array(
    'class'    => 'latest_updated',
    'function' => 'get_latest_updated_date',
    'filename' => 'latest_updated.php',
    'filepath' => 'hooks'
  ),

);
