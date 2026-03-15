<?php

defined('BASEPATH') OR exit('No direct script access allowed.');
use Da\QrCode\QrCode;
/*
if (!function_exists('userdataFromUsername')) {

    function userdataFromUsername($username) {
        $ci = &get_instance();
        $result=$ci->db->get_where("users",array("email"=>$username))->row_array();
        return $result;
    }

}*/

function pd($data, $die=1) {
  echo '<pre>';
  print_r($data);
  if ($die==1)
    die;
  echo '</pre>';
}
if (!function_exists('is_api_request')) {
     function is_api_request() {
    return (!empty(apache_request_headers()['access_token'])); 
  }
}


if (!function_exists('generate_qrcode')) {
  function generate_qrcode($string,$size=50,$margin=200) {
    $qrCode = (new QrCode($string))
    ->setSize(2048)
    ->setMargin($margin)
    ->useForegroundColor(0,0,0);
    return '<img width="'.$size.'" src="'.$qrCode->writeDataUri().'" alt="QR Code" />';
  }
}

if ( ! function_exists('pr')) {
  function pr($arr)
  {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    die;
  }
}

/**
 * [To print last query]
*/
if ( ! function_exists('lq')) {
  function lq()
  {
    $CI = & get_instance();
    echo $CI->db->last_query();
    die;
  }
}
 if(!function_exists('curl_get_erp_token')){
   function curl_get_erp_token($uri="", $data = array()) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://argold-catalog.8848digital.com/api/method/digitalcatalog_api_erpnext.api.access_token.get_access_api_token?usr=administrator&pwd=Catalog%408848%40digital%40C%40',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_HTTPHEADER => array(
      'Cookie: full_name=Guest; sid=Guest; system_user=no; user_id=Guest; user_image='
      ),
     ));

     $response = curl_exec($curl);

    curl_close($curl);
    return $response;
   }}

if (!function_exists('get_errorMsg')) {
  function get_errorMsg($msg = "") {
    if ($msg == "")
        $msg = "Oops! Error.  Please try again later!!!";
    $error_msg = array(
        "status" => "error",
        "data" => $msg
    );
    return $error_msg;
  }

}

if (!function_exists('get_validation_errors')) {
  function get_validation_errors($errors,$type=''){
    $validation_errors=array(
        'status'=>'error',
        'errors'=>$errors,
        'error_type'=>$type
    );
    return $validation_errors;
  }
}
if (!function_exists('sanitize_input_text')) {
  function sanitize_input_text($str){
    $CI = & get_instance();  // get instance, access the CI superobject
    return $CI->security->xss_clean($str);  //security library must be autoloaded
  }
}

if (!function_exists('sanitize_output_text')) {
  function sanitize_output_text($str){
    return htmlspecialchars($str);
  }
}

if (!function_exists('get_csrf_token')) {
  function get_csrf_token(){
    $CI = & get_instance();  // get instance, access the CI superobject
    $csrf = array(
      'name' => $CI->security->get_csrf_token_name(),  //csrf token key
      'hash' => $CI->security->get_csrf_hash()  //csrf token value
    );
    return $csrf;
  }
}

if ( ! function_exists('makedirs')) {
  function makedirs($folder='', $mode=DIR_WRITE_MODE){
    if(!empty($folder)) {
      if(!is_dir(FCPATH . $folder)){
        mkdir(FCPATH . $folder, $mode);
      }
    }
  }
}

if (!function_exists('custom_url_manager')){
  function custom_url_manager($type='',$page_number=''){
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

      if(isset($url) && !empty($url)){
        $ordered = (isset($_GET['ordered_columns']) ? $_GET['ordered_columns'] : '');
        $selected = (isset($_GET['selected_column']) ? $_GET['selected_column'] : '');
        $page_no = (isset($_GET['page_no']) ? $_GET['page_no'] : '');
        $url = str_replace("?select_col=1&table_filter=1","",$url);$url = str_replace("&selected_column=".@$_GET['selected_column']."&ordered_columns=".@$_GET['ordered_columns'],"",$url);

        $url = str_replace("?selected_column=".@$_GET['selected_column']."&ordered_columns=".@$_GET['ordered_columns'],"",$url);
        $url = str_replace("&select_col=","",$url);
        $url = str_replace("&is_ajax=0","",$url);
        $url = str_replace("&is_ajax=1","",$url);
        $url = str_replace("&selected_column=".@$_GET['selected_column']."&ordered_columns=".@$_GET['ordered_columns'],"",$url);
        $url = str_replace("&page_no=".@$_GET['page_no'],"",$url);
        $url = str_replace("?page_no=".@$_GET['page_no'],"",$url);
        $url = str_replace("?page_no=''","",$url);

        // SELECT & AGRRANGE COLUMNS
        if(($selected == 1 && $ordered == 1) || $type == 'ordered_columns')
          $url .= get_connector($url)."selected_column=1&ordered_columns=1";
        elseif(($selected == 1 && $ordered != 1) || $type == 'selected_column')
          $url .= get_connector($url)."selected_column=1&ordered_columns=0";
        // PAGINATION
        if($page_no != '' || $type == 'pagination')
          $url .= get_connector($url)."page_no=".$page_number;
        return $url;
      }
      return '';
  }
}

