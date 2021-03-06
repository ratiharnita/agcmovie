<?php 
$ip             = $_SERVER['REMOTE_ADDR']; 
$do             = isset($_GET['do'])?$_GET['do'] : null;
$id             = isset($_GET['id'])?$_GET['id'] : null;
$po             = isset($_GET['po'])?$_GET['po'] : null;
$s              = isset($_GET['s'])?$_GET['s'] : "";
$slug           = isset($_GET['slug'])?$_GET['slug'] : "";
$post_id        = isset($_GET['post'])?$_GET['post'] : null;
$page           = isset($_GET['page'])?$_GET['page'] : null;
$post_type      = isset($_GET['post_type'])?$_GET['post_type'] : null;
$type           = isset($_GET['type'])?$_GET['type'] : null;
$action         = isset($_GET['action'])?$_GET['action'] : null;
$post_status    = isset($_GET['post_status'])?$_GET['post_status'] : null;
$user_id        = isset($_GET['user_id'])?$_GET['user_id'] : null;
$role           = isset($_GET['role'])?$_GET['role'] : null;
$comment_status = isset($_GET['comment_status'])?$_GET['comment_status'] : null;
$theme          = isset($_GET['theme'])?$_GET['theme'] : null;
$plugin_status  = isset($_GET['plugin_status'])?$_GET['plugin_status'] : null;
$filename       = isset($_GET['filename'])?$_GET['filename'] : null;
$category_name  = isset($_GET['category_name'])?$_GET['category_name'] : null;

