<?php include('header.php');
if(isset($_POST['submit'])){
  if(!empty($_POST['user_login']) || !empty($_POST['email'])){
   $username      = escape($_POST['user_login']);
   $email         = escape($_POST['email']);
   $nickname      = escape($_POST['nickname']);
   $url           = escape($_POST['url']);
   $description   = escape($_POST['description']);
   $pass1         = escape($_POST['pass1']);
   $password      = md5($pass1);
   $pass2         = escape($_POST['pass2']);

  if ($username == $session||is_admin()){
    if ($pass1==$pass2){
      $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      $result = mysqli_query($db, "UPDATE oc_users SET email='$email', password='$password', nickname='$nickname', user_url='$url', description='$description' WHERE username='$username'") or die (mysqli_error($db));
        if ($result){
            $success = '<div id="message">Profile updated.</div>';
        }
      mysqli_close($db);
    }else{
        $passerror = '<div id="message">ERROR: Please enter the same password in the two password fields</div>';
    }
   }
 }
}
        if (!empty($user_id)) {
	$row = get_mysqli_array("oc_users WHERE id = '$user_id'");
        } else {
        $row = get_mysqli_array("oc_users WHERE username='$session' or email ='$session'");
        }
?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Profile</h2>
                    <?php if(!empty($success)){echo $success;}?><?php if(!empty($passerror)){echo $passerror;}?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
               <form action="profile.php?user_id=<?php echo $row['id'];?>" method="post" enctype="multipart/form-data">
               <table class="table form-table table-hover"><tbody>
                <tr>
		 <th><label for="user_login">Username</label></th>
		 <td><input type="text" name="username" value="<?php echo $row['username'];?>" disabled class="form-control regular-text"> <span class="help-block">Usernames cannot be changed.</span></td>
	        </tr>
                <tr>
	         <th><label for="nickname">Full Name</label></th>
	         <td><input type="text" name="nickname" value="<?php echo $row['nickname'];?>" class="form-control regular-text"></td>
                </tr>
                <tr>
	         <th><label for="email">E-mail <span class="help-block">(required)</span></label></th>
	         <td><input type="email" name="email" value="<?php echo $row['email'];?>" class="form-control regular-text ltr"></td>
                </tr>
                <tr>
	         <th><label for="url">Website</label></th>
	         <td><input type="url" name="url" value="<?php echo $row['user_url'];?>" class="form-control regular-text code"></td>
                </tr>
                <tr>
	         <th><label for="description">Biographical Info</label></th>
	         <td><textarea name="description" rows="3" class="form-control regular-text"><?php echo $row['description'];?></textarea><br>
	         <span class="help-block">Share a little biographical information to fill out your profile. This may be shown publicly.</span></td>
                </tr>
                <tr>
	         <th><label for="password">Password</label></th>
	         <td><input type="password" name="pass1" class="form-control regular-text" autocomplete="off">
	         <span class="help-block">If you would like to change the password type a new one. Otherwise leave this blank.</span></td>
                </tr>
                <tr>
	         <th><label for="password">Repeat New Password</label></th>
	         <td><input type="password" name="pass2" class="form-control regular-text" autocomplete="off">
	         <span class="help-block">Type your new password again.</span></td>
                </tr>
                </tbody></table>
                <input type="hidden" name="user_login" value="<?php echo $row['username'];?>">
                <p class="submit"><input type="submit" name="submit" class="btn button-large" value="Update Profile"></p>
                </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.col-row -->
<?php include('footer.php');?>