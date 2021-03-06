<?php include('header.php');
if(!is_admin()){
  header("location:index.php");
}
?>
    <div class="row">
        <div class="col-lg-12">
<?php 
    if (!empty($page)){
        if ($hook->hook_exist ( 'plugins_loaded' )) {
            $hook->execute_hook ( 'plugins_loaded' );
        }
    }else{
?>
<?php 
if(isset($_POST['submit'])){

    if(!empty($_POST['blogname']) || !empty($_POST['url']) || !empty($_POST['email'])){

        if (is_admin()){

            $url['option_value']  = escape($_POST['url']);
            $blogname['option_value']  = escape($_POST['blogname']);
            $description['option_value']  = escape($_POST['description']);
            $email['option_value']  = escape($_POST['email']);
            $keyword['option_value']  = escape($_POST['keyword']);
            $users_can_register['option_value']  = escape($_POST['users_can_register']);
            $posts_default['option_value']  = escape($_POST['posts_default']);
            $default_role['option_value']  = escape($_POST['default_role']);
            $timezone_string['option_value']  = escape($_POST['timezone_string']);

            options_update ( 'url' , $url);
            options_update ( 'name' , $blogname);
            options_update ( 'description' , $description);
            options_update ( 'email' , $email);
            options_update ( 'users_can_register' , $users_can_register);
            options_update ( 'posts_default' , $posts_default);
            options_update ( 'keyword' , $keyword);
            options_update ( 'default_role' , $default_role);
            options_update ( 'timezone_string' , $timezone_string);

                $pesan = '<div id="message">Settings saved.</div><br/>';

        }
    }
}
?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">General Settings</h2>
                    <?php if(!empty($pesan)){echo $pesan;}?>
                </div><!-- col-lg-12 -->
            </div><!-- row -->
            <div class="row">
               <div class="col-lg-12">
               <form action="options-general.php" method="post">
               <table class="table form-table table-hover"><tbody>
                <tr>
		 <th><label for="user_login">Site Title</label></th>
		 <td><input type="text" name="blogname" value="<?php echo bloginfo('name'); ?>" class="form-control regular-text"></td>
	        </tr>
                <tr>
	         <th><label for="tagline">Tagline</label></th>
	         <td><input type="text" name="description" value="<?php echo bloginfo('description'); ?>" class="form-control regular-text"><p class="help-block">In a few words, explain what this site is about.</p></td>
                </tr>
                <tr>
	         <th><label for="url">Site Address (URL)</label></th>
	         <td><input type="url" name="url" value="<?php echo bloginfo('url'); ?>" class="form-control regular-text"></td>
                </tr>
                <tr>
	         <th><label for="keyword">Keyword</label></th>
	         <td><input type="text" name="keyword" value="<?php echo bloginfo('keyword'); ?>" class="form-control regular-text"></td>
                </tr>
                <tr>
	         <th><label for="users_can_register">Membership</label></th>
	         <td><input type="checkbox" <?php if( 1 == get_bloginfo('users_can_register') ){ echo 'checked'; }; ?> value="1" name="users_can_register" /> Anyone can register</td>
                </tr>
                <tr>
	         <th><label for="posts_default">Posts default</label></th>
	         <td><input type="checkbox" <?php if( 1 == get_bloginfo('posts_default') ){ echo 'checked'; }; ?> value="1" name="posts_default" /> Publish or Draft</td>
                </tr>
                <tr>
	         <th><label for="email">E-mail Address</label></th>
	         <td><input type="email" name="email" value="<?php echo bloginfo('email'); ?>" class="form-control regular-text"><p class="help-block">This address is used for admin purposes, like new user notification.</p></td>
                </tr>
                <tr>
                <th scope="row"><label for="timezone_string">Timezone</label></th>
                <td><select id="timezone_string" name="timezone_string"><?php foreach($timezones as $region => $list){print '<optgroup label="' . $region . '">' . "\n";foreach($list as $timezone => $name){?> <option value="<?php echo $timezone;?>" <?php if (get_bloginfo('timezone_string') == $timezone): ?>selected="selected"<?php endif; ?>><?php echo $name;?></option><?php }print '<optgroup>' . "\n";}; ?></select><span id="utc-time"><abbr title="Coordinated Universal Time">UTC</abbr> time is <code><?php date_default_timezone_set("UTC");echo date("Y-m-d H:i:s", time()); ?></code></span><span id="local-time">Local time is <code><?php  date_default_timezone_set(get_bloginfo('timezone_string'));echo date("Y-m-d H:i:s", time()); ?></code></span><p class="help-block">Choose a city in the same timezone as you.</p></td>
                </tr>
                <tr class="form-field">
		<th scope="row"><label for="role">New User Default Role</label></th>
		<td><select name="default_role" id="default_role">
                <option <?php if (get_bloginfo('default_role') == "subscriber"): ?>selected="selected"<?php endif; ?> value="subscriber">Subscriber</option>
                <option <?php if (get_bloginfo('default_role') == "contributor"): ?>selected="selected"<?php endif; ?> value="contributor">Contributor</option>
                <option <?php if (get_bloginfo('default_role') == "author"): ?>selected="selected"<?php endif; ?> value="author">Author</option>
                <option <?php if (get_bloginfo('default_role') == "editor"): ?>selected="selected"<?php endif; ?> value="editor">Editor</option>
                <option <?php if (get_bloginfo('default_role') == "administrator"): ?>selected="selected"<?php endif; ?> value="administrator">Administrator</option>		
                </select>
		</td>
	        </tr>
                </tbody></table>
                <p class="submit"><input type="submit" name="submit" class="btn btn-primary" value="Save Changes"></p>
                </form>
                </div><!-- /.col-lg-12 -->
                </div><!-- row -->
<?php 
}
?>
        </div><!-- col-lg-12 -->
    </div><!-- row -->
<?php include('footer.php');?>