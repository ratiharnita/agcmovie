<?php
/**
 * Movie2k functions and definitions
 *
 * @package OcimPress
 * @subpackage movie2k
 * @since Movie2k 1.0
 */

/**
 * add column if not exist.
 */
$hooks->add_action('admin_header','movie2k_create_table');
function movie2k_create_table() {
	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

	if (!$mysqli->query("SELECT imdb FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `imdb` varchar(50) NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT rating FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `rating` varchar(20) NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT duration FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `duration` varchar(20) NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT country FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `country` varchar(20) NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT year FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `year` year(4) NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT actors FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `actors` varchar(500) NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT director FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `director` varchar(500) NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT language FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `language` varchar(20) NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT picturequality FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `picturequality` int(11) UNSIGNED NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT terms2 FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `terms2` varchar(20) NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT terms3 FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `terms3` varchar(20) NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT url2 FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `url2` varchar(255) NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT url3 FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `url3` varchar(255) NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT season FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `season` int(11) UNSIGNED NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT hoster FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `hoster` varchar(100) NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT episode FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `episode` int(11) UNSIGNED NOT NULL;"); 
	}
	if (!$mysqli->query("SELECT report FROM oc_posts")) {
		$mysqli->query("ALTER TABLE oc_posts ADD COLUMN `report` varchar(20) NOT NULL;"); 
	}
        mysqli_close($mysqli);
}
if(get_bloginfo('dmca') != null){
        if ( strposa( get_current_url(), preg_split('/\n|\r\n?/', get_bloginfo( 'dmca' ) ) ) )
                header( 'Location: /' );
        
}
function random_movie($imdb) {
	global $post;
   
	$result = get_mysqli("oc_posts WHERE active = 1 and type = 1 and imdb = '$imdb' group by hoster ORDER BY picturequality DESC LIMIT 3");
        while ($RA = mysqli_fetch_array($result)) { 

		$phpdate = strtotime($RA['pubdate']);
		$mysqldate = date( 'H:i', $phpdate );
		$quality = $RA['picturequality'];
		if ($quality==0) {$quality='0';} elseif ($quality==1){$quality='1';} elseif ($quality==2){$quality='2';} elseif ($quality==3){$quality='3';} elseif ($quality==4){$quality='4';} elseif ($quality==5){$quality='5';}else {$quality='0';}

			echo '<tr><td id="tdmovies" width="260"><img style="vertical-align: middle;" src="/oc-content/themes/movie2k/images/hoster/'.strtolower($RA['hoster']).'.png" width="16" alt="'.$RA['hoster'].' '.$RA['title'].'" title="'.$RA['hoster'].' '.$RA['title'].'"> <a href="/'.$RA['guid'].'"><font color="#000000">'.$RA['hoster'].'</font></a></td></tr>';   

	} 
	mysqli_free_result($result);
}

