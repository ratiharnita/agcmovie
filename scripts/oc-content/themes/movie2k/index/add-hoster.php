<?php include(THEMES.'header.php');
if( is_admin() ){

if ($action == 'add'){
if(!empty($_POST['name'])){
    $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    $name           = escape($_POST['name']); 
    $slug           = permalink($name);
    $flag           = $_SERVER['DOCUMENT_ROOT'] . '/oc-content/themes/movie2k/images/hoster/'.$slug.'.png';

        if($_FILES["hoster"]["name"]!=''){move_uploaded_file($_FILES["hoster"]["tmp_name"], $flag);}
        mysqli_query($db,"INSERT INTO oc_terms (name,slug,type) VALUES ('$name','$slug',3)") or die (mysqli_error($db));
    mysqli_close($db);
}  
} 

if($action == 'edit'){
if(!empty($_POST['name'])){
    $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    $name           = escape($_POST['name']); 
    $slug           = permalink($name);
    $flag           = $_SERVER['DOCUMENT_ROOT'] . '/oc-content/themes/movie2k/images/hoster/'.$slug.'.png';

        if($_FILES["hoster"]["name"]!=''){move_uploaded_file($_FILES["hoster"]["tmp_name"], $flag);}
        mysqli_query($db,"UPDATE oc_terms SET name='$name',slug='$slug' WHERE id = '$post_id'") or die (mysqli_error($db));
    mysqli_close($db);
}
}
?>


            <div align="center"><br><font color="#FF0000" face="Arial"><b></b></font><br>
            
            <table cellspacing="0" cellpadding="20" width="600">
                <tbody>
                 <tr>
                    <td bgcolor="#646464" align="center">
                        <font face="Arial" color="#FFFFFF"><b> ..:: Hoster ::.. </b></font>
                    </td>
                </tr>
               <?php if($action != 'edit'){?>
                <tr>
                    <td bgcolor="#AAAAAA" align="center">
                        <br>
                        <table>
                            <tbody>
                              <form method="POST" id="formposturl" action="/page/add-hoster&action=add" enctype="multipart/form-data">
                              <tr>
                                <td><font face="Arial" color="#000000">Name Hoster&nbsp;</font></td>
                                <td><input name="name" type="text"></td>
                              </tr>
                              <tr>
                                <td><font face="Arial" color="#000000">Icon Hoster </font></td>
                                <td><input name="hoster" type="file"></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <br>
                                    <button name="submit" class="submit" id="submit" type="submit">Add New</button>
                                    <br><br>
                                </td>
                              </tr> 
                              </form>
                        </tbody></table>
                    </td>
                </tr>
                <?php 
                }else{ 
                $row     = get_mysqli_array("oc_terms WHERE id='$post_id'");
                ?>
                <tr>
                    <td bgcolor="#AAAAAA" align="center">
                        <br>
                        <table>
                            <tbody>
                              <form method="POST" id="formposturl" action="/page/add-hoster&post=<?php echo $row['id'];?>&action=edit" enctype="multipart/form-data">
                              <tr>
                                <td><font face="Arial" color="#000000">Name Hoster&nbsp;</font></td>
                                <td><input name="name" value="<?php echo $row['name'];?>" type="text"></td>
                              </tr>
                              <tr>
                                <td><font face="Arial" color="#000000">Icon Hoster </font></td>
                                <td><input name="hoster" type="file"></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <br>
                                    <button name="submit" class="submit" id="submit" type="submit">Edit</button>
                                    <a href="/page/add-hoster">Add New</a>
                                    <br><br>
                                </td>
                              </tr> 
                              </form>
                        </tbody></table>
                    </td>
                </tr>
                <?php } ?>
                 <tr>
                    <td bgcolor="#646464" align="center">
                        <font face="Arial" color="#FFFFFF"><b> ..:: List Hoster ::.. </b></font>
                    </td>
                </tr>
                <?php
                          $result     = get_mysqli("oc_terms WHERE type = 3 order by name asc");
                          while ($row = mysqli_fetch_assoc($result)) 
                {
                ?>
                 <tr>
                    <td bgcolor="#AAAAAA" align="left" style="padding:5px 10px;border-bottom: 1px solid #E4DBDB;">
                        <img src="/oc-content/themes/movie2k/images/hoster/<?php echo $row['slug'];?>.png" width="16" height="16" style="vertical-align: middle;"> <a title="Edit <?php echo $row['name'];?>" href="/page/add-hoster&post=<?php echo $row['id'];?>&action=edit" style="vertical-align: middle;"><font face="Arial" color="#646464"><b><?php echo $row['name'];?></b></font></a>
                    </td>
                </tr>
                <?php 
                } 
                ?>
            </tbody></table>
            </div>

<?php
} else {header("location:/");}
include(THEMES.'footer.php');?>