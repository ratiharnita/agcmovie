        <!-- Navigation -->
        <nav class="navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#" <?php if ($indexin) {echo 'class="current"';} ?>><i class="glyphicon glyphicon-dashboard mr5"></i> Dashboard<?php if (!$indexin) {echo '<span class="glyphicon arrow"></span>';} ?></a>
                            <ul class="nav nav-second-level collapse <?php if ($indexin) {echo 'in';} ?>">
                                <li>
                                    <a href="index.php">Dashboard</a>
                                </li>
                                <?php if (is_admin()){?>
                                <li>
                                    <a href="update-core.php">Updates</a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="oc-menu-separator"><div class="separator"></div></li>
                        <?php if (is_admin()){?>
                        <li>
                            <a href="#" <?php if ($post_typein) {echo 'class="current"';} ?>><i class="glyphicon glyphicon-pencil mr5"></i> Posts<?php if (!$post_typein) {echo '<span class="glyphicon arrow"></span>';} ?></a>
                            <ul class="nav nav-second-level collapse <?php if ($post_typein) {echo 'in';} ?>">
                                <li>
                                    <a href="edit.php?post_type=post">All Post</a>
                                </li>
                                <li>
                                    <a href="post-new.php">Add New Post</a>
                                </li>
                                <li><a href="category.php">Categories</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" <?php if ($post_typepage) {echo 'class="current"';} ?>><i class="glyphicon glyphicon-edit mr5"></i> Pages<?php if (!$post_typepage) {echo '<span class="glyphicon arrow"></span>';} ?></a>
                            <ul class="nav nav-second-level collapse <?php if ($post_typepage) {echo 'in';} ?>">
                                <li>
                                    <a href="edit.php?post_type=page">All Pages</a>
                                </li>
                                <li>
                                    <a href="post-new.php?post_type=page">Add New</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="edit-comments.php" <?php if ($commentin) {echo 'class="current"';} ?>><i class="glyphicon glyphicon-comment mr5"></i> Comments</a></li>
                        <li><a href="#" <?php if ($themesin) {echo 'class="current"';} ?>><i class="glyphicon glyphicon-th-large mr5"></i> Appearance<?php if (!$themesin) {echo '<span class="glyphicon arrow"></span>';} ?></a>
                            <ul class="nav nav-second-level collapse <?php if ($themesin) {echo 'in';} ?>">
                                <li><a href="themes.php">Themes</a></li>
                                <li><a href="customize.php">Customize</a></li>
                                <li><a href="widgets.php">Widgets</a></li>
                                <li><a href="nav-menus.php">Menus</a></li>
                                <?php $hooks->do_action('admin_menu');?>
                                <li><a href="theme-editor.php">Editor</a></li>
                            </ul>
                        </li>
                       <li><a href="#" <?php if ($pluginsin) {echo 'class="current"';} ?>><i class="glyphicon glyphicon-wrench mr5"></i> Plugins<?php if (!$pluginsin) {echo '<span class="glyphicon arrow"></span>';} ?></a>
                            <ul class="nav nav-second-level collapse <?php if ($pluginsin) {echo 'in';} ?>">
                                <li><a href="plugins.php">Installed Plugins</a></li>
                                <li><a href="plugin-install.php">Add New</a></li>
                                <li><a href="plugin-editor.php">Editor</a></li>
                            </ul>
                        </li>
                        <li><a href="#" <?php if ($rolein) {echo 'class="current"';} ?>><i class="glyphicon glyphicon-user mr5"></i> User<?php if (!$rolein) {echo '<span class="glyphicon arrow"></span>';} ?></a>
                            <ul class="nav nav-second-level collapse <?php if ($rolein) {echo 'in';} ?>">
                                <li>
                                    <a href="users.php">All Users</a>
                                </li>
                                <li>
                                    <a href="user-new.php">Add New</a>
                                </li>
                                <li>
                                    <a href="profile.php">Your Profile</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" <?php if ($settingin) {echo 'class="current"';} ?>><i class="glyphicon glyphicon-cog mr5"></i> Settings<?php if (!$settingin) {echo '<span class="glyphicon arrow"></span>';} ?></a>
                            <ul class="nav nav-second-level collapse <?php if ($settingin) {echo 'in';} ?>">
                                <li><a href="options-general.php">General</a></li>
                                <li><a href="options-reading.php">Reading</a></li>
                                <li><a href="options-discussion.php">Discussion</a></li>
                                <li><a href="permalink.php">Permalinks</a></li>
                            </ul>
                        </li>
                        <?php } else {?>
                        <li><a href="profile.php" <?php if ($rolein) {echo 'class="current"';} ?>><i class="glyphicon glyphicon-user mr5"></i> Profile</a></li>
                        <?php 
                        }  
                        if ($hook->hook_exist ( 'admin_menu' )) {

	                                     $hook->execute_hook ( 'admin_menu' );

                        }
                        ?>
                        <li>
                            <a target="_blank" href="/"><i class="glyphicon glyphicon-link mr5"></i> Visit Site</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
         </nav>