function random_xxx($title){
	$result = get_mysqli("oc_posts WHERE active = 1 and type = 4 and title = '$title' ORDER BY pubdate DESC LIMIT 10");
		while ($RA = mysqli_fetch_array($result)) { 
		$phpdate = strtotime($RA['pubdate']);
		$mysqldate = date( 'H:i', $phpdate );
		$quality = $RA['picturequality'];

		if ($quality==0) {$quality='0';} elseif ($quality==1){$quality='1';} elseif ($quality==2){$quality='2';} elseif ($quality==3){$quality='3';} elseif ($quality==4){$quality='4';} elseif ($quality==5){$quality='5';}else {$quality='0';}

			echo '<tr><td id="tdmovies" width="260"><img style="vertical-align: middle;" src="/oc-content/themes/movie2k/images/hoster/'.strtolower($RA['hoster']).'.png" width="16" alt="'.$RA['hoster'].' '.$RA['title'].'" title="'.$RA['hoster'].' '.$RA['title'].'"> <a href="/'.$RA['guid'].'"><font color="#000000">'.$RA['hoster'].'</font></a></td></tr>';   

		} 
    mysqli_free_result($result);
}
function category_first($imdb){
        $result = get_mysqli("oc_posts WHERE active = 1 and imdb = '$imdb' ORDER BY picturequality DESC LIMIT 4");
		while ($RL = mysqli_fetch_array($result)) { 
			$quality = $RL['picturequality'];
			if ($quality==0) {$quality='0';} elseif ($quality==1){$quality='1';} elseif ($quality==2){$quality='2';} elseif ($quality==3){$quality='3';} elseif ($quality==4){$quality='4';} elseif ($quality==5){$quality='5';}else {$quality='0';}
                	echo '<tr><td id="tdmovies" width="305"><img style="vertical-align: middle;" src="/oc-content/themes/movie2k/images/hoster/'.strtolower($RL['hoster']).'.png" width="16" alt="'.$RL['hoster'].' '.$RL['title'].'" title="'.$RL['hoster'].' '.$RL['title'].'"> <a href="/'.$RL['guid'].'"><font color="#000000">'.$RL['hoster'].'</font></a></td><td id="tdmovies" width="105"><span style="font-size:14px;vertical-align:top;">Quality: <img src="/oc-content/themes/movie2k/images/'.$quality.'.gif" alt="Movie quality" title="Movie quality" style="vertical-align:top;">  </span></td></tr>';   
		} 
	mysqli_free_result($result);
}
function tvshows_home($imdb){
	$result = get_mysqli("oc_posts WHERE active = 1 and type = 3 and imdb = '$imdb' ORDER BY pubdate DESC LIMIT 4");
		while ($RL = mysqli_fetch_array($result)) { 
                	$quality = $RL['picturequality'];
			if ($quality==0) {$quality='0';} elseif ($quality==1){$quality='1';} elseif ($quality==2){$quality='2';} elseif ($quality==3){$quality='3';} elseif ($quality==4){$quality='4';} elseif ($quality==5){$quality='5';}else {$quality='0';}

			echo '<tr><td id="tdmovies" width="200"><img src="/oc-content/themes/movie2k/images/hoster/'.strtolower($RL['hoster']).'.png" width="16"> <a href="/'.$RL['guid'].'"><font color="#000000">'.$RL['hoster'].'</font></a></td><td id="tdmovies" width="130">S'.$RL['season'].' - Episode'.$RL['episode'].'</td><td id="tdmovies" width="100">&nbsp;</td></tr>';   
		} 
	mysqli_free_result($result);
}

function middle_first($imdb){
	$result= get_mysqli("oc_posts WHERE active=1 and type = 1 and imdb = '$imdb' Group by hoster ORDER BY pubdate DESC LIMIT 20");
		while ($MF = mysqli_fetch_array($result)) { 
			$phpdate = strtotime($MF['pubdate']);
                	$mysqldate = date( 'H:i', $phpdate );
			$quality = $MF['picturequality'];
			if ($quality==0) {$quality='0';} elseif ($quality==1){$quality='1';} elseif ($quality==2){$quality='2';} elseif ($quality==3){$quality='3';} elseif ($quality==4){$quality='4';} elseif ($quality==5){$quality='5';}else {$quality='0';}

			echo '<div id="tablemoviesindex2" style="padding-bottom:2px;"><a href="/'.$MF['guid'].'">'.$mysqldate.' &nbsp; <img style="vertical-align:middle;" border="0" src="/oc-content/themes/movie2k/images/hoster/'.strtolower($MF['hoster']).'.png" alt="'.$MF['title'].'" title="'.$MF['title'].'" width="16"> &nbsp; watch on '.$MF['hoster'].'</a></div>';   

		} 
	mysqli_free_result($result);
}

function related_movie(){
    global $post;

    $RP_ID  = "oc_posts WHERE active = 1 and type NOT IN ('2') and terms = '".$post['terms']."'  Group by imdb ORDER BY Rand() LIMIT 5";
    $result = get_mysqli($RP_ID);
        $i = 1; 
        while ($RAT = mysqli_fetch_array($result)) { 
        if (empty($RAT['images'])) {$images='/oc-content/themes/movie2k/images/noposter.gif';} else {$images=$RAT['images'];}

            $output = '<div class="SM_schatten SM_fleft"><div class="SM_pic"><a href="/'.$RAT['guid'].'"><img src="'.$images.'" alt="'.$RAT['title'].'" title="'.$RAT['title'].'" border="0" style="width:79px;max-width:79px;max-height:111px;min-height:111px;"></a></div><div class="SM_pictitle"><a href="/'.$RAT['guid'].'">'.$RAT['title'].'</a></div></div>';   
            echo "$output"; 
            $i++; 
        } 
    mysqli_free_result($result);
}

