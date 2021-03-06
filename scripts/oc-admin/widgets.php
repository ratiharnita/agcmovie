<?php include('header.php');
if(!is_admin()){
  header("location:index.php");
}
?>
   <div class="row">
      <div class="col-lg-12">
         <h2 class="page-header">Widgets</h2>
       </div><!-- col-lg-12 -->
   </div><!-- row -->
   <div class="row">
         <?php 
         $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
         if ( $action == 'inactive' ){
              mysqli_query($db, "UPDATE oc_options SET active = 2 WHERE id = '$id'") or die(mysqli_error($db));
         }
         if ( $action == 'active' ){
              mysqli_query($db, "UPDATE oc_options SET active = 1 WHERE id = '$id'") or die(mysqli_error($db));
         }
         if ( $action == 'delete' ){
              mysqli_query($db, "DELETE FROM oc_options WHERE active = 2 and id = '$id'") or die(mysqli_error($db));
         }
         if ( $action == 'add' ){
             $title= preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', escape($_POST['title'])); 
             $content = escape($_POST['content']);
                 if (!empty($title)){
                       mysqli_query($db, "INSERT INTO oc_options (option_name, option_value, autoload, active) VALUES ('$title', '$content', 'widget', 1)")or die (mysqli_error($db));
           }
        }
         if ( $action == 'shortcode' ){
             $title= preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', escape($_POST['title_shortcode'])); 
             $content = escape($_POST['content_shortcode']);
                 if (!empty($title)){
                       mysqli_query($db, "INSERT INTO oc_options (option_name, option_value, autoload, active) VALUES ('$title', '$content', 'shortcode', 1)")or die (mysqli_error($db));
           }
        }
         if ( $action == 'saving' ){
               if (isset($_POST['title'])){
             $title = $_POST['title'];
             $content = $_POST['content'];

            mysqli_query($db, "UPDATE oc_options SET option_name = '$title', option_value = '$content' WHERE id='$id'") or die(mysqli_error($db));
           }
        }
        ?>
          <div class="col-lg-6 col-md-6">
             <h3>Available Widgets</h3>
             <p>To activate a widget click on a Add Widget button.</p>
             <form action="widgets.php?action=add" method="post" enctype="multipart/form-data">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                         <button type="button" class="close" data-toggle="collapse" data-target="#c-add-widget" aria-expanded="true" aria-controls="c-add-widget"><span class="glyphicon glyphicon-chevron-up"></span></button>
                        Text or HTML</div>
                    <div class="panel-body panel-collapse collapse in" id="c-add-widget">
                       <input type="text" name="title" placeholder="Title Widgets" class="form-control" />
                       <div class="clearfix"></div>
                       <hr />
                       <div class="clearfix"></div>
                       <textarea class="form-control" rows="5" placeholder="Arbitrary text or HTML." name="content"></textarea>
                       <hr />
                       <div class="clearfix"></div>
                       <button type="submit" name="save_widget" class="button button-primary">Add Widget</button>
                       <button type="reset" class="button btn-danger">Reset</button>
                     </div> <!-- panel-body-->
                </div> <!-- panel panel-primary-->
             </form>

             <form action="widgets.php?action=shortcode" method="post" enctype="multipart/form-data">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                         <button type="button" class="close" data-toggle="collapse" data-target="#c-add-shortcode" aria-expanded="true" aria-controls="c-add-shortcode"><span class="glyphicon glyphicon-chevron-up"></span></button>
                        Shortcode</div>
                    <div class="panel-body panel-collapse collapse" id="c-add-shortcode">
                       <input type="text" name="title_shortcode" placeholder="Title Widgets" class="form-control" />
                       <div class="clearfix"></div>
                       <hr />
                       <div class="clearfix"></div>
                       <textarea class="form-control" rows="5" placeholder="Shortcode." name="content_shortcode"></textarea>
                       <hr />
                       <div class="clearfix"></div>
                       <button type="submit" name="save_widget" class="button button-primary">Add Widget</button>
                       <button type="reset" class="button btn-danger">Reset</button>
                     </div> <!-- panel-body-->
                </div> <!-- panel panel-primary-->
             </form>
             <h3>Inactive Widgets</h3>
             <p>To activate a widget click on a Active link below.</p>
             <?php $result=mysqli_query($db, "SELECT * FROM oc_options where active = '2' ORDER BY id ASC") or die (mysqli_error($db));
      while($widgets = mysqli_fetch_array($result)){ ?>
              <div class="panel panel-primary">
                  <div class="panel-heading">Text: <?php echo $widgets['option_name'];?></div>
                  <div class="panel-body">
                       <a href='widgets.php?id=<?php echo $widgets['id'];?>&action=active'>Active</a>
                       <a href='widgets.php?id=<?php echo $widgets['id'];?>&action=delete'>Delete</a>
                  </div> <!-- panel-body --> 
              </div> <!-- panel panel-primary --> 
          <?php }
          ?>
          </div><!-- col-lg-6-->
          <div class="col-lg-6 col-md-6">
             <h3>Active Widgets</h3>
             <p>To deactivate a widget click on a delete button.</p>
              <div class="panel panel-green">
                  <div class="panel-heading">
                       <h3>Primary Sidebar</h3>
                       <p>Main sidebar that appears on the blog.</p>
                  </div>
                  <div class="panel-body">
     <?php $result=mysqli_query($db, "SELECT * FROM oc_options where active = 1 ORDER BY id ASC") or die (mysqli_error($db));
      while($widgets = mysqli_fetch_array($result)){ ?>
         <form action="widgets.php?action=saving&id=<?php echo $widgets['id'];?>" method="post" enctype="multipart/form-data">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                     <button type="button" class="close" data-toggle="collapse" data-target="#c-saving-<?php echo $widgets['id'];?>" aria-expanded="true" aria-controls="c-saving-<?php echo $widgets['id'];?>"><span class="glyphicon glyphicon-chevron-down"></span></button>
                     Text: <?php echo $widgets['option_name'];?>
                  </div>
                  <div class="panel-body panel-collapse collapse" id="c-saving-<?php echo $widgets['id'];?>">
                       <input type="text" name="title" value="<?php echo $widgets['option_name'];?>" placeholder="Title Widgets" class="form-control" />
                       <div class="clearfix"></div>
                       <hr />
                       <textarea class="form-control" rows="2" name="content"><?php echo $widgets['option_value'];?></textarea>
                       <hr />
                       <div class="clearfix"></div>
                       <button type="submit" class="button button-primary">Save</button>
                       <a href='widgets.php?id=<?php echo $widgets['id'];?>&action=inactive' class="button button-danger">Delete</a>
                       </div><!-- panel-body --> 
              </div> <!-- panel panel-primary --> 
          </form>
      <?php }
      mysqli_close($db);
      ?>
                  </div><!-- panel-body --> 
              </div> <!-- panel panel-primary --> 
          </div><!-- col-lg-6-->
   </div><!-- row -->
<?php include('footer.php');?>