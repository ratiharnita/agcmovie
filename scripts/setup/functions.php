<?php
  /**
   * Functions.php
   *
   * @package OcimPress
   * @author www.ocimpress.com
   * @copyright 2014
   * @version $Id: functions.php, v1.00 2014-11-06 10:33:05
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php

  /**
   * getWritableCell()
   * 
   * @param mixed $aDir
   * @return
   */
  function getIniSettings($aSetting)
  {
      $out = (ini_get($aSetting) == '1' ? 'ON' : 'OFF');
      return $out;
  }

  /**
   * getWritableCell()
   * 
   * @param mixed $aDir
   * @return
   */
  function getWritableCell($aDir)
  {
	  echo '<tr>';
	  echo '<td class="elem">'.$aDir .CMS_DS.'</td>';
	  echo '<td>';
	  echo is_writable(DDPBASE.$aDir) ? '<span class="yes">Writeable</span>' : '<span class="no">Unwriteable</span>';
	  echo '</td>';
	  echo '</tr>';
  }

  /**
   * sanitize()
   * 
   * @param mixed $string
   * @param bool $trim
   * @return
   */
  function sanitize($string, $trim = false)
  {
	$string = filter_var($string, FILTER_SANITIZE_STRING); 
	$string = trim($string);
	$string = stripslashes($string);
	$string = strip_tags($string);
	$string = str_replace(array('‘','’','“','”'), array("'","'",'"','"'), $string);
	if($trim)
	$string = substr($string, 0, $trim);
	
	return $string;
  }

  /**
   * parse_mysql_dump()
   * 
   * @param mixed $filename
   * @param mixed $dblink
   * @return
   */
  function parse_mysql_dump($filename, $dblink)
  {
      global $success, $msg;

      $templine = '';
      $lines = file($filename);
      foreach ($lines as $line_num => $line) {
          if (substr($line, 0, 2) != '--' && $line != '') {
              $templine .= $line;
              if (substr(trim($line), -1, 1) == ';') {
                  if (!mysqli_query($dblink, $templine)) {
                      $success = false;
                      $msg = "<div class=\"qerror\">'" . mysqli_errno($dblink) . " " . mysqli_errno($dblink) . "' during the following query:</div> 
					  <div class=\"query\">{$templine} </div>";
                  }
                  $templine = '';
              }

          }
      }
  }

  /**
   * testModRewrite()
   * 
   * @return
   */
  function testModRewrite()
  {
      global $script_path;

      if ($script_path == "/")
          $script_path = "";

      if ($content = @file_get_contents(".htaccess")) {
          $content = str_replace("RewriteBase /setup/", "RewriteBase " . $script_path . "/setup/", $content);
          if (is_writable(".htaccess")) {
              $continue = true;
          } else {
              if (@chmod(".htaccess", 0755)) {
                  $continue = true;
              } else {
                  $continue = false;
              }
          }
          if ($continue) {
              if ($handle = @fopen(".htaccess", "w")) {
                  @fwrite($handle, $content);
                  @fclose($handle);
              }
              @chmod(".htaccess", 0644);
          }
      }
  }
  
  /**
   * writeConfigFile()
   * 
   * @param mixed $host
   * @param mixed $username
   * @param mixed $password
   * @param mixed $name
   * @return
   */
  function writeConfigFile($host, $username, $password, $name)
  {
      
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
      
      $confile = '../oc-config.php';
      if (!file_exists($confile)) {
          $handle = fopen($confile, 'w');
          fwrite($handle, $content);
          fclose($handle);
          $success = true;
      } else {
          $success = false;
      }
  }

  /**
   * safeConfig()
   * 
   * @param mixed $host
   * @param mixed $username
   * @param mixed $password
   * @param mixed $name
   * @return
   */
  function safeConfig($host, $username, $password, $name)
  {
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
	  
	  return $content;
  }
  
  /**
   * cmsHeader()
   * 
   * @return
   */
  function cmsHeader()
  {
      echo '<!doctype html>';
      echo '<html>';
      echo '<head>';
      echo '<meta charset="utf-8">';
      echo '<title>OcimPress - Web Installer</title>';
      echo '<link rel="stylesheet" type="text/css" href="style.css" />';
      echo '</head>';
      echo '<body>';
      echo '<div class="logo"></div><div id="installation">';
  }


  /**
   * cmsFooter()
   * 
   * @return
   */
  function cmsFooter()
  {
      global $err;

      echo '</div>';
      echo '<div id="copyright">OcimPress<br />';
      echo 'Copyright &copy; ' . date("Y") . ' www.ocimpress.com';
      echo '</div>';
      echo '<script type="text/javascript">';

      if ($err) {
          $j = 0;
          foreach ($err as $key => $i) {
              if ($i > 0) {
                  $first = ($j > 0) ? $i : '';
                  echo "document.getElementById('err{$i}').style.display = 'block';\n";
                  echo "document.getElementById('t{$i}').style.background = 'rgb(255, 107, 107)';\n";
                  $j++;
              }
          }
          echo "document.getElementById('t{$err[0]}').focus();\n";
      }

      echo '</script>';
      echo '</body>';
      echo '</html>';
  }
?>