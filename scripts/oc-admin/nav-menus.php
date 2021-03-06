<?php include('header.php');
if(!is_role()){
  header("location:index.php");
}
?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Edit Menus <a href="nav-menus.php" class="add-new-h2">Add New</a></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
<?php
if ($action == 'delete'){
$db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$delcategory      = mysqli_query($db, "DELETE FROM oc_terms WHERE id='$post_id'") or die(mysqli_error($db));
      echo '<div class="alert alert-success">Menus successfully deleted.</div>';
} 

if($post_type == 'nav_menus'){
    if(isset($_POST['update'])){	
      if(!empty($_POST['name'])) {
        $name   = isset($_POST['name'])?$_POST['name']:"";
        $name   = escape($name);
        $url  = escape($_POST['url']);
        $parent = isset($_POST['parent'])?$_POST['parent']:"";
	$description  = isset($_POST['description'])?$_POST['description']:"";
        $description  = escape($description);
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $cat2 = "UPDATE oc_terms SET name='$name',slug='$url',description='$description',type='$parent' WHERE id = '$post_id'";
	mysqli_query($db, $cat2) or die(mysqli_error($db)); 
	echo "<div class='alert alert-success'>Category has change</div>";
        mysqli_close($db);
      }
    }

$row     = get_mysqli_array("oc_terms WHERE id='$post_id'");
if($row['type']==12){$tipe = 'Pages';} elseif ($row['type']==13){$tipe = 'Links';} elseif ($row['type']==14){$tipe = 'Category';} else {$tipe = 'Links';}
?>
                <div class="col-lg-5">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" action="nav-menus.php?post=<?php echo $post_id;?>&action=edit&post_type=nav_menus" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Link Text</label>
                                            <input name="name" class="form-control" value="<?php echo $row['name'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>URL</label>
                                            <input name="url" class="form-control" value="<?php echo $row['slug'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control" name="parent"><option value="<?php echo $row['type'];?>"><?php echo $tipe;?></option><option value="14">Category</option><option value="12">Pages</option><option value="13">Links</option></select>
                                            <p class="help-block">Pages, Links or Category</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="5" cols="40"><?php echo $row['description'];?></textarea>
                                            <p class="help-block">The description is not prominent by default; however, some themes may show it.</p>
                                        </div>
                                        <div class="form-group">
                                            <button name="update" type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col-lg-12 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-5-->
                      <?php
                      } else {
                      if($action=='add'){
if(!empty($_POST['name'])){
$name         = isset($_POST['name'])?$_POST['name']:"";
$name         = escape($name);

$url          = escape($_POST['url']);
$parent       = isset($_POST['parent'])?$_POST['parent']:"";
$description  = isset($_POST['description'])?$_POST['description']:"";
$description  = escape($description);
$db           = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$catinsert    = "INSERT INTO oc_terms (name,description,slug,type) VALUES ('$name','$description','$url','$parent')";
$q1           = mysqli_query($db, $catinsert) or die(mysqli_error($db)); 
mysqli_close($db);
 } 
}
                      ?>
                <div class="col-lg-5">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" action="nav-menus.php?action=add" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Link Text</label>
                                            <input name="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Url</label>
                                            <input name="url" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control" name="parent"><option value="14">Category</option><option value="12">Pages</option><option value="13">Links</option></select>
                                            <p class="help-block">Pages, Links or Category</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="5" cols="40"></textarea>
                                            <p class="help-block">The description is not prominent by default; however, some themes may show it.</p>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Add New Menu</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col-lg-12 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-5-->
                      <?php
                      } 
                      ?>
                <div class="col-lg-7">
                    <div class="panel panel-default">
                      <ul>
                          <li><span class="hname">Name</span><span class="hdescription">Description</span><span class="hslug">URL</span></li>
                      </ul>
                      <div class="panel-ul">
                          <ul>
                             <?php $query = get_mysqli("oc_terms where type in (12,13,14) ORDER BY name");
                               while($row = mysqli_fetch_assoc($query)){?>
                              <li><span class="tname"><b><a title="Edit <?php echo $row['name'];?>" href="nav-menus.php?post=<?php echo $row['id'];?>&action=edit&post_type=nav_menus"><?php echo $row['name'];?></a></b><div class="row-actions"><a title="Edit <?php echo $row['name'];?>" href="nav-menus.php?post=<?php echo $row['id'];?>&amp;action=edit&post_type=nav_menus">Edit</a> | <a title="Delete" href="nav-menus.php?post=<?php echo $row['id'];?>&action=delete">Delete</a> | <a target="_blank" href="<?php echo $row['slug'];?>">View</a></div></span><span class="tdescription"><?php echo $row['description'];?></span><span class="tslug"><?php echo $row['slug'];?></span></li>
                              <?php } ?>
                          </ul>
                      </div><!-- panel-ul -->    
                      </div><!-- /.panel -->                
                 </div><!-- /.col-lg-7-->
            </div><!-- /.row (nested) -->

<?php include('footer.php');?>