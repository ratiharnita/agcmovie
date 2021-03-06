<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/oc-load.php');
$date=date("r");
$rssquery = get_mysqli( "oc_posts WHERE active=1 and type = 3 group by imdb ORDER BY id DESC LIMIT 10" );
for ($i = 0; $row = mysqli_fetch_array($rssquery); $i++)
{
    $the_rss[$i]['id'] = $row['id'];
    $the_rss[$i]['title'] = $row['title'];
    $the_rss[$i]['date'] = $row['pubdate'];
    $the_rss[$i]['name'] = strtolower($row['name']);
    $the_rss[$i]['description'] = short($row['description'],'200');
    $the_rss[$i]['permalink'] = get_home_url().'/'.$row['guid'];
}

header("Content-type: text/xml");

echo'<?xml version="1.0"?>
<rss version="2.0"
xmlns:content="http://purl.org/rss/1.0/modules/content/"
xmlns:wfw="http://wellformedweb.org/CommentAPI/"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<title>'.get_bloginfo('name').'</title>
<atom:link href="'.get_bloginfo('url').'/page/rss" rel="self" type="application/rss+xml" />
<link>'.get_bloginfo('url').'</link>
<description>'.preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', get_bloginfo('description')).'</description>
<lastBuildDate>'.$date.'</lastBuildDate>';
?>

<?php if(empty($the_rss)) {
    echo '<item>Sorry, No posts found.</item>';
} else { foreach($the_rss as $rss): ?>
<item>
<title><?php echo preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $rss['title']);?></title>
<link><?php echo $rss['permalink'];?></link>
<description><?php echo preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $rss['description']);?></description>
<guid><?php echo $rss['permalink'];?></guid>  
<pubDate><?php echo $rss['date'];?></pubDate>
</item>
<?php endforeach; } ;?>
<?php 
echo "</channel>";
echo "</rss>";
?>