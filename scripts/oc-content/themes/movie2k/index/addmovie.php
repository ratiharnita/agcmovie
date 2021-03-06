<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/oc-load.php');
include_once('imdb.php');
$UploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/oc-content/uploads/images/';
$imdb = new Imdb();

if (!@file_exists($UploadDirectory)) {
  //destination folder does not exist
  die("Make sure Upload directory exist!");
}
if($_POST){  
        $db     = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if(!isset($_POST['title']) || strlen($_POST['title'])<1)
        {
                die("<div class='error'>Your title empty, Use always the movie title which is used on IMDB.com!</div>");
        }
        if($_POST['hoster1'] == "" )
        {
                die("<div class='error'>Choose Hoster!</div>"); 
        } 
        if($_POST['language'] == "" )
        {
                die("<div class='error'>Choose language!</div>"); 
        } else {
           $language = isset($_POST['language'])?$_POST['language']:"";
        }
        $xxx = isset($_POST['xxx'])?$_POST['xxx']:""; 

        if(isset($_POST['xxx'])) {
        if(!isset($_POST['description']) || strlen($_POST['description'])<1)
        {
               die("<div class='error'>Please insert movie description.</div>");
        }
        if($_POST['genre1xxx'] == "" )
        {
                die("<div class='error'>Choose Genre</div>"); 
        } 
        } else {
        if($_POST['genre1'] == "" )
        {
                die("<div class='error'>Choose Genre</div>"); 
        } 
        if(!isset($_POST['imdb']) || strlen($_POST['imdb'])<1)
        {
               die("<div class='error'>Please insert the IMDB ID of this movie! (http://www.imdb.com) (Format: 0123456)</div>");
        }
        }
    $next = isset($_POST['uid'])?$_POST['uid']:"";
    $next2 = isset($_POST['uid2'])?$_POST['uid2']:"";
    $next3 = isset($_POST['uid3'])?$_POST['uid3']:"";
    $next4 = isset($_POST['uid4'])?$_POST['uid4']:"";
    $next5 = isset($_POST['uid5'])?$_POST['uid5']:"";

    $hoster1 = escape($_POST['hoster1']);
    $hoster2 = escape($_POST['hoster2']);
    $hoster3 = escape($_POST['hoster3']);
    $hoster4 = escape($_POST['hoster4']);
    $hoster5 = escape($_POST['hoster5']);
    $title   = escape($_POST['title']);
 //   $imdblink = escape($_POST['imdb']);
    $imdblink = $_POST['imdb'];
    $imdbid = basename(parse_url($imdblink, PHP_URL_PATH));
    $imdbuser = 'http://www.imdb.com/title/'.$imdbid.'/';
    $movieArray = $imdb->getMovieInfoById($imdbid);

    $descriptions = escape($_POST['description']);
    if (empty($descriptions)) {$description = $movieArray['plot'];} else {$description = $descriptions;}

    $hosterlink = escape($_POST['hosterlink']);
    $hosterembed = escape($_POST['hosterembed']);
  if (empty($hosterembed)) {$hosters = $hosterlink;} else {$hosters = $hosterembed;}
  if (empty($hosterembed)) {$season = '1';} else {$season = '2';}
    $part1_1 = escape($_POST['part1_1']);
    $part1_2 = escape($_POST['part1_2']);
    $part1_3 = escape($_POST['part1_3']);
    $part2_1 = escape($_POST['part2_1']);
    $part2_2 = escape($_POST['part2_2']);
    $part2_3 = escape($_POST['part2_3']);
    $part3_1 = escape($_POST['part3_1']);
    $part3_2 = escape($_POST['part3_2']);
    $part3_3 = escape($_POST['part3_3']);
    $part4_1 = escape($_POST['part4_1']);
    $part4_2 = escape($_POST['part4_2']);
    $part4_3 = escape($_POST['part4_3']);
    $part5_1 = escape($_POST['part5_1']);
    $part5_2 = escape($_POST['part5_2']);
    $part5_3 = escape($_POST['part5_3']);

    $picturequality = isset($_POST['picturequality'])?$_POST['picturequality']:"";
    $durations = escape($_POST['duration']);
    $years = escape($_POST['year']);
    $countri = escape($_POST['country']);
    $director = escape($_POST['director']);
    $actors = escape($_POST['actors']);
    $rating = $movieArray['rating'];

    $movieArraycast = array($movieArray['cast']);
    foreach ($movieArraycast as $key_cast => $cast) {$cast = is_array($cast)?implode(", ", $cast):$cast;}
    $movieArraydirectors = array($movieArray['directors']);
    foreach ($movieArraydirectors as $key_directors => $directors) {$directors = is_array($directors)?implode(", ", $directors):$directors;}
    $movieArraywriters = array($movieArray['writers']);
    foreach ($movieArraywriters as $key_writers => $writers) {$writers = is_array($writers)?implode(", ", $writers):$writers;}

  if (empty($durations)) {$duration = $movieArray['runtime'];} else {$duration = $durations;}
  if (empty($years)) {$year = $movieArray['year'];} else {$year = $years;}
  if (empty($countri)) {$country = $movieArraycountry = array($movieArray['country']);foreach ($movieArraycountry as $key_country => $country) {$country = is_array($country)?implode(", ", $country):$country;}} else {$country = $countri;}
  if (empty($director)) {$regie = $directors.', '.$writers;} else {$regie = $director;}
      if(isset($_POST['xxx'])) { if (empty($actors)) {$actor = 'N/A';} else {$actor = $actors;}
  } else {
  if (empty($actors)) {$actor = $cast;} else {$actor = $actors;}
  }

  $names = escape($_POST['user_post']);
  $genre1 = isset($_POST['genre1'])?$_POST['genre1']:"";
  $genre2 = isset($_POST['genre2'])?$_POST['genre2']:"";
  $genre3 = isset($_POST['genre3'])?$_POST['genre3']:"";  
  $genre1xxx = isset($_POST['genre1xxx'])?$_POST['genre1xxx']:"";
  $genre2xxx = isset($_POST['genre2xxx'])?$_POST['genre2xxx']:"";
  $genre3xxx = isset($_POST['genre3xxx'])?$_POST['genre3xxx']:"";   
  
  if (!empty($genre1)) {$category1=$genre1; $category2=$genre2; $category3=$genre3;} elseif (!empty($genre1xxx)) {$category1=$genre1xxx; $category2=$genre2xxx; $category3=$genre3xxx;} else {$category1='1'; $category2=''; $category3='';}

  if (!empty($genre1xxx)) {$type = 4;} else {$type = 1;}

    $checkmovie = get_mysqli("oc_posts WHERE user = '$names' and url = '$part1_1' and picturequality = '$picturequality'");

if (mysqli_num_rows($checkmovie) > 0) {
    die("<div class='error'>Already added, Please refresh the page</div>");
}

    $pubdate = date("Y-m-d H:i:s");
    $newtitle = limit_word($title, 10);
    $permalink = permalink($newtitle);  

    $guid1 = movie_permalink($next, $permalink);
    $guid2 = movie_permalink($next2, $permalink);
    $guid3 = movie_permalink($next3, $permalink);
    $guid4 = movie_permalink($next4, $permalink);
    $guid5 = movie_permalink($next5, $permalink);

    $Random = rand(0, 99999);
    $FileName = strtolower($_FILES['thumbnailfile']['name']);
    $ImageExt = substr($FileName, strrpos($FileName, '.'));
    $FileType = $_FILES['thumbnailfile']['type'];
    $FileSize = $_FILES['thumbnailfile']["size"];

    $thumbnaillink = escape($_POST['thumbnaillink']);

if (!empty($FileName)) {
  switch(strtolower($FileType))
  {
    case 'image/jpeg': //jpeg file
    case 'image/jpg': //jpeg file
      break;
    default:
      die('<div class="alert alert-danger">Unsupported File Images!</div>');
  }
  $thumb1 = '/cover-'.$next.$Random.'_'.$permalink.$ImageExt;
   if(move_uploaded_file($_FILES['thumbnailfile']["tmp_name"], $UploadDirectory . $thumb1))
   {
  $image1 = '/oc-content/uploads/images/cover-'.$next.$Random.'_'.$permalink.$ImageExt;
   } else { die('<div class="alert alert-danger">There seems to be a problem. please try again.</div>');}

} elseif (!empty($thumbnaillink)) {

$url = trim($_POST["thumbnaillink"]);
if($url){
$file = fopen($url,"rb");
if($file){
$directory = $_SERVER['DOCUMENT_ROOT'] . '/oc-content/uploads/images/';
$valid_exts = array("jpg","jpeg"); // default image only extensions
$ext = end(explode(".",strtolower(basename($url))));
if(in_array($ext,$valid_exts)){

$ImageExt  = substr($url, strrpos($url, '.')); 
$filename = 'cover-'.$next.$Random.'_'.$permalink.$ImageExt;
$newfile = fopen($directory . $filename, "wb");
if($newfile){
while(!feof($file)){
fwrite($newfile,fread($file,1024 * 3),1024 * 3); 
}
$folder_upload = '/oc-content/uploads/images/';
$image2 = $folder_upload.$filename;
$thumb2 = $filename;
} 
}else{ die('<div class="error">Only GIF,JPG,JPEG,PNG</div>');
}
} 
} 

} else {

$imdbposterurl = $movieArray['poster'];
if($imdbposterurl){
$file = fopen($imdbposterurl,"rb");
if($file){
$directory = $_SERVER['DOCUMENT_ROOT'] . '/oc-content/uploads/images/';
$valid_exts = array("jpg","jpeg"); // default image only extensions
$ext = end(explode(".",strtolower(basename($imdbposterurl))));
if(in_array($ext,$valid_exts)){

$ImageExt  = substr($imdbposterurl, strrpos($imdbposterurl, '.')); 
$filename = 'cover-'.$next.$Random.'_'.$permalink.$ImageExt;
$newfile = fopen($directory . $filename, "wb");
if($newfile){
while(!feof($file)){
fwrite($newfile,fread($file,1024 * 3),1024 * 3); 
}
$folder_upload = '/oc-content/uploads/images/';
$image2 = $folder_upload.$filename;
$thumb2 = $filename;
} 
}else{ die('<div class="error">Only GIF,JPG,JPEG,PNG</div>');
}
} 
} 
}

$active = get_bloginfo('posts_default');

if (empty($image1)) {$image = $image2;} else {$image = $image1;} 
if (empty($thumb1)) {$thumb = $thumb2;} else {$thumb = $thumb1;}

    mysqli_query( $db, "INSERT INTO oc_posts (title, description, images, pubdate, active, type, terms, terms2, terms3, user, permalink, guid, hoster, picturequality, imdb, duration, country, year, director, actors, rating, season, language, url, url2, url3) VALUES ('$title', '$description', '$image', '$pubdate', '$active', '$type', '$category1', '$category2', '$category3', '$names', '$permalink', '$guid1', '$hoster1', '$picturequality', '$imdbuser', '$duration', '$country', '$year', '$regie', '$actor', '$rating', '$season', '$language', '$part1_1', '$part1_2', '$part1_3')" ) or die (mysqli_error($db));

if (!empty($part2_1)) 
{
    mysqli_query( $db, "INSERT INTO oc_posts  (title, description, images, pubdate, active, type, terms, terms2, terms3, user, permalink, guid, hoster, picturequality, imdb, duration, country, year, director, actors, rating, season, language, url, url2, url3) VALUES ('$title', '$description', '$image', '$pubdate', '$active', '$type', '$category1', '$category2', '$category3', '$names', '$permalink', '$guid2', '$hoster2', '$picturequality', '$imdbuser', '$duration', '$country', '$year', '$regie', '$actor', '$rating', '$season', '$language', '$part2_1', '$part2_2', '$part2_3')" ) or die (mysqli_error($db));
}

if (!empty($part3_1)) 
{
    mysqli_query( $db, "INSERT INTO oc_posts  (title, description, images, pubdate, active, type, terms, terms2, terms3, user, permalink, guid, hoster, picturequality, imdb, duration, country, year, director, actors, rating, season, language, url, url2, url3) VALUES ('$title', '$description', '$image', '$pubdate', '$active', '$type', '$category1', '$category2', '$category3', '$names', '$permalink', '$guid3', '$hoster3', '$picturequality', '$imdbuser', '$duration', '$country', '$year', '$regie', '$actor', '$rating', '$season', '$language', '$part3_1', '$part3_2', '$part3_3')" ) or die (mysqli_error($db));
}
if (!empty($part4_1)) 
{
    mysqli_query( $db, "INSERT INTO oc_posts  (title, description, images, pubdate, active, type, terms, terms2, terms3, user, permalink, guid, hoster, picturequality, imdb, duration, country, year, director, actors, rating, season, language, url, url2, url3) VALUES ('$title', '$description', '$image', '$pubdate', '$active', '$type', '$category1', '$category2', '$category3', '$names', '$permalink', '$guid4', '$hoster4', '$picturequality', '$imdbuser', '$duration', '$country', '$year', '$regie', '$actor', '$rating', '$season', '$language', '$part4_1', '$part4_2', '$part4_3')" ) or die (mysqli_error($db));
}
if (!empty($part5_1)) 
{
    mysqli_query( $db, "INSERT INTO oc_posts  (title, description, images, pubdate, active, type, terms, terms2, terms3, user, permalink, guid, hoster, picturequality, imdb, duration, country, year, director, actors, rating, season, language, url, url2, url3) VALUES ('$title', '$description', '$image', '$pubdate', '$active', '$type', '$category1', '$category2', '$category3', '$names', '$permalink', '$guid5', '$hoster5', '$picturequality', '$imdbuser', '$duration', '$country', '$year', '$regie', '$actor', '$rating', '$season', '$language', '$part5_1', '$part5_2', '$part5_3')" ) or die (mysqli_error($db));
}

        echo '<script type="text/javascript">function leave() {window.location = "/page/add-tvshow";}setTimeout("leave()", 1000);</script><div class="error">Thank you! The movie was added and will appear on this webpage after a short inspection!</div>';
mysqli_close($db);
}
?>