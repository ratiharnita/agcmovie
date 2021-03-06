<?php include('header.php');
if(!is_role()){
  header("location:index.php");
}
?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Add New <?php if($post_type == "page"){echo 'Page';}else{echo 'Post';}?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                            <?php
$NEXTQ = get_mysqli('oc_posts ORDER BY id DESC LIMIT 1');
$NEXTFETCHASSOC = mysqli_fetch_assoc($NEXTQ);
$nextid = $NEXTFETCHASSOC['id'] + 1;
if (is_admin()){
if($post_type == "page"){
if(!empty($_POST['title']) || !empty($_POST['description'])){
$title        = escape($_POST['title']);
$description  = escape($_POST['description']);
$user         = escape($_POST['user']);
$urltitle     = permalink($title);  
$permalink    = $urltitle;
$pubdate      = date("Y-m-d H:i:s");
$active       = escape($_POST['edit-post-status']);
   $cekguid = get_mysqli("oc_posts where guid='$permalink'"); 
   if(mysqli_num_rows($cekguid) > 0 ) {
   $guid      = $urltitle.'-'.$nextid;
   } else {
   $guid      = $urltitle;
   }
    $db       = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
   $q1        = "INSERT INTO oc_posts (title,description,user,guid,permalink,pubdate,active,type) VALUES ('$title','$description','$user','$guid','$permalink','$pubdate','$active','2')";
$result       = mysqli_query($db, $q1) or die (mysqli_error($db));
mysqli_close($db);
  if($q1){
     header("location:/oc-admin/post.php?post=$nextid&post_type=page");
  }
} 

}else{
if(!empty($_POST['title']) || !empty($_POST['description'])){
$title        = escape($_POST['title']);
$description  = escape($_POST['description']);
$user         = escape($_POST['user']);
$terms        = escape($_POST['terms']);
$tags         = escape($_POST['tags']);
$active       = escape($_POST['edit-post-status']);
$sticky       = escape($_POST['edit-post-sticky']);
$comment      = escape($_POST['comment_status']);
$urltitle     = permalink($title);  
$permalink    = $urltitle;
$pubdate      = date("Y-m-d H:i:s");
   $guid      = custom_permalink($permalink,$terms);
         $url = get_bloginfo('url').'/'.$guid;
   $db        = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
   $q1        = "INSERT INTO oc_posts (title,description,user,guid,permalink,terms,pubdate,active,type,tags,sticky,comment_status) VALUES ('$title','$description','$user','$guid','$permalink','$terms','$pubdate','$active','1','$tags','$sticky','$comment')";
$result       = mysqli_query($db, $q1) or die (mysqli_error($db));
mysqli_close($db);
  if($result){
      $ping = pingomatic($title,$url);
      if($ping){
      header("location:/oc-admin/post.php?post=$nextid");
      }
  }
} 
}
}
?>
              <form method="post" action="post-new.php?<?php if($post_type == "page"){echo 'post_type=page';}else{echo 'post_type=post';}?>" role="form" enctype="multipart/form-data">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                        <div class="form-group">
                                            <input name="title" class="form-control" placeholder="Enter title here">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="description" id="content" class="form-control" style="width: 100%; height: 300px;"></textarea>
                                        </div>
                                </div>
                                <!-- /.col-lg-12 (nested) -->
                                
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8-->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Publish
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                                <?php if($post_type == "page"){}else{?>
                                <li class=""><a href="#categories" data-toggle="tab">Categories</a></li>
                                <li class=""><a href="#other" data-toggle="tab">Other Options</a></li>
                                <?php }?>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="home">
                                    <br>
                                    <div class="misc"><i class="glyphicon glyphicon-pencil"></i> Status: <select name="edit-post-status"><option value="1">Publish</option><option value="0">Draft</option></select></div>
                                    <div class="misc"><i class="glyphicon glyphicon-time"></i> Sticky: <select name="edit-post-sticky"><option value="1">Yes</option><option selected value="0">No</option></select></div>
                                    <div class="misc"><i class="glyphicon glyphicon-floppy-save"></i> Published <strong>immediately</strong></div>
    <?php 
     if ($hook->hook_exist ( 'admin_post_options' )) {
	$hook->execute_hook ( 'admin_post_options' );
     }
    ?>
                                </div>
                                <?php if($post_type == "page"){}else{?>
                                <div class="tab-pane fade" id="categories">
                                    <label> </label>
                                    <select class="form-control" name="terms"><?php echo showcat();?></select>
                                    <h5><a href="category.php" target="_blank">+ Add New Category</a></h5>
                                </div>
                                <div class="tab-pane fade" id="other">
                                    <h5>Tags</h5>
                                    <div class="form-group">
                                            <input name="tags" class="form-control">
                                            <p class="help-block">Separate tags with commas</p>
                                    </div>
                                    <div class="misc"><i class="glyphicon glyphicon-comment"></i> Discussion: <input type="checkbox" value="open" name="comment_status" checked/> Allow comments.</div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                      <div class="panel-footer">            
                      <div id="delete-action"><a class="submitdelete deletion" href="post.php?post=<?php echo $nextid;?>&amp;post_status=draft">Save Draft</a></div>
                      <div id="publishing-action">
                      <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['user'];?>"/>                      
                      <button type="submit" class="btn btn-primary">Publish</button>
               </div>
             <div class="clearfix"></div></div>
                    </div>
                    <!-- /.panel -->                
                 </div>
                <!-- /.col-lg-4-->
                </form>
            </div>
<script src="../oc-includes/js/ckeditor/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'content', {
        "filebrowserImageUploadUrl": "<?php echo get_bloginfo('url');?>/oc-includes/js/ckeditor/plugins/imgupload/imgupload.php",
        'filebrowserImageBrowseUrl': '<?php echo get_bloginfo('url');?>/oc-includes/js/ckeditor/plugins/imgbrowse/imgbrowse.html?imgroot=/oc-content/uploads/images',
	toolbar: [
	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo' ] },
	{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
	{ name: 'tools', items: [ 'Maximize' ] },
	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
	{ name: 'others', items: [ '-' ] },
	'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
	{ name: 'paragraph', groups: [ 'list', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'Blockquote' ] },
	{ name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
	{ name: 'colors', items: [ 'TextColor', 'BGColor' ] }
	]
});
</script>
<?php include('footer.php');?>