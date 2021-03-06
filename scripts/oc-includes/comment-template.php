<?php
/**
 * Comment template functions
 */
function comments_template( $file = '/comments.php') {
	$include = ABSPATH . get_bloginfo('stylesheet_url').'/'. $file;
	if ( file_exists( $include ) ){
		include( $include );
        } else {
        include( ABSPATH . OCINC . '/theme/comments.php');
        }
}
function have_comments( $id = '') {
	$hasil = get_mysqli("oc_comments WHERE comment_post_ID = '$id' and comment_approved = 1");
	if (mysqli_num_rows($hasil) > 0){
           return true;
        } else {
           return false;
	}
}
function list_comments( $id = '' ) {
	$data = get_mysqli("oc_comments WHERE comment_post_ID = '$id' and comment_approved = 1");
        return $data;
}

function single_comments( $value, $id = '' ) {
	$data = get_mysqli_array("oc_comments WHERE comment_post_ID = '$id' and comment_approved = 1");
        return $data['$value'];
}
function num_comments($query) {
	$numpost = get_mysqli("oc_comments WHERE {$query}");
	return mysqli_num_rows($numpost);
}