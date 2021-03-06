<?php include(THEMES.'header.php');
if(isset($_POST['submit'])){
        $username = isset($_POST['username'])?$_POST['username']:"";
        $password = substr(md5(uniqid(rand(),1)),3,10);
        $pass = md5($password);
        $query = "oc_users WHERE username = '$username' or email = '$username'";
        $hasil = get_mysqli( "oc_users WHERE username = '$username' or email = '$username'" );
                if (mysqli_num_rows($hasil) > 0){
                        $data  = mysqli_fetch_array($hasil);
                        $alamatEmail = $data['email'];
                        $title  = "New Password";
                        $pesan  = "Username: ".$username." \nYour new password is ".$password;
                        $header = "From: noreply@".$_SERVER["HTTP_HOST"]."";
                        $kirimEmail = mail($alamatEmail, $title, $pesan, $header);
                                if ($kirimEmail) {
                                        $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                                        $hasil = mysqli_query( $db, "UPDATE oc_users SET password = '$pass' WHERE username = '$username' or email = '$username'" ) or die(mysqli_error($db));
                                        mysqli_close($db);
                                                if ($hasil) {
                                                        echo '<div class="alert alert-danger">The new password has been reset and sent to your email</div>';
                                                } 
                                                else 
                                                {
                                                        echo '<div class="alert alert-danger">The new password to the email delivery fails</div>';
                                                }
                                } else { 
                                        echo '<div class="alert alert-danger">This Username or Email not exist.</div>'; 
                                }
                }
?>
<div id="maincontent4">

<br><br>
    <form method="POST" action="/page/forpass">
        <div align="center"><br><font color="#FF0000" face="Arial"><b></b></font><br>
        
        <table cellspacing="0" cellpadding="2" width="300" align="center">
            <tbody><tr>
                <td bgcolor="#646464" align="center">
                    <font face="Arial" color="#FFFFFF"><b> ..:: Send new password ::..</b></font>
                </td>
            </tr>
            <tr>
                <td bgcolor="#AAAAAA" align="center">
                    <br>
                    <table>
                        <tbody><tr>
                            <td><font face="Arial" color="#000000">Email:</font></td>
                            <td><input name="username" placeholder="Your username or Email" ></td>
                        </tr>
                    </tbody></table>
                    <br>
                    <input type="submit" name="submit" value=" SEND ">
                    <br><br>
                    <a href="/page/register">Register new account</a>
                    <br><br>
                </td>
            </tr>
        </tbody></table>
        </div>
    </form>
    
</div>

<?php include(THEMES.'footer.php');?>