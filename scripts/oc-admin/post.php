<?php include('header.php');?>

            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Edit <?php if($post_type == "page"){echo 'Page <a href="post-new.php?post_type=page" class="add-new-h2">Add New</a>';}else{echo 'Post <a href="post-new.php" class="add-new-h2">Add New</a>';}?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
<?php
$post_cek     = get_mysqli_array("oc_posts WHERE id='$post_id'");
$postuser     = isset($_GET['user'])?$_GET['user']:"";
$post_status  = isset($_GET['post_status'])?$_GET['post_status']:"";
if ($post_status == 'draft'){
        if ( $postuser == $post_cek['user'] || is_admin() ) {
                $db           = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $resultdraft = mysqli_query($db, "UPDATE oc_posts SET active='0' WHERE id='$post_id'") or die(mysqli_error($db));
                if($resultdraft){
                        echo '<div id="message">Post updated.</div><br/>';
                }
                mysqli_close($db);
        } else {
                $pesan = '<div id="error">You do not have sufficient permissions to edit this posts</div><br/>';
        }
}
if($post_type=='page'){
    if ( is_role() ){
        if(!empty($_POST['title']) || !empty($_POST['description'])){
        $title        = escape($_POST['title']);
        $description  = escape($_POST['description']);
        $guid         = permalink(escape($_POST['permalink']));
        $permalink    = permalink(escape($_POST['permalink']));
        $pubdate      = date("Y-m-d H:i:s");
        $db           = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $qpage        = "UPDATE oc_posts SET title='$title',description='$description',pubdate='$pubdate',guid='$guid',permalink='$permalink' WHERE id='$post_id'";
        $resultpage   = mysqli_query($db, $qpage) or die (mysqli_error($db));
                if($resultpage){
                        pingomatic($title,$url);
                }
        mysqli_close($db);
        }
    }
}
if($post_type=='post'){
if($action=='edit'){
    if ($postuser == $post_cek['user'] || is_role()){
        if(!empty($_POST['title']) || !empty($_POST['description'])){
        $title        = escape($_POST['title']);
        $description  = escape($_POST['description']);
        $terms        = escape($_POST['terms']);
        $tags         = escape($_POST['tags']);
        $comment      = escape($_POST['comment_status']);
        $pubdate      = date("Y-m-d H:i:s");
        $active       = escape($_POST['active']);
        $permalink    = permalink(escape($_POST['permalink']));
    if($_POST['type'] == 1){
        $guid         = edit_permalink($post_id,$permalink,$terms);
    }else{
        $guid         = $permalink;
    } 

        $url          = get_bloginfo('url').'/'.$guid;
        $db           = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $q1           = "UPDATE oc_posts SET title='$title',description='$description',active='$active',pubdate='$pubdate',guid='$guid',permalink='$permalink',terms='$terms',tags='$tags',comment_status='$comment' WHERE id='$post_id'";
        $resultpost   = mysqli_query($db, $q1) or die (mysqli_error($db));
                if($resultpost){
                        pingomatic($title,$url);
                }
        mysqli_close($db);
        } 
        } else {
                $pesan = '<div class="alert alert-danger">You do not have sufficient permissions to edit this posts</div>';
    }
}
}

