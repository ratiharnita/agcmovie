<?php 
session_start();
ob_start();
/**
 * Ocim User Page
 *
 * Handles authentication, registering, resetting passwords, forgot password,
 * and other user handling.
 *
 * @package OcimPress
 */
/** Make sure that the Ocim bootstrap has run before continuing. */
require( dirname( __FILE__ ) . '/oc-load.php' );
$db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php bloginfo('name');?> › <?php if($action=="lostpassword"){echo 'Lost Password';}elseif ($action=="register"){echo 'Registration Form';}else{echo 'Log In';}?></title>
    <meta name="description" content="<?php if($action=="lostpassword"){echo 'Lost Password';}elseif ($action=="register"){echo 'Registration Form';}else{echo 'Log In';}?>">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" id="open-sans-css" href="//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&amp;subset=latin%2Clatin-ext" type="text/css" media="all">
    <!-- Bootstrap Core CSS -->
    <link href="/oc-includes/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/oc-includes/css/admin.css" rel="stylesheet">
    <style type="text/css">
    html {
     background: #f1f1f1;
    }
    body {
     background-color: #f1f1f1;
    }
    .login h1 {
     margin: 0;
     padding: 8% 0 0;
     text-align: center; 
    }
    .login h1 a {
     background-image: url(/oc-includes/images/ocim.png);
     background-size: 84px;
     background-position: center top;
     background-repeat: no-repeat;
     color: #999;
     height: 84px;
     font-size: 20px;
     font-weight: 400;
     line-height: 1.3em;
     margin: 0 auto 25px;
     padding: 0;
     text-decoration: none;
     width: 84px;
     text-indent: -9999px;
     outline: 0;
     overflow: hidden;
     display: block;
     }
     label {
     color: #777;
     font-weight: normal;
     font-size: 14px;
     }
     .panel-default {
     border-color: transparent;
     }
     .panel-body {
     padding: 26px 24px 46px;
     }
     .login-panel {
     -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.13);
     box-shadow: 0 1px 3px rgba(0,0,0,.13);
     }
     input.form-control {
     font-size: 24px;
     padding: 3px;
     margin: 2px 6px 16px 0;
     height: auto;
     }
    </style>
</head>

