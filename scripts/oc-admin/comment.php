<?php include('header.php');
if(!is_role()){
  header("location:index.php");
}
?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Edit Comment</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
<?php 
if(is_role()){
if($action=='edit'){

        $comment_author       = escape($_POST['newcomment_author']);
        $comment_author_email = escape($_POST['newcomment_author_email']);
        $comment_author_url   = escape($_POST['newcomment_author_url']);
        $comment_content      = escape($_POST['description']); 
        $comment_approved     = escape($_POST['comment_status']);

        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                $result = mysqli_query($db, "UPDATE oc_comments SET comment_author='$comment_author', comment_author_email='$comment_author_email', comment_author_url='$comment_author_url', comment_content='$comment_content', comment_approved='$comment_approved' WHERE comment_ID='$id'") or die (mysqli_error($db));
        mysqli_close($db);
                if ($result){
                        header("location:edit-comments.php");
                }
}
}
$comment_row = get_mysqli_array("oc_comments WHERE comment_ID='$id'");
?>
               <form action="comment.php?id=<?php echo $id;?>&action=edit" method="post">
                <div class="col-lg-9">
                 <div id="namediv" class="stuffbox">
                  <h3><label for="name">Author</label></h3>
                  <table class="form-table editcomment">
                  <tbody>
                   <tr>
	            <td class="first">Name:</td>
	            <td><input type="text" name="newcomment_author" class="form-control" value="<?php echo $comment_row['comment_author'];?>"></td>
                   </tr>
                   <tr>
	           <td>E-mail:</td>
	           <td><input type="text" name="newcomment_author_email" class="form-control" size="30" value="<?php echo $comment_row['comment_author_email'];?>"></td>
                   </tr>
                   <tr>
	           <td>URL (<a href="<?php echo $comment_row['comment_author_url'];?>" rel="external nofollow" target="_blank">visit site</a>):</td>
	           <td><input type="text" name="newcomment_author_url" size="30" class="form-control code" value="<?php echo $comment_row['comment_author_url'];?>"></td>
                   </tr>
                  </tbody>
                 </table>
                 </div>
                 <textarea name="description" id="content" style="width: 100%; height: 100px"><?php echo $comment_row['comment_content'];?></textarea>
                </div>
                <!-- /.col-lg-9 -->
                <div class="col-lg-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Status
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <div class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
                           <label class="approved"><input type="radio" checked name="comment_status" value="1">Approved</label><br>
                           <label class="waiting"><input type="radio" name="comment_status" value="0">Pending</label>
                           </div>
                          <i class="glyphicon glyphicon-time"></i> Submitted on: <strong><?php echo date('M d, Y @ h:i', strtotime($comment_row['comment_date']));?></strong>
                        </div>
                        <!-- /.panel-body -->
                      <div class="panel-footer">            
                      <div id="delete-action"><a class="submitdelete deletion" href="edit-comments.php?id=<?php echo $post_id?>&action=unapprovecomment">Move to Trash</a></div>
                      <div id="publishing-action">
                      <button type="submit" class="btn btn-primary">Update</button>
               </div>
                  <div class="clearfix"></div>
                  </div>
                    </div>
                    <!-- /.panel -->                
                 </div>
               </form>

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
                </div>
                <!-- /.row -->
<?php include('footer.php');?>