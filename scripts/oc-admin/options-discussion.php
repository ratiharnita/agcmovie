<?php include('header.php');
if(!is_role()){
  header("location:index.php");
}
?>

            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Discussion Settings</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
<?php 
if(isset($_POST['submit'])){
        if (is_admin()){

                $default_comment_status['option_value']  = escape($_POST['default_comment_status']);  
                options_update ( 'default_comment_status' , $default_comment_status);
    
                $comment_registration['option_value']  = escape($_POST['comment_registration']);  
                options_update ( 'comment_registration' , $comment_registration);
    
                $comment_moderation['option_value']  = escape($_POST['comment_moderation']);  
                options_update ( 'comment_moderation' , $comment_moderation);
  
                $blacklist_keys['option_value']  = escape($_POST['blacklist_keys']);  
                options_update ( 'blacklist_keys' , $blacklist_keys);

            echo '<div id="message">Settings saved.</div>';
        }
}
?>
               <form action="options-discussion.php" method="post">
               <table class="table form-table table-hover"><tbody>
                 <tr>
                 <th scope="row">Default article settings</th>
                 <td><fieldset>
                  <?php if (get_bloginfo('default_comment_status')=='1'){?>
                  <input type="checkbox" name='default_comment_status' <?php echo (isset($_POST['default_comment_status'])?"value='1'":"value='1'")?><?php echo (isset($_POST['default_comment_status'])?"checked":"checked") ?>  />
                  <?php }else{?>
                  <input type="checkbox" name='default_comment_status' <?php echo (isset($_POST['default_comment_status'])?"value='0'":"value='1'")?><?php echo (isset($_POST['default_comment_status'])?"":"") ?>  />
<?php }?> Allow people to post comments on new articles<br><p class="help-block">(These settings may be overridden for individual articles.)</p>
                  <br/>
                  <?php if (get_bloginfo('comment_registration')=='1'){?>
                  <input type="checkbox" name='comment_registration' <?php echo (isset($_POST['comment_registration'])?"value='1'":"value='1'")?><?php echo (isset($_POST['comment_registration'])?"checked":"checked") ?>  />
                  <?php }else{?>
                  <input type="checkbox" name='comment_registration' <?php echo (isset($_POST['comment_registration'])?"value='0'":"value='1'")?><?php echo (isset($_POST['comment_registration'])?"":"") ?>  />
<?php }?> Users must be registered and logged in to comment
                  <br/>
                  <?php if (get_bloginfo('comment_moderation')=='1'){?>
                  <input type="checkbox" name='comment_moderation' <?php echo (isset($_POST['comment_moderation'])?"value='1'":"value='1'")?><?php echo (isset($_POST['comment_moderation'])?"checked":"checked") ?>  />
                  <?php }else{?>
                  <input type="checkbox" name='comment_moderation' <?php echo (isset($_POST['comment_moderation'])?"value='0'":"value='1'")?><?php echo (isset($_POST['comment_moderation'])?"":"") ?>  />
<?php }?> Comment must be manually approved</fieldset></td>
                </tr>
                <tr>
                <th>Keyword Blacklist</th>
                <td>
                <p>When a comment contains any of these words in its content, name, URL, e-mail, or IP, it will be marked as spam. One word or IP per line. It will match inside words.</p><br>
                <textarea name="blacklist_keys" rows="10" cols="50" class="form-control large-text code"><?php echo get_bloginfo('blacklist_keys');?></textarea>
                </td>
                </tr>
                </tbody></table>
                <p class="submit"><input type="submit" name="submit" class="btn btn-primary" value="Save Changes"></p>
                </form>

                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
<?php include('footer.php');?>