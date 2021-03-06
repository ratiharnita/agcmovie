<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/oc-load.php');
if (isset( $_SERVER['HTTP_X_REQUESTED_WITH'] )):
if( is_login() ){
  if (!empty($_POST['comment_content']) AND !empty($_POST['comment_post_ID'])) {
    // preventing sql injection
    $name = escape($_POST['comment_author']);
    $mail = escape($_POST['comment_author_email']);
    $comments = escape($_POST['comment_content']);
    $comment = stripslashes($comments);
    $draft = $_POST['comment_approved'];
    $postId = escape($_POST['comment_post_ID']);
    $dates = date("Y-m-d H:i:s");

    $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_query($db, "INSERT INTO oc_comments (comment_author, comment_author_email, comment_content, comment_post_ID, comment_date, comment_approved) VALUES('{$name}', '{$mail}', '{$comment}', '{$postId}', '{$dates}', '{$draft}')"); 
    mysqli_close($db);
  }
}
?>
<!-- sending response with new comment and html markup-->
   <div class="avatar"><img src="<?php echo gravatar($mail);?>" width="50" height="50" alt="<?php echo $name;?>"><header class="comment-header"><div class="name">You<br><br>Just Now</div></header></div>
    <aside class="answer-display"><p><?php echo $comment?></p></aside>
<?php
  // close connection
endif?>