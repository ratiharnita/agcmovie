<?php
  /**
   * Safe Configuration
   *
   * @package OcimPress
   * @author www.ocimpress.com
   * @copyright 2014
   * @version $Id: safe_config.php, v1.00 2014-11-06 10:33:05
   */
?>
<?php
  $host = $_GET['h'];
  $username = $_GET['u'];
  $password = $_GET['p'];
  $name = $_GET['n'];
  
  header("Content-Type: application/octet-stream");
  header("Content-Disposition: attachment; filename=oc-config.php");

	  $content = "<?php \n" 
. "\t/** \n" 
. "\t* The base configurations\n"
. "\n"
. "\t* @package OcimPress\n"
. "\t* @author ocimpress.com\n"
. "\t* @copyright 2014\n"
. "\t* @version Id: oc-config.php, ".date('F j, Y H:i:s')." \n"
. "\t*/\n"

. "\t/** \n" 
. "\t* Database Constants - these constants refer to \n"
. "\t* the database configuration settings. \n"
. "\t*/\n"
. "\t define('DB_HOST', '".$host."'); \n" 
. "\t define('DB_USER', '".$username."'); \n"  
. "\t define('DB_PASSWORD', '".$password."'); \n"  
. "\t define('DB_NAME', '" . $name . "');\n" 
. " \n" 
. "\t/** \n" 
. "\t* check connection\n"
. "\t*/\n"
. "\t if (mysqli_connect_errno()) {\n"
. "\t     printf(mysqli_connect_error());\n"
. "\t     exit();\n"
. "\t }\n"

. "\t/** \n" 
. "\t* Absolute path to the OcimPress directory \n"
. "\t*/\n"
. "\t if ( !defined('BASEPATH') ); \n"  
. "\t     define('BASEPATH', dirname(__FILE__) . '/');\n" 

. " \n" 
. "\t/** \n" 
. "\t* Sets up OcimPress vars and included files \n"
. "\t*/\n"
. "\t     require_once( BASEPATH . 'oc-settings.php');\n" 
. "?>";

echo $content;

?>