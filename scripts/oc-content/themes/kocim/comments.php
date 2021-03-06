<?php require_once( BASEPATH . '/oc-load.php' );
  if ( have_comments($post['id']) ) : ?>
	<h3 class="comments"><?php echo num_comments("comment_post_ID = '".$post['id']."' and comment_approved = 1");?> Response to "<?php echo $post['title']; ?>"</h3>

                <hr>
       <!-- Comment List -->
       <div id="comments">
        <?php  $resultcomments = get_mysqli("oc_comments WHERE comment_post_ID = '".$post['id']."' and comment_approved = 1");
         while ($row = mysqli_fetch_array($resultcomments)){?>
	 <div class="media">
                    <a class="pull-left" href="<?php echo $row['comment_author_url'];?>">
                        <img width="42" height="42" class="media-object" src="<?php echo gravatar($row['comment_author_email']);?>" alt="<?php echo $row['comment_author'];?>">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $row['comment_author'];?>
                            <small><?php echo $row['comment_date'];?></small>
                        </h4>
                        <?php echo $row['comment_content'];?>
                    </div>
         </div>
        <?php } ?>

                <hr>

       </div>
<?php endif; ?>
                    <!-- Comments Form -->
                    <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="<?php echo get_home_url() .'/'. OCINC ;?>/theme/comments-post.php" method='post'>
                    <?php if ( !is_login() ) : ?>
                        <div class="form-group"> 
                         <label for="author">Name <span class="required">*</span></label>
                         <input type='text' name='author' class="form-control" value='<?php echo (isset($_POST['author']) ? $_POST['author'] : ''); ?>'>
                        </div>
                        <div class="form-group"> 
                         <label for="author">Email <span class="required">*</span></label>
                         <input type='email' name='email' class="form-control" value='<?php echo (isset($_POST['email']) ? $_POST['email'] : ''); ?>'>
                        </div>
                        <div class="form-group"> 
                         <label for="author">Website</label>
                         <input type='url' name='url' class="form-control" value='<?php echo (isset($_POST['url']) ? $_POST['url'] : ''); ?>'>
                        </div>
                    <?php endif; ?>
                        <div class="form-group">
                            <label for="author">Comment <span class="required">*</span></label>
                            <textarea name='content' class="form-control" cols="45" rows="8"></textarea>
                        </div>
                        <input type='hidden' name='comment_authors' value='<?php echo $session; ?>'>
                        <input type='hidden' name='comment_post_ID' value='<?php echo $post['id']; ?>'>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>