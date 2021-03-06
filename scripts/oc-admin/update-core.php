<?php include('header.php');
if(!is_admin()){
  header("location:index.php");
}
?>
     <div class="row">
          <div class="col-lg-12">
               <h2>OcimPress Updates</h2>
               <p>Last checked on <?php echo date('F j, Y \a\t h:i a', strtotime(date("r")));?>. &nbsp; <a style="vertical-align: baseline;" class="button" href="update-core.php?action=do-core-reinstall">Check Again</a></p>
               <h3 style="color: #222;font-size: 1.3em;1em 0">You have the latest version of OcimPress. Future security updates will be applied automatically.</h3>
<?php
if($action=='do-core-reinstall'){
	file_put_contents('oc.zip', file_get_contents('http://ocimpress.com/source/latest.zip'));
	$zip = new ZipArchive();
	$res = $zip->open('oc.zip');
	if ($res === TRUE) {
		// Extract ZIP file
		$zip->extractTo('../');
		$zip->close();
		unlink('oc.zip');
	} 
}
?>
          <?php if($message) echo "<p>$message</p>"; ?>
          <ul style="list-style-type: none;padding: 0;margin: 1em 0;" class="core-updates"><li><p>If you need to re-install version 1.0, you can do so here or download the package and re-install manually:</p>
               <form method="post" action="update-core.php?action=do-core-reinstall">
               <p><input type="submit" name="upgrade" id="upgrade" class="button" value="Re-install Now">&nbsp;<a href="http://ocimpress.com/source/latest.zip" class="button">Download 1.0</a>&nbsp;</p>
               </form>
               </li>
          </ul>

          </div><!-- col-lg-12 -->
     </div><!-- row -->

<?php include('footer.php');?>