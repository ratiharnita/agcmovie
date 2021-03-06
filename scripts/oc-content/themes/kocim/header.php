<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till "container" div.
 *
 * @package OcimPress
 * @subpackage Kocim
 * @since Kocim 1.0
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title><?php oc_title(get_bloginfo('name'),' - ');?></title>
	<meta name="description" content="<?php oc_description(get_bloginfo('description'));?>" />
	<meta name="keywords" content="<?php oc_keyword(get_bloginfo('keyword'));?>" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="generator" content="OcimPress" />
	<meta name="robots" content="<?php bloginfo('blog_public'); ?>,follow" />

	<link rel="alternate" type="application/rss+xml" title="My Blog » Feed" href="<?php echo get_home_url();?>/feed" />
	<link rel="canonical" href="<?php echo get_current_url();?>" />
	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,300,600" type="text/css" />

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>/style.css" type="text/css" media="screen" />
	<link rel="shortcut icon" href="<?php echo get_home_url();?>/oc-content/uploads/favicon.png" type="image/x-icon" /> 
        <?php 
        $hooks->do_action( 'theme_header' );
        if ( $hook->hook_exist ( 'theme_header' ) ) {
	        $hook->execute_hook ( 'theme_header' );
        }
        ?>
	<?php ocim_head(); ?>
</head>

<BODY>
<!-- Navigation -->
	<nav class="navbar navbar-inverse" role="navigation">
        	<div class="container">
            	<!-- Brand and toggle get grouped for better mobile display -->
            		<div class="navbar-header">
                		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    			<span class="sr-only">Toggle navigation</span>
                    			<span class="icon-bar"></span>
                    			<span class="icon-bar"></span>
                    			<span class="icon-bar"></span>
                		</button>
                		<a class="navbar-brand" href="<?php echo get_home_url();?>"><?php echo logo();?></a>
            		</div>
            		<!-- Collect the nav links, forms, and other content for toggling -->
            		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                		<ul class="nav navbar-nav">
                    			<?php echo list_categories('','<li>','</li>');?>
                		</ul>
                		<form class="navbar-form navbar-right" role="form" method="GET" action="/index.php" accept-charset="UTF-8">
                    			<div class="form-group">
                        			<input type="hidden" name="do" value="search" /> 
                        			<input type="text" name="id" placeholder="Search..." class="form-control">
                    			</div>
                		</form>
            		</div>
            		<!-- /.navbar-collapse -->
        	</div>
        <!-- /.container -->
    	</nav>
    	<!-- Page Content -->
    	<div class="container">
        	<div class="row">