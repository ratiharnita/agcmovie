<?php include(THEMES.'header.php');
$sutradara = permalink($id,' ');
$indexquery = get_mysqli("oc_posts where active = 1 and type = 1 and director like '%$sutradara%' GROUP BY imdb ORDER BY pubdate DESC limit 50");
for ($i = 0; $row = mysqli_fetch_array($indexquery); $i++)
{
    $the_updates[$i]['id'] = $row['id'];
    $the_updates[$i]['title'] = $row['title'];
    $the_updates[$i]['date'] = $row['pubdate'];
    $the_updates[$i]['name'] = strtolower($row['user']);
    $the_updates[$i]['url'] = $row['url'];
    $the_updates[$i]['info'] = $row['type'];
    $the_updates[$i]['thumbnail'] = $row['images'];
    $the_updates[$i]['permalink'] = '/'.$row['guid'];
    $the_updates[$i]['hoster'] = $row['hoster'];
    $the_updates[$i]['picturequality'] = $row['picturequality'];
    $the_updates[$i]['duration'] = $row['duration'];
    $the_updates[$i]['director'] = $row['director'];
    $the_updates[$i]['actors'] = $row['actors'];
    $the_updates[$i]['rating'] = $row['rating'];
    $the_updates[$i]['language'] = $row['language'];
    $quality = $row['picturequality'];
if ($quality==0) {$quality='0';} elseif ($quality==1){$quality='1';} elseif ($quality==2){$quality='2';} elseif ($quality==3){$quality='3';} elseif ($quality==4){$quality='4';} elseif ($quality==5){$quality='5';}else {$quality='0';}
}
?>
<div id="tdmoviesheader" style="margin-bottom:0px;"><span style="padding-left: 5px; font-weight: bold;">Title</span><span style="padding-left: 530px; font-weight: bold;">Hoster</span>  <span style="padding-left: 145px; font-weight: bold;">Q.</span><span style="padding-left: 17px; font-weight: bold;"><a href="movies.php?list=updates&amp;start=&amp;id=&amp;order=imdbrating&amp;name=&amp;search=" style="font-size:14px;">IMDB Rating</a></span><span style="padding-left:32px; font-weight: bold;">Lang.</span></div>
<div id="maincontent4">
<table id="tablemoviesindex"><tbody>
<?php if (empty($the_updates)) { echo '<div class="post">Sorry, No movie found.</div>';} else { foreach($the_updates as $updates): ?>
<tr id="coverPreview<?php echo $updates['id'];?>">
  <td width="550" id="tdmovies">
   <a href="<?php echo $updates['permalink'];?>"><?php echo $updates['title'];?></a>
  </td>
  <td width="185" id="tdmovies">
    <a href="<?php echo $updates['permalink'];?>">
      <img src="/oc-content/themes/movie2k/images/hoster/<?php echo strtolower($updates['hoster']);?>.png" width="16" style="vertical-align:middle;" border="0"> watch on <?php echo $updates['hoster'];?></a>
  </td>
  <td width="25" id="tdmovies">
      <img src="/oc-content/themes/movie2k/images/<?php echo $quality;?>.gif" border="0"></td>
  <td id="tdmovies" width="114">&nbsp;&nbsp;&nbsp;<strong><?php echo $updates['rating'];?></strong> / 10</td>
  <td align="right" id="tdmovies" width="25"><img border="0" src="/oc-content/themes/movie2k/images/flag/<?php echo strtolower($updates['language']);?>.png" width="24" height="14"></td>
</tr>
<script type="text/javascript">
        $(document).ready(function(){
                $("#coverPreview<?php echo $updates['id'];?>").hover(function(e){
                $("body").append("<?php if (!empty($updates['thumbnail'])) {?><p id='coverPreview'><img src='<?php echo $updates['thumbnail'];?>' alt='Image preview' width=105 /></p><?php } else {};?>");  
            $("#coverPreview").css("top",(e.pageY) + "px").css("left",(e.pageX) + "px").fadeIn("fast");            
                $("#coverPreview<?php echo $updates['id'];?>").mousemove(function(e){ $("#coverPreview").css("top",(e.pageY) + "px").css("left",(e.pageX) + "px"); });  
            }, function() { $("#coverPreview").remove(); });
                    
                });
    </script>
<?php endforeach; }?>

</tbody></table>
    </div>
<?php include(THEMES.'footer.php');?>