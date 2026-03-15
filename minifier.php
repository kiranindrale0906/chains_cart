<?php
	/*
	 * JS and CSS Minifier 
	 * version: 1.0 (2013-08-26)
	 *
	 * This document is licensed as free software under the terms of the
	 * MIT License: http://www.opensource.org/licenses/mit-license.php
	 *
	 * Toni Almeida wrote this plugin, which proclaims:
	 * "NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK."
	 * 
	 * This plugin uses online webservices from javascript-minifier.com and cssminifier.com
	 * This services are property of Andy Chilton, http://chilts.org/
	 *
	 * Copyrighted 2013 by Toni Almeida, promatik.
	 */
	
	function minifyJS($arr,$dest){
		minify($arr, 'https://javascript-minifier.com/raw',$dest);
	}
	
	function minifyCSS($arr,$dest){
		minify($arr, 'https://cssminifier.com/raw',$dest);
	}
	
	function minify($arr, $url,$dest) {//echo "<pre>";print_r($arr);die;
		$handler = fopen($dest, 'w') or die("File <a href='" . $dest . "'>" . $dest . "</a> error!<br />");
		foreach ($arr as $value) {
			fwrite($handler, getMinified($url, file_get_contents($value)));
			
		}
		fclose($handler);
		echo "File <a href='" . $dest . "'>" . $dest . "</a> done!<br />";
	}
	
	function getMinified($url, $content) {
		$postdata = array('http' => array(
	        'method'  => 'POST',
	        'header'  => 'Content-type: application/x-www-form-urlencoded',
	        'content' => http_build_query( array('input' => $content) ) ) );
		return file_get_contents($url, false, stream_context_create($postdata));
	}
	
?>