function related_hoster($imdb){
    $RP_ID = "oc_posts WHERE active = 1 and type NOT IN ('2') and imdb = '$imdb' ORDER BY picturequality DESC,hoster DESC";
    $result  = get_mysqli($RP_ID);
           $i = 1; 
              while ($RAT = mysqli_fetch_array($result)) { 
                  $output = '<tr id="tablemoviesindex2"><td height="20" width="150"><a href="/'.$RAT['guid'].'">'.date('m/d/Y', strtotime($RAT['pubdate'])).' <img border="0" style="vertical-align:top;" src="/oc-content/themes/movie2k/images/hoster/'.strtolower($RAT['hoster']).'.png" alt="'.$RAT['hoster'].' '.$RAT['title'].'" title="'.$RAT['hoster'].' '.$RAT['title'].'" width="16"> '.$RAT['hoster'].'</a></td><td align="right" width="58"><a href="/'.$RAT['guid'].'">Quality:</a> <img style="vertical-align: top;" src="/oc-content/themes/movie2k/images/'.$RAT['picturequality'].'.gif" alt="Movie quality" title="Movie quality"></td></tr>';   
                             echo "$output"; 
            $i++; 
    } 
    mysqli_free_result($result);
}
function related_hoster_xxx($title){
    $RP_ID = "oc_posts WHERE active = 1 and type NOT IN ('2') and title = '$title' ORDER BY picturequality DESC,hoster DESC";
    $result = get_mysqli($RP_ID);
           $i = 1; 
              while ($RAT = mysqli_fetch_array($result)) { 
                  $output = '<tr id="tablemoviesindex2"><td height="20" width="150"><a href="/'.$RAT['guid'].'">'.date('m/d/Y', strtotime($RAT['pubdate'])).' <img border="0" style="vertical-align:top;" src="/oc-content/themes/movie2k/images/hoster/'.strtolower($RAT['hoster']).'.png" alt="'.$RAT['hoster'].' '.$RAT['title'].'" title="'.$RAT['hoster'].' '.$RAT['title'].'" width="16"> '.$RAT['hoster'].'</a></td><td align="right" width="58"><a href="/'.$RAT['guid'].'">Quality:</a> <img style="vertical-align: top;" src="/oc-content/themes/movie2k/images/'.$RAT['picturequality'].'.gif" alt="Movie quality" title="Movie quality"></td></tr>';   
                             echo "$output"; 
            $i++; 
    } 
    mysqli_free_result($result);
}
function same_hoster($imdb,$hoster){
    $result = get_mysqli("oc_posts WHERE active = 1 and type NOT IN ('2') and imdb = '$imdb' and hoster = '$hoster' ORDER BY id DESC");
        $i = 1; 
        while ($row = mysqli_fetch_array($result)) { 
            $output = '<option value="/'.$row['guid'].'">'.$row['hoster'].' (1/'.$i.')</option>';   
            echo $output; 
        $i++; 
        } 
    mysqli_free_result($result);
}
function season_list_drop($imdb){
    $query  = get_mysqli("oc_posts WHERE active = 1 and type = 3 and imdb = '$imdb' group by season ORDER BY id DESC");
        while ($row = mysqli_fetch_array($query)) { 
            $output = '<option value="/'.$row['guid'].'">Season '.$row['season'].'</option>';   
            echo $output; 
        } 
}
function episode_list_drop($imdb){
    global $post;
    $query  = get_mysqli("oc_posts WHERE active = 1 and type = 3 and imdb = '$imdb' and season = '".$post['season']."' group by episode ORDER BY id DESC");
        while ($row = mysqli_fetch_array($query)) { 
            $output = '<option value="/'.$row['guid'].'">Episode '.$row['episode'].'</option>';   
            echo $output; 
        } 
}
function related_tv($imdb){
    global $post;
    $RP_ID = "oc_posts WHERE active = 1 and type = 3 and imdb = '$imdb' and season = '".$post['season']."' and episode = '".$post['episode']."' ORDER BY picturequality DESC";
    $result = get_mysqli($RP_ID);
           $i = 1; 
              while ($RAT = mysqli_fetch_array($result)) { 
                  $output = '<tr id="tablemoviesindex2"><td height="20" width="120"><a href="/'.$RAT['guid'].'">Episode '.$RAT['episode'].'</a></td><td align="left" width="88"><a href="/'.$RAT['guid'].'"><img border="0" style="vertical-align:top;" src="/oc-content/themes/movie2k/images/hoster/'.strtolower($RAT['hoster']).'.png" alt="'.$RAT['hoster'].' '.$RAT['title'].'" title="'.$RAT['hoster'].' '.$RAT['title'].'" width="16"> '.$RAT['hoster'].'</td></tr>';   
                             echo "$output"; 
            $i++; 
    } 
    mysqli_free_result($result);
}