<BODY>
   <div class="container login">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
             <h1><a href="http://www.ocimscripts.com/" title="Powered by OcimPress"><?php bloginfo('name');?></a></h1>

        <?php if($action=="lostpassword"){
        if(isset($_POST['redirect_to'])){
        $username    = escape($_POST['username']);
        $password    = substr(md5(uniqid(rand(),1)),3,6);
        $pass        = md5($password);
        $query       = "SELECT * FROM oc_users WHERE username = '$username' or email = '$username'";
        $hasil       = mysqli_query($db,$query);
        $data        = mysqli_fetch_array($hasil);

        $alamatEmail = $data['email'];
        $header      = 'From: ocimcms@' . $_SERVER["HTTP_HOST"] . "\r\n";
        $header     .= 'MIME-Version: 1.0' . "\r\n";
        $header     .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $title       = '['.get_bloginfo('name').'] New Password';
        $pesan       = 'Username: '.$username.'<br>Password: '.$password.'<br><br><a href="'.get_bloginfo('url').'/oc-login.php">'.get_bloginfo('url').'/oc-login.php</a>';
        $kirimEmail  = mail($alamatEmail, $title, $pesan, $header);

        if ($kirimEmail) {
                $query = "UPDATE oc_users SET password = '$pass' WHERE username = '$username' or email = '$username'";
                $hasil = mysqli_query($db,$query);

                if ($hasil){
                        $success = '<div id="message">The new password has been reset and sent to your email</div>';
                }
                } else {
                        $error = '<p id="error"><strong>ERROR</strong>: Invalid username or e-mail.<br></p>';
                }
}
?>
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
                                <p id="message">
                                    Please enter your username or email address. You will receive a link to create a new password via email.
                                </p>
                                    <?php echo $error;?><?php echo $success;?>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="oc-login.php?action=lostpassword" method="post">
                        <input style="display:none">
                        <input type="password" style="display:none">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username or E-mail" name="username" type="text" autofocus>
                                </div>
                                <input type="hidden" name="redirect_to">
                                <button type="submit" class="button button-primary">Get New Password</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
                   <p id="nav">
                     <a href="/oc-login.php">Log in</a>
                   </p>
                   <a href="/" title="Are you lost?">← Back to My Blog</a>
              </div>
<?php 
        } elseif ( $action=="logout" ) {

        $datetime = date("Y-m-d H:i:s");
        $result = mysqli_query($db, "UPDATE oc_users SET online = '" . $datetime . "' WHERE username='" . $_SESSION['user'] . "' or email = '" . $_SESSION['user'] . "'") or die(mysqli_error($db)); 
        session_destroy();
        header("Location:oc-login.php");

        } elseif ( $action=="register" ){

        if(isset($_POST['redirect_reg'])){
        if(!empty($_POST['username'])){
        if(!empty($_POST['user_email'])){
        $username = escape($_POST['username']);
        $email    = escape($_POST['user_email']);
        $pass     = substr(md5(uniqid(rand(),1)),3,6);
        $password = md5($pass);
        $username_result  = get_mysqli("oc_users WHERE username='$username'");
        $email_result     = get_mysqli("oc_users WHERE email='$email'");
        $usernamecount = mysqli_num_rows($username_result);
        if($usernamecount!=1) {
                $emailcount = mysqli_num_rows($email_result);

        if($emailcount!=1) {
        $online       = date("Y-m-d H:i:s");
        $role         = get_bloginfo('default_role');
        $useradd      = "INSERT INTO oc_users 
                        (username,password,email,nickname,role,online,active) 
                                VALUES 
                        ('$username','$password','$email','$username','$role','$online',1)
                        ";
        $resultuser   = mysqli_query($db, $useradd) or die (mysqli_error($db));

        if ($resultuser){
        $subject = '['.get_bloginfo('name').'] Your username and password';
        $header  = 'From: ocimcms@' . $_SERVER["HTTP_HOST"] . "\r\n";
        $header .= 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $message  = 'Username: '.$username.'<br>';
        $message .= 'Password: '.$pass.'<br><br>';
        $message .= '<a href="'.get_bloginfo('url').'/oc-login.php">'.get_bloginfo('url').'/oc-login.php</a>';
        $kirimEmail  = mail($email, $subject, $message, $header);
                header("location:oc-login.php?action=registered");
        }

        }else{$errorusername = '<div id="error"><strong>ERROR</strong>: This email is already registered, please choose another one.</div>';}
        }else{$errorusername = '<div id="error"><strong>ERROR</strong>: This username is already registered. Please choose another one.</div>';}
        }else{$empty = '<div id="error"><strong>ERROR</strong>: Please type your e-mail address.</div>';}
        }else{$empty = '<div id="error"><strong>ERROR</strong>: Please enter a username.</div>';}
        }
        if(get_bloginfo('users_can_register')==1){
?>
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
                        <p id="message">Register For This Site</p><?php echo $empty;?><?php echo $errorusername;?><br>
                        <form role="form" action="oc-login.php?action=register" method="post">
                        <input style="display:none">
                        <input type="password" style="display:none">
                            <fieldset>
                                <div class="form-group">
                                    <label for="user_login">Username<br></label>
                                    <input class="form-control" name="username" type="text" value="<?php echo (isset($_POST['username']) ? $_POST['username'] : ''); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="user_email">Email<br></label>
                                    <input class="form-control" name="user_email" type="email" value="<?php echo (isset($_POST['user_email']) ? $_POST['user_email'] : ''); ?>">
                                </div>
                                <p id="reg_passmail">A password will be e-mailed to you.</p>
                                <input type="hidden" name="redirect_reg">
                                <button type="submit" class="button button-primary">Register</button>
                            </fieldset>
                        </form>
                    </div><!-- panel-body -->
                </div><!-- login-panel -->
                <p id="nav">
	           <a href="/oc-login.php">Log in</a> | <a href="/oc-login.php?action=lostpassword" title="Password Lost and Found">Lost your password?</a>
                </p>
                   <a href="/" title="Are you lost?">← Back to My Blog</a>

<?php 
}else{header("location:oc-login.php?action=disabled");}
}elseif($action=="disabled"){
    $registration = '<div id="error">User registration is currently not allowed.<br></div>';
?>
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
                       <?php echo $registration;?>
                        <form role="form" action="oc-login.php" method="post">
                        <input style="display:none">
                        <input type="password" style="display:none">
                            <fieldset>
                                <div class="form-group">
                                    <label for="user_login">Username<br></label>
                                    <input class="form-control" placeholder="Username or E-mail" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="user_login">Password<br></label>
                                    <input class="form-control" placeholder="Password" name="password" type="password" autofocus>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <button type="submit" class="button button-primary">Log In</button>
                            </fieldset>
                        </form>
                    </div><!-- panel-body -->
                </div><!-- login-panel -->
                <p id="nav">
	           <?php if(get_bloginfo('users_can_register')==1){?><a href="/oc-login.php?action=register">Register</a> | <?php }?><a href="/oc-login.php?action=lostpassword" title="Password Lost and Found">Lost your password?</a>
                </p>
                   <a href="/" title="Are you lost?">← Back to My Blog</a>
<?php }else{?>
                <div class="login-panel panel panel-default">
<?php
$err=isset($_GET['error'])?$_GET['error']:""; 
if($err=='error'){?>
<div id="error"><p><strong>ERROR</strong>: Invalid Username or Password.</p></div>
<?php } 
if(!isset($_SESSION['user'])){
if(isset($_POST['login'])){

$username       = escape($_POST["username"]); 
$pass           = escape($_POST["password"]); 
$password       = md5($pass);
$result         = get_mysqli("oc_users WHERE password='$password' and username = '$username' or email = '$username'");
$count          = mysqli_num_rows($result);
if($count==1) {
    $userrow        = get_mysqli_array("oc_users WHERE password='$password' and username='$username' or email = '$username'");
  $_SESSION["user"] = $userrow['username'];
  $datetime         = date("Y-m-d H:i:s");
  $sql              = "update oc_users set online='" . $datetime . "' where username='" . $username . "' or email = '" . $username . "'";
  mysqli_query($db, $sql);
         header("location:oc-admin");
} else { header("location:oc-login.php?error=error");}
}
?>
                    <div class="panel-body">
                       <?php if($action=="registered"){echo '<p id="message">Registration complete. Please check your e-mail.<br></p>';}?>
                        <form role="form" action="oc-login.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <label for="user_login">Username<br></label>
                                    <input class="form-control" placeholder="Username or E-mail" name="username" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="user_login">Password<br></label>
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>
                                <label class="checkbox-inline">
                                        <input name="remember" type="checkbox" id="inlineCheckbox1"> Remember Me
                                </label>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" name="login" class="button button-primary navbar-right">Log In</button>
                            </fieldset>
                        </form>
                    </div><!-- panel-body -->
                </div><!-- login-panel -->
                <p id="nav">
	           <?php if(get_bloginfo('users_can_register')==1){?><a href="/oc-login.php?action=register">Register</a> | <?php }?><a href="/oc-login.php?action=lostpassword" title="Password Lost and Found">Lost your password?</a>
                </p>
                   <a href="/" title="Are you lost?">← Back to My Blog</a>
<?php }else{header("location:/");}?>
<?php }?>
            </div>
        </div>
    </div>
</BODY>
</html>