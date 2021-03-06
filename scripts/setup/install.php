<?php
  /**
   * Install.php
   *
   * @package OcimPress
   * @author ocimpress.com
   * @copyright 2014
   * @version $Id: install.php, v1.00 2014-12-30 8:08:05
   */
  define("_VALID_PHP", true);
  require_once ("functions.php");
  session_start();

  $msg = '';

  error_reporting(0);
  define("CMS_DS", DIRECTORY_SEPARATOR);
  define("BASE", dirname(__file__));
  define("DDPBASE", str_replace('setup', '', BASE));

  $script_path = str_replace('/setup', '', dirname($_SERVER['SCRIPT_NAME']));

  $_SERVER['REQUEST_TIME'] = time();

  $step = !isset($_GET['step']) ? 0 : (int)$_GET['step'];

  if (isset($_POST['db_action'])) {
      $err = false;

      if (!$_POST['dbhost'])
          $err[] = 1;

      if (!$_POST['dbuser'])
          $err[] = 2;

      if (!$_POST['dbpwd'])
          $err[] = 3;

      if (!$_POST['dbname'])
          $err[] = 4;

      if (!$_POST['admin_username'])
          $err[] = 5;

      if (!$_POST['admin_password'])
          $err[] = 6;

      if ($_POST['admin_password'] != $_POST['admin_password2'])
          $err[] = 7;

      if (!$_POST['site_email'])
          $err[] = 8;

      if (!$err) {
          $link = mysqli_connect($_POST['dbhost'], $_POST['dbuser'], $_POST['dbpwd']);

          $error = false;

          if (!$link) {
              $error = true;
              $msg = 'Could not connect to MySQL server: ' . mysqli_error($link) . '<br />';
          }

          if (!mysqli_select_db($link, $_POST['dbname'])) {
              $error = true;
              $msg .= 'Could not select database ' . sanitize($_POST['dbname']) . ': ' . mysqli_error($link);
          }

          /** Writing to database **/
          if (!$error) {
              mysqli_query($link, "CREATE DATABASE `" . $_POST['dbname'] . "`;");
              mysqli_select_db($link, $_POST['dbname']);

              $success = true;
              parse_mysql_dump("sql/structure.sql", $link);

              if ($script_path == "/")
                  $script_path = "";
              $conrobots = '../robots.txt';
              if (!file_exists($conrobots)) {

                  $handlerobots = fopen("../robots.txt", 'w'); 
                  $inputrobots  = "User-agent: *
Crawl-delay: 5
# Directories
Disallow: /oc-admin/
Disallow: /oc-content/
Disallow: /oc-includes/
Disallow: /setup/
Disallow: /page/*

# Files
Disallow: /oc-config.php
Disallow: /oc-load.php
Disallow: /oc-settings.php

Sitemap: ".$_POST['site_url']."/sitemap.xml";
                  if (fwrite($handlerobots,$inputrobots)>0){
                                    fclose($handlerobots);
                  }
              }
          }

          $user = (isset($_POST['admin_username'])) ? $_POST['admin_username'] : "";
          $pass = (isset($_POST['admin_password'])) ? sanitize($_POST['admin_password']) : "";
          $url = (isset($_POST['site_url'])) ? $_POST['site_url'] : "";
          $sitename = (isset($_POST['site_name'])) ? $_POST['site_name'] : "";
          $site_description = (isset($_POST['site_description'])) ? $_POST['site_description'] : "";
          $site_email = (isset($_POST['site_email'])) ? $_POST['site_email'] : "";

          mysqli_query($link, "INSERT INTO `oc_users` 
                       (`id`, `username`, `password`, `email`, `nickname`, `role`, `online`, `active`, `description`, `user_url`)
                       VALUES 
                       (1,'" . sanitize($user) . "','" . md5($pass) . "','" . sanitize($site_email) . "','Administrator','administrator',NOW(),1, '','" . sanitize($url) . "')
                       ");

          mysqli_query($link, "INSERT INTO `oc_posts` (`id`, `title`, `description`, `pubdate`, `user`, `active`, `guid`, `permalink`, `terms`, `type`, `tags`, `images`, `sticky`, `url`, `comment_status`) VALUES
(1,'Hello World!','Welcome to Ocim CMS. This is your first post Edit or delete it, then start blogging!',NOW(),'" . sanitize($user) . "', 1,'1/hello-world','hello-world', 1, 1, '','','','','open')");

          mysqli_query($link, "UPDATE `oc_options` SET option_value=CASE id 
              WHEN 1 THEN '" . sanitize($url) . "' 
              WHEN 2 THEN '" . sanitize($sitename) . "' 
              WHEN 3 THEN '" . sanitize($site_description) . "'
              WHEN 4 THEN '" . sanitize($site_email) . "'
                  END 
              WHERE id IN (1,2,3,4)");

          mysqli_close($link);

          if (!$error) {
              if (!file_exists("../oc-config.php")) {
                  cmsHeader();
                  include ("templates/finish.tpl.php");
                  cmsFooter();
                  writeConfigFile($_POST['dbhost'], $_POST['dbuser'], $_POST['dbpwd'], $_POST['dbname']);
                  exit;
              }
          }
      }
  }

?>
<?php cmsHeader();?>
<?php
  if (!$step):
      clearstatcache();
      include ("templates/pre_install.tpl.php");
  elseif ($step == 1):
      include ("templates/license.tpl.php");
  elseif ($step == '2'):
      include ("templates/configuration.tpl.php");
  else:
      echo 'Incorrect step. Please follow installation instructions.';
  endif;

?>
<?php cmsFooter();?>