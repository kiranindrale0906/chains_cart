<?php defined('BASEPATH') OR exit('No direct script access allowed.');

function image_sizes($field_name,$controller){
  $img_sizes = array();
  $ci = &get_instance();
  $file_content = get_file_content($field_name,$controller);
  $folder =  isset($file_content['folder'])?$file_content['folder']:'';
  switch($folder){
    case 'admin/basic_informations' :
      $img_sizes['thumbnail'] = array('width'=>400, 'height'=>400, 'folder'=>'/thumb');
      $img_sizes['small'] = array('width'=>200, 'height'=>200, 'folder'=>'/small');
      $img_sizes['large'] = array('width'=>1000,'height'=>1000,'folder'=>'/large');
    break;
    case 'qr_codes' :
      $img_sizes['thumbnail'] = array('width'=>400, 'height'=>400, 'folder'=>'/thumb');
      $img_sizes['small'] = array('width'=>200, 'height'=>200, 'folder'=>'/small');
      $img_sizes['large'] = array('width'=>1000,'height'=>1000,'folder'=>'/large');
    break;
    case 'yellow_qr_codes' :
        $img_sizes['thumbnail'] = array('width'=>400, 'height'=>400, 'folder'=>'/thumb');
        $img_sizes['small'] = array('width'=>200, 'height'=>200, 'folder'=>'/small');
        $img_sizes['large'] = array('width'=>1000,'height'=>1000,'folder'=>'/large');
    break;
  case 'order_details' :
        $img_sizes['thumbnail'] = array('width'=>400, 'height'=>400, 'folder'=>'/thumb');
        $img_sizes['small'] = array('width'=>200, 'height'=>200, 'folder'=>'/small');
        $img_sizes['large'] = array('width'=>1000,'height'=>1000,'folder'=>'/large');
    break;
  case 'orders' :
        $img_sizes['thumbnail'] = array('width'=>400, 'height'=>400, 'folder'=>'/thumb');
        $img_sizes['small'] = array('width'=>200, 'height'=>200, 'folder'=>'/small');
        $img_sizes['large'] = array('width'=>1000,'height'=>1000,'folder'=>'/large');
    break;
  case 'export_orders' :
        $img_sizes['thumbnail'] = array('width'=>400, 'height'=>400, 'folder'=>'/thumb');
        $img_sizes['small'] = array('width'=>200, 'height'=>200, 'folder'=>'/small');
        $img_sizes['large'] = array('width'=>1000,'height'=>1000,'folder'=>'/large');
    break;
  }
  return $img_sizes;
}

function get_file_content($field_name,$controller){
  $ci = &get_instance();
  $file_content = array('upload_on'=>LOCAL);
    switch($field_name){
      case 'photo_file_name' :
        $folder_array = array('folder'=>'admin/basic_informations');
        $file_content = array_merge($file_content,$folder_array);
      break;
      case 'qr_code_details/image' :
        $folder_array = array('folder'=>'qr_codes');
        $file_content = array_merge($file_content,$folder_array);
      break;
    case 'yellow_qr_code_details/image' :
        $folder_array = array('folder'=>'yellow_qr_codes');
        $file_content = array_merge($file_content,$folder_array);
      break;
    case 'order_details/image' :
        $folder_array = array('folder'=>'arc_orders/order_details');
        $file_content = array_merge($file_content,$folder_array);
      break;
    case 'orders/image' :
        $folder_array = array('folder'=>'arc_orders/orders');
        $file_content = array_merge($file_content,$folder_array);
      break;
    case 'export_orders/image' :
        $folder_array = array('folder'=>'arc_orders/export_orders');
        $file_content = array_merge($file_content,$folder_array);
      break;
    }
    
  return $file_content;
}