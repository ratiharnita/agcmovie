<?php include('header.php');
if(!is_admin()){
  header("location:index.php");
}
?>

            <div class="row">
                <div class="col-lg-12">
                <h2>Add Plugins</h2>
<?php
if($_FILES["zip_file"]["name"]) {
	$filename = $_FILES["zip_file"]["name"];
	$source = $_FILES["zip_file"]["tmp_name"];
	$type = $_FILES["zip_file"]["type"];
	
	$name = explode(".", $filename);
        $target = $_SERVER['DOCUMENT_ROOT'] . "/oc-content/plugins/"; 
	$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/s-compressed');
	foreach($accepted_types as $mime_type) {
		if($mime_type == $type) {
			$okay = true;
			break;
		} 
	}
	
	$continue = strtolower($name[1]) == 'zip' ? true : false;
	if(!$continue) {
		$message = "<div id='error'>The file you are trying to upload is not a .zip file.</div>";
	}else{

	$target_path = $target.$filename;  // change this to the correct site path

	if(move_uploaded_file($source, $target_path)) {
		$zip = new ZipArchive();
		$res = $zip->open($target_path);
		if ($res === TRUE) {
		        $message = "<div id='message'>Your .zip plugin file was uploaded and unpacked.</div>";
			$zip->extractTo($target);
			$zip->close();

			unlink($target_path);
		}
	} else {$message = "<div id='error'>The file you are trying to upload is not a .zip file. Please try again.</div>";}
	}
}
?>
                <?php if($message) echo "<p>$message</p>"; ?>
                <div class="upload-theme">
	         <p class="install-help">If you have a plugin in a .zip format, you may install it by uploading it here.</p>
                 <form method="post" enctype="multipart/form-data" class="wp-upload-form" action="theme-install.php">
	          <input type="file" name="zip_file">
	          <input type="submit" name="submit" id="install-theme-submit" class="button" value="Install Now">
                 </form>
		</div>

                </div><!-- col-lg-12 -->
            </div><!-- row -->

<?php include('footer.php');?>