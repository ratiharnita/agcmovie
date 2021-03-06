<?php include('header.php');
if(!is_role()){
  header("location:index.php");
}
?>
            <div class="row">
                <div class="col-lg-12 wrap">
                <?php 
                   if (!empty($page)){
                       if ( $hooks->do_action( 'add_theme_page' ) ) {
                            $hooks->do_action( 'add_theme_page' );
                       }
                   }else{
               ?>
                <h2>Themes <span class="badge title-count"><?php $directorytheme = "../oc-content/themes/";echo (count(glob("$directorytheme/*",GLOB_ONLYDIR))); ?></span><a href="theme-install.php" class="add-new-h2">Add New</a></h2>

                <div class="theme-browser rendered">
                 <div class="themes">
<?php
   if($action=='edit'){
   if (!empty($theme)){

                $stylesheet_url['option_value']  = '/oc-content/themes/'.$theme; 
                options_update ( 'stylesheet_url' , $stylesheet_url);
    
                $themes['option_value']  = $theme;  
                options_update ( 'theme' , $themes);

                echo '<div id="message2">New theme activated.</div>';
                header("location:/oc-admin/themes.php" );
        }
   }


   $target = $_SERVER['DOCUMENT_ROOT'] . "/oc-content/themes/";
   $entry = scandir($target);
   for ($i = 0; $i<count($entry); $i++) {
    if(strlen($entry[$i]) >= 3) {
            $check_for_html_doc = strpos($entry[$i], 'html');
            $check_for_php = strpos($entry[$i], 'php');
            $check_for_txt = strpos($entry[$i], 'txt');
            if($check_for_html_doc === false && $check_for_php === false && $check_for_txt === false) {
     ?>
<a data-toggle="modal" href="customize.php?theme=<?php echo $entry[$i];?>" data-target="#my<?php echo $entry[$i];?>">
   <div class="theme <?php if (get_bloginfo('theme')==$entry[$i]){?>active<?php }?>">
	<div class="theme-screenshot"><img src="<?php echo $directorytheme;?><?php echo $entry[$i];?>/screenshot.png" alt="<?php echo ucwords($entry[$i]);?>"></div>
	
	<span class="more-details" id="<?php echo $entry[$i];?>-action">Theme Details</span>

	<h3 class="theme-name" id="<?php echo $entry[$i];?>-name"><?php if (get_bloginfo('theme')==$entry[$i]){?><span>Active:</span> <?php echo ucwords($entry[$i]);?><?php } else {?><?php echo ucwords($entry[$i]);?><?php } ?></h3>
	
	<div class="theme-actions">

	 <?php if (get_bloginfo('theme')==$entry[$i]){?><a class="button button-primary customize load-customize" href="customize.php?theme=<?php echo $entry[$i];?>">Customize</a><?php } else {?><a class="button button-primary activate" href="themes.php?action=edit&theme=<?php echo $entry[$i];?>">Activate</a> <a class="button button-secondary load-customize" target="_blank" href="../">Live Preview</a><?php } ?>

	</div>
</div></a>
               <div class="modal fade" id="my<?php echo $entry[$i];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                     <div class="modal-dialog">
                           <div class="modal-content">
                          </div> <!-- /.modal-content -->
                     </div> <!-- /.modal-dialog -->
                </div> <!-- /.modal -->
<?php 
     } 
    }
   }
?>
<div class="theme add-new-theme"><a href="theme-install.php"><div class="theme-screenshot"><span></span></div><h3 class="theme-name">Add New Theme</h3></a></div></div><br class="clear">
              </div>
<?php 
}
$hooks->do_action( 'admin_create_table' );
?>
           </div><!-- col-lg-12 -->
      </div><!-- row -->

<?php include('footer.php');?>