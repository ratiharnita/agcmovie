<?php include('header.php');
if(!is_role()){
  header("location:index.php");
}
$hooks->do_action( 'admin_create_table' );
?>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Plugins</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
<?php 
switch ($action) {
	case "deactivate" :
		$deaction['action'] = 0;
		$deactive['active'] = 0;

		query_update ( "oc_plugins", $deaction, "filename='" . $filename . "'" );
		query_update ( "oc_plugins", $deactive, "filename='" . $filename . "'" );
                header("location:/oc-admin/plugins.php");

		break;
	case "activate" :
		$countactivate = numplugin ( "filename = '" . escape ( $filename ) . "'" );
		if ($countactivate < 1) {
                        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                        mysqli_query($db,"INSERT INTO oc_plugins (filename,action,active) VALUES ('$filename',1,1)") or die (mysqli_error($db));
                        mysqli_close($db);
                        header("location:/oc-admin/plugins.php");

		} else {

			$dataaction ['action'] = 1;
			$dataactivate ['active'] = 1;
			query_update ( "oc_plugins", $dataaction , "filename='" . $filename . "'" );
			query_update ( "oc_plugins", $dataactivate , "filename='" . $filename . "'" );
                        header("location:/oc-admin/plugins.php");

		}
                break;
}

$oc_plugins               = new AdminPagina(false);
$oc_plugins->number_links = 4;
  if($plugin_status == "active"){
   $oc_plugins->sql       = "SELECT * FROM oc_plugins where action = 1 order by filename asc";
  } elseif($plugin_status == "inactive") {
   $oc_plugins->sql       = "SELECT * FROM oc_plugins where action = 0 order by filename asc";
  } else {
   $oc_plugins->sql       = "SELECT * FROM oc_plugins order by filename asc";
  }

$oc_plugins_result        = $oc_plugins->get_page_result();
$oc_plugins_num_rows      = $oc_plugins->get_page_num_rows();
$plugins_pagination       = $oc_plugins->navigation("", "active", false, false, false, true,"<li>","</li>");
?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="subsubsub">
	                    <a href="plugins.php">All <span class="count">(<?php echo numplugin("action NOT IN ('3')");?>)</span></a> |
	                    <a href="plugins.php?plugin_status=active">Active <span class="count">(<?php echo numplugin('action = 1');?>)</span></a> |
	                    <a href="plugins.php?plugin_status=inactive">Inactive <span class="count">(<?php echo numplugin('action = 0');?>)</span></a>          </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Plugin</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        <?php 
foreach ( $plugin_admin as $plugin_header ) {
	$active = false;
	foreach ( $oc_plugins_result as $result_row )
		if ($plugin_header ['filename'] == $result_row ['filename'] && $result_row ['action'] == 1)
			$active = true;
	?>
		<tr <?php if ($active) echo "class='active'";?>>
			<td class="plugin-title"><strong><?php echo $plugin_header ['Name'];?></strong><div class="row-actions visible"><span <?php if ($active) echo "class='activate'";?>><?php if (! $active) {echo '<a href="plugins.php?action=activate&filename=' . $plugin_header ['filename'] . '" title="Activate this plugin" class="edit">Activate</a>';} else {echo '<a href="plugins.php?action=deactivate&filename=' . $plugin_header ['filename'] . '" title="Deactivate this plugin" class="edit">Deactivate</a>';?></span> <?php if ($plugin_header ['Setting']) {echo '| <span class="settings"><a href="' . $plugin_header ['Setting'] . '" title="Settings">Settings</a></span>';} }?> <?php if (!$active) echo '| <span class="delete"><a href="plugins.php?role=delete-selected&filename=' . $plugin_header ['filename'] . '" title="Delete this plugin" class="delete">Delete</a></span>';?></div>
                        </td>
			<td class='column-description desc'><div class="plugin-description"><p><?php echo $plugin_header ['Description'];?></p></div>
                        <div class="second plugin-version-author-uri">Version <?php echo $plugin_header ['Version'];?> | By <a target="_blank" rel="nofollow" href="<?php echo $plugin_header ['AuthorURI'];?>" title="Visit author homepage"><?php echo $plugin_header ['Author'];?></a></div>
			</td>
		</tr>
             <?php
               
             }
             ?>
</tbody>
                                </table>
</form>
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div><!-- /.row -->
            </div><!-- /.col-lg-12 -->
<?php include('footer.php');?>