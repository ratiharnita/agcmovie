<?php 
require_once('../oc-load.php');
if(!isset($_SESSION['user'])){
     header("location:../oc-login.php");
}
if (!empty($theme)){

$bits = array();
$file_source = '../oc-content/themes/'.$theme.'/style.css';

if (($handle = fopen($file_source,'r')) !== FALSE) {
     while (($data = fgetcsv($handle, 0, ":")) !== FALSE) {
          if ( ! isset($data[1])) {
               $data[1] = null;
          }
     $bits[$data[0]] = $data[1];
     } 
    fclose ( $handle  );
}

$fopen = fopen($file_source,'r');
     $theme_data = fread($fopen, filesize($file_source));
          preg_match ( '|Theme Name:(.*)$|mi', $theme_data, $name );
          preg_match ( '|Theme URI:(.*)$|mi', $theme_data, $uri );
          preg_match ( '|Version:(.*)|i', $theme_data, $version );
          preg_match ( '|Description:(.*)$|mi', $theme_data, $description );
          preg_match ( '|Author:(.*)$|mi', $theme_data, $author_name );
          preg_match ( '|Author URI:(.*)$|mi', $theme_data, $author_uri );
          preg_match ( '|Tags:(.*)$|mi', $theme_data, $tags );

?>
<!DOCTYPE html>
<html>
<head>
     <meta http-equiv="content-type" content="text/html; charset=UTF-8">
     <title><?php echo $theme;?></title>  
</head>
<BODY>
<div class="theme-overlay">
     <div class="theme-overlay active">
	<div class="theme-wrap">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span></button>
		</div>
		<div class="modal-body">
			<div class="theme-screenshots">
				<div class="screenshot"><img src="/oc-content/themes/<?php echo $theme;?>/screenshot.png" alt="<?php echo $theme;?>"></div>
			</div>

			<div class="theme-info">
				<span class="current-label">Current Theme</span>
				<h3 class="theme-name"><?php echo $name [1] ;?><span class="theme-version">Version: <?php echo $version[1];?></span></h3>
				<h4 class="theme-author">By <a target="_blank" href="<?php echo $author_uri[1] ;?>"><?php echo $author_name[1] ;?></a></h4>
				<p class="theme-description"><?php echo $description[1] ;?></p>
				<p class="theme-tags"><span>Tags:</span> <?php echo $tags[1];?></p>
			</div>
		</div>

		<div class="modal-footer">
                   <?php if (get_bloginfo('theme')==$theme){?>
			<div class="active-theme">
				<a href="/oc-admin/customize.php" class="button button-primary customize load-customize hide-if-no-customize">Customize</a>
				<a class="button button-secondary" href="widgets.php">Widgets</a> <a class="button button-secondary" href="nav-menus.php">Menus</a> <a class="button button-secondary" href="themes.php?page=custom-header">Header</a> <a class="button button-secondary" href="themes.php?page=custom-background">Background</a>
                        </div>
                     <?php }else{?>
			<div class="inactive-theme">
				<a href="/oc-admin/themes.php?action=edit&theme=<?php echo $theme;?>" class="button button-primary activate">Activate</a>
				
				<a target="_blank" href="../" class="button button-secondary load-customize hide-if-no-customize">Live Preview</a>
			</div>
                      <?php }?>
		</div>
	</div>
</div></div>
</BODY>
</html>
<?php }else{?>
<?php include('header.php');

if (isset($_POST['submit']) && isset($_FILES['logo'])) {
    if($_FILES["logo"]["name"]!=''){
        move_uploaded_file($_FILES["logo"]["tmp_name"], "../oc-content/uploads/logo.png");
    }
}
if (isset($_POST['save']) && isset($_FILES['favicon'])) {
    if($_FILES["favicon"]["name"]!=''){
        move_uploaded_file($_FILES["favicon"]["tmp_name"], "../oc-content/uploads/favicon.png");
    }
}
?>

            <div class="row">
                <div class="col-lg-12 wrap">
                <h2>Customize Themes</h2>
                <div class="clearfix"></div>
                <h3>Custom Header</h3>
                <div class="clearfix"></div>

<table class="form-table">
<tbody>

<tr>
<th scope="row">Preview</th>
<td>
		<div id="headimg">
		<h1 class="displaying-header-text"><a id="name" style="color:#fff;" onclick="return false;" href="/"><?php echo logo();?></a></h1>
	</div>
</td>
</tr>

<tr>
<th scope="row">Select Image</th>
<td>
	<p>You can select an image to be shown at the top of your site by uploading from your computer or choosing from your media library.<br><b>Note: Refresh browser after upload images</b></p>
	<form enctype="multipart/form-data" id="upload-form" class="wp-upload-form" method="post" action="/oc-admin/customize.php">
	<p class="upload-theme">
		<label for="upload">Choose an image from your computer:</label><br>
		<input type="file" id="upload" name="logo">
		<input type="submit" name="submit" id="submit" class="button" value="Upload">
        </p>
	</form>
</td>
</tr>
</tbody>
</table>

                <h3>Custom Favicon</h3>
                <div class="clearfix"></div>
<table class="form-table">
<tbody>

<tr>
<th scope="row">Preview</th>
<td>
		<div id="headimg">
		<h1 class="displaying-header-text"><a id="name" style="color:#fff;" onclick="return false;" href="/"><img src="/oc-content/uploads/favicon.png" alt="favicon"/></a></h1>
	</div>
</td>
</tr>

<tr>
<th scope="row">Select Image</th>
<td>
	<form enctype="multipart/form-data" id="upload-form" class="wp-upload-form" method="post" action="/oc-admin/customize.php">
	<p class="upload-theme">
		<label for="upload">Choose an image from your computer:</label><br>
		<input type="file" id="upload" name="favicon">
		<input type="submit" name="save" id="save" class="button" value="Upload">
        </p>
	</form>
</td>
</tr>
</tbody>
</table>
                </div><!-- col-lg-12 -->
            </div><!-- row -->
<?php include('footer.php');?>
<?php }?>