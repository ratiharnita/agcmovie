<?php include(THEMES.'header.php');
if ( is_login() ) {
  
$edit = isset($_GET['edit'])?$_GET['edit']:"";

if ($action == 'delete'){
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    $action = mysqli_query($db, "DELETE FROM oc_posts WHERE id = '$post_type'") or die(mysqli_error($db));
    echo '<div class="error">Movie successfully deleted</div>';
mysqli_close($db);
}
if ( $action == 'yes' ){
    $url1 = escape($_POST['url1']);
    $url2 = escape($_POST['url2']);
    $url3 = escape($_POST['url3']);
    $hoster = isset($_POST['hoster'])?$_POST['hoster']:"";
    $picturequality = isset($_POST['picturequality'])?$_POST['picturequality']:"";
    $pubdate = date("Y-m-d H:i:s");
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($db, "UPDATE oc_posts SET pubdate = '$pubdate', url='$url', url2='$url2', url3='$url3', hoster='$hoster', picturequality='$picturequality' WHERE id = '$post_type'") or die(mysqli_error($db));
mysqli_close($db);
    echo '<div class="error">Movie updated</div>';
}  
if(empty($post_id)){$post_id = 1;}  
$result = get_mysqli("oc_posts where active = '$post_id' and type NOT IN ('2') and user = '$session' ORDER BY pubdate DESC");
?>

<div id="maincontent4">
<?php 
if ($edit == 'yes'){
$edit = get_mysqli_array("oc_posts WHERE id = '$post_id'"); 
?>
    <form method="POST" id="formposturl" action="/page/myuploads&post_type=<?php echo $post_id;?>&edit=yes&action=yes">
    <table>
        <tbody><tr><td>Part 1</td><td><textarea cols="40" rows="5" class="interfaceforms" name="url1" placeholder="embed code or link"><?php echo $edit['url'];?></textarea></td></tr>
        <?php if (!empty($edit['url3'])){?> 
        <tr><td>Part 2</td><td><textarea cols="40" rows="5" class="interfaceforms" name="url2" placeholder="embed code or link"><?php echo $edit['url2'];?></textarea></td></tr
        <tr><td>Part 3</td><td><textarea cols="40" rows="5" class="interfaceforms" name="url3" placeholder="embed code or link"><?php echo $edit['url3'];?></textarea></td></tr><?php } elseif (!empty($edit['url2'])){?> 
        <tr><td>Part 2</td><td><textarea cols="40" rows="5" class="interfaceforms" name="url2" placeholder="embed code or link"><?php echo $edit['url2'];?></textarea></td></tr>
        <?php } ;?> 
        <tr><td>Hoster:</td><td><select class="interfaceforms" name="hoster"><option value="<?php echo $edit['hoster'];?>">no change</option><?php echo option_category('type = 3');?></select></select></td></tr>

        <tr><td width="120">Picture Quality:</td><td><select class="interfaceforms" type="checkbox" name="picturequality"><option value="<?php echo $edit['picturequality'];?>">no change</option><option value="0">Unknown</option><option value="1">Cam</option><option value="2">TS</option><option value="3">TC</option><option value="4">Screener</option><option value="55">R5</option><option value="5">DVDRip/BDRip</option></select></td></tr>
        </tbody></table>
        <br>
        <input type="submit" value="Edit!">
    </form>
    <br><br>
    <?php 
    } 
    ?>

    <form method="POST" action="/page/add" style="display:inline">
        <input type="submit" value="Add movie" style="width:150px">
    </form> &nbsp;&nbsp;&nbsp;&nbsp;
    <form method="POST" action="/page/addtvshow" style="display:inline">
        <input type="submit" value="Add tvshow" style="width:150px">
    </form> &nbsp;&nbsp;&nbsp;&nbsp;
    <br><br>
    Filter: Show only <a href="/page/myuploads&post=1">online links</a> | <a href="/page/myuploads&post=2">offline links</a> | <a href="/page/myuploads&post=0">waiting links</a> | <a href="/page/myuploads&post=3">queued links</a> | <a href="/page/myuploads&post=4">disabled links</a> | <a href="/page/myuploads">all links</a>
    <br><br>
    <table class="tables"><tbody>
        <thead><tr>
            <td><strong>Movie</strong></td>
            <td align="center" width="150"><strong>Hoster</strong></td>
            <td align="center" width="100"><strong>Status</strong></td>
            <td align="center" width="100" align="right"><strong>Options</strong></td>
        </tr></thead>
    <?php 
    while ($updates = mysqli_fetch_assoc($result)) { 
        $aktif = $updates['active'];
        if ($aktif==0) {$active='waiting for approval';} elseif ($aktif==1){$active='online';} elseif ($aktif==2){$active='offline links';} elseif ($aktif==3){$active='queued links';} elseif ($aktif==4){$active='disabled links';} else {$aktif='online';}
        if ($aktif==0) {$warna='orange';} elseif ($aktif==1){$warna='green';} elseif ($aktif==2){$warna='yellow';} elseif ($aktif==3){$warna='blue';} elseif ($aktif==4){$warna='red';} else {$warna='green';}
    ?>
        <tr bgcolor="#DDDDDD">
            <td><a href="/<?php echo $updates['guid']?>"><?php echo $updates['title']?></a></td>
            <td><img src="/oc-content/themes/movie2k/images/hoster/<?php echo strtolower($updates['hoster']);?>.png" width="16" height="16"> <?php echo $updates['hoster']?></td>
            <td bgcolor="<?php echo $warna;?>" align="center"><?php echo $active;?></td>
            <td align="center"><a href="/page/myuploads&post_type=<?php echo $updates['id'];?>&edit=yes">edit</a> | <a href="/page/myuploads&post_type=<?php echo $updates['id']?>&action=delete">delete</a> </td>
        </tr>
    <?php 
    }
    ?>
    </tbody></table>
    <br><br>
    </div>

<?php
} else {header("location:/");}
include(THEMES.'footer.php');?>