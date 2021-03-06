<?php include('header.php');
if(!is_role()){
  header("location:index.php");
}
?>
            <div class="row">
                <div class="col-lg-12">
                <div style="margin-bottom:20px"></div>
<?php 
                if(is_admin()){
                    $db     = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    if ($action == 'trash'){
                        mysqli_query($db, "UPDATE oc_posts SET active='0' WHERE id='$post_id'") or die(mysqli_error($db));
                            echo '<div id="message">Post successfully draft</div>';
                    }

                    if ($action == 'restore'){
                        mysqli_query($db, "UPDATE oc_posts SET active='1' WHERE id='$post_id'") or die(mysqli_error($db));
                            echo '<div id="message">Post successfully Restore</div>';
                    }

                    if ($action == 'sticky'){
                        mysqli_query($db, "UPDATE oc_posts SET sticky='1' WHERE id='$post_id'") or die(mysqli_error($db));
                            echo '<div id="message">Post successfully sticky</div>';
                    }

                    if ($action == 'unsticky'){
                        mysqli_query($db, "UPDATE oc_posts SET sticky='0' WHERE id='$post_id'") or die(mysqli_error($db));
                            echo '<div id="message">Post successfully unsticky</div>';
                    }

                    if ($action == 'delete'){
                        $image = get_mysqli_array("oc_posts WHERE id='$post_id'"); 
                        $delimage = $image['images'];
                        $filename = '..'.$delimage;
                        if(@getimagesize($filename)){unlink($filename);}
                        mysqli_query($db, "DELETE FROM oc_posts WHERE id='$post_id'") or die(mysqli_error($db));
                            echo '<div id="message">Post successfully Deleted</div>';
                    }

                    if(isset($_POST['action2'])){
                        if(isset($_POST['bulk'])){
                        $checkbox = $_POST['checkbox'];
                        for($i=0;$i<count($checkbox);$i++){
                            $del_id = $checkbox[$i];
                                if($_POST['bulk']=="deleted"){
                                    $image = get_mysqli_array("oc_posts WHERE id='$del_id'");  
                                    $delimage = $image['images'];
                                    $filename = '..'.$delimage;
                                        if(@getimagesize($filename)){unlink($filename);}
                                    $sql = "DELETE FROM oc_posts WHERE id='$del_id'";
                                        $result = mysqli_query($db, $sql) or die (mysqli_error($db));
                                    } elseif ( $_POST['bulk'] == "trash" ) {
                                        mysqli_query($db, "UPDATE oc_posts SET active='0' WHERE id='$del_id'") or die(mysqli_error($db));
                                    } else {
                                    }
                                }
                            }
                        }
                    }
                    mysqli_close($db);
                    $oc_edit               = new AdminPagina(1000);
                    $oc_edit->number_links = 4;
                        if($post_type == "page"){
                            if($post_status == "publish"){
                                $oc_edit->sql          = "SELECT * FROM oc_posts where active = 1 and type = 2 order by id desc";
                            } elseif ( $post_status == "draft" ) {
                                $oc_edit->sql          = "SELECT * FROM oc_posts where active = 0 and type = 2 order by id desc";
                            } else {
                                $oc_edit->sql          = "SELECT * FROM oc_posts where type = 2 order by id desc";
                            }
                        } else {
                            if($post_status == "publish"){
                                $oc_edit->sql          = "SELECT * FROM oc_posts where active = 1 and type NOT IN ('2') order by id desc";
                            } elseif ( $post_status == "draft" ) {
                                $oc_edit->sql          = "SELECT * FROM oc_posts where active = 0 and type NOT IN ('2') order by id desc";
                            } elseif ( $post_status == "sticky" ) {
                                $oc_edit->sql          = "SELECT * FROM oc_posts where sticky = 1 and type NOT IN ('2') order by id desc";
                            } elseif ( $post_status == "category" ) {
                                $oc_edit->sql          = "SELECT * FROM oc_posts where terms = '$category_name' and type NOT IN ('2') order by id desc";
                            } elseif ( $post_status == "author" ) {
                                $oc_edit->sql          = "SELECT * FROM oc_posts where user = '$post_id' and type NOT IN ('2') order by id desc";
                            } else {
                                $oc_edit->sql          = "SELECT * FROM oc_posts where type NOT IN ('2') order by id desc";
                            }
                        }
                    $oc_edit_result        = $oc_edit->get_page_result();
                    $oc_edit_num_rows      = $oc_edit->get_page_num_rows();
                    $oc_edit_nav_info      = $oc_edit->page_info("Result: %d - %d of %d records");
                    $edit_pagination       = $oc_edit->navigation("", "active", false, false, false, true,"<li>","</li>");
