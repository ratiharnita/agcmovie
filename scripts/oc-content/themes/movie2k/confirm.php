<?php include('header.php');?>

<?php
$passkey = isset($_GET['passkey'])?$_GET['passkey']:"";
if ( $passkey ) {
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$result = mysqli_query($db, "UPDATE oc_users SET description = NULL, active = 1 WHERE description = '$passkey'") or die(mysqli_error($db));
if ( $result ) {
    echo '<div>Your email has been verified, please enter the information that you provided when registering. <a href="/page/login">Log in</a></div>';
} 
mysqli_close($db);
} else {
    header("location:/");
}
?>
<?php include('footer.php');?>