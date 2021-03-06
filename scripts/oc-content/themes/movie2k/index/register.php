<?php include(THEMES.'header.php');?>

<div id="tdmoviesheader" style="margin-bottom:0px;">
    <span style="padding-left: 5px; font-weight: bold;">Registration</span>
</div>

<?php 
if ( is_login() ) { echo 'You have already registered'; } else {
if ( get_bloginfo('users_can_register') == 1 ) {
if ( isset($_POST['submit'])) {  
if ( isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]){
if ( strlen($_POST['username'])<4 || strlen($_POST['username'])>32 )
    { echo '<font color="#FF0000"><b>Your username must be between 4 and 32 characters!</b></font>'; } else { 

    $usernamed  = escape($_POST['username']);
    $usernamed  = strtolower($usernamed);
    $dupusers   = get_mysqli_array("oc_users WHERE username = '$usernamed'");
    if ( $dupusers['username'] != $usernamed ){

    if(strlen($_POST['password1'])<6)
    { echo '<font color="#FF0000"><b>Password must be least 6 characters long.</b></font>'; } else {

    $email      = escape($_POST['email1']);
    $email2     = escape($_POST['email2']);
    if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) { echo '<font color="#FF0000"><b>Invalid email format.</b></font>'; } else {
        
    $email_sql  = get_mysqli("oc_users WHERE email = '$email'");
    if ( mysqli_num_rows( $email_sql ) == 0 ){
    if ( $email == $email2 ){

    $password1  = escape($_POST['password1']);
    $password2  = escape($_POST['password2']);
    if ( $password1 == $password2 ) {

    $gpassword  = md5($password1); // Encrypted Password
    $com_code   = md5(uniqid(rand()));
    $role       = get_bloginfo('default_role');   
    $web        = get_bloginfo('name');
    $domain     = get_bloginfo('url');
    $register   = date('Y-m-d H:i:s');

    $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $result2 = mysqli_query($db, "INSERT INTO oc_users (username, email, password, description, role, online) VALUES ('$usernamed', '$email', '$gpassword', '$com_code', '$role', '$register')" ) or die(mysqli_error($db));
    mysqli_close($db);

    if ( $result2 ) {
    $to = $email;
    $subject = "Verify your email on $web";
    $header  = 'From: noreply@' . get_domain(get_bloginfo('url')) . "\r\n";
    $header .= 'MIME-Version: 1.0' . "\r\n";
    $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $message = 'Dear <strong>'.$usernamed.'</strong>,<br><br>';
    $message .= "Thanks for signing with us at <strong>$web</strong> and welcome.<br><br>";
    $message .= "Username: $usernamed<br>Password: $password1<br><br>To activate your $web account, please click the link below:<br>";
    $message .= "$domain/index.php?do=confirm&passkey=$com_code<br>If clicking the link doesn't work, copy and paste the whole address into your browser.<br><br>";
    $message .= "We look forward to see you there,<br>the $web team";
    $sentmail = mail($to,$subject,$message,$header);

    if ( $sentmail ) {echo '<div class="alert alert-warning">Thank you for registering! A confirmation email has been sent to <strong>'.$email.'</strong>. Please click on the link in that email in order to activate your account.</div>';
   } else {echo '<font color="#FF0000"><b>Cannot send Confirmation link to your e-mail address</b></font>';}
  } 
} else { echo "<font color='#FF0000'><b>Your password doesn't match</b></font>"; }
    } else { echo "<font color='#FF0000'><b>Your Email doesn't match</b></font>"; }
} else { echo '<font color="#FF0000"><b>This Email is already used.</b></font>'; }
}
}
} else { echo '<font color="#FF0000"><b>This Username is already used.</b></font>'; }
}
} else { echo '<font color="#FF0000"><b>That CAPTCHA was incorrect. Try again.</b></font>'; }
}

?>

<form method="POST" action="/page/register" enctype="multipart/form-data">

            <div align="left"><br>
           
            <table cellspacing="0" cellpadding="20" width="100%" align="left">
                  <tbody><tr>
                    <td align="left">&nbsp;</td>
                    <td>
                        <table align="left">
                            <tbody><tr>
                                <td align="left"><font face="Arial" color="#000000">Username:</font></td>
                                <td align="left"><input name="username" type="text" autocomplete="off"> <font size="1">please choose an username with 4 or less characters</font></td>
                            </tr>
                            <tr>
                                <td align="left"><font face="Arial" color="#000000">Password:</font></td>
                                <td align="left"><input name="password1" type="password" autocomplete="off"> <font size="1">Password must be least 6 characters long.</font></td>
                            </tr>
                            <tr>
                                <td align="left"><font face="Arial" color="#000000">Password confirmation:</font></td>
                                <td align="left"><input name="password2" type="password" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <td align="left"><font face="Arial" color="#000000">Email:</font></td>
                                <td align="left"><input name="email1" type="email" autocomplete="off"> <font size="1">We will send an email to you to confirm your account!</font></td>
                            </tr>
                            <tr>
                                <td align="left"><font face="Arial" color="#000000">Email confirmation:</font></td>
                                <td align="left"><input name="email2" type="email" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <td align="left" valign="top"><font face="Arial" color="#000000">Captcha: <font size="1"></font></font></td>
                                <td align="left"><img src="/oc-includes/plugins/captcha.php" border="0"><br><font size="2">Please enter this code:</font><br><input name="captcha" autocomplete="off"></td>
                            </tr>
                            <tr>
                        <td align="left" valign="top"></td><td align="left">
                        <br><br>
                        <input type="submit" name="submit" class="button1" value=" OPEN YOUR ACCOUNT ">
                        <br><br>
                        <a href="/page/login">Already have an account? Click here to login!</a></td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
            </div>
        </form>

<?php }else{?>
<div class="alert alert-warning">User registration is currently not allowed.</div>
<?php }?>
<?php }?>

<?php include(THEMES.'footer.php');?>