function protect($string) {
	 $protection = htmlspecialchars(trim($string), ENT_QUOTES);
	 return $protection;
}
function permalink($str, $delimiter = '-', $options = array()) {
         $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
  
         $defaults = array(
         'delimiter' => $delimiter,
         'limit' => null,
         'lowercase' => true,
         'replacements' => array(),
         'transliterate' => false,
         );
  
         $options = array_merge($defaults, $options);
  
    $char_map = array(
    // Latin
    'ÃƒÂ€' => 'A', 'ÃƒÂ' => 'A', 'ÃƒÂ‚' => 'A', 'ÃƒÂƒ' => 'A', 'ÃƒÂ„' => 'A', 'ÃƒÂ…' => 'A', 'ÃƒÂ†' => 'AE', 'ÃƒÂ‡' => 'C', 
    'ÃƒÂˆ' => 'E', 'ÃƒÂ‰' => 'E', 'ÃƒÂŠ' => 'E', 'ÃƒÂ‹' => 'E', 'ÃƒÂŒ' => 'I', 'ÃƒÂ' => 'I', 'ÃƒÂŽ' => 'I', 'ÃƒÂ' => 'I', 
    'ÃƒÂ' => 'D', 'ÃƒÂ‘' => 'N', 'ÃƒÂ’' => 'O', 'ÃƒÂ“' => 'O', 'ÃƒÂ”' => 'O', 'ÃƒÂ•' => 'O', 'ÃƒÂ–' => 'O', 'Ã…Â' => 'O', 
    'ÃƒÂ˜' => 'O', 'ÃƒÂ™' => 'U', 'ÃƒÂš' => 'U', 'ÃƒÂ›' => 'U', 'ÃƒÂœ' => 'U', 'Ã…Â°' => 'U', 'ÃƒÂ' => 'Y', 'ÃƒÂž' => 'TH', 
    'ÃƒÂŸ' => 'ss', 
    'Ãƒ ' => 'a', 'ÃƒÂ¡' => 'a', 'ÃƒÂ¢' => 'a', 'ÃƒÂ£' => 'a', 'ÃƒÂ¤' => 'a', 'ÃƒÂ¥' => 'a', 'ÃƒÂ¦' => 'ae', 'ÃƒÂ§' => 'c', 
    'ÃƒÂ¨' => 'e', 'ÃƒÂ©' => 'e', 'ÃƒÂª' => 'e', 'ÃƒÂ«' => 'e', 'ÃƒÂ¬' => 'i', 'ÃƒÂ­' => 'i', 'ÃƒÂ®' => 'i', 'ÃƒÂ¯' => 'i', 
    'ÃƒÂ°' => 'd', 'ÃƒÂ±' => 'n', 'ÃƒÂ²' => 'o', 'ÃƒÂ³' => 'o', 'ÃƒÂ´' => 'o', 'ÃƒÂµ' => 'o', 'ÃƒÂ¶' => 'o', 'Ã…Â‘' => 'o', 
    'ÃƒÂ¸' => 'o', 'ÃƒÂ¹' => 'u', 'ÃƒÂº' => 'u', 'ÃƒÂ»' => 'u', 'ÃƒÂ¼' => 'u', 'Ã…Â±' => 'u', 'ÃƒÂ½' => 'y', 'ÃƒÂ¾' => 'th', 
    'ÃƒÂ¿' => 'y',
 
    // Latin symbols
    'Ã‚Â©' => '(c)',
 
    // Greek
    'ÃŽÂ‘' => 'A', 'ÃŽÂ’' => 'B', 'ÃŽÂ“' => 'G', 'ÃŽÂ”' => 'D', 'ÃŽÂ•' => 'E', 'ÃŽÂ–' => 'Z', 'ÃŽÂ—' => 'H', 'ÃŽÂ˜' => '8',
    'ÃŽÂ™' => 'I', 'ÃŽÂš' => 'K', 'ÃŽÂ›' => 'L', 'ÃŽÂœ' => 'M', 'ÃŽÂ' => 'N', 'ÃŽÂž' => '3', 'ÃŽÂŸ' => 'O', 'ÃŽ ' => 'P',
    'ÃŽÂ¡' => 'R', 'ÃŽÂ£' => 'S', 'ÃŽÂ¤' => 'T', 'ÃŽÂ¥' => 'Y', 'ÃŽÂ¦' => 'F', 'ÃŽÂ§' => 'X', 'ÃŽÂ¨' => 'PS', 'ÃŽÂ©' => 'W',
    'ÃŽÂ†' => 'A', 'ÃŽÂˆ' => 'E', 'ÃŽÂŠ' => 'I', 'ÃŽÂŒ' => 'O', 'ÃŽÂŽ' => 'Y', 'ÃŽÂ‰' => 'H', 'ÃŽÂ' => 'W', 'ÃŽÂª' => 'I',
    'ÃŽÂ«' => 'Y',
    'ÃŽÂ±' => 'a', 'ÃŽÂ²' => 'b', 'ÃŽÂ³' => 'g', 'ÃŽÂ´' => 'd', 'ÃŽÂµ' => 'e', 'ÃŽÂ¶' => 'z', 'ÃŽÂ·' => 'h', 'ÃŽÂ¸' => '8',
    'ÃŽÂ¹' => 'i', 'ÃŽÂº' => 'k', 'ÃŽÂ»' => 'l', 'ÃŽÂ¼' => 'm', 'ÃŽÂ½' => 'n', 'ÃŽÂ¾' => '3', 'ÃŽÂ¿' => 'o', 'ÃÂ€' => 'p',
    'ÃÂ' => 'r', 'ÃÂƒ' => 's', 'ÃÂ„' => 't', 'ÃÂ…' => 'y', 'ÃÂ†' => 'f', 'ÃÂ‡' => 'x', 'ÃÂˆ' => 'ps', 'ÃÂ‰' => 'w',
    'ÃŽÂ¬' => 'a', 'ÃŽÂ­' => 'e', 'ÃŽÂ¯' => 'i', 'ÃÂŒ' => 'o', 'ÃÂ' => 'y', 'ÃŽÂ®' => 'h', 'ÃÂŽ' => 'w', 'ÃÂ‚' => 's',
    'ÃÂŠ' => 'i', 'ÃŽÂ°' => 'y', 'ÃÂ‹' => 'y', 'ÃŽÂ' => 'i',
 
    // Turkish
    'Ã…Âž' => 'S', 'Ã„Â°' => 'I', 'ÃƒÂ‡' => 'C', 'ÃƒÂœ' => 'U', 'ÃƒÂ–' => 'O', 'Ã„Âž' => 'G',
    'Ã…ÂŸ' => 's', 'Ã„Â±' => 'i', 'ÃƒÂ§' => 'c', 'ÃƒÂ¼' => 'u', 'ÃƒÂ¶' => 'o', 'Ã„ÂŸ' => 'g', 
 
    // Russian
    'ÃÂ' => 'A', 'ÃÂ‘' => 'B', 'ÃÂ’' => 'V', 'ÃÂ“' => 'G', 'ÃÂ”' => 'D', 'ÃÂ•' => 'E', 'ÃÂ' => 'Yo', 'ÃÂ–' => 'Zh',
    'ÃÂ—' => 'Z', 'ÃÂ˜' => 'I', 'ÃÂ™' => 'J', 'ÃÂš' => 'K', 'ÃÂ›' => 'L', 'ÃÂœ' => 'M', 'ÃÂ' => 'N', 'ÃÂž' => 'O',
    'ÃÂŸ' => 'P', 'Ã ' => 'R', 'ÃÂ¡' => 'S', 'ÃÂ¢' => 'T', 'ÃÂ£' => 'U', 'ÃÂ¤' => 'F', 'ÃÂ¥' => 'H', 'ÃÂ¦' => 'C',
    'ÃÂ§' => 'Ch', 'ÃÂ¨' => 'Sh', 'ÃÂ©' => 'Sh', 'ÃÂª' => '', 'ÃÂ«' => 'Y', 'ÃÂ¬' => '', 'ÃÂ­' => 'E', 'ÃÂ®' => 'Yu',
    'ÃÂ¯' => 'Ya',
    'ÃÂ°' => 'a', 'ÃÂ±' => 'b', 'ÃÂ²' => 'v', 'ÃÂ³' => 'g', 'ÃÂ´' => 'd', 'ÃÂµ' => 'e', 'Ã‘Â‘' => 'yo', 'ÃÂ¶' => 'zh',
    'ÃÂ·' => 'z', 'ÃÂ¸' => 'i', 'ÃÂ¹' => 'j', 'ÃÂº' => 'k', 'ÃÂ»' => 'l', 'ÃÂ¼' => 'm', 'ÃÂ½' => 'n', 'ÃÂ¾' => 'o',
    'ÃÂ¿' => 'p', 'Ã‘Â€' => 'r', 'Ã‘Â' => 's', 'Ã‘Â‚' => 't', 'Ã‘Âƒ' => 'u', 'Ã‘Â„' => 'f', 'Ã‘Â…' => 'h', 'Ã‘Â†' => 'c',
    'Ã‘Â‡' => 'ch', 'Ã‘Âˆ' => 'sh', 'Ã‘Â‰' => 'sh', 'Ã‘ÂŠ' => '', 'Ã‘Â‹' => 'y', 'Ã‘ÂŒ' => '', 'Ã‘Â' => 'e', 'Ã‘ÂŽ' => 'yu',
    'Ã‘Â' => 'ya',
 
    // Ukrainian
    'ÃÂ„' => 'Ye', 'ÃÂ†' => 'I', 'ÃÂ‡' => 'Yi', 'Ã’Â' => 'G',
    'Ã‘Â”' => 'ye', 'Ã‘Â–' => 'i', 'Ã‘Â—' => 'yi', 'Ã’Â‘' => 'g',
 
    // Czech
    'Ã„ÂŒ' => 'C', 'Ã„ÂŽ' => 'D', 'Ã„Âš' => 'E', 'Ã…Â‡' => 'N', 'Ã…Â˜' => 'R', 'Ã… ' => 'S', 'Ã…Â¤' => 'T', 'Ã…Â®' => 'U', 
    'Ã…Â½' => 'Z', 
    'Ã„Â' => 'c', 'Ã„Â' => 'd', 'Ã„Â›' => 'e', 'Ã…Âˆ' => 'n', 'Ã…Â™' => 'r', 'Ã…Â¡' => 's', 'Ã…Â¥' => 't', 'Ã…Â¯' => 'u',
    'Ã…Â¾' => 'z', 
 
    // Polish
    'Ã„Â„' => 'A', 'Ã„Â†' => 'C', 'Ã„Â˜' => 'e', 'Ã…Â' => 'L', 'Ã…Âƒ' => 'N', 'ÃƒÂ“' => 'o', 'Ã…Âš' => 'S', 'Ã…Â¹' => 'Z', 
    'Ã…Â»' => 'Z', 
    'Ã„Â…' => 'a', 'Ã„Â‡' => 'c', 'Ã„Â™' => 'e', 'Ã…Â‚' => 'l', 'Ã…Â„' => 'n', 'ÃƒÂ³' => 'o', 'Ã…Â›' => 's', 'Ã…Âº' => 'z',
    'Ã…Â¼' => 'z',
 
    // Latvian
    'Ã„Â€' => 'A', 'Ã„ÂŒ' => 'C', 'Ã„Â’' => 'E', 'Ã„Â¢' => 'G', 'Ã„Âª' => 'i', 'Ã„Â¶' => 'k', 'Ã„Â»' => 'L', 'Ã…Â…' => 'N', 
    'Ã… ' => 'S', 'Ã…Âª' => 'u', 'Ã…Â½' => 'Z',
    'Ã„Â' => 'a', 'Ã„Â' => 'c', 'Ã„Â“' => 'e', 'Ã„Â£' => 'g', 'Ã„Â«' => 'i', 'Ã„Â·' => 'k', 'Ã„Â¼' => 'l', 'Ã…Â†' => 'n',
    'Ã…Â¡' => 's', 'Ã…Â«' => 'u', 'Ã…Â¾' => 'z'
  );
  
  $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
  
  if ($options['transliterate']) {
    $str = str_replace(array_keys($char_map), $char_map, $str);
  }
  
  $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
  
  $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
  
  $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
  
  $str = trim($str, $options['delimiter']);
  
  return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function short($text, $len = 150, $more = '...') {
         $txt = ltrim(strip_tags($text));
         if (strlen($txt) > $len) {
         $text = substr($txt, 0, $len);
         $txt = substr($text, 0, strrpos($text, ' ')).$more;
         }
         return $txt;
}

function random_string($length = 10) {
         $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $randomString = '';
         for ($i = 0; $i < $length; $i++) {
                  $randomString .= $characters[rand(0, strlen($characters) - 1)];
         }
         return $randomString;
}
function escape($value){ 
        $db = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $value = isset($value)?$value : '';
        return mysqli_real_escape_string($db, $value); 
}
function custom_permalink( $title, $category = 1 ){ 
        $month  = date("Y/m");   
        $day    = date("Y/m/d");
        $posts  = get_mysqli_array("oc_posts ORDER BY id DESC LIMIT 1");
        $id     = $posts['id'] + 1;
        $terms  = get_mysqli_array("oc_terms WHERE id = '$category'");
        $custom = get_bloginfo('custom_permalink');
        $pse    = get_bloginfo('permalink_structure'); 
 
        if ($custom == '6'){     
              $guid = $id.'/'.$title.$pse; 
        } 
        elseif ($custom == '5'){
              $guid = $terms['slug'].'/'.$title.$pse; 
        }
        elseif ($custom == '4'){
              $guid = $month.'/'.$title.$pse; 
        }
         elseif ($custom == '3'){
              $guid = $day.'/'.$title.$pse; 
        }
        elseif ($custom == '2'){
              $guid = $title.$pse; 
        }
        elseif ($custom == '1'){
              $guid = 'p='.$id; 
        }
        else{
              $guid='p='.$id;
        } 

    return $guid;

}
function edit_permalink( $id, $title, $category = 1 ){ 
        $month  = date("Y/m");   
        $day    = date("Y/m/d");
        $terms  = get_mysqli_array("oc_terms WHERE id = '$category'");
        $custom = get_bloginfo('custom_permalink');
        $pse    = get_bloginfo('permalink_structure'); 
 
        if ($custom == '6'){     
              $guid = $id.'/'.$title.$pse; 
        } 
        elseif ($custom == '5'){
              $guid = $terms['slug'].'/'.$title.$pse; 
        }
        elseif ($custom == '4'){
              $guid = $month.'/'.$title.$pse; 
        }
         elseif ($custom == '3'){
              $guid = $day.'/'.$title.$pse; 
        }
        elseif ($custom == '2'){
              $guid = $title.$pse; 
        }
        elseif ($custom == '1'){
              $guid = 'p='.$id; 
        }
        else{
              $guid='p='.$id;
        } 

    return $guid;

}
function get_current_url($seo = true, $base_url = false){
       $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
       $sp = strtolower($_SERVER["SERVER_PROTOCOL"]);
       $protocol = substr($sp, 0, strpos($sp, "/")) . $s;
       $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
       if ($base_url){
             return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port;
       }
       if ( ! $seo){
             $url = $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['SCRIPT_NAME'];
             $url .= ($_SERVER['QUERY_STRING'] != '') ? '?'. $_SERVER['QUERY_STRING'] : '';
                     return rtrim($url, "?&");
        }
        return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . $_SERVER['REQUEST_URI'];
}

function get_home_url(){
        return get_current_url(false, true);
} 

function limit_word($string, $word_limit) {
        $words = explode(' ', $string);
        return implode(' ', array_slice($words, 0, $word_limit));
}  

function strposa($haystack, $needle, $offset=0) {
        if(is_array($needle)):
                foreach($needle as $query) {
                        if(!empty($query)):
                                if(strpos( (string) $haystack, $query, $offset) !== false) return true; // stop on first true result
                        endif;
                }
        endif;
        return false;
}

function multiexplode($delimiters,$string) {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
}

function get_date_from_gmt( $string, $format = 'Y-m-d H:i:s' ) {
        $tz = get_bloginfo( 'timezone_string' );
        if ( $tz ) {
                $datetime = date_create( $string, new DateTimeZone( 'UTC' ) );
                if ( ! $datetime )
                        return date( $format, 0 );
                $datetime->setTimezone( new DateTimeZone( $tz ) );
                $string_localtime = $datetime->format( $format );
        } else {
                if ( ! preg_match('#([0-9]{1,4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})#', $string, $matches) )
                        return date( $format, 0 );
                $string_time = gmmktime( $matches[4], $matches[5], $matches[6], $matches[2], $matches[3], $matches[1] );
                $string_localtime = gmdate( $format, $string_time + get_bloginfo( 'gmt_offset' ) * HOUR_IN_SECONDS );
        }
        return $string_localtime;
}

function strip_all_tags($string, $remove_breaks = false) {
        $string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
        $string = strip_tags($string);
        if ( $remove_breaks )
                $string = preg_replace('/[\r\n\t ]+/', ' ', $string);
        return trim( $string );
}

function get_domain($url){
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : '';
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
                return $regs['domain'];
        }
        return false;
}

