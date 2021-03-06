<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till "container" div.
 *
 * @package OcimPress
 * @subpackage ARSA
 * @since ARSA 1.0
 */
include_once('function.php');
?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title><?php oc_title(get_bloginfo('name'),' - ');?></title>
	<meta name="description" content="<?php oc_description(get_bloginfo('description'));?>" />
	<meta name="keyword" content="<?php oc_keyword(get_bloginfo('keyword'));?>" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="MobileOptimized" content="320" />
	<meta content="ocimpress" name="generator" />
	<meta name="robots" content="<?php bloginfo('blog_public'); ?>,follow" />

	<link rel="canonical" href="<?php echo get_current_url();?>" /> 
	<link rel="sitemap" href="<?php bloginfo('url');?>/sitemap.xml" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name');?> Feed" href="<?php echo get_home_url();?>/feed" />  

	<link rel="stylesheet" href="<?php bloginfo('url');?>/oc-includes/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php bloginfo('url');?><?php bloginfo('stylesheet_url');?>/style.css" type="text/css" />

	<link rel="shortcut icon" href="<?php bloginfo('url');?>/oc-content/uploads/favicon.png" type="image/x-icon" /> 
        <?php 
        $hooks->do_action( 'theme_header' );
        if ( $hook->hook_exist ( 'theme_header' ) ) {
	        $hook->execute_hook ( 'theme_header' );
        }
        ?>
	<?php ocim_head(); ?>
</head>

<BODY>
<div id="wrapper">
	<div id="header">
		<div class="container">

			<div class="pull-left">
				<div id="logo">
					<a href="<?php bloginfo('url');?>"><?php echo logo();?></a> <span class="beta">BETA</span>
				</div><!-- .logo -->
			</div><!-- .pull-left -->

			<div class="pull-left">
				<ul id="feed-filter">
          				<?php echo list_categories('','<li>','</li>');?>
        			</ul>
			</div><!-- .pull-left -->

			<form method="GET" action="/index.php" accept-charset="UTF-8" id="search" class="pull-right">
				<span class="add-on">
					<span class="glyphicon glyphicon-search"></span>
				</span>
                                <input type="hidden" name="do" value="search" type="text">
				<input id="inputIcon" placeholder="Search...." name="id" type="text">
			</form>    
			<div id="menu-mobile"><i class="fi-list"></i></div><!-- .menu-mobile -->
				<ul id="mob-menu" class="pull-right js">
					<?php oc_list_categories('','<li>','</li>');?>
				</ul><!-- .mob-menu -->

		</div><!-- .container -->
	</div><!-- .header -->

	<div class="container">
		<div id="content">
			<div class="row">