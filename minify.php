<body style="font-family: monospace;">
<?php
	$system_path = 'system';
	define('BASEPATH', $system_path);
	include_once("minifier.php");
	include_once("application/config/constants.php");
	include_once("application/helpers/layouts/layouts_helper.php");
	include_once("application/helpers/layouts/application_helper.php");
	include_once("application/helpers/layouts/login_helper.php");
	if (defined('STDIN'))
	{
		chdir(dirname(__FILE__));
	}

	if (($_temp = realpath($system_path)) !== FALSE)
	{
		$system_path = $_temp.DIRECTORY_SEPARATOR;
	}
	else
	{
		// Ensure there's a trailing slash
		$system_path = strtr(
			rtrim($system_path, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		).DIRECTORY_SEPARATOR;
	}
	// Is the system path correct?
	if ( ! is_dir($system_path))
	{
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: '.pathinfo(__FILE__, PATHINFO_BASENAME);
		exit(3); // EXIT_CONFIG
	}
	// Path to the system directory
	$date = new DateTime();
	$timestamp = $date->getTimestamp();
	/* FILES ARRAYs
	 * Keys as input, Values as output */ 
	$assets_css_path_application_minified = 'assets/application/minified/';
	$assets_js_path_application_minified = 'assets/application/minified/';
	$assets_css_path_login_minified = 'assets/login/minified/';
	$assets_js_path_login_minified = 'assets/login/minified/';
	minifyCSS(APPLICATION_CSS(),$assets_css_path_application_minified."application-".$timestamp.".css");
	minifyCSS(login_css(),$assets_css_path_login_minified."login-".$timestamp.".css");
	minifyJS(APPLICATION_JS(),$assets_js_path_application_minified."application-".$timestamp.".js");
	minifyJS(login_js(),$assets_js_path_login_minified."login-".$timestamp.".js");
echo $timestamp;	
?>
</body>
