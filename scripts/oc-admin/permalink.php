<?php include('header.php');
if( !is_admin() ){
  header("location:index.php");
}
if (is_admin()){
    if($action=='true'){ 
       if(isset($_POST['selection'])){
            $selection['option_value']  = escape($_POST['selection']);
            $permalink_structure['option_value']  = escape($_POST['permalink_structure']);

            options_update ( 'custom_permalink' , $selection);
            options_update ( 'permalink_structure' , $permalink_structure);

                $pesan = '<div id="message">Permalink structure updated.</div><br/>';
       }
    } 
        if (get_bloginfo('custom_permalink') == 6){     
              $guid = '/123456/sample-post'; 
        } 
        elseif (get_bloginfo('custom_permalink') == 5){
              $guid = '/category/sample-post'; 
        }
        elseif (get_bloginfo('custom_permalink') == 4){
              $guid = '/2014/01/sample-post'; 
        }
         elseif (get_bloginfo('custom_permalink') == 3){
              $guid = '/2014/01/16/sample-post'; 
        }
        elseif (get_bloginfo('custom_permalink') == 2){
              $guid = '/sample-post'; 
        }
        elseif (get_bloginfo('custom_permalink') == 1){
              $guid = '/p=123'; 
        }
        else{
              $guid = '/p=123';
        } 
?>
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Permalink Settings</h2>
                    <?php if(!empty($pesan)){echo $pesan;}?>
                </div><!-- col-lg-12 -->
        </div><!-- row -->

        <div class="row">
            <div class="col-lg-12">
                <p>By default Ocim CMS uses web <abbr title="Universal Resource Locator">URL</abbr>s which have question marks and lots of numbers in them; however, Ocim CMS offers you the ability to create a custom URL structure for your permalinks and archives. This can improve the aesthetics, usability, and forward-compatibility of your links.</p>
                <h3>Common Settings</h3>                    
                <form action="permalink.php?action=true" class="form-horizontal" method="post">
                        <table class="form-table"><tbody>
                            <tr>
                            <th><label><input name="selection" type="radio" value="1" <?php if (get_bloginfo('custom_permalink') == "1"): ?>checked="checked"<?php endif;?>> Default</label></th>
                            <td><code><?php bloginfo('url');?>/p=123</code></td>
                            </tr>
                            <tr>
                            <th><label><input name="selection" type="radio" value="2" <?php if (get_bloginfo('custom_permalink') == "2"): ?>checked="checked"<?php endif;?> > Post name</label></th>
                            <td><code><?php bloginfo('url');?>/sample-post</code></td>
                            </tr>
                            <tr>
                            <th><label><input name="selection" type="radio" value="3" <?php if (get_bloginfo('custom_permalink') == "3"): ?>checked="checked"<?php endif;?>> Day and name</label></th>
                            <td><code><?php bloginfo('url');?>/2014/01/16/sample-post</code></td>
                            </tr>
                            <tr>
                            <th><label><input name="selection" type="radio" value="4" <?php if (get_bloginfo('custom_permalink') == "4"): ?>checked="checked"<?php endif;?>> Month and name</label></th>
                            <td><code><?php bloginfo('url');?>/2014/01/sample-post</code></td>
                            </tr>
                            <tr>
                            <th><label><input name="selection" type="radio" value="5" <?php if (get_bloginfo('custom_permalink') == "5"): ?>checked="checked"<?php endif;?>> Category</label></th>
                            <td><code><?php bloginfo('url');?>/category/sample-post</code></td>
                            </tr>
                            <tr>
                            <th><label><input name="selection" type="radio" value="6" <?php if (get_bloginfo('custom_permalink') == "6"): ?>checked="checked"<?php endif;?>> ID</label></th>
                            <td><code><?php bloginfo('url');?>/123456/sample-post</code></td>
                            </tr>
                        <tr>
                            <th><label>Custom Structure at End</label></th>
                            <td>
                            <code><?php bloginfo('url');?><?php echo $guid;?></code>
                            <input name="permalink_structure" type="text" value="<?php echo bloginfo('permalink_structure');?>">
                            </td>
                            <td><p></p></td>
                            </tr> 
                        </tbody></table>
                            <button type="submit" name="btnsave" class="btn btn-primary">Save Changes</button>
                </form>
            </div><!-- col-lg-12 -->
        </div><!-- row -->
<?php } ?>
<?php include('footer.php');?>