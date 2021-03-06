<?php
require_once( 'load.php' );
$admin_bar = get_mysqli_array("oc_users WHERE username = '$session' or email ='$session'");
function ocim_head(){
global $hook;
    if ($hook->hook_exist ( 'theme_header' )) {
	$hook->execute_hook ( 'theme_header' );
    }
    if (is_login()){?>
  <link rel="stylesheet" id="admin-bar-css" href="/oc-includes/css/admin-bar.min.css" type="text/css" media="all">
  <?php 
  } 
}

function ocim_footer(){
    global $admin_bar,$post,$hook;
    if (is_login()){?><div id="adminbar" class="" role="navigation">
      <a class="screen-reader-shortcut" href="#oc-toolbar" tabindex="1">Skip to toolbar</a>
      <div class="quicklinks" id="oc-toolbar" role="navigation" aria-label="Top navigation toolbar." tabindex="0">
    <ul id="oc-admin-bar-root-default" class="ab-top-menu">
    <li id="oc-admin-bar-oc-logo" class="menupop"><a class="ab-item" aria-haspopup="true" href="#"><span class="ab-label"><span class="glyphicon glyphicon-info-sign mr5"></span></span></a><div class="ab-sub-wrapper"><ul id="oc-admin-bar-oc-logo-default" class="ab-submenu">
    <li id="oc-admin-bar-about"><a class="ab-item" href="http://ocimpress.com/">About OcimPress</a></li></ul><ul id="oc-admin-bar-oc-logo-external" class="ab-sub-secondary ab-submenu">
    <li id="oc-admin-bar-wporg"><a class="ab-item" href="http://www.ocimscripts.com/">www.ocimscripts.com</a></li>
    <li id="oc-admin-bar-support-forums"><a class="ab-item" href="https://www.facebook.com/groups/ocimscripts/">Support Forums</a></li>
    </ul></div>    
    </li>
    <li id="oc-admin-bar-site-name" class="menupop"><a class="ab-item" aria-haspopup="true" href="/oc-admin/"><span class="ab-label"><span class="glyphicon glyphicon-home mr5"></span><?php echo get_bloginfo('name');?></span></a>
     <div class="ab-sub-wrapper">
     <ul id="oc-admin-bar-site-name-default" class="ab-submenu">
       <li id="oc-admin-bar-dashboard"><a class="ab-item" href="/oc-admin/">Dashboard</a></li>
     </ul>
     <?php if(is_role()){?>
     <ul id="oc-admin-bar-appearance" class="ab-submenu">
      <li id="oc-admin-bar-widgets"><a class="ab-item" href="/oc-admin/edit.php">Posts</a></li>    
      <li id="oc-admin-bar-themes"><a class="ab-item" href="/oc-admin/themes.php">Themes</a></li>
      <li id="oc-admin-bar-widgets"><a class="ab-item" href="/oc-admin/widgets.php">Widgets</a></li>
      <li id="oc-admin-bar-menus"><a class="ab-item" href="/oc-admin/nav-menus.php">Menus</a></li>
      <li id="oc-admin-bar-background"><a class="ab-item" href="/oc-admin/options-general.php">Settings</a></li>
      <li id="oc-admin-bar-view-site"><a class="ab-item" href="/">View Site</a></li>
     </ul>
     <?php } ?>
     </div>    
    </li>
    <?php if(is_role()){?>
    <li id="oc-admin-bar-new-content" class="menupop"><a class="ab-item" aria-haspopup="true" href="/oc-admin/post-new.php"><span class="ab-label"><span class="glyphicon glyphicon-plus mr5"></span> New</span></a>
    <div class="ab-sub-wrapper">
    <ul id="oc-admin-bar-new-content-default" class="ab-submenu">
    <li id="oc-admin-bar-new-post"><a class="ab-item" href="/oc-admin/post-new.php">Post</a></li>
    <li id="oc-admin-bar-new-media"><a class="ab-item" href="/oc-admin/category.php">Category</a></li>
    <li id="oc-admin-bar-new-page"><a class="ab-item" href="/oc-admin/post-new.php?post_type=page">Page</a></li>
    <li id="oc-admin-bar-new-user"><a class="ab-item" href="/oc-admin/user-new.php">User</a></li>
    </ul>
    </div>
    </li>
    <?php if(!empty($post['id'])){?>
    <li id="oc-admin-bar-edit"><a class="ab-item" href="/oc-admin/post.php?post=<?php echo $post['id'];?>&action=edit"><span class="ab-label"><span class="glyphicon glyphicon-pencil mr5"></span> Edit Post</span></a></li>
    <?php } ?>
    <?php if ($hook->hook_exist ( 'admin_menu' )) {?>
    <li id="oc-admin-bar-plugin" class="menupop"><a class="ab-item" aria-haspopup="true" title="Setting Plugin"><span class="glyphicon glyphicon-wrench mr5"></span> <span class="ab-label">Setting Plugin</span></a><div class="ab-sub-wrapper"><ul id="oc-admin-bar-plugin-default" class="ab-submenu">
	<?php $hook->execute_hook ( 'admin_menu' );?>
    </ul></div></li>
    <?php } ?>
    <?php } ?>
    </ul>
    <ul id="oc-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">
    <li id="oc-admin-bar-search" class="admin-bar-search"><div class="ab-item ab-empty-item" tabindex="-1"><form action="/index.php" method="get" id="adminbarsearch"><input type="hidden" name="do" value="search"><input class="adminbar-input" name="id" id="adminbar-search" type="text" maxlength="150"><input type="submit" class="adminbar-button" value="Search"></form></div></li>
    <li id="oc-admin-bar-my-account" class="menupop with-avatar"><a class="ab-item" aria-haspopup="true" href="/oc-admin/profile.php" title="My Account"><span class="ab-label">Howdy, <?php echo $admin_bar['username'];?></span><img alt="<?php echo $admin_bar['username'];?>" src="<?php echo gravatar($admin_bar['email']);?>" class="avatar avatar-26 photo" height="26" width="26"></a><div class="ab-sub-wrapper"><ul id="oc-admin-bar-user-actions" class="ab-submenu">
    <li id="oc-admin-bar-user-info"><a class="ab-item" tabindex="-1" href="/oc-admin/profile.php"><img alt="<?php echo $admin_bar['username'];?>" src="<?php echo gravatar($admin_bar['email']);?>" class="avatar avatar-64 photo" height="64" width="64"><span class="display-name"><?php echo $admin_bar['username'];?></span></a>    </li>
    <li id="oc-admin-bar-edit-profile"><a class="ab-item" href="/oc-admin/profile.php">Edit My Profile</a>    </li>
    <li id="oc-admin-bar-logout"><a class="ab-item" href="/oc-login.php?action=logout">Log Out</a>    </li></ul></div>    </li></ul>      </div>
    </div>
  <script type="text/javascript" src="/oc-includes/js/admin-bar.min.js"></script><?php } 
}
?>