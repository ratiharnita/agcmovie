<?php include(THEMES.'header.php');
$query = get_mysqli("oc_posts where active = 1 and type = 4 group by title ORDER BY pubdate DESC limit 50");
for ($i = 0; $row = mysqli_fetch_array($query); $i++)
{
    $the_updates[$i]['id'] = $row['id'];
    $the_updates[$i]['title'] = $row['title'];
    $the_updates[$i]['date'] = $row['pubdate'];
    $the_updates[$i]['thumbnail'] = $row['images'];
    $the_updates[$i]['permalink'] = '/'.$row['guid']; 
    $the_updates[$i]['hoster'] = $row['hoster'];
    $the_updates[$i]['picturequality'] = $row['picturequality'];
    $the_updates[$i]['duration'] = $row['duration'];
    $the_updates[$i]['rating'] = $row['rating'];
    $the_updates[$i]['language'] = $row['language'];
    $quality = $row['picturequality'];
    if ($quality==0) {$quality='0';} elseif ($quality==1){$quality='1';} elseif ($quality==2){$quality='2';} elseif ($quality==3){$quality='3';} elseif ($quality==4){$quality='4';} elseif ($quality==5){$quality='5';}else {$quality='0';}
}
?>
<?php if (isset($_COOKIE["xxx"])){?>
<div id="tdmoviesheader"><span style="padding-left: 5px; font-weight: bold;"> Featured movies</span><span style="padding-left: 150px; font-weight: bold;">Latest Updates</span> <span style="padding-left: 370px; font-weight: bold;">Featured movies</span></div>

<div id="menu">
<?php include(THEMES.'index/xxx-left.php');?>
</div><!--end menu-->

<div id="maincontent">
    <div id="maincontentnew">
    <table id="tablemoviesindex">
        <tbody>
        <?php if (empty($the_updates)) { echo 'No movie submited yet';} else { foreach($the_updates as $updates): ?>
            <tr id="coverPreview<?php echo $updates['id']?>">
                <td id="tdmovies" width="380"><a href="<?php echo $updates['permalink'];?>"><?php echo $updates['title']?></a></td>
                <td id="tdmovies"><a href="<?php echo $updates['permalink']?>"><img src="/oc-content/themes/movie2k/images/hoster/<?php echo strtolower($updates['hoster']);?>.png" width="16" border="0"></a></td>
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
        </tbody>
    </table>
    </div>
</div>

<div id="maincontent2">
<?php include(THEMES.'index/xxx-right.php');?>
</div><!--end maincontent2-->

<?php
} else {header("location:/page/xxxcheck");}
?>
<?php include(THEMES.'footer.php');?>