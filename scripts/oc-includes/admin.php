<?php 
function Categories($id,$value) {
        $row = get_mysqli_array("oc_terms WHERE id = '$id'");
	return $row[$value];
}

function publish($id,$sep = '') {
	$row = get_mysqli_array("oc_posts WHERE id='$id'");
	$active = '';
                if($row['active'] == 0) { 
                        $active = $sep.'Draft'; 
                } 
	return $active;
}
function published($id,$value) {
	$row = get_mysqli_array("oc_posts WHERE id='$id'");
        if($row[$value] == 1) { $active = 'Published'; } 
        else { $active = 'Draft'; }
	return $active;
}
function showcat() {
        $aqu = get_mysqli("oc_terms WHERE type = 1");
        $showcat = "";
        while($row = mysqli_fetch_array($aqu)){
                $id = $row['id'];
                $name = $row['name'];
                $showcat.= '<option value="'.$id.'">'.$name.'</option>';
        }
        return $showcat;
}
function postcat($value) {
        $aqu = get_mysqli("oc_terms WHERE type = 1");
        $showcat = "";
        while($row = mysqli_fetch_array($aqu)){
                if($value==$row['id']){
                        $selected='selected';
                        $showcat.= '<option '.$selected.' value="'.$row['id'].'">'.$row['name'].'</option>';
                }else{
                        $showcat.= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                }
        }
        return $showcat;
}
function catboxes() {
        $aqu = get_mysqli("oc_terms WHERE type = 1");
        $catboxes = "";
        while($row = mysqli_fetch_array($aqu)){
                $id = $row['id'];
                $name = $row['name'];
                $catboxes.= '<div class="checkbox"><label><input type="checkbox" value="'.$id.'">'.$name.'</label></div>';
        }
        return $catboxes;
}
function numpost($query) {
	$numpost = get_mysqli("oc_posts WHERE {$query}");
	return mysqli_num_rows($numpost);
}
function numusers($query) {
	$numusers = get_mysqli("oc_users WHERE {$query}");
	return mysqli_num_rows($numusers);
}
function numcomment($query) {
	$numcomment = get_mysqli("oc_comments WHERE {$query}");
	return mysqli_num_rows($numcomment);
}
function numplugin($query) {
	$numcomment = get_mysqli("oc_plugins WHERE {$query}");
	return mysqli_num_rows($numcomment);
}
function gravatar($mail='', $size = 64){
	$url = "http://www.gravatar.com/avatar/";
	$url .= md5( strtolower( trim( $mail ) ) );
	$url .= "&s=" . $size;
	return $url;
}
function avatar32($query){
        $row  = get_mysqli_array("oc_users WHERE {$query}");
        if (!empty($row['avatar'])) {$avatar = $row['avatar'];} else {$avatar = "/oc-includes/images/avatar.png";}
        return $avatar; 
}
function users($user,$value) {
        global $session;
        if (!empty($user)) {
	        $row = get_mysqli_array("oc_users WHERE id='$user'");
        } else {
                $row = get_mysqli_array("oc_users WHERE username='$session' or email ='$session'");
        }
	return $row[$value];
}
function userinfo($user,$value) {
        if (!empty($user)) {
	        $sql = get_mysqli("oc_users WHERE username = '$user' or email = '$user'");
	        $row = mysqli_fetch_array($sql);
        }
	return $row[$value];
}
function cekusers($user,$value) {
	$row = get_mysqli_array( "oc_users WHERE username = '$user'" );
	return $row[$value];
}
function is_admin($role = 'administrator') {
        global $session;
	$row = get_mysqli_array("oc_users WHERE role = '$role' and username = '$session' or email ='$session'");
        if ($row['role']=='administrator') {
                return true;
        } else {
                return false;
	}
}
function is_login( $active = 1 ) {
        global $session;
	$row = get_mysqli_array("oc_users WHERE username='$session' or email ='$session'");
        if ($row['active']== $active) {
                return true;
        } else {
                return false;
	}
}
function is_role() {
        global $session;
	$row = get_mysqli_array("oc_users WHERE username='$session' or email ='$session'");
        if ($row['role']=='administrator' || $row['role']=='author' || $row['role']=='editor') {
                return true;
        } else {
                return false;
	}
}
function option_edit_categories( $args = '' ){
       $aqu = get_mysqli("oc_terms WHERE {$args}");
       $showcat = "";
       while($row = mysqli_fetch_array($aqu)){
                 $showcat.= '<option value="edit.php?post_type=post&post_status=category&category_name='.$row['id'].'">'.$row['name'].'</option>';
       }
       return $showcat;
}