function get_tld($url) {
        $url = trim($url);
        if (!preg_match('~^http://~i', $url))
                $url = "http://{$url}";
        $domain = parse_url($url, PHP_URL_HOST);
        $domain = preg_replace('~^www\.~', NULL, strtolower($domain));
        $parts = explode('.', $domain);
                return (count($parts) > 2) ? ".{$parts[1]}.{$parts[2]}" : '.' . end($parts);
}
function time_ago($date){
        if(empty($date)) {
                return "No date provided";
        }
        $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths         = array("60","60","24","7","4.35","12","10");
        $now             = time();
        $unix_date       = strtotime($date);
        if(empty($unix_date)) {    
                return "Bad date";
        }
        if($now > $unix_date) {    
                $difference   = $now - $unix_date;
                $tense        = "ago";
        
        } else {
                $difference   = $unix_date - $now;
                $tense        = "from now";
        }
        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
                $difference /= $lengths[$j];
        }
        $difference = round($difference);
        if($difference != 1) {
                $periods[$j].= "s";
        }
        return "$difference $periods[$j] {$tense}";
}

function oc_explode($string, $delimiter = "\n", $before = '<li>', $after = '</li>') {
        $words = explode( $delimiter , $string );
                $result = "";
                foreach($words as $k) {
                        $result .= $before.$k.$after;
                }
        return $result;
} 
function get_http_response($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
}
function is_images($url = null){
    $a = @getimagesize($url);
    $image_type = $a[2];
     
    if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
    {
           $url_parsed = parse_url($url); 
   extract($url_parsed); 
   if (!@$scheme) $url_parsed = parse_url('http://'.$url); 
   extract($url_parsed); 
   if(!@$port) $port = 80; 
   if(!@$path) $path = '/'; 
   if(@$query) $path .= '?'.$query; 
   $out = "HEAD $path HTTP/1.0\r\n"; 
   $out .= "Host: $host\r\n"; 
   $out .= "Connection: Close\r\n\r\n"; 
   if(!$fp = @fsockopen($host, $port, $es, $en, 5)){ 
       return false; 
   } 
   fwrite($fp, $out); 
   while (!feof($fp)) { 
       $s = fgets($fp, 128); 
       if(($followRedirects) && (preg_match('/^Location:/i', $s) != false)){ 
           fclose($fp); 
           return get_images(trim(preg_replace("/Location:/i", "", $s))); 
       } 
       if(preg_match('/^HTTP(.*?)200/i', $s)){ 
           fclose($fp); 
           return true; 
       } 
     } 
    fclose($fp); 
    }
    return false;
}
function get_images($url, $followRedirects = true) 
{ 
   $url_parsed = parse_url($url); 
   extract($url_parsed); 
   if (!@$scheme) $url_parsed = parse_url('http://'.$url); 
   extract($url_parsed); 
   if(!@$port) $port = 80; 
   if(!@$path) $path = '/'; 
   if(@$query) $path .= '?'.$query; 
   $out = "HEAD $path HTTP/1.0\r\n"; 
   $out .= "Host: $host\r\n"; 
   $out .= "Connection: Close\r\n\r\n"; 
   if(!$fp = @fsockopen($host, $port, $es, $en, 5)){ 
       return false; 
   } 
   fwrite($fp, $out); 
   while (!feof($fp)) { 
       $s = fgets($fp, 128); 
       if(($followRedirects) && (preg_match('/^Location:/i', $s) != false)){ 
           fclose($fp); 
           return get_images(trim(preg_replace("/Location:/i", "", $s))); 
       } 
       if(preg_match('/^HTTP(.*?)200/i', $s)){ 
           fclose($fp); 
           return true; 
       } 
   } 
   fclose($fp); 
   return false; 
} 
function numbercomma($input){
        if(strlen($input)<=3): 
                return $input;
        endif;
        $length=substr($input,0,strlen($input)-3);
        $formatted_input = numbercomma($length).",".substr($input,-3);
                return $formatted_input;
}
function my_str_split($string){
        $slen=strlen($string);
        for($i=0; $i<$slen; $i++)
        {
                $sArray[$i]=$string{$i};
        }
        return $sArray;
}
function noDiacritics($string){
      //cyrylic transcription
      $cyrylicFrom = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
      $cyrylicTo   = array('A', 'B', 'W', 'G', 'D', 'Ie', 'Io', 'Z', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Ch', 'C', 'Tch', 'Sh', 'Shtch', '', 'Y', '', 'E', 'Iu', 'Ia', 'a', 'b', 'w', 'g', 'd', 'ie', 'io', 'z', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'ch', 'c', 'tch', 'sh', 'shtch', '', 'y', '', 'e', 'iu', 'ia'); 
 
      
      $from = array("Á", "À", "Â", "Ä", "Ă", "Ā", "Ã", "Å", "Ą", "Æ", "Ć", "Ċ", "Ĉ", "Č", "Ç", "Ď", "Đ", "Ð", "É", "È", "Ė", "Ê", "Ë", "Ě", "Ē", "Ę", "Ə", "Ġ", "Ĝ", "Ğ", "Ģ", "á", "à", "â", "ä", "ă", "ā", "ã", "å", "ą", "æ", "ć", "ċ", "ĉ", "č", "ç", "ď", "đ", "ð", "é", "è", "ė", "ê", "ë", "ě", "ē", "ę", "ə", "ġ", "ĝ", "ğ", "ģ", "Ĥ", "Ħ", "I", "Í", "Ì", "İ", "Î", "Ï", "Ī", "Į", "Ĳ", "Ĵ", "Ķ", "Ļ", "Ł", "Ń", "Ň", "Ñ", "Ņ", "Ó", "Ò", "Ô", "Ö", "Õ", "Ő", "Ø", "Ơ", "Œ", "ĥ", "ħ", "ı", "í", "ì", "i", "î", "ï", "ī", "į", "ĳ", "ĵ", "ķ", "ļ", "ł", "ń", "ň", "ñ", "ņ", "ó", "ò", "ô", "ö", "õ", "ő", "ø", "ơ", "œ", "Ŕ", "Ř", "Ś", "Ŝ", "Š", "Ş", "Ť", "Ţ", "Þ", "Ú", "Ù", "Û", "Ü", "Ŭ", "Ū", "Ů", "Ų", "Ű", "Ư", "Ŵ", "Ý", "Ŷ", "Ÿ", "Ź", "Ż", "Ž", "ŕ", "ř", "ś", "ŝ", "š", "ş", "ß", "ť", "ţ", "þ", "ú", "ù", "û", "ü", "ŭ", "ū", "ů", "ų", "ű", "ư", "ŵ", "ý", "ŷ", "ÿ", "ź", "ż", "ž");
      $to   = array("A", "A", "A", "A", "A", "A", "A", "A", "A", "AE", "C", "C", "C", "C", "C", "D", "D", "D", "E", "E", "E", "E", "E", "E", "E", "E", "G", "G", "G", "G", "G", "a", "a", "a", "a", "a", "a", "a", "a", "a", "ae", "c", "c", "c", "c", "c", "d", "d", "d", "e", "e", "e", "e", "e", "e", "e", "e", "g", "g", "g", "g", "g", "H", "H", "I", "I", "I", "I", "I", "I", "I", "I", "IJ", "J", "K", "L", "L", "N", "N", "N", "N", "O", "O", "O", "O", "O", "O", "O", "O", "CE", "h", "h", "i", "i", "i", "i", "i", "i", "i", "i", "ij", "j", "k", "l", "l", "n", "n", "n", "n", "o", "o", "o", "o", "o", "o", "o", "o", "o", "R", "R", "S", "S", "S", "S", "T", "T", "T", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "W", "Y", "Y", "Y", "Z", "Z", "Z", "r", "r", "s", "s", "s", "s", "B", "t", "t", "b", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "w", "y", "y", "y", "z", "z", "z");
      
      
      $from = array_merge($from, $cyrylicFrom);
      $to   = array_merge($to, $cyrylicTo);
      
      $newstring=str_replace($from, $to, $string);   
      return $newstring;
}
function createslug($string, $slug='-', $maxlen=0){
      $newStringTab=array();
      $string=strtolower(noDiacritics($string));
      if(function_exists('str_split'))
      {
         $stringTab=str_split($string);
      }
      else
      {
         $stringTab=my_str_split($string);
      }

      $numbers=array("0","1","2","3","4","5","6","7","8","9","-");
      //$numbers=array("0","1","2","3","4","5","6","7","8","9");

      foreach($stringTab as $letter)
      {
         if(in_array($letter, range("a", "z")) || in_array($letter, $numbers))
         {
            $newStringTab[]=$letter;
            //print($letter);
         }
         elseif($letter==" ")
         {
            $newStringTab[]= "$slug";
         }
      }

      if(count($newStringTab))
      {
         $newString=implode($newStringTab);
         if($maxlen>0)
         {
            $newString=substr($newString, 0, $maxlen);
         }
         
         $newString = removeDuplicates('--', '-', $newString);
      }
      else
      {
         $newString='';
      }      
      
      return $newString;
}
function removeDuplicates($sSearch, $sReplace, $sSubject){
      $i=0;
      do{
      
         $sSubject=str_replace($sSearch, $sReplace, $sSubject);         
         $pos=strpos($sSubject, $sSearch);
         
         $i++;
         if($i>100)
         {
            die('removeDuplicates() loop error');
         }
         
      }while($pos!==false);
      
      return $sSubject;
}

function is_true($true = 'true'){
      if($true = 'true'){
            return true;
      } else {
            return false;
      }
}

function save_images($image,$value) {
      $file = @fopen($image,"rb");
      if($file){
            $directory = $_SERVER['DOCUMENT_ROOT'] . '/oc-content/uploads/images/';
            $valid_exts = array("jpg","jpeg","gif","png"); // default image only extensions
            $ext = end(explode(".",strtolower(basename($image))));
            if(in_array($ext,$valid_exts)){
                  $ImageExt  = substr($image, strrpos($image, '.')); 
                  $Random = rand(0, 99999);
                  $filename  = $value.'_'.$Random.$ImageExt;
                  $newfile   = fopen($directory . $filename, "wb");
                        if($newfile){
                              while(!feof($file)){
                              fwrite($newfile,fread($file,1024 * 5),1024 * 5); 
                              }
                         $images = '/oc-content/uploads/images/'.$filename;
                         return $images;
                        }
            }
      }
}
function get_contents($url) {
     if (function_exists('curl_exec')){ 
          $ch = curl_init();

          $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
          $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
          $header[] = "Cache-Control: max-age=0";
          $header[] = "Connection: keep-alive";
          $header[] = "Keep-Alive: 300";
          $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
          $header[] = "Accept-Language: en-us,en;q=0.5";
          $header[] = "Pragma: ";

          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_HEADER, 0);
          curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5 );
          curl_setopt($ch, CURLOPT_REFERER, "http://www.facebook.com");
          curl_setopt($ch, CURLOPT_AUTOREFERER, true);
          curl_setopt($ch, CURLOPT_TIMEOUT, 30);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/".rand(3,5).".".rand(0,3)." (Windows NT ".rand(3,5).".".rand(0,2)."; rv:2.0.1) Gecko/20100101 Firefox/".rand(3,5).".0.1");
          $url_get_contents_data = curl_exec($ch);
          curl_close($ch);
          if ($url_get_contents_data == false){
                      $ch = curl_init();
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                      curl_setopt($ch, CURLOPT_HEADER, 0);
                      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                      curl_setopt($ch, CURLOPT_URL, $url);
                      $url_get_contents_data = curl_exec($ch);
                      curl_close($ch);
          }
     }elseif(function_exists('file_get_contents')){
          $url_get_contents_data = @file_get_contents($url);
     }elseif(function_exists('fopen') && function_exists('stream_get_contents')){
          $handle = fopen ($url, "r");
          $url_get_contents_data = stream_get_contents($handle);
     }else{
          $url_get_contents_data = false;
     }
return $url_get_contents_data;
}
function isBot() {
        $bots = array("Indy", "Blaiz", "Java", "libwww-perl", "Python", "OutfoxBot", "User-Agent", "PycURL", "AlphaServer", "T8Abot", "Syntryx", "WinHttp", "WebBandit", "nicebot", "Teoma", "alexa", "froogle", "inktomi", "looksmart", "URL_Spider_SQL", "Firefly", "NationalDirectory", "Ask Jeeves", "TECNOSEEK", "InfoSeek", "WebFindBot", "girafabot", "crawler", "www.galaxy.com", "Googlebot", "Scooter", "Slurp", "appie", "FAST", "WebBug", "Spade", "ZyBorg", "rabaz");

        foreach ($bots as $bot)
        if (stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false)
                return true;
        if (empty($_SERVER['HTTP_USER_AGENT']) || $_SERVER['HTTP_USER_AGENT'] == " ")
                return true;
  
        return false;
}