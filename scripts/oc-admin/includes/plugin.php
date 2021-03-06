<div class="row">
                <div class="col-lg-12 wrap">
                 <h2>Edit Plugins</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
<?php

$directory = '../oc-content/plugins/'.$_GET['dir'].'/';

if (empty($theme)) {
    $fn = $directory . 'index.php';
} else {
    $fn = $directory . $_GET['theme'];
    $exploded = multiexplode(array("."),$_GET['theme']);
    $ntemplate = ucwords($exploded[0]);
    $ftemplate = $_GET['theme'];
}

if(isset($_POST['content'])){
    $content = stripslashes($_POST['content']);
    $fp = fopen($fn,"w") or die ("Error opening file in write mode!");
    fputs($fp,$content);
    echo '<div id="message"><p>File edited successfully.</p></div>';
    fclose($fp) or die ("Error closing file!");
}
?>
                 <div class="navbar-left">
                    <h5><strong><?php echo ucwords(get_bloginfo('theme')); ?>: <?php echo $ntemplate;?> (<?php echo $ftemplate;?>)</strong></h5>
                </div>
                 <div class="navbar-right">
                    
                </div>
                </div>
                <div class="col-lg-12">
                    <hr />
                  <div class="col-lg-9" style="padding-left: 0;">
                    <!-- Form starts.  -->
                     <form class="form-horizontal" action="<?php echo $_SERVER["PHP_SELF"] ?>?dir=<?php echo $_GET['dir'];?>&theme=<?php echo $theme;?>" method="post">
                         <textarea class="form-control" style="color: #333;font-family: Consolas,Monaco,monospace;font-size: 13px;" rows="30" name="content"><?php if ( file_exists( $fn ) ) readfile($fn); ?></textarea>
                          <hr>
                          <button type="submit" class="button button-primary">Update File</button>
                     </form>
                </div>

                <div class="col-md-3">
<h3>Plugin Files</h3>
<?php
    $exclude_list = array(".","..","screenshot.png");
    if (isset($_GET["dir"])) {
        $dir_path = $_SERVER["DOCUMENT_ROOT"] . '/oc-content/plugins/'.$_GET['dir'].'/';
    } else {
        $dir_path = $_SERVER["DOCUMENT_ROOT"] . '/oc-content/plugins/';
    }
//-- until here
function dir_nav() {
    global $exclude_list, $dir_path;
    $directories = array_diff(scandir($dir_path), $exclude_list);
        echo "<ul id='templateside' style='list-style:none;padding:0'>";
            foreach($directories as $entry) {
                if(is_file($dir_path.$entry)) {
                    echo "<li><a href='?dir=".$_GET["dir"]."&theme=".$entry."'>".$entry."</a></li>";
                }
            }
        echo "</ul>";
    }

dir_nav();

?>
           </div>
          </div>         
                </div>
                <!-- /.row -->