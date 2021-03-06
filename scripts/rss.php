<?php
require( dirname( __FILE__ ) . '/oc-load.php' );

$limits      = get_bloginfo('posts_per_rss');  
date_default_timezone_set(get_bloginfo('timezone_string'));
$rssquery    = get_mysqli("oc_posts WHERE active = 1 and type NOT IN ('2') ORDER BY id DESC LIMIT $limits");

header("Content-type: text/xml");

echo'<?xml version="1.0"?>
<rss xmlns:content="http://purl.org/rss/1.0/modules/content/"
xmlns:wfw="http://wellformedweb.org/CommentAPI/"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" version="2.0">
<channel>
<title>'.get_bloginfo('name').'</title>
<atom:link href="'.get_bloginfo('url').'/rss.php" rel="self" type="application/rss+xml" />
<link>'.get_bloginfo('url').'</link>
<description>'.preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', get_bloginfo('description')).'</description>
<lastBuildDate>'.date("r").'</lastBuildDate>';
?>

<?php if(empty($rssquery)) {echo '<item>Sorry, No posts found.</item>';} else { foreach($rssquery as $rss): ?>
<item>
<title><?php echo ucwords(permalink($rss['title'], ' '));?></title>
<link><?php echo get_bloginfo('url').'/'.$rss['guid'];?></link>
<description><?php echo permalink(short($rss['description'],150,'...'), ' ');?></description>
<guid><?php echo get_bloginfo('url').'/'.$rss['guid'];?></guid>  
<pubDate><?php echo date('r', strtotime($rss['pubdate']));?></pubDate>
</item>
<?php endforeach; } ;?>
<?php 
echo "</channel>";
echo "</rss>";
?>