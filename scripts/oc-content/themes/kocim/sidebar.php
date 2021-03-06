<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">

        <?php get_widget('<div class="list-group">','</div>','<h2 class="list-group-item active">','</h2>','class="list-group-item"')?>

        <!-- Blog Recent Post -->
        <div class="list-group">
                <h2 class="list-group-item active"><i class="glyphicon glyphicon-list"></i> Recent Post</h2>
                        <?php echo recentpost('','','class="list-group-item"');?>
        </div>

        <!-- Blog Categories Well -->
        <div class="list-group">
                <h2 class="list-group-item active"><i class="glyphicon glyphicon-tag"></i> Blog Categories</h2>
                        <?php echo oc_list_categories('','','','class="list-group-item"');?>
        </div>

        <!-- Blog Meta -->
        <div class="list-group">
                <h2 class="list-group-item disabled"><i class="glyphicon glyphicon-bookmark"></i> Meta</h2>
		        <?php if ( !is_login() ) :?>

			<?php if ( get_bloginfo('users_can_register') == 1 ) :?>
                                <a class="list-group-item" rel="nofollow" href="/oc-login.php?action=register">Register</a>
                        <?php endif;?>
                                <a class="list-group-item" rel="nofollow" href="/oc-login.php">Log in</a>

                        <?php else:?>
                                <a class="list-group-item" rel="nofollow" href="/oc-admin/">Site Admin</a>
                                <a class="list-group-item" rel="nofollow" href="/oc-login.php?action=logout">Log out</a>
                        <?php endif;?>

			<a class="list-group-item" rel="nofollow" href="/feed">Entries <abbr title="Really Simple Syndication">RSS</abbr></a>
			<a class="list-group-item" rel="nofollow" href="/sitemap.xml">Entries <abbr title="A site map (or sitemap) is a list of pages of a web site accessible to crawlers or users">Sitemap</abbr></a>
                        <a class="list-group-item" target="_blank" href="http://www.ocimscripts.com/" title="Script PHP">ocimscripts.com</a>
                        <a class="list-group-item" target="_blank" href="http://ocimpress.com/" title="Powered by OcimPress">ocimpress.com</a>			
        </div>
</div>