function EpisodePulldown($imdb){
    $RP_ID = "oc_posts WHERE active = 1 and type = 3 and imdb = '$imdb' ORDER BY picturequality DESC,hoster DESC";
    $RPQ  = get_mysqli($RP_ID);
           $i = 1; 
              while ($RAT = mysqli_fetch_array($RPQ)) { 
                  $output = "document.getElementById('episodediv".$RAT['episode']."').style.display='none';
                             document.forms.episodeform".$RAT['episode'].".episode.selectedIndex=0;";   
                             echo "$output"; 
            $i++; } 
}

function movie_permalink( $id, $title ){ 
    $pse    = get_bloginfo('permalink_structure'); 
    $custom = get_bloginfo('m2k_custom_permalink');

        if ($custom == '1'){       
            $guid = $id .'/'. $title . $pse; 
        } else {
            $guid = $title .'-'. $id . $pse; 
        }
    return $guid;
}

if($po) {
    $part = isset($_GET['part'])?$_GET['part'] : null;
if ($part==3) {
    $part1 = '/oc-content/themes/movie2k/images/part1_inactive.png';
    $part2 = '/oc-content/themes/movie2k/images/part2_inactive.png';
    $part3 = '/oc-content/themes/movie2k/images/part3_active.png';
} elseif ($part==2) {
    $part1 = '/oc-content/themes/movie2k/images/part1_inactive.png';
    $part2 = '/oc-content/themes/movie2k/images/part2_active.png';
    $part3 = '/oc-content/themes/movie2k/images/part3_inactive.png';
} elseif ($part==1) {
    $part1 = '/oc-content/themes/movie2k/images/part1_active.png';
    $part2 = '/oc-content/themes/movie2k/images/part2_inactive.png';
    $part3 = '/oc-content/themes/movie2k/images/part3_inactive.png';
} else {
    $part1 = '/oc-content/themes/movie2k/images/part1_active.png';
    $part2 = '/oc-content/themes/movie2k/images/part2_inactive.png';
    $part3 = '/oc-content/themes/movie2k/images/part3_inactive.png';
}

    if (!empty($post['url3'])) {
        $partembed = '<div style="float:left;padding-bottom:5px; padding-right:5px;"><a href="/post.php?po='.$post['id'].'&part=1"><img src="'.$part1.'" border="0"></a></div><div style="float:left;padding-bottom:5px; padding-right:5px;"><a href="/post.php?po='.$post['id'].'&part=2"><img src="'.$part2.'" border="0"></a></div><div style="float:left;padding-bottom:5px; padding-right:5px;"><a href="/post.php?po='.$post['id'].'&part=3"><img src="'.$part3.'" border="0"></a></div>';
    } elseif (!empty($post['url2'])) {
        $partembed = '<div style="float:left;padding-bottom:5px; padding-right:5px;"><a href="/post.php?po='.$post['id'].'&part=1"><img src="'.$part1.'" border="0"></a></div><div style="float:left;padding-bottom:5px; padding-right:5px;"><a href="/post.php?po='.$post['id'].'&part=2"><img src="'.$part2.'" border="0"></a></div>';
    } else {
        $partembed = '';
    }

    if ($part==1) {
        if (strpos($post['url'],'iframe') !== false){$embed = $post['url'];} else {$embed = '<a target="_blank" rel="nofollow" href="'.$post['url'].'"><img src="/oc-content/themes/movie2k/images/click_link.jpg" alt="view '.$post['title'].'" title="view '.$post['title'].'"></a>';}
    } elseif ($part==2){
        if (strpos($post['url2'],'iframe') !== false){$embed = $post['url2'];} else {$embed = '<a target="_blank" rel="nofollow" href="'.$post['url2'].'"><img src="/oc-content/themes/movie2k/images/click_link.jpg" alt="view '.$post['title'].'" title="view '.$post['title'].'"></a>';}
    } elseif ($part==3){
        if (strpos($post['url3'],'iframe') !== false){$embed = $post['url3'];} else {$embed = '<a target="_blank" rel="nofollow" href="'.$post['url3'].'"><img src="/oc-content/themes/movie2k/images/click_link.jpg" alt="view '.$post['title'].'" title="view '.$post['title'].'"></a>';}
    } else {
        if (strpos($post['url'],'iframe') !== false){$embed = $post['url'];}else{$embed = '<a target="_blank" rel="nofollow" href="'.$post['url'].'"><img src="/oc-content/themes/movie2k/images/click_link.jpg" alt="view '.$post['title'].'" title="view '.$post['title'].'"></a>';}
}


}
?>