<?php include('header.php');
if(!is_role()){
  header("location:index.php");
}
?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Categories <a href="category.php" class="add-new-h2">Add New</a></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
<?php
if ($action == 'delete'){
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $delcategory  = mysqli_query($db, "DELETE FROM oc_terms WHERE id='$post_id'") or die(mysqli_error($db));
                echo '<div class="alert alert-success">Category successfully deleted.</div>';
        mysqli_close($db);
} 

if($post_type == 'category'){
        if(isset($_POST['update'])){	
        if(!empty($_POST['name'])) {
                $name   = isset($_POST['name'])?$_POST['name']:"";
                $name   = escape($name);
                $slugs  = escape($_POST['slug']);
	        $slug   = permalink($slugs);
                $parent = isset($_POST['parent'])?$_POST['parent']:"";
                $description  = escape($description);

                $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $cat2 = "UPDATE oc_terms SET name='$name',slug='$slug',description='$description',child='$parent' WHERE id = '$post_id'";
	                mysqli_query($db, $cat2) or die(mysqli_error($db)); 
	                        echo "<div class='alert alert-success'>Category has change</div>";
                mysqli_close($db);
        }
        }

$row     = get_mysqli_array("oc_terms WHERE id='$post_id'");
$childs  = $row['child'];
$qc      = get_mysqli_array("oc_terms WHERE id='$childs'");
?>
                <div class="col-lg-5">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" action="category.php?post=<?php echo $post_id;?>&action=edit&post_type=category" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" class="form-control" value="<?php echo $row['name'];?>">
                                            <p class="help-block">The name is how it appears on your site.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input name="slug" class="form-control" value="<?php echo $row['slug'];?>">
                                            <p class="help-block">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Parent</label>
                                            <select class="form-control" name="parent"><option value="<?php echo $row['child'];?>"><?php echo $qc['name'];?></option><option value="0">None</option><?php echo showcat();?></select>
                                            <p class="help-block">Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children categories for Bebop and Big Band. Totally optional.</p>
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
                                $name = isset($_POST['name'])?$_POST['name']:"";
                                $name = escape($name);
                                $categorysql     = get_mysqli("oc_terms WHERE name='".$name."' and type=1"); 
                                $hasilcategory   = mysqli_fetch_array($categorysql);
                                        if ($hasilcategory['name'] != $name){
                                                $slugs = escape($_POST['slug']);
                                                if(empty($slugs)) {$slug = permalink($name);} else {$slug = permalink($slugs);}
                                                $parent       = isset($_POST['parent'])?$_POST['parent']:"";
                                                $description  = isset($_POST['description'])?$_POST['description']:"";
                                                $description  = escape($description);
                                                        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                                        $catinsert = "INSERT INTO oc_terms (name,description,slug,child,type) VALUES ('$name','$description','$slug','$parent',1)";
                                                        $q1 = mysqli_query($db, $catinsert) or die(mysqli_error($db)); 
                                                        mysqli_close($db);
                                        }else{echo '<div class="alert alert-danger">A term with the name '.$name.' already exists.</div>';}
                        } 
                        }
                        ?>
                <div class="col-lg-5">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" action="category.php?action=add" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" class="form-control">
                                            <p class="help-block">The name is how it appears on your site.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input name="slug" class="form-control">
                                            <p class="help-block">The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Parent</label>
                                            <select class="form-control" name="parent"><option value="0">None</option><?php echo showcat();?></select>
                                            <p class="help-block">Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children categories for Bebop and Big Band. Totally optional.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="5" cols="40"></textarea>
                                            <p class="help-block">The description is not prominent by default; however, some themes may show it.</p>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Add New Category</button>
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
                          <li><span class="hname">Name</span><span class="hdescription">Description</span><span class="hslug">Slug</span><span class="hcount">Count</span></li>
                      </ul>
                      <div class="panel-ul">
                          <ul>
                              <?php echo categoryphp(); ?>
                          </ul>
                      </div><!-- panel-ul -->    
                      </div><!-- /.panel -->                
                 </div><!-- /.col-lg-7-->
            </div><!-- /.row (nested) -->
<?php 
function categorylist($data, $parent = 0, $class = 'dropdown-menu'){
       static $i = 1;
       $tab = str_repeat(" ",$i);
            if(isset($data[$parent])){
                $html = "$tab";
                $i++;
                 foreach($data[$parent] as $v){
                     $child = categorylist($data, $v->id);
                     $html .= "$tab";
if($v->child > 0){
                     $html .= '<li><span class="tname"><b><a title="Edit '.$v->name.'" href="category.php?post='.$v->id.'&action=edit&post_type=category">— '.$v->name.'</a></b><div class="row-actions"><a title="Edit '.$v->name.'" href="category.php?post='.$v->id.'&action=edit&post_type=category">Edit</a> | <a title="Delete Category" href="category.php?post='.$v->id.'&action=delete">Delete</a> | <a target="_blank" href="../category/'.$v->slug.'">View</a></div></span><span class="tdescription">'.$v->description.'</span><span class="tslug">'.$v->slug.'</span><span class="tcount"><a href="category.php?post='.$v->id.'&action=edit&post_type=category">'.numpost("terms = '$v->id' and type NOT IN ('2')").'</a></span>';
}else{
                     $html .= '<li><span class="tname"><b><a title="Edit '.$v->name.'" href="category.php?post='.$v->id.'&action=edit&post_type=category">'.$v->name.'</a></b><div class="row-actions"><a title="Edit '.$v->name.'" href="category.php?post='.$v->id.'&action=edit&post_type=category">Edit</a> | <a title="Delete Category" href="category.php?post='.$v->id.'&action=delete">Delete</a> | <a target="_blank" href="../category/'.$v->slug.'">View</a></div></span><span class="tdescription">'.$v->description.'</span><span class="tslug">'.$v->slug.'</span><span class="tcount"><a href="category.php?post='.$v->id.'&action=edit&post_type=category">'.numpost("terms = '$v->id' and type NOT IN ('2')").'</a></span>';

}
                     if($child){
                         $i–;
                         $html .= "<ul>";
                         $html .= $child;
                         $html .= "</ul>";
                         $html .= "$tab";
                     }
                     $html .= "</li>";
                }
                $html .= "$tab";
            return $html;
          } else {
        return false;
      }
}

function categoryphp(){
      $query = get_mysqli("oc_terms where type = 1 ORDER BY name");
      while($row = mysqli_fetch_object($query)){
           $data[$row->child][] = $row;
      }
    return categorylist($data);
}
?>
<?php include('footer.php');?>