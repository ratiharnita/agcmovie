<?php include(THEMES.'header.php');
if(is_login()){

$pass = isset($_GET['pass'])?$_GET['pass']:"";
if ($pass == 'modify'){
$user             = escape($_POST['name']); 
$password1        = escape($_POST['password1']); 
$password2        = escape($_POST['password2']); 
$password         = md5($password1);

        if(!empty($_POST['password1'])) {
                if ($password1==$password2) {
                        $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                        mysqli_query($db,"UPDATE oc_users  SET password = '$password' WHERE username='$user'") or die (mysqli_error($db));
                        mysqli_close($db);
                                echo "<div class='success'>Successfully Update</div>";
                } 
                else 
                { 
                        echo "<div class='error'>Password did not match! Try again.</div>";
                }
        } 
        else 
        {
        echo "<div class='error'>Please provide a password.</div>";
        }
}
  
$mail = isset($_GET['mail'])?$_GET['mail']:"";
if ($mail == 'modify'){
        $user = escape($_POST['name']); 
        $email1 = escape($_POST['email1']);
        $email2 = escape($_POST['email2']);


        if(!empty($_POST['email1'])) {
        if ($email1==$email2) {
        if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
                echo '<div class="error">Invalid email format.</div>';
        } else 
        {
                $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                mysqli_query($db,"UPDATE oc_users SET password='$password', email='$email1' WHERE username='$user'") or die (mysqli_error($db));
                mysqli_close($db);
                        echo "<div class='success'>Successfully Update</div>";
        }
        } else 
        {
                echo "<div class='error'>Email did not match! Try again.</div>";
        }
        } else 
        {
                echo "<div class='error'>Please provide a Email.</div>";
        }

}  

$act      = isset($_GET['avatar'])?$_GET['avatar']:"";
if($act=='yes'){
$avatar   = isset($_FILES['gambar'])?$_FILES['gambar']:"";
if (!empty($avatar)){
$directory = $_SERVER['DOCUMENT_ROOT'] . '/oc-content/uploads/users/';
if (!@file_exists($directory)) {die("Make sure Upload directory exist!");}

$sql_user_img  = get_mysqli("oc_users WHERE username = '$session'");
$fa_user_img   = mysqli_fetch_array($sql_user_img);
$user_img_id   = $fa_user_img['id']; 
	$FileName  = strtolower($_FILES['gambar']['name']); //uploaded file name
        $ImageExt  = substr($FileName, strrpos($FileName, '.')); //file extension
	$FileType  = $_FILES['gambar']['type']; //file type
	$FileSize  = $_FILES['gambar']["size"]; //file size
	switch(strtolower($FileType))
	{
		//allowed file types
		case 'image/png': //png file
		case 'image/gif': //gif file 
		case 'image/jpeg': //jpeg file
		case 'image/bmp': //bmp file
			break;
		default:
	}
	$NewFileName = $user_img_id.'_o_c_i_m'.$ImageExt;
        if(move_uploaded_file($_FILES['gambar']["tmp_name"], $directory . $NewFileName ))
         {

	   $photos = '/oc-content/uploads/users/'.$NewFileName;
         } else {$photos = '';}
    if(($_FILES['gambar']['size']/1024) > 100) { 
        echo 'File Size is not allowed, only 100 KB Max'; 
    } else {
        $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        mysqli_query($db,"UPDATE oc_users SET avatar = '$photos' WHERE username = '$session'") or die (mysqli_error($db));
        mysqli_close($db);
?>
<div class="success">Avatar updated.</div>
<?php 
}
}
}
?>


            <div align="center"><br><font color="#FF0000" face="Arial"><b></b></font><br>
            
            <table cellspacing="0" cellpadding="20" width="600" align="center">
                <tbody><tr>
                    <td bgcolor="#646464" align="center">
                        <font face="Arial" color="#FFFFFF"><b> ..:: Edit your account ::..</b></font>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#AAAAAA" align="center">
                        <br>
                        <table>
                            <tbody>
                              <form method="POST" id="formposturl" action="/page/modify&pass=modify" enctype="multipart/form-data">
                              <tr>
                                <td><font face="Arial" color="#000000">New password:</font></td>
                                <td><input name="password1" value="" type="password"></td>
                            </tr>
                            <tr>
                                <td><font face="Arial" color="#000000">Password confirmation:</font></td>
                                <td><input name="password2" value="" type="password"></td>
                            </tr><script type="text/javascript" src="http://nv.github.io/show-password-on-focus.js/show_password_onfocus.user.js"></script>

                                                         <tr>
                                <td> </td>
                                <td>
                                    <br>
                                    <input type="hidden" name="name" id="name" value="<?php echo $session;?>">   
                                    <button name="submit" class="submit" id="submit" type="submit">Submit!</button>
                                    <br><br>
                                </td>
                            </tr> 
                                      </form>
                              <form method="POST" id="formposturl" action="/page/modify&mail=modify" enctype="multipart/form-data">
                            <tr>
                                <td><font face="Arial" color="#000000">New Email:</font></td>
                                <td><input name="email1" value="" type="email"></td>
                            </tr>
                            <tr>
                                <td><font face="Arial" color="#000000">Email confirmation:</font></td>
                                <td><input name="email2" value="" type="email"></td>
                            </tr>
                            <tr>
                                <td> </td>
                                <td>
                                    <br>
                                    <input type="hidden" name="name" id="name" value="<?php echo $session;?>">   
                                    <button name="submit" class="submit" id="submit" type="submit">Submit!</button>
                                    <br><br>
                                </td>
                            </tr>
                            </form>
                            <form method="POST" id="formposturl" action="/page/modify&avatar=yes" enctype="multipart/form-data">
                            <tr>
                                <td><font face="Arial" color="#000000">New Avatar:</font></td>
                                <td><input name="gambar" type="file"><font size="1">max. 600kb, picture will be displayed with 38x50px</font></td>
                            </tr>
                            <tr>
                                <td> </td>
                                <td>
                                    <br>
                                    <button name="submit" class="submit" id="submit" type="submit">Upload!</button>
                                    <br><br>
                                </td>
                            </tr>
                            </form>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
            </div>

<?php
} else {header("location:/");}
include(THEMES.'footer.php');?>