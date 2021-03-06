<?php include(THEMES.'header.php');
if ( is_admin() ) {
$db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$edit = isset($_GET['edit'])?$_GET['edit']:"";

if ($action == 'delete'){
    mysqli_query($db, "DELETE FROM oc_posts WHERE id = '$post_type'") or die(mysqli_error($db));
    echo '<div class="error">Movie successfully deleted</div>';
}
if ( $action == 'yes' ){
    $title = escape($_POST['title']);
    $url1 = escape($_POST['url1']);
    $url2 = escape($_POST['url2']);
    $url3 = escape($_POST['url3']);
    $onlinemode = isset($_POST['onlinemode'])?$_POST['onlinemode']:"";
    $hoster = isset($_POST['hoster'])?$_POST['hoster']:"";
    $picturequality = isset($_POST['picturequality'])?$_POST['picturequality']:"";
    $pubdate = date("Y-m-d H:i:s");

    $sql_edit = "UPDATE oc_posts SET title='$title', active='$onlinemode', pubdate = '$pubdate', url='$url1', url2='$url2', url3='$url3', hoster='$hoster', picturequality='$picturequality', report='' WHERE id = '$post_type'"; 
    mysqli_query($db, $sql_edit) or die(mysqli_error($db));
    echo '<div class="error">Movie updated</div>';
}  
if ( $action == 'sticky' ){
    $pubdate = date("Y-m-d H:i:s");
    mysqli_query($db, "UPDATE oc_posts SET pubdate = '$pubdate', sticky = 1 WHERE id = '$post_type'") or die(mysqli_error($db));
    echo '<div class="error">Movie updated</div>';
}  
if ( $action == 'unsticky' ){
    $pubdate = date("Y-m-d H:i:s");
    mysqli_query($db, "UPDATE oc_posts SET pubdate = '$pubdate', sticky = 0 WHERE id = '$post_type'") or die(mysqli_error($db));
    echo '<div class="error">Movie updated</div>';
}
if ( $action == 'approve' ){
    mysqli_query($db, "UPDATE oc_posts SET active = 1 WHERE id = '$post_type'") or die(mysqli_error($db));
    echo '<div class="error">Movie updated</div>';
}
if ( $action == 'offline' ){
    mysqli_query($db, "UPDATE oc_posts SET active = 2 WHERE id = '$post_type'") or die(mysqli_error($db));
    echo '<div class="error">Movie updated</div>';
}  
if ( $action == 'online' ){
    mysqli_query($db, "UPDATE oc_posts SET active = 1 WHERE id = '$post_type'") or die(mysqli_error($db));
    echo '<div class="error">Movie updated</div>';
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
$result = get_mysqli("oc_posts where type NOT IN ('2') ORDER BY pubdate DESC LIMIT $start, $limit");
}else{
$result = get_mysqli("oc_posts where active = '$post_id' and type NOT IN ('2') ORDER BY pubdate DESC LIMIT $start, $limit");
}
?>

<div id="maincontent4">
<?php 
if ($edit == 'yes'){
$edit = get_mysqli_array("oc_posts WHERE id = '$post_type'"); 
?>
    <form method="POST" id="formposturl" action="/page/list-movie&post_type=<?php echo $post_type;?>&edit=yes&action=yes">
    <table>
        <tbody>
        <tr><td>Title:</td><td><input type="text" name="title" value="<?php echo $edit['title'];?>" /></td></tr>
        <tr><td>Part 1</td><td><textarea cols="40" rows="5" class="interfaceforms" name="url1" placeholder="embed code or link"><?php echo $edit['url'];?></textarea></td></tr>
        <?php if (!empty($edit['url3'])){?> 
        <tr><td>Part 2</td><td><textarea cols="40" rows="5" class="interfaceforms" name="url2" placeholder="embed code or link"><?php echo $edit['url2'];?></textarea></td></tr
        <tr><td>Part 3</td><td><textarea cols="40" rows="5" class="interfaceforms" name="url3" placeholder="embed code or link"><?php echo $edit['url3'];?></textarea></td></tr><?php } elseif (!empty($edit['url2'])){?> 
        <tr><td>Part 2</td><td><textarea cols="40" rows="5" class="interfaceforms" name="url2" placeholder="embed code or link"><?php echo $edit['url2'];?></textarea></td></tr>
        <?php } ;?> 
        <tr><td>Status:</td><td><select class="interfaceforms" name="onlinemode"><option value="<?php echo $edit['active'];?>">no change</option><option value="1">Online</option><option value="2">Offline</option></select></select></td></tr>
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
    Filter: Show only <a href="/page/list-movie&post=1">online links</a> (<?php echo numpost("active = 1 and type NOT IN ('2')");?>) | <a href="/page/list-movie&post=2">offline links</a> (<?php echo numpost("active = 2 and type NOT IN ('2')");?>) | <a href="/page/list-movie&post=0">waiting links</a> (<?php echo numpost("active = 0 and type NOT IN ('2')");?>) | <a href="/page/list-movie">all links</a> (<?php echo numpost("type NOT IN ('2')");?>)
    <br><br>
    <table class="tables"><tbody>
        <thead><tr>
            <td><strong>Movie</strong></td>
            <td align="center" width="70"><strong>Genre</strong></td>
            <td align="center" width="120"><strong>Hoster</strong></td>
            <td align="center" width="50"><strong>Status</strong></td>
            <td align="center" width="50"><strong>Report</strong></td>
            <td align="center" width="200" align="right"><strong>Options</strong></td>
        </tr></thead>
    <?php 
    while ($updates = mysqli_fetch_assoc($result)) { 
        if ($updates['type']==1) {$genre='Movie';} elseif ($updates['type']==3){$genre='TV Show';} elseif ($updates['type']==4){$genre='XXX Movie';} else {$genre='Movie';}
        $aktif = $updates['active'];
        if ($aktif==0) {$active='waiting';} elseif ($aktif==1){$active='online';} elseif ($aktif==2){$active='offline';} else {$aktif='online';}
        if ($aktif==0) {$warna='orange';} elseif ($aktif==1){$warna='green';} elseif ($aktif==2){$warna='red';} else {$warna='green';}
    ?>
        <tr bgcolor="#ffffff">
            <td><a href="/<?php echo $updates['guid']?>"><?php echo $updates['title']?></a></td>
            <td align="center"><?php echo $genre;?></td>
            <td><img src="/oc-content/themes/movie2k/images/hoster/<?php echo strtolower($updates['hoster']);?>.png" width="16" height="16"> <?php echo $updates['hoster']?></td>
            <td bgcolor="<?php echo $warna;?>" align="center"><?php echo $active;?></td>
            <td align="center"><?php echo $updates['report']?></td>
            <td align="center"><?php if ($updates['sticky'] == 1){?><a href="/page/list-movie&post_type=<?php echo $updates['id']?>&action=unsticky">unsticky</a><?php }else{ ?><a href="/page/list-movie&post_type=<?php echo $updates['id']?>&action=sticky">sticky</a><?php } ?> | <a href="/page/list-movie&post_type=<?php echo $updates['id'];?>&edit=yes">edit</a> | <a href="/page/list-movie&post_type=<?php echo $updates['id']?>&action=delete">delete</a> | <?php if ($updates['active'] == 1){?><a href="/page/list-movie&post=1&post_type=<?php echo $updates['id']?>&action=offline">offline</a><?php }elseif ($updates['active'] == 2){ ?><a href="/page/list-movie&post=2&post_type=<?php echo $updates['id']?>&action=online">online</a><?php }elseif ($updates['active'] == 0){ ?><a href="/page/list-movie&post=0&post_type=<?php echo $updates['id']?>&action=approve">approve</a><?php }else{ ?><a href="/page/list-movie&post=0&post_type=<?php echo $updates['id']?>&action=online">online</a><?php } ?></td>
        </tr>
    <?php 
    }    
    ?>
    </tbody></table>
    <br><br>
    <?php 

$rows    = mysqli_num_rows(get_mysqli("oc_posts"));
$total   = ceil($rows/$limit);

if($page>1){
echo "<a href='/page/list-movie&page=".($page-1)."' class='prev'>PREVIOUS</a>";
}
if($id!=$total){
echo "<a href='/page/list-movie&page=".($page+1)."' class='prev'>NEXT</a>";
}

echo "<ul class='page'>";
for($i=1;$i<=$total;$i++){
    if($i==$page) { 
        echo "<li class='current'>".$i."</li>"; 
    } else { 
        echo "<li><a href='/page/list-movie&page=".$i."'>".$i."</a></li>"; 
    }
}
echo "</ul>";

?>
    </div>

<?php
} else {header("location:/");}
include(THEMES.'footer.php');?>