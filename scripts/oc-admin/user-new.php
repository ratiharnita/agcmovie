<?php include('header.php');
if(!is_role()){
  header("location:index.php");
}
?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Add New User</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
<?php 
if(is_role()){
if(isset($_POST['submit'])){
  if(!empty($_POST['user_login']) || !empty($_POST['email']) || !empty($_POST['pass1']) || !empty($_POST['pass2'])){
   $user_login    = escape($_POST['user_login']);
   $email         = escape($_POST['email']);
   $nickname      = escape($_POST['nickname']);
   $pass1         = escape($_POST['pass1']);
   $password      = md5($pass1);
   $pass2         = escape($_POST['pass2']);
   $role          = escape($_POST['role']);

   $usernama = get_mysqli_array("oc_users WHERE username='$user_login'");
   $emails = get_mysqli_array("oc_users WHERE email='$email'");
   if ($usernama['username']!=$user_login){
   if ($emails['email']!=$email){
   if ($pass1==$pass2){
   $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
   $user_add = "INSERT INTO oc_users (username,email,nickname,password,role,active) VALUES ('$user_login','$email','$nickname','$password','$role',1)";
   $result = mysqli_query($db, $user_add) or die (mysqli_error($db));
   mysqli_close($db);
   if ($result){
      header("location:users.php");
   }
   }else{echo '<div class="alert alert-danger">ERROR: Please enter the same password in the two password fields</div>';}
   }else{echo '<div class="alert alert-danger">ERROR: This email is already registered. Please choose another one.</div>';}
   }else{echo '<div class="alert alert-danger">ERROR: This username is already registered. Please choose another one.</div>';}
  }
}
}
?>
                <div class="col-lg-12">
               <form action="user-new.php" method="post">
               <table class="table form-table table-hover"><tbody>
                <tr>
		 <th><label for="user_login">Username <span class="help-block">(required)</span></label></th>
		 <td><input type="text" name="user_login" value="<?php echo (isset($_POST['user_login']) ? $_POST['user_login'] : ''); ?>" required class="form-control regular-text"></td>
	        </tr>
                <tr>
	         <th><label for="email">E-mail <span class="help-block">(required)</span></label></th>
	         <td><input type="email" name="email" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : ''); ?>" required class="form-control regular-text"></td>
                </tr>
                <tr>
	         <th><label for="nickname">Full Name</label></th>
	         <td><input type="text" name="nickname" value="<?php echo (isset($_POST['nickname']) ? $_POST['nickname'] : ''); ?>" class="form-control regular-text"></td>
                </tr>
                <tr>
	         <th><label for="password">Password <span class="help-block">(required)</span></label></th>
	         <td><input type="password" name="pass1" required class="form-control regular-text" autocomplete="off"></td>
                </tr>
                <tr>
	         <th><label for="password">Repeat Password <span class="help-block">(required)</span></label></th>
	         <td><input type="password" name="pass2" required class="form-control regular-text" autocomplete="off"></td>
                </tr>
                <tr class="form-field">
		<th scope="row"><label for="role">Role</label></th>
		<td>
                  <select name="role" id="role">
                                    <option selected value="subscriber">Subscriber</option>
                                    <option value="contributor">Contributor</option>
                                    <option value="author">Author</option>
                                    <option value="editor">Editor</option>
                                    <option value="administrator">Administrator</option>
                  </select>
		</td>
	        </tr>
                </tbody></table>
                <p class="submit"><input type="submit" name="submit" class="btn button-large" value="Add New User"></p>
                </form>
                </div>
                <!-- /.col-lg-12 -->

<?php include('footer.php');?>