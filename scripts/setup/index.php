<?php
  /**
   * Index.php
   *
   * @package OcimPress
   * @author ocimpress.com
   * @copyright 2014
   * @version $Id: index.php, v1.00 2014-11-06 10:33:05 
   */
?>
<?php
  if (!file_exists("../oc-config.php")) {
      if (file_exists("install.php")) {
          header("Location: install.php");
      } else {
          die("<div style='text-align:center'>" 
			  . "<span style='padding: 5px; border: 1px solid #999; background-color:#EFEFEF;" 
			  . "font-family: Verdana; font-size: 11px; margin-left:auto; margin-right:auto; display:inline-block'>" 
			  . "<b>Attention:</b>The configuration file is missing and a new installation cannot be started because the install file cannot be located</span></div>");
      }
  } else {
      die("<div style='text-align:center'>" 
		  . "<span style='padding: 5px; border: 1px solid #999; background-color:#EFEFEF;" 
		  . "font-family: Verdana; font-size: 11px; margin-left:auto; margin-right:auto; display:inline-block'>" 
		  . "<b>Attention:</b> The file oc-config.php already exists!<br>If you want to reinstall OcimPress you must first delete the oc-config.php</span></div>");
  }
?>