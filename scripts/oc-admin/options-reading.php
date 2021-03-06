<?php include('header.php');
if(!is_role()){
  header("location:index.php");
}
?>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Reading Settings</h2>
        </div><!-- col-lg-12 -->
    </div><!-- row -->
    <div class="row">
        <div class="col-lg-12">
<?php 
if(isset($_POST['submit'])){
    if(!empty($_POST['posts_per_page']) || !empty($_POST['posts_per_rss'])){
    $db          = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $dmcar       = mysqli_query($db, "SELECT option_name FROM oc_options where option_name = 'dmca'"); 
        if(mysqli_num_rows($dmcar) == "0"){
            mysqli_query($db, "Insert into oc_options (option_name,option_value) VALUES ('dmca','')"); 
        }
    mysqli_close($db);
        if(empty($_POST['blog_public'])){
                $blog_public['option_value']  = 'index';
        } else {
                $blog_public['option_value']  = escape($_POST['blog_public']);
        }

        if (is_admin()){
                $posts_per_page['option_value']  = escape($_POST['posts_per_page']);  
                options_update ( 'posts_per_page' , $posts_per_page);
    
                $posts_per_rss['option_value']  = escape($_POST['posts_per_rss']);  
                options_update ( 'posts_per_rss' , $posts_per_rss);
      
                options_update ( 'blog_public' , $blog_public);

                $dmca['option_value']  = $_POST['dmca'];  
                options_update ( 'dmca' , $dmca);

                echo '<div id="message">Settings saved.</div>';

        }
    }
}
?>
            <form action="options-reading.php" method="post">
                <table class="table form-table table-hover"><tbody>
                <tr>
		 <th><label for="posts_per_page">Blog pages show at most</label></th>
		 <td><input type="number" name="posts_per_page" value="<?php echo bloginfo('posts_per_page'); ?>" class="form-control small-text"> posts</td>
	        </tr>
                <tr>
	         <th><label for="posts_per_rss">Syndication feeds show the most recent</label></th>
	         <td><input type="number" name="posts_per_rss" value="<?php echo bloginfo('posts_per_rss'); ?>" class="form-control small-text"> items</td>
                </tr>
                <tr>
	         <th><label for="blog_public">Search Engine Visibility</label></th>
	         <td><input type="checkbox" <?php if( 'noindex' == get_bloginfo('blog_public') ){ echo 'checked'; }; ?> value="noindex" name="blog_public"> Discourage search engines from indexing this site<p class="help-block">It is up to search engines to honor this request.</p></td>
                </tr>
                                <tr>
                <th>DMCA Page Removal</th>
                <td>
                <p>Block link removal takedown DMCA. One link per line. <b>Example:</b><br><br> http://domain.com/mp3/taylor-swift.html<br>http://domain.com/mp3/porn.html</p><br>
                <textarea name="dmca" rows="10" cols="50" class="form-control large-text code"><?php echo get_bloginfo('dmca');?></textarea>
                </td>
                </tr>
                </tbody></table>
                <p class="submit"><input type="submit" name="submit" class="btn btn-primary" value="Save Changes"></p>
            </form>
        </div><!-- /.col-lg-12 -->
    </div><!-- row -->
<?php include('footer.php');?>