<?php 
/**
 * OCIM CMS Administration.
 *
 * @package Ocim
 * @subpackage Administration
 */
$indexin = '';
$urlTitle = '';
$settingin = '';
$rolein = '';
$themesin = '';
$post_typein = '';
$post_typepage = '';
$pluginsin = '';
$commentin = '';

$urlTitle = parse_url($_SERVER['REQUEST_URI']);
$pageName = $urlTitle['path'];

if (!empty($page)) {$pagetitle = ucwords($page);}else{$pagetitle = 'General Settings';}

if($pageName == '/oc-admin/index.php' || $pageName == '/oc-admin/'){
  $pageTitle = 'Dashboard ‹ ';
  $indexin = 'in'; 
} else if($pageName == '/oc-admin/update-core.php'){
  $pageTitle = 'Ocim CMS Updates ‹ ';
  $indexin = 'in'; 
} else if($pageName == '/oc-admin/options-general.php'){
  $pageTitle = 'General Settings ‹ ';
  $settingin = 'in';  
} else if($pageName == '/oc-admin/permalink.php'){
  $pageTitle = 'Permalink Settings ‹ ';
  $settingin = 'in'; 
} else if($pageName == '/oc-admin/options-reading.php'){
  $pageTitle = 'Reading Settings ‹ ';
  $settingin = 'in';
} else if($pageName == '/oc-admin/options-discussion.php'){
  $pageTitle = 'Discussion Settings ‹ ';
  $settingin = 'in';
} else if($pageName == '/oc-admin/users.php'){
  $pageTitle = 'Users ‹ ';
  $rolein = 'in';
} else if($pageName == '/oc-admin/user-new.php'){
  $pageTitle = 'Add New User ‹ ';
  $rolein = 'in';
} else if($pageName == '/oc-admin/profile.php'){
  $pageTitle = 'Profile ‹ ';
  $rolein = 'in';
} else if($pageName == '/oc-admin/themes.php'){
  $pageTitle = 'Manage Themes ‹ ';
  $themesin = 'in';
} else if($pageName == '/oc-admin/customize.php'){
  $pageTitle = 'Customize Themes ‹ ';
  $themesin = 'in';
} else if($pageName == '/oc-admin/nav-menus.php'){
  $pageTitle = 'Menus ‹ ';
  $themesin = 'in';
} else if($pageName == '/oc-admin/widgets.php'){
  $pageTitle = 'Widgets ‹ ';
  $themesin = 'in';
} else if($pageName == '/oc-admin/theme-install.php'){
  $pageTitle = 'Add Themes ‹ ';
  $themesin = 'in';
} else if($pageName == '/oc-admin/theme-editor.php'){
  $pageTitle = 'Edit Themes ‹ ';
  $themesin = 'in';
} else if($pageName == '/oc-admin/post.php'){
  $pageTitle = 'Edit Post ‹ ';
  $post_typein = 'in';
} else if($_SERVER['REQUEST_URI'] == '/oc-admin/post-new.php?post_type=page'){
  $pageTitle = 'Add New Page ‹ ';
  $post_typepage = 'in';
} else if($pageName == '/oc-admin/post-new.php'){
  $pageTitle = 'Add New Post ‹ ';
  $post_typein = 'in';
} else if($pageName == '/oc-admin/edit-comments.php'){
  $pageTitle = 'Comments ‹ ';
  $commentin = 'in';
} else if($pageName == '/oc-admin/category.php'){
  $pageTitle = 'Categories ‹ ';
  $post_typein = 'in';
} else if($pageName == '/oc-admin/plugins.php'){
  $pageTitle = 'Plugins ‹ ';
  $pluginsin = 'in';
} else if($pageName == '/oc-admin/plugin-install.php'){
  $pageTitle = 'Add Plugins ‹ ';
  $pluginsin = 'in';
} else if($pageName == '/oc-admin/plugin-editor.php'){
  $pageTitle = 'Edit Plugins ‹ ';
  $pluginsin = 'in';
} else if($post_type == 'post'){
  $pageTitle = ucwords($post_type).' ‹ ';
  $post_typein = 'in'; 
} else if($post_type == 'page'){
  $pageTitle = ucwords($post_type).' ‹ ';
  $post_typepage = 'in';
} else {
  $pageTitle = 'Dashboard ‹ ';
}
function feedocimpress($feed_url) {
     
    $content = @file_get_contents($feed_url);
    $x = new SimpleXmlElement($content);
     
    foreach($x->channel->item as $entry) {
        echo '<p><strong><a href="'.$entry->link.'" title="'.$entry->title.'">' . $entry->title . '</a></strong><br /><small><em>' . $entry->pubDate.'</em></small></p>';
    }
}