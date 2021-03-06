<?php 
function oc_title($name = false, $separate = ' '){
        global $id,$do,$po,$post;
        $canurl = parse_url(get_current_url(), PHP_URL_PATH);
        $parts = parse_url($canurl);  
        $file_name = basename($parts['path']); 
        $fileurl = explode(".",$file_name); 

        if(!empty($id)){$asal = ucwords(permalink($id,' '));} else {$asal = ucwords(permalink($do,' '));}
        if(!empty($post['title'])){$posttitle = ucwords($post['title']);} else {$posttitle = ucwords(permalink($fileurl[0],' '));}

        if($po) { $title = $posttitle.$separate.$name; }  
        elseif($id) { $title = $asal.$separate.$name; }
        else { $title = get_bloginfo('name'); }
                echo $title;
}
function oc_description($name = false, $separate = ', '){
        global $id,$do,$po,$post;
        $canurl = parse_url(get_current_url(), PHP_URL_PATH);
        $parts = parse_url($canurl);  
        $file_name = basename($parts['path']); 
        $fileurl = explode(".",$file_name); 

        if(!empty($id)){$asal = ucwords(permalink($id,' '));} else {$asal = ucwords(permalink($do,' '));}
        if(!empty($post['title'])){$posttitle = short($post['description'],150);} else {$posttitle = ucwords(permalink($fileurl[0],' '));}

        if($po) { $title = $posttitle.$separate.$name; }  
        elseif($id) { $title = $asal.$separate.$name; }
        else { $title = get_bloginfo('description'); }
                echo $title;
}
function oc_keyword($name = false, $separate = ', '){
        global $id,$do,$po,$post;
        $canurl = parse_url(get_current_url(), PHP_URL_PATH);
        $parts = parse_url($canurl);  
        $file_name = basename($parts['path']); 
        $fileurl = explode(".",$file_name); 

        if(!empty($id)){$asal = permalink($id,' ');} else {$asal = permalink($do,' ');}
        if(!empty($post['title'])){$posttitle = createslug(limit_word($post['title'],9),', ');} else {$posttitle = permalink($fileurl[0],' ');}

        if($po) { $title = $posttitle.$separate.$name; }  
        elseif($id) { $title = $asal.$separate.$name; }
        else { $title = get_bloginfo('keyword'); }
                echo $title;
}
function recentpost($before = "",$after = "", $class = "",$limit = 5) {
	$sql = get_mysqli("oc_posts WHERE type = 1 and active = 1 order by pubdate desc limit $limit");
        $recentpost = "";
	while($row = mysqli_fetch_array($sql)){
              $recentpost.= $before.'<a '.$class.'href="'.get_bloginfo('url').'/'.$row['guid'].'">'.$row['title'].'</a>'.$after;
        }
	return $recentpost;
}
function option_categories( $args = '', $before = '',$after = '', $class = '' ){
        $aqu = get_mysqli("oc_terms WHERE {$args}");
        $showcat = "";
        while($row = mysqli_fetch_array($aqu)){
                $showcat.= $before.'<option '.$class.'value="'.$row['id'].'">'.$row['name'].'</option>'.$after;
        }
        return $showcat;
}
function option_category( $args = '', $before = '',$after = '', $class = '' ){
        $aqu = get_mysqli("oc_terms WHERE {$args}");
        $showcat = "";
        while($row = mysqli_fetch_array($aqu)){
                $showcat.= $before.'<option '.$class.'value="'.$row['slug'].'">'.$row['name'].'</option>'.$after;
        }
        return $showcat;
}
function related_posts($terms, $active = '1', $type = '1', $limit = '5', $before = '<li>', $after = '</li>'){
        $query  = get_mysqli("oc_posts where active = '$active' and type = '$type' and terms='$terms' order by id desc LIMIT $limit");
        while ($row = mysqli_fetch_array($query)) : 
                echo $before.'<a href="/'.$row['guid'].'">'.$row['title'].'</a>'.$after;   
        endwhile; 
}
function comments_open(){
        global $session;
        $row = get_mysqli_array( "oc_users WHERE username = '$session'" );
        if(get_bloginfo('default_comment_status') == "1"||$row['role']=='administrator') {
                return true;
        } else {
                return false;
	}
}
function get_Categories($id,$value) {
	$row = get_mysqli_array("oc_terms WHERE slug = '$id'");
	return $row[$value];
}
function comment_registration(){
        global $session;
        $comment_registration = get_bloginfo('comment_registration');
        $row = get_mysqli_array( "oc_users WHERE username = '$session'" );
        if ($row['active']==$comment_registration||$row['role']=='administrator') {
                return true;
        } else {
                return false;
	}
}

