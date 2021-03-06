<?php
  /**
   * Load
   *
   * @package OcimPress
   * @author ocimpress.com
   * @copyright 2014
   * @version $load: oc-load.php, v1.00 2014-11-12 10:27:30
   */
  if ( !defined('BASEPATHT') )
	define('BASEPATHT', dirname(__FILE__) . '/');

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );

  if ( file_exists( BASEPATHT . 'oc-config.php') ) {

	require_once( BASEPATHT . 'oc-config.php' );

  } else {

	  header("Location: setup/");
	  exit;
  }

  date_default_timezone_set(get_bloginfo('timezone_string'));
  $site_url = get_home_url();

  define("SITEURL", $site_url);
  define("ADMINURL", $site_url."/oc-admin");
  define("UPLOADS", BASEPATH . "oc-content/uploads/");
  define("UPLOADURL", SITEURL . "/oc-content/uploads/");

  define("THEMEDIR", BASEPATH . "oc-content/themes/" . get_bloginfo('theme'));
  define("THEMEURL", SITEURL . "/oc-content/themes/" . get_bloginfo('theme'));
  define("THEMES", BASEPATH . 'oc-content/themes/' . get_bloginfo('theme').'/');
  $oc_plugin_paths = BASEPATH . 'oc-content/plugins/';

  global $hooks;
  $hooks->add_action('theme_widget','get_widgets');

  if ( file_exists( THEMES . 'function.php' ) ) {
	require_once( THEMES . 'function.php' );
  }
?>