<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package OcimPress
 * @subpackage Arsa
 * @since Arsa 1.0
 */
?>
<div class="sidebar">

    <?php $hooks->do_action('theme_widget');?>

    <?php widget_shortcode();?>

    <div class="list-group">
        <h2 class="list-group-item disabled">Recent Post</h2>
        <?php echo recentpost('','','class="list-group-item"');?>
    </div>

    <div id="tags">
    <table class="tags-table">
        <thead>
            <tr><td colspan="2"><span class="glyphicon glyphicon-tag"></span> Random Tags</td></tr>
        </thead>
        <tbody>
            <tr>
                <td><?php $tag = get_mysqli("oc_posts where active=1 AND tags IS NOT NULL AND TRIM(tags) <> '' group by tags order by rand() limit 5");
                     while ($row = mysqli_fetch_array($tag)) {
                            echo get_tag($row['tags']);
                     } 
                ?></td>
            </tr>
        </tbody>
    </table>
    </div>

    <div class="list-group">
        <h2 class="list-group-item disabled">Meta</h2>
        <?php if(!isset($_SESSION['user'])){?>
        <?php if(get_bloginfo('users_can_register')==1){?>
        <a class="list-group-item" rel="nofollow" href="/oc-login.php?action=register">Register</a>
        <?php }?>
        <a class="list-group-item" rel="nofollow" href="/oc-login.php">Log in</a>
        <?php }else{?>
        <a class="list-group-item" rel="nofollow" href="/oc-admin/">Site Admin</a>
        <a class="list-group-item" rel="nofollow" href="/oc-login.php?action=logout">Log out</a>
        <?php }?>
        <a class="list-group-item" rel="nofollow" href="/feed">Entries <abbr title="Really Simple Syndication">RSS</abbr></a>
        <a class="list-group-item" rel="nofollow" href="/sitemap.xml">Entries <abbr title="A site map (or sitemap) is a list of pages of a web site accessible to crawlers or users">Sitemap</abbr></a>
        <a class="list-group-item" href="http://www.ocimscripts.com/" title="Premium Themes OcimPress">ocimscripts.com</a>
        <a class="list-group-item" href="http://ocimpress.com/" title="Powered by OcimPress">ocimpress.com</a>
    </div>

</div>