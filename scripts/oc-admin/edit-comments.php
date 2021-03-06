<?php include('header.php');
if(!is_admin()){
  header("location:index.php");
}
?>

            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Comments</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
<?php 
$db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if(is_admin()){
if ($action == 'approvecomment'){
mysqli_query($db, "Update oc_comments Set comment_approved = 1 WHERE comment_ID='$id'") or die(mysqli_error($db));
  echo '<div class="alert alert-success">Comments successfully Approve</div>';
}
if ($action == 'unapprovecomment'){
mysqli_query($db, "Update oc_comments Set comment_approved = 0 WHERE comment_ID='$id'") or die(mysqli_error($db));
  echo '<div class="alert alert-success">Comments successfully Unapprove</div>';
}
if ($action == 'deletecomment'){
mysqli_query($db, "DELETE FROM oc_comments WHERE comment_ID='$id'") or die(mysqli_error($db));
  echo '<div class="alert alert-success">Comments successfully Deleted</div>';
}

if(isset($_POST['action2'])){
if(isset($_POST['bulk'])){
 $checkbox = $_POST['checkbox'];
 for($i=0;$i<count($checkbox);$i++){
  $del_id = $checkbox[$i];
  if($_POST['bulk']=="deleted"){
    $sql = "DELETE FROM oc_comments WHERE comment_ID='$del_id'";
    $result = mysqli_query($db, $sql) or die (mysqli_error($db));
  }else{
    mysqli_query($db, "Update oc_comments Set comment_approved = 0 WHERE comment_ID='$del_id'") or die(mysqli_error($db));
  }
 }
}
}
}
mysqli_close($db);
$oc_users               = new AdminPagina(false);
$oc_users->number_links = 4;
  if($comment_status == "approved"){
   $oc_users->sql       = "SELECT * FROM oc_comments where comment_approved = 1 order by comment_ID desc";
  } elseif($comment_status == "moderated") {
   $oc_users->sql       = "SELECT * FROM oc_comments where comment_approved = 0 order by comment_ID desc";
  } else {
   $oc_users->sql       = "SELECT * FROM oc_comments order by comment_ID desc";
  }
$oc_users_result        = $oc_users->get_page_result();
$oc_users_num_rows      = $oc_users->get_page_num_rows();
$oc_users_nav_info      = $oc_users->page_info("Result: %d - %d of %d records");
$users_pagination       = $oc_users->navigation("", "active", false, false, false, true,"<li>","</li>");
?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="subsubsub">
	                    <a href="edit-comments.php">All <span class="count">(<?php echo numcomment('comment_approved = 1');?>)</span></a> |
	                    <a href="edit-comments.php?comment_status=moderated">Pending <span class="count">(<?php echo numcomment("comment_approved = 0");?>)</span></a> |
	                    <a href="edit-comments.php?comment_status=approved">Approved <span class="count">(<?php echo numcomment("comment_approved = 1");?>)</span></a>          </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                 <form name="form1" method="post" action="">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="all" id="all" /></th>
                                            <th>Author</th>
                                            <th>Comment</th>
                                            <th>In Response To</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php while($row = mysqli_fetch_assoc($oc_users_result)){?>
                                    <tr class="gradeA odd">
                                       <td><input name="checkbox[]" type="checkbox" id="checkbox" value="<?php echo $row['comment_ID'];?>"></td>
                                       <td class="column-username"><img alt="<?php echo $row['comment_author'];?>" src="<?php echo gravatar($row['comment_author_email']);?>" class="avatar-32" height="32" width="32"><strong><a class="row-title" title="Edit <?php echo $row['comment_author'];?>" href="profile.php?user_id=<?php echo $row['user_id'];?>"><?php echo $row['comment_author'];?></a></strong><?php if($row['comment_author_url']!=""){?><br><a title="<?php echo $row['comment_author_url'];?>" href="<?php echo $row['comment_author_url'];?>"><?php echo $row['comment_author_url'];?></a><?php }?></td>
                                       <td>Submitted on <?php echo $row['comment_date'];?><p style="margin:.6em 0;"><?php echo $row['comment_content'];?></p><?php if(is_admin()){?><div class="row-actions"><?php if($row['comment_approved']==0){?><span class="approve"><a href="edit-comments.php?id=<?php echo $row['comment_ID'];?>&action=approvecomment" title="Approve this comment">Approve</a></span><?php }else{?><span class="unapprove"><a href="edit-comments.php?id=<?php echo $row['comment_ID'];?>&action=unapprovecomment" title="Unapprove this comment">Unapprove</a></span><?php }?> | <a title="Reply to this comment" target="_blank" href="/<?php echo get_posts("where id='".$row['comment_post_ID']."'",'guid');?>">Reply</a> | <a href="comment.php?id=<?php echo $row['comment_ID'];?>" title="Edit comment">Edit</a><span class="spam"><?php if($row['comment_approved']==0){?> | <a href="edit-comments.php?id=<?php echo $row['comment_ID'];?>&action=deletecomment" title="Delete Permanently this comment">Delete Permanently</a></span></div><?php }?><?php }?></td>
                                       <td><a href="post.php?post=<?php echo $row['comment_post_ID'];?>"><?php echo get_posts("where id='".$row['comment_post_ID']."'",'title');?></a><br><span class="badge rel" data-original-title="<?php echo numcomment("comment_post_ID = '".$row['comment_post_ID']."' and comment_approved = 0");?> pending"><?php echo numcomment("comment_post_ID = '".$row['comment_post_ID']."' and comment_approved = 1");?></span> <a target="_blank" href="/<?php echo get_posts("where id='".$row['comment_post_ID']."'",'guid');?>">View Post</a></td>
                                    </tr>
<?php
}
?>
</tbody>
                                </table>
<div class="row"><div class="col-sm-6"><label><select name="bulk" class="form-control" style="float: left;width: 150px;font-weight: normal;"><option value="-1" selected="selected">Bulk Actions</option><option value="unapprove">Unapprove</option><option value="deleted">Delete</option></select><input class="btn btn-primary" name="action2" type="submit" id="delete" value="Apply" style="float: left;height: 30px;  line-height: 30px;padding: 0 12px;margin: 0 0 0 10px;"/></label></div><div class="col-sm-6"><div class="dataTables_paginate paging_simple_numbers"><?php echo '<ul class="pagination">'.$users_pagination.'</ul>';?></div></div></div>
</form>
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
<?php include('footer.php');?>