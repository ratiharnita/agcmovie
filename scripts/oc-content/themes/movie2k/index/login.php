<?php include(THEMES.'header.php');?>
  <?php if( is_login() ){header("location:/");}else{?>
<div id="maincontent4">
<br><br>
<center><?php
if(isset($_POST['submit'])) {

    $username = $_POST['username'];
    $pass = $_POST['password'];
    $password = md5($pass);
    $result = get_mysqli("oc_users WHERE username = '$username' AND password = '$password' AND active = 1" );
    $num_row = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

    if($num_row == 1) {
        $_SESSION['user'] = $row['username'];
        header("location:/");
    } else {
        echo '<font color="#FF0000" face="Arial"><b>Wrong username or Password!</b></font><br>';
    }
    if(empty($_POST['username'])) {
        echo '<font color="#FF0000" face="Arial"><b>Empty username!</b></font><br>';
    } 
    if(empty($_POST['password'])) {
        echo '<font color="#FF0000" face="Arial"><b>Empty password!</b></font>';
    }
}
?></center>
    <form method="POST" action="/page/login">
        <div align="center"><br><font color="#FF0000" face="Arial"><b></b></font><br>
        
        <table cellspacing="0" cellpadding="2" width="300" align="center">
            <tbody><tr>
                <td bgcolor="#646464" align="center">
                    <font face="Arial" color="#FFFFFF"><b> ..:: Login ::..</b></font>
                </td>
            </tr>
            <tr>
                <td bgcolor="#AAAAAA" align="center">
                    <table width="270"> 
                        <tbody><tr>
                            <td align="left"><font face="Arial" color="#000000">Username:</font></td>
                            <td align="left"><input style="width:200px;padding:2px;" name="username" type="text" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td align="left"><font face="Arial" color="#000000">Password:</font></td>
                            <td align="left"><input style="width:200px;padding:2px;" name="password" type="password" autocomplete="off"></td>
                            <script type="text/javascript" src="http://nv.github.io/show-password-on-focus.js/show_password_onfocus.user.js"></script>
                        </tr>

                                          </tbody></table>
                    <br>
                    <input type="submit" name="submit" value=" LOGIN ">
                    <br><br>
                    <a href="/page/register">Register new account</a>
                    <br>
                    <a href="/page/forpass">Forgot password?</a>
                    <br><br>
                </td>
            </tr>
        </tbody></table>
        </div>
    </form>
</div>
<?php
}
?>

<?php include(THEMES.'footer.php');?>