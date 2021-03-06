<?php include('header.php');
if(!is_admin()){
  header("location:index.php");
}
?>
        <div class="row">
                <div class="col-lg-12">
                        <h2 class="page-header">Users</h2>
                </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
        <div class="row">
                <div class="col-lg-12">
<?php 
$db       = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if ($action == 'delete'){
mysqli_query($db, "DELETE FROM oc_users WHERE id='$user_id'") or die(mysqli_error($db));
        echo '<div class="alert alert-success">Users successfully Deleted</div>';
}

if(isset($_POST['action2'])){
        if(isset($_POST['bulk'])){
                $checkbox = $_POST['checkbox'];
                for($i=0;$i<count($checkbox);$i++){
                        $del_id = $checkbox[$i];
                                if($_POST['bulk']=="deleted"){
                                        $sql = "DELETE FROM oc_users WHERE id='$del_id'";
                                        $result = mysqli_query($db, $sql) or die (mysqli_error($db));
                                }
                }
        }
}
mysqli_close($db);

$oc_users               = new AdminPagina(1000);
$oc_users->number_links = 4;
  if($role == "administrator"){
   $oc_users->sql       = "SELECT * FROM oc_users where active = 1 and role = 'administrator' order by id asc";
  } elseif($role == "subscriber") {
   $oc_users->sql       = "SELECT * FROM oc_users where active = 1 and role = 'subscriber' order by id asc";
  } elseif($role == "pending") {
   $oc_users->sql       = "SELECT * FROM oc_users where active = 0 order by id asc";
  } else {
   $oc_users->sql       = "SELECT * FROM oc_users order by id asc";
  }
$oc_users_result        = $oc_users->get_page_result();
$oc_users_num_rows      = $oc_users->get_page_num_rows();
$oc_users_nav_info      = $oc_users->page_info("Result: %d - %d of %d records");
$users_pagination       = $oc_users->navigation("", "active", false, false, false, true,"<li>","</li>");
?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="subsubsub">

	                    <a href="users.php">All <span class="count">(<?php echo numusers('active = 1 or active = 0');?>)</span></a> |
                            <a href="users.php?role=pending">Pending <span class="count">(<?php echo numusers('active = 0');?>)</span></a> |
	                    <a href="users.php?role=administrator">Administrator <span class="count">(<?php echo numusers("active = 1 and role = 'administrator'");?>)</span></a> |
	                    <a href="users.php?role=subscriber">Subscriber <span class="count">(<?php echo numusers("active = 1 and role = 'subscriber'");?>)</span></a>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                 <form name="form1" method="post" action="">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="all" id="all" /></th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Posts</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php while($row = mysqli_fetch_assoc($oc_users_result)){?>
                                    <tr class="gradeA odd">
                                       <td><input name="checkbox[]" type="checkbox" id="checkbox" value="<?php echo $row['id'];?>"></td>
                                       <td class="column-username"><img alt="<?php echo $row['username'];?>" src="<?php echo gravatar($row['email']);?>" class="avatar-32" height="32" width="32"><strong><?php if(is_admin()){?><a class="row-title" title="Edit <?php echo $row['username'];?>" href="profile.php?user_id=<?php echo $row['id'];?>"><?php echo $row['username'];?></a></strong> <div class="row-actions"><a title="Edit this item" href="profile.php?user_id=<?php echo $row['id'];?>">Edit</a><?php if($row['id']==1){}else{?> | <a title="Delete Users" href="users.php?user_id=<?php echo $row['id'];?>&action=delete">Delete</a><?php }?></div><?php }else{?><a class="row-title" title="<?php echo $row['username'];?>" href="/user/<?php echo $row['guid'];?>"><?php echo $row['username'];?></a><?php if($row['username'] == $session){?><div class="row-actions"><a title="Edit this item" href="profile.php?user_id=<?php echo $row['id'];?>">Edit</a></div><?php }?><?php }?></td>
                                       <td><?php echo $row['nickname'];?></td>
                                       <td><?php echo $row['email'];?></td>
                                       <td><?php echo $row['role'];?></td>
                                       <td><?php echo numpost("user = '".$row['username']."' and active = 1 and type = 1");?></td>
                                    </tr>
<?php
}
?>
</tbody>
                                </table>
<div class="row"><div class="col-sm-6"><label><select name="bulk" class="form-control" style="float: left;height: 30px;width: 130px;padding: 6px 5px;font-weight: normal;"><option value="-1" selected="selected">Bulk Actions</option><option value="deleted">Delete</option></select><input class="btn btn-primary" name="action2" type="submit" id="delete" value="Apply" style="float: left;height: 30px;  line-height: 30px;padding: 0 12px;margin: 0 0 0 10px;"/></label></div><div class="col-sm-6"><div class="dataTables_paginate paging_simple_numbers"><?php echo '<ul class="pagination">'.$users_pagination.'</ul>';?></div></div></div>
</form>
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->

<?php include('footer.php');?>