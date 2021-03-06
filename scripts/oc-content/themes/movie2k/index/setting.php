<?php include(THEMES.'header.php');
if( is_admin() ){

if($action == 'edit'){
    if(!empty($_POST['blogname']) || !empty($_POST['email'])){

        if (is_admin()){
            $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
            $colads           = mysqli_query($db, "SELECT option_name FROM oc_options WHERE option_name in ('ads_300x250','ads_468x60','ads_728x90','ads_160x600','fbapp')") or die(mysqli_error($db)); 
            $num_query_ads    = mysqli_num_rows($colads);
            if($num_query_ads == "0"){
                      mysqli_query($db, "Insert into oc_options (option_name,option_value) VALUES 
                              ('ads_300x250',''),
                              ('ads_468x60',''),
                              ('ads_728x90',''),
                              ('ads_160x600',''),
                              ('fbapp','')
                      ") or die(mysqli_error($db)); 
            }
            mysqli_close($db);
            $blogname['option_value']  = escape($_POST['blogname']);
            $description['option_value']  = escape($_POST['description']);
            $email['option_value']  = escape($_POST['email']);
            $keyword['option_value']  = escape($_POST['keyword']);
            $users_can_register['option_value']  = escape($_POST['users_can_register']);
            $posts_default['option_value']  = escape($_POST['posts_default']);
            $default_role['option_value']  = escape($_POST['default_role']);
            $dmca['option_value']  = $_POST['dmca'];
            $fbapp['option_value']  = $_POST['fbapp'];
            $ads1['option_value']  = $_POST['ads1'];
            $ads2['option_value']  = $_POST['ads2'];
            $ads3['option_value']  = $_POST['ads3'];

            options_update ( 'name' , $blogname);
            options_update ( 'description' , $description);
            options_update ( 'email' , $email);
            options_update ( 'users_can_register' , $users_can_register);
            options_update ( 'posts_default' , $posts_default);
            options_update ( 'keyword' , $keyword);
            options_update ( 'default_role' , $default_role);
            options_update ( 'dmca' , $dmca);
            options_update ( 'fbapp' , $fbapp);
            options_update ( 'ads_468x60' , $ads1);
            options_update ( 'ads_300x250' , $ads2);
            options_update ( 'ads_160x600' , $ads3);

                $pesan = '<div id="message">Settings saved.</div><br/>';

        }
    }
}
?>
<?php if(!empty($pesan)){echo $pesan;}?>
            <form id="tabel" method="POST" action="/page/setting&action=edit" enctype="multipart/form-data">

               <table><tbody>
                <tr>
                    <th bgcolor="#646464" style="color:#fff;padding:5px 10px!important">
                        <b> ..:: Setting ::.. </b>
                    </th>
                </tr>
                <tr>
		 <th><label for="user_login">Site Title</label></th>
		 <td><input type="text" name="blogname" value="<?php echo get_bloginfo('name'); ?>"></td>
	        </tr>
                <tr>
	         <th><label for="tagline">Description</label></th>
	         <td><input type="text" name="description" value="<?php echo get_bloginfo('description'); ?>"><p class="help-block">In a few words, explain what this site is about.</p></td>
                </tr>
                <tr>
	         <th><label for="keyword">Keyword</label></th>
	         <td><input type="text" name="keyword" value="<?php echo get_bloginfo('keyword'); ?>"></td>
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
	         <td><input type="email" name="email" value="<?php echo get_bloginfo('email'); ?>"><p class="help-block">This address is used for admin purposes, like new user notification.</p></td>
                </tr>
                <tr>
	         <th><label for="ads1">DMCA Link</label></th>
	         <td><textarea cols="40" rows="5" name="dmca" placeholder="Insert movie link here"><?php echo get_bloginfo('dmca'); ?></textarea><p class="help-block">Block link removal takedown DMCA separate by newline.<br><b>Example</b>:<br>http://domain.com/american-sniper-69.html<br>http://domain.com/fury-17.html</p></td>
                </tr>
                <tr>
	         <th><label for="fbapp">Facebook APP ID</label></th>
	         <td><input type="text" name="fbapp" value="<?php echo get_bloginfo('fbapp'); ?>"></td>
                </tr>
                <tr>
	         <th><label for="ads1">Ads 468x60</label></th>
	         <td><textarea cols="40" rows="5" name="ads1" placeholder="embed code or link"><?php echo get_bloginfo('ads_468x60'); ?></textarea></td>
                </tr>
                <tr>
	         <th><label for="ads2">Ads 300x250</label></th>
	         <td><textarea cols="40" rows="5" name="ads2" placeholder="embed code or link"><?php echo get_bloginfo('ads_300x250'); ?></textarea></td>
                </tr>
                <tr>
	         <th><label for="ads2">Ads 160x600</label></th>
	         <td><textarea cols="40" rows="5" name="ads3" placeholder="embed code or link"><?php echo get_bloginfo('ads_160x600'); ?></textarea></td>
                </tr>
                <tr><td>&nbsp;</td>
                <td><button name="submit" class="submit" id="submit" type="submit">Submit!</button></td>
                </tr>
                </tbody></table>
            </form>


<?php
} else {header("location:/");}
include(THEMES.'footer.php');?>