function get_connector($url){
  $connector = '?';
  $is_question = substr_count($url, "?");
  if($is_question>=1)
    $connector = '&';

  return $connector;
}


/**
 * Object to Array
 *
 * Takes an object as input and converts the class variables to array key/vals
 * Uses the magic __FUNCTION__ callback method for multi arrays.
 *
 * $array = object_to_array($object);
 * print_r($array);
 *
 * @param object - The $object to convert to an array
 * @return array
 */
if ( ! function_exists('object_to_array'))
{
  function object_to_array($object)
  {
    if (is_object($object))
    {
      // Gets the properties of the given object with get_object_vars function
      $object = get_object_vars($object);
    }
    return (is_array($object)) ? array_map(__FUNCTION__, $object) : $object;
  }
}

/**
 * combine array
 *
 * Combines two arrays with simillar strecture and different data and returns a combined array
 * @param Arrays - two arrays with simillar strecture
 * @return array - combined array
 */

if(! function_exists('combine_array'))
{
  function combine_array($array1, $array2)
  {
    foreach ($array1 as $key => $value) {
      if (is_array($value)) {
        $array1[$key] = combine_array($value, $array2[$key]);
      } elseif (is_numeric($value) && is_numeric($array2[$key])) {
        $array1[$key] = $array1[$key] + $array2[$key];
      } elseif (is_null($value) && is_null($array2[$key])) {
        $array1[$key] = NULL;
      } elseif (is_null($value) && is_numeric($array2[$key])) {
        $array1[$key] = $array2[$key];
      } elseif (is_numeric($value) && is_null($array2[$key])) {
        $array1[$key] = $array1[$key];
      }
    }
    return $array1;
  }
}

/**
 * merge_combine_array
 *
 */

if(! function_exists('merge_combine_array'))
{
  function merge_combine_array($array1, $array2)
  {
    foreach ($array1 as $key => $value) {
      if (is_array($value)) {
        if(array_key_exists($key, $array2)) {
          $array1[$key] = merge_combine_array($value, $array2[$key]);
        }
      } elseif (is_numeric($value) && is_numeric($array2[$key])) {
        $array1[$key] = $array1[$key] + $array2[$key];
      } elseif (is_null($value) && is_null($array2[$key])) {
        $array1[$key] = NULL;
      } elseif (is_null($value) && is_numeric($array2[$key])) {
        $array1[$key] = $array2[$key];
      } elseif (is_numeric($value) && is_null($array2[$key])) {
        $array1[$key] = $array1[$key];
      }
    }

    foreach ($array2 as $key => $value) {
      if (is_array($value)) {
        if(!array_key_exists($key, $array1)) {
          $array1[$key] = $value;
        }
      }
    }

    return $array1;
  }
}

// if (!function_exists('curl_post_request')) {
//   function curl_post_request($uri, $data = array()) {
//     if(!empty($uri)) {
//       $api_url=$uri;
//       $curl = curl_init($api_url);
//       curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//       curl_setopt($curl, CURLOPT_POST, true);
//       curl_setopt($curl, CURLOPT_POSTFIELDS,  http_build_query($data));
//       curl_setopt($curl, CURLOPT_HTTPHEADER, [
//         'authtoken:'.AUTH_TOKEN
//       ]);

//       $response = curl_exec($curl);
//       curl_close($curl);
//       return $response;
//     }
//     else
//     {
//       return 'API URL and/or access token not defined';
//     }
//   }
// }
if (!function_exists('curl_post_request')) {
  function curl_post_request($uri, $data = array()) {
    if(!empty($uri)) {
      $api_url=$uri;
      $curl = curl_init($api_url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_FAILONERROR, true);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS,  http_build_query($data));
      curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'authtoken:'.AUTH_TOKEN
      ]);

      $response = curl_exec($curl);
      if(curl_errno($curl))
      {
          $response=array('status'=>'error');
      }
      curl_close($curl);
      return $response;
    }
    else
    {
      return 'API URL and/or access token not defined';
    }
  }
}

if (!function_exists('array_to_csv_download')) {
  function array_to_csv_download($array, $filename = "export.csv", $delimiter=",") {
    $file = fopen('php://output','w+');
    // ob_start();
    //fputcsv($file, $array, $delimiter);
    fwrite($file, implode(',', $array));
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="'.$filename.'";');
    //fclose($file);
    $out = ob_get_clean();
    echo trim(str_replace("\r\n","",$out));
  }
}