function popuplinks($text) {
        $text = preg_replace('/<a (.+?)>/i', "<a $1 target='_blank' rel='external'>", $text);
        return $text;
}

function logo() {
        $link = BASEPATH .'/oc-content/uploads/logo.png';
        if (file_exists($link)) :
                $src  = get_bloginfo('url') .'/oc-content/uploads/logo.png';
                $text = '<img src="'.$src.'" alt="'.get_bloginfo('name').'" />';
        else:
                $text = get_bloginfo('name');
        endif;
        return $text;
}

function tanggal($format,$nilai="now"){
        $en = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
        $id = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Jan","Feb","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
        return str_replace($en,$id,date($format,strtotime($nilai)));
}  

function menuList($data, $parent = 0, $class = 'dropdown-menu'){
        static $i = 1;
        $tab = str_repeat(" ",$i);
            if(isset($data[$parent])){
                $html = "$tab";
                $i++;
                 foreach($data[$parent] as $v){
                     $child = menuList($data, $v->id);
                     $html .= "$tab<li class='dropdown'>";
                     $html .= '<a href="/category/'.$v->slug.'">'.$v->name.'</a>';

                     if($child){
                         $i–;
                         $html .= "<ul class='dropdown-menu'>";
                         $html .= $child;
                         $html .= "</ul>";
                         $html .= "$tab";
                     }
                     $html .= '</li>';
                }
                $html .= "$tab";
            return $html;
          } else {
        return false;
      }
}

function list_categories(){
        $query = get_mysqli("oc_terms where type = 1 ORDER BY name");
        while($row = mysqli_fetch_object($query)){
                $data[$row->child][] = $row;
        }
        return menuList($data);
}
function oc_list_categories( $args = '', $before = '',$after = '', $class = '' ){
        $aqu = get_mysqli("oc_terms WHERE type = 1 {$args}");
        $showcat = "";
        while($row = mysqli_fetch_array($aqu)){
                $showcat.= $before.'<a '.$class.'href="'.get_bloginfo('url').'/category/'.$row['slug'].'">'.$row['name'].'</a>'.$after;
        }
        return $showcat;
}

function get_tag($query, $bef = '', $aft = '', $class = 'tag-cloud', $rel = 'rel="nofollow"'){
        if(!empty($query)){
        $tags = explode(",", $query);
                for($i = 0; $i < count($tags); $i++){
                        $string .= $bef.'<a href="/tag/'.permalink($tags[$i]).'" title="'.$tags[$i].'" class="'.$class.'" '.$rel.'>'.$tags[$i].'</a>'.$aft;
                }
        return $string;
        }
}
function get_tags($query, $bef = '', $aft = '', $class = 'tag-cloud', $rel = 'rel="nofollow"'){
    if(!empty($query)){
    $tags = explode(" ", $query);
    for($i = 0; $i < count($tags); $i++){
         $string .= $bef.'<a href="/tag/'.permalink($tags[$i]).'" title="'.$tags[$i].'" class="'.$class.'" '.$rel.'>'.$tags[$i].'</a>'.$aft;
    }
    return $string;
    }
}
function is_home() {
        $host = get_bloginfo('url').'/';
        if ( get_current_url() == $host ) {
                return true;
        } else {
                return false;
        }
}