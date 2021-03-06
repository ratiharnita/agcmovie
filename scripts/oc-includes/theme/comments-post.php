<?php require_once( $_SERVER['DOCUMENT_ROOT'] . '/oc-load.php' );
if(isset($_POST['submit'])){
    $comment_post_ID     = escape($_POST['comment_post_ID']);
    $comment_content     = escape($_POST['content']);
    $guidpost = get_mysqli_array("oc_posts WHERE id='$comment_post_ID'");
    $balik = get_bloginfo('url').'/'.$guidpost['guid'];

    $blacklist = explode(",", get_bloginfo('blacklist_keys'));
    $konten = strtolower($comment_content);

    if (strposa($konten, $blacklist, 1)) {
        echo error_html('illegal keyword found');
       } else {
    if(!empty($session)){
    $comment_author       = $session;
    $user_id              = userinfo($session,'id');
    $comment_author_email = userinfo($session,'email');
    $comment_author_url   = userinfo($session,'url');
    } else {
    $comment_author       = escape($_POST['author']);
    $comment_author_email = escape($_POST['email']);
    $comment_author_url   = escape($_POST['url']);
    }
    if(!empty($comment_content)) {
    if(!empty($comment_author)) {
    if(!empty($comment_author_email)) {
    $comment_author_IP   = $_SERVER['REMOTE_ADDR'];
    $comment_date        = date("Y-m-d H:i:s");
    $comment_approved    = get_bloginfo('default_comment_status');
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "INSERT INTO oc_comments (comment_post_ID,comment_author,comment_author_email,comment_author_url,comment_author_IP,comment_date,comment_approved,comment_content,user_id) VALUES ('$comment_post_ID','$comment_author','$comment_author_email','$comment_author_url','$comment_author_IP','$comment_date','$comment_approved','$comment_content','$user_id')";
        $hasil = mysqli_query($db, $query);
        mysqli_close($db);
              if($hasil){
                    header("location:$balik");
              }

      }else{echo error_html('email');}
     }else{echo error_html('name');}
    }else{echo error_html('description');}
  }
}