?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="subsubsub">

                            <?php if($post_type == "page"){ ?>

	                    <a href="edit.php?post_type=page">All <span class="count">(<?php echo numpost('type = 2');?>)</span></a> |
	                    <a href="edit.php?post_type=page&post_status=publish">Published <span class="count">(<?php echo numpost('active = 1 and type = 2');?>)</span></a> |
	                    <a href="edit.php?post_type=page&post_status=draft">Draft <span class="count">(<?php echo numpost('active = 0 and type = 2');?>)</span></a>
                            <?php }else{ ?>

	                    <a href="edit.php?post_type=post">All <span class="count">(<?php echo numpost("type NOT IN ('2')");?>)</span></a> |
	                    <a href="edit.php?post_type=post&post_status=publish">Published <span class="count">(<?php echo numpost("active = 1 and type NOT IN ('2')");?>)</span></a> |
	                    <a href="edit.php?post_type=post&post_status=draft">Draft <span class="count">(<?php echo numpost("active = 0 and type NOT IN ('2')");?>)</span></a> |
	                    <a href="edit.php?post_type=post&post_status=sticky">Sticky <span class="count">(<?php echo numpost("sticky = 1 and type NOT IN ('2')");?>)</span></a> 
                            <select name="category_name" id="category" onchange="location = this.options[this.selectedIndex].value;"><option value="">View all categories</option><?php echo option_edit_categories('type = 1');?></select>
                            <?php }?>

                            </div>
                        </div> <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form name="form1" method="post" action="">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="all" id="all" /></th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <?php if($post_type == "page"){}else{?>
                                            <th>Categories</th>
                                            <th><i class="glyphicon glyphicon-comment"></i></th>
                                            <?php }?>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php
                    while($row = mysqli_fetch_assoc($oc_edit_result)){ 

                    if($post_type == "post"||$post_type == ""){
?>
                         <tr class="gradeA odd">
                             <td><input name="checkbox[]" type="checkbox" id="checkbox" value="<?php echo $row['id'];?>"></td>

                             <td><?php if( is_admin() ){?>
                             <strong>
                                 <a class="row-title" title="Edit <?php echo $row['title'];?>" href="post.php?post=<?php echo $row['id'];?>"><?php echo $row['title'];?></a><?php echo publish($row['id'],' - ');?>
                             </strong> 
                             <div class="row-actions">
                                 <a title="Edit this item" href="post.php?post=<?php echo $row['id'];?>">Edit</a> | <?php if($row['sticky'] == 0){?><a title="Make this post sticky" href="edit.php?post_status=sticky&post_type=post&post=<?php echo $row['id'];?>&action=sticky">Sticky</a><?php }else{ ?><a title="Make this post Unsticky" href="edit.php?post_status=sticky&post_type=post&post=<?php echo $row['id'];?>&action=unsticky">Unsticky</a><?php } ?>| 

                                    <?php if($post_status == "publish" || $row['active'] == 1){?>
                                     <a title="Move this item to the Trash" href="edit.php?post_status=publish&post_type=post&post=<?php echo $row['id'];?>&action=trash">Trash</a><?php } else { ?><a title="Restore" href="edit.php?post_status=draft&post_type=post&post=<?php echo $row['id'];?>&action=restore">Restore</a> | <a title="Delete Permanently" href="edit.php?post_status=draft&post_type=post&post=<?php echo $row['id'];?>&action=delete">Delete Permanently</a>
                                    <?php } ?>

                                    <?php if($post_status == "publish" || $row['active'] == 1){?> | <a title="View <?php echo $row['title'];?>" href="../<?php echo $row['guid'];?>" target="_blank">View</a><?php if($row['sticky'] == 1){?> | <strong style="color: #222;">Sticky</strong><?php } ?>
                                    <?php } ?>
                             </div><!-- row-actions -->

                             <?php } else { ?>

                                    <?php if($row['user'] == $session){?><strong><a class="row-title" title="Edit <?php echo $row['title'];?>" href="post.php?post=<?php echo $row['id'];?>"><?php echo $row['title'];?></a><?php echo publish($row['id'],' - ');?></strong> <div class="row-actions"><a title="Edit this item" href="post.php?post=<?php echo $row['id'];?>">Edit</a> <?php if($post_status == "publish" || $row['active'] == 1){?> | <a title="View <?php echo $row['title'];?>" href="../<?php echo $row['guid'];?>" target="_blank">View</a><?php }?></div><?php }else{?><strong><a class="row-title" title="<?php echo $row['title'];?>" href="../<?php echo $row['guid'];?>" target="_blank"><?php echo $row['title'];?></a><?php echo publish($row['id'],' - ');?></strong><?php }?>
<?php }?></td>
                             <td><a href="edit.php?post_type=post&post_status=author&post=<?php echo $row['user'];?>"><?php echo $row['user'];?></a></td>
                             <td class="center"><a href="edit.php?post_type=post&post_status=category&category_name=<?php echo $row['terms'];?>"><?php echo Categories($row['terms'],'name');?></a></td>
                             <td class="center"><span class="badge rel" data-original-title="<?php echo numcomment("comment_post_ID = '".$row['id']."' and comment_approved = 0");?> pending"><?php echo numcomment("comment_post_ID = '".$row['id']."' and comment_approved = 1");?></span></td>
                             <td class="center"><?php echo date('d/m/Y', strtotime($row['pubdate']));?><br><?php echo Published($row['id'],'active');?></td>
                         </tr>
<?php                     
                    } else { 
                    if(is_admin()) {
?>
                    <tr class="gradeA odd">
                         <td><input name="checkbox[]" type="checkbox" id="checkbox" value="<?php echo $row['id'];?>"></td>
                             <td><strong><a class="row-title" title="Edit <?php echo $row['title'];?>" href="post.php?post=<?php echo $row['id'];?>&post_type=page"><?php echo $row['title'];?></a><?php echo publish($row['id'],' - ');?></strong> <div class="row-actions"><a title="Edit this item" href="post.php?post=<?php echo $row['id'];?>&post_type=page">Edit</a> | <?php if($post_status == "publish" || $row['active'] == 1){?><a title="Move this item to the Trash" href="edit.php?post_status=publish&post_type=page&post=<?php echo $row['id'];?>&action=trash">Trash</a><?php }else{ ?><a title="Restore" href="edit.php?post_status=draft&post_type=page&post=<?php echo $row['id'];?>&action=restore">Restore</a> | <a title="Delete Permanently" href="edit.php?post_status=draft&post_type=page&post=<?php echo $row['id'];?>&action=delete">Delete Permanently</a><?php }?><?php if($post_status == "publish" || $row['active'] == 1){?> | <a title="View <?php echo $row['title'];?>" href="../<?php echo $row['guid'];?>" target="_blank">View</a><?php }?></div></td>
                             <td><?php echo $row['user'];?></td>
                             <?php if($post_type == "post"){?><td class="center"><a href="edit.php?post_type=post&post_status=category&category_name=<?php echo $row['terms'];?>"><?php echo Categories($row['terms'],'name');?></a></td><?php }?>
                             <td class="center"><?php echo date('d/m/Y', strtotime($row['pubdate']));?><br><?php echo Published($row['id'],'active');?></td>
                    </tr>
<?php }
}
}?>
</tbody>
                                </table>
<div class="row"><div class="col-sm-6"><label><select name="bulk" class="form-control" style="float: left;width: 150px;font-weight: normal;"><option value="-1" selected="selected">Bulk Actions</option><option value="trash">Move to Draft</option><option value="deleted">Delete Permanently</option></select><input class="btn btn-primary" name="action2" type="submit" id="delete" value="Apply" style="float: left;margin: 0 0 0 10px;"/></label></div><div class="col-sm-6"><div class="dataTables_paginate paging_simple_numbers"><?php echo '<ul class="pagination">'.$edit_pagination.'</ul>';?></div></div></div>
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