$post_row = get_mysqli_array("oc_posts WHERE id='$post_id'");
?>
<form method="post" action="post.php?post=<?php echo $post_id?>&action=edit<?php if($post_type == "page"){echo '&post_type=page';}else{echo '&post_type=post';}?>" role="form" enctype="multipart/form-data">
                <div class="col-lg-8">
                   <?php if(!empty($pesan)){echo $pesan;}?><?php if(!empty($resultpost)){?><div id="message"><?php if($post_type == "page"){echo 'Page';}else{echo 'Post';}?> updated.</div><br/><?php };?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                        <div class="form-group">
                                            <input name="title" class="form-control" value="<?php echo stripslashes($post_row['title']);?>" placeholder="Enter title here"><hr>
                                            <strong>Permalink:</strong> <input style="width:50%;height:24px;color:#555;padding:0 10px;border:1px solid #ccc;background:#f7f7f7;border-radius:3px;font-family:cursive,sans-serif;" type="text" name='permalink' value="<?php echo $post_row['permalink'];?>" /> <a href="<?php bloginfo('url');?>/<?php echo $post_row['guid'];?>" target="_blank" title="View Post" class="button button-small">View Post</a> <input id="shortlink" type="hidden" value="<?php bloginfo('url');?>/p=<?php echo $post_row['id'];?>"><a href="#" class="button button-small rel" title="Get Shortlink" onclick="prompt('URL:', jQuery('#shortlink').val()); return false;">Get Shortlink</a><hr>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="description" id="content" class="form-control" style="width: 100%; height: 300px"><?php echo $post_row['description'];?></textarea>
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
                                <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
                                <?php if($post_type == "page") {} else { ?>
                                <?php if($post_row['type'] == 1){ ?>
                                <li class=""><a href="#categories" data-toggle="tab">Categories</a></li>
                                <li class=""><a href="#other" data-toggle="tab">Other Options</a></li>
                                <?php 
                                }
                                }
                                ?>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="info">
                                    <br>
                                    <div class="misc"><i class="glyphicon glyphicon-pencil"></i> Status: <strong><?php echo Published($post_row['id'],'active');?></strong> <input type="checkbox" <?php if( 1 == $post_row['active'] ){ echo 'checked'; }; ?> value="1" name="active" /> Check to publish</div>
                                    <div class="misc"><i class="glyphicon glyphicon-time"></i> Published on: <strong><?php echo date('M d, Y @ h:i', strtotime($post_row['pubdate']));?></strong></div>
                                    <div class="misc"><i class="glyphicon glyphicon-user"></i> Author: <strong><?php echo $post_row['user'];?></strong></div>
                                <?php if($post_row['type'] == 2){ ?>
                                    <div class="misc"><i class="glyphicon glyphicon-comment"></i> Discussion: <input type="checkbox" <?php if( 'open' == $post_row['comment_status'] ){ echo 'checked'; }; ?> value="open" name="comment_status" /> Allow comments.</div>
                                <?php 
                                }
                                ?>
                                </div>
                                <?php if($post_type == "page"){}else{?>
                                <?php if($post_row['type'] == 1){ ?>
                                <div class="tab-pane fade" id="categories">
                                    <label> </label>
                                    <select class="form-control" name="terms"><?php echo postcat($post_row['terms']);?></select>
                                    <h5><a href="category.php" target="_blank">+ Add New Category</a></h5>
                                </div>
                                <div class="tab-pane fade" id="other">
                                    <h5>Tags</h5>
                                    <div class="form-group">
                                            <input name="tags" value="<?php echo $post_row['tags'];?>" class="form-control">
                                            <p class="help-block">Separate tags with commas</p>
                                    </div>
                                    <div class="misc"><i class="glyphicon glyphicon-comment"></i> Discussion: <input type="checkbox" <?php if( 'open' == $post_row['comment_status'] ){ echo 'checked'; }; ?> value="open" name="comment_status" /> Allow comments.</div>
                                </div>
                                <?php 
                                }
                                }
                                ?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                      <div class="panel-footer">            
                           <div id="delete-action"><a class="submitdelete deletion" href="post.php?post=<?php echo $post_id?>&amp;post_status=draft">Move to Trash</a></div>
                           <div id="publishing-action">
                                <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['user'];?>"/>    
                                <input type="hidden" name="type" id="type" value="<?php echo $post_row['type'];?>"/>                                        
                                <button type="submit" class="btn btn-primary">Update</button>
                           </div>
                           <div class="clearfix"></div>
                      </div>
                    </div><!-- panel-default -->         
                 </div><!-- col-lg-4-->
             </form>
            </div>
             <!-- /.row (nested) -->
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