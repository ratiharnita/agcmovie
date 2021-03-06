<?php include(THEMES.'header.php');
$indexquery = get_mysqli( "oc_posts where active = 1 and type = 3 ORDER BY pubdate DESC limit 50" );
for ($i = 0; $row = mysqli_fetch_array($indexquery); $i++)
{
    $the_updates[$i]['id'] = $row['id'];
    $the_updates[$i]['title'] = $row['title'];
    $the_updates[$i]['date'] = $row['pubdate'];
    $the_updates[$i]['hoster'] = $row['hoster'];
    $the_updates[$i]['guid'] = $row['guid'];
    $the_updates[$i]['season'] = $row['season'];
    $the_updates[$i]['episode'] = $row['episode'];
    $the_updates[$i]['language'] = $row['language'];
    $the_updates[$i]['quality'] = $row['picturequality'];
}
?>
<div id="tdmoviesheader" style="margin-bottom:0px;"><span style="padding-left: 5px; font-weight: bold;">Title</span><span style="padding-left: 517px; font-weight: bold;">Hoster</span> <span style="padding-left: 138px; font-weight: bold;">Q.</span><span style="padding-left: 17px; font-weight: bold;">Date (GMT +1) </span><span style="padding-left:82px; font-weight: bold;">L.</span></div>
<div id="maincontent4">
<table id="tablemoviesindex"><tbody>
<?php if (empty($the_updates)) { echo '<div class="post">Sorry, No posts found.</div>';} else { foreach($the_updates as $updates): ?>
<tr id="coverPreview<?php echo $updates['id']?>">
  <td width="538" id="tdmovies">
   <a href="/<?php echo $updates['guid'];?>"><?php echo $updates['title']?> , Season: <?php echo $updates['season'];?> , Episode: <?php echo $updates['episode'];?></a>
  </td>
  <td width="185" id="tdmovies">
      <img src="/oc-content/themes/movie2k/images/hoster/<?php echo strtolower($updates['hoster']);?>.png" width="16" style="vertical-align:middle;" border="0"> watch on <?php echo $updates['hoster']?>
  </td>
  <td width="25" id="tdmovies"><img src="/oc-content/themes/movie2k/images/<?php echo $updates['quality'];?>.gif" border="0"></td>
  <td width="175" id="tdmovies">
   <?php echo date('m/d/Y h:i a', strtotime($updates['date']));?>
  </td>
  <td id="tdmovies"><img border="0" src="/oc-content/themes/movie2k/images/flag/<?php echo strtolower($updates['language']);?>.png" width="24" height="14"></td>
</tr>
<?php endforeach; }?>

</tbody></table>
    </div>
<?php include(THEMES.'footer.php');?>