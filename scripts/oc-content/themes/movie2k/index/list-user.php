<?php include(THEMES.'header.php');
if ( is_admin() ) {
  
$edit = isset($_GET['edit'])?$_GET['edit']:"";
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if ($action == 'delete'){
    $action = mysqli_query($db, "DELETE FROM oc_users WHERE id = '$post_type'") or die(mysqli_error($db));
    echo '<div class="error">Users successfully deleted</div>';
}
if ( $action == 'yes' ){
    $username = escape($_POST['username']);
    $nickname = escape($_POST['nickname']);
    $email = escape($_POST['email']);
    $onlinemode = isset($_POST['onlinemode'])?$_POST['onlinemode']:"";

    $sql_edit = "UPDATE oc_users SET active='$onlinemode', username = '$username', nickname='$nickname', email='$email' WHERE id = '$post_type'"; 
mysqli_query($db, $sql_edit) or die(mysqli_error($db));
    echo '<div class="error">Users updated</div>';
}  

if ( $action == 'approve' ){
    mysqli_query($db, "UPDATE oc_users SET active = 1 WHERE id = '$post_type'") or die(mysqli_error($db));
    echo '<div class="error">Users updated</div>';
}
if ( $action == 'banned' ){
    mysqli_query($db, "UPDATE oc_users SET active = 2 WHERE id = '$post_type'") or die(mysqli_error($db));
    echo '<div class="error">Users updated</div>';
}  
if ( $action == 'activate' ){
    mysqli_query($db, "UPDATE oc_users SET active = 1 WHERE id = '$post_type'") or die(mysqli_error($db));
    echo '<div class="error">Users updated</div>';
}  
mysqli_close($db);

$start=0;
$limit=25;

if(isset($_GET['page']))
{
$page=$_GET['page'];
$start=($page-1)*$limit;
}
if(empty($post_id)){
$result = get_mysqli("oc_users where role NOT IN ('administrator') ORDER BY id DESC LIMIT $start, $limit");
}else{
$result = get_mysqli("oc_users where active = '$post_id' and role NOT IN ('administrator') ORDER BY id DESC LIMIT $start, $limit");
}
?>

<div id="maincontent4">
<?php 
if ($edit == 'yes'){
$edit = get_mysqli_array("oc_users WHERE id = '$post_type'"); 
?>
    <form method="POST" id="formposturl" action="/page/list-user&post_type=<?php echo $post_type;?>&edit=yes&action=yes">
    <table>
        <tbody>
        <tr><td>Username</td><td><input class="interfaceforms" name="username" type="text" value="<?php echo $edit['username'];?>"></td></tr>
        <tr><td>Name</td><td><input class="interfaceforms" name="nickname" type="text" value="<?php echo $edit['nickname'];?>"></td></tr>
        <tr><td>Email</td><td><input class="interfaceforms" name="email" type="text" value="<?php echo $edit['email'];?>"></td></tr>
        <tr><td>Status:</td><td><select class="interfaceforms" name="onlinemode"><option value="<?php echo $edit['active'];?>">no change</option><option value="1">Active</option><option value="2">Banned</option></select></select></td></tr>
        </tbody></table>
        <br>
        <input type="submit" value="Edit!">
    </form>
    <br><br>
    <?php 
    } 
    ?>

    <br><br>
    Filter: Show only <a href="/page/list-user&post=1">active user</a> (<?php echo numusers("active = 1 and role NOT IN ('administrator')");?>) | <a href="/page/list-user&post=2">banned user</a> (<?php echo numusers("active = 2 and role NOT IN ('administrator')");?>) | <a href="/page/list-user&post=0">waiting user</a> (<?php echo numusers("active = 0 and role NOT IN ('administrator')");?>) | <a href="/page/list-user">all user</a> (<?php echo numusers("active = 1 and role NOT IN ('administrator')");?>)
    <br><br>
    <table class="tables"><tbody>
        <thead><tr>
            <td><strong>Username</strong></td>
            <td align="center" width="70"><strong>Email</strong></td>
            <td align="center" width="50"><strong>Status</strong></td>
            <td align="center" width="200" align="right"><strong>Options</strong></td>
        </tr></thead>
    <?php 
    while ($updates = mysqli_fetch_assoc($result)) { 
        $aktif = $updates['active'];
        if ($aktif==0) {$active='waiting';} elseif ($aktif==1){$active='active';} elseif ($aktif==2){$active='banned';} else {$aktif='active';}
        if ($aktif==0) {$warna='orange';} elseif ($aktif==1){$warna='green';} elseif ($aktif==2){$warna='red';} else {$warna='green';}
    ?>
        <tr bgcolor="#ffffff">
            <td><?php echo $updates['username']?></td>
            <td><?php echo $updates['email']?></td>
            <td bgcolor="<?php echo $warna;?>" align="center"><?php echo $active;?></td>
            <td align="center"><a href="/page/list-user&post_type=<?php echo $updates['id'];?>&edit=yes">edit</a> | <a href="/page/list-user&post_type=<?php echo $updates['id']?>&action=delete">delete</a> | <?php if ($updates['active'] == 1){?><a href="/page/list-user&post=1&post_type=<?php echo $updates['id']?>&action=banned">banned</a><?php }elseif ($updates['active'] == 2){ ?><a href="/page/list-user&post=2&post_type=<?php echo $updates['id']?>&action=activate">activate</a><?php }elseif ($updates['active'] == 0){ ?><a href="/page/list-user&post=0&post_type=<?php echo $updates['id']?>&action=approve">approve</a><?php }else{ ?><a href="/page/list-user&post=0&post_type=<?php echo $updates['id']?>&action=banned">banned</a><?php } ?></td>
        </tr>
    <?php 
    }    
    ?>
    </tbody></table>
    <br><br>
    <?php 

$rows    = mysqli_num_rows(get_mysqli("oc_users"));
$total   = ceil($rows/$limit);

if($page>1){
echo "<a href='/page/list-user&page=".($page-1)."' class='prev'>PREVIOUS</a>";
}
if($id!=$total){
echo "<a href='/page/list-user&page=".($page+1)."' class='prev'>NEXT</a>";
}

echo "<ul class='page'>";
for($i=1;$i<=$total;$i++){
    if($i==$page) { 
        echo "<li class='current'>".$i."</li>"; 
    } else { 
        echo "<li><a href='/page/list-user&page=".$i."'>".$i."</a></li>"; 
    }
}
echo "</ul>";

?>
    </div>

<?php
} else {header("location:/");}
include(THEMES.'footer.php');?>