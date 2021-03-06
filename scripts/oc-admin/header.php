<?php 
if(!isset($_SESSION)){
        session_start();
        ob_start();
}
if(!isset($_SESSION['user'])){
        header("location:../oc-login.php");
}
require_once('../oc-load.php');
require_once('includes/admin.php');
require_once('includes/pagination.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title><?php if ($hook->hook_exist ( 'admin_title' )) {
	            $hook->execute_hook ( 'admin_title' );
                  } else {echo $pageTitle;};?> <?php bloginfo('name');?></title>
    <meta name="description" content="Admin Panel">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="../oc-includes/css/bootstrap.min.css" type="text/css" media="all">

    <!-- Custom CSS -->
    <link href="../oc-includes/css/admin.css" rel="stylesheet">

    <!-- Themes CSS -->
    <link href="css/load-style.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,300,600' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php 
if ($hook->hook_exist ( 'admin_head' )) {
	$hook->execute_hook ( 'admin_head' );
}
$hooks->do_action('admin_header');
?>
<?php ocim_head(); ?>
</head>

<BODY>
<div id="wrapper" class="oc-admin">
 <?php include('sidebar.php');?>
        <div id="page-wrapper">
<?php 
if ($hook->hook_exist ( 'admin_notices' )) {
	$hook->execute_hook ( 'admin_notices' );
}
$hooks->do_action('admin_notices');
?>