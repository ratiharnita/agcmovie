<?php require_once( BASEPATH . '/oc-load.php' );
  if ( have_comments($post['id']) ) : ?>
	<h4 class='title'><?php echo num_comments("comment_post_ID = '".$post['id']."' and comment_approved = 1");?> Response to "<?php echo $post['title']; ?>"</h4>

       <!-- Comment List -->
       <ol class='commentlist'>
	 <?php  $resultcomments = get_mysqli("oc_comments WHERE comment_post_ID = '".$post['id']."' and comment_approved = 1");
         while ($row = mysqli_fetch_array($resultcomments)){?>
	 <li class="comment" id="li-comment-<?php echo $row['comment_post_ID'];?>">
	 	 <div class="comment-author vcard">
	 	 	 	 <img alt="<?php echo $row['comment_author'];?>" height="40" width="40" src="<?php echo gravatar($row['comment_author_email']);?>" style="display: block;" />
	 	 </div><!--end comment-author-->
	 	 <div id="comment-<?php echo $row['idc'];?>" class="rapidx_comment">
	 	 	 	 <div class="comment-meta commentmetadata">
	 	 	 	 	 	 <cite class="fn"><a href="<?php echo $row['comment_author_url'];?>" target="_blank"><?php echo $row['comment_author'];?></a></cite> <?php echo time_ago($row['comment_date']);?> 
	 	 	 	 </div><!--end comment-meta-->
	 	 	 	 <div class="comment-body">
	 	 	 	 	 	 <p><?php echo $row['comment_content'];?></p>
	 	 	 	 </div><!--end comment-body-->
	 	 </div><!--end comment-->

         </li><!--end comment-->
        <?php } ?>

       </ol><!--end commentlist-->
<?php endif; ?>

	 <!-- Comments Form -->
	 <div class="well">
	 	 <h4 class='title'><span>Leave a Comment</span></h4>
	 	 <p class="comment-notes">Your email address will not be published. Required fields are marked <span class="required">*</span></p>
	 	 <p class="comment-notes">(please do not use a spammy keyword or a domain as your name, or it will be deleted.)</p>
	 	 <form action="<?php echo get_home_url() .'/'. OCINC ;?>/theme/comments-post.php" class='_form' method='post'>

	 	 <?php if ( !is_login() ) : ?>
	 	 	 <div class='cform name'><input type='text' name='author' placeholder='Name *' value='<?php echo (isset($_POST['author']) ? $_POST['author'] : ''); ?>'></div>
	 	 	 <div class='cform email'><input type='text' name='email' placeholder='mail@example.com *' value='<?php echo (isset($_POST['email']) ? $_POST['email'] : ''); ?>'></div>
	 	 	 <div class='cform web'><input type='text' name='url' placeholder='website *' value='<?php echo (isset($_POST['url']) ? $_POST['url'] : ''); ?>'></div>
	 	 <?php endif; ?>

                            <textarea name='content' id='cf_message' cols="50" rows="3"></textarea>

                        <input type='hidden' name='comment_authors' value='<?php echo $session; ?>'>
                        <input type='hidden' name='comment_post_ID' value='<?php echo $post['id']; ?>'>
                        <button type="submit" name="submit" id='cf_send'>Submit</button>
                    </form>
                </div>